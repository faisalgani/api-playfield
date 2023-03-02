<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\M_room;

class C_room extends Controller
{

    public function get_room(Request $request){
        $response = array();
        $name = $request->query('roomName');
        if($name == null){
            $query = M_room::where('active','=',1)->orderBy('room_name','ASC')->get();
        }else{
            $query = M_room::where('active','=',1)->where('room_name','like','%'.$name.'%')->orderBy('room_name','ASC')->get();
        }
      
        if(count($query) > 0){
            $response['metadata']['message']='success';
            $response['metadata']['code']=200;
            $response['data'] = $query;
        }else{
            $response['metadata']['message']='failed data not found';
            $response['metadata']['code']=400;
        }
        return response()->json($response);
    }

    public function get_detail_room(Request $request){
        $response = array();
        $id = $request->query('id');
        if($id == '' || $id == null){
            $response['metadata']['message']='id cannot be null';
            $response['metadata']['code']=400;
        }else{
            $query = M_room::with('room_to_gallery')->where('id','=',$id)->get();
            if(count($query) > 0){
                $response['metadata']['message']='success';
                $response['metadata']['code']=200;
                $response['data'] = $query;
            }else{
                $response['metadata']['message']='failed data not found';
                $response['metadata']['code']=400;
            }
        }
      
        return response()->json($response);
    }

    public function get_room_schedule(Request $request){
        $response = array();
        $id = $request->query('id');
        $date = $request->query('date');
        if($id == '' || $date == null){
            $response['metadata']['message']='id or date cannot be null';
            $response['metadata']['code']=400; 
        }else{
            $query = DB::select("SELECT a.id,a.room_id,a.start_time,a.end_time,CASE WHEN EXISTS (
                SELECT id FROM room_booking_detail b WHERE b.room_schedule_id=a.id AND b.date_booked='".$date."') THEN 1 ELSE 0 END AS is_booked 
                FROM room_schedule a INNER JOIN room c ON c.id=a.room_id WHERE a.room_id='".$id."' AND c.active=1");
            if(count($query) > 0){
                $response['metadata']['message']='success';
                $response['metadata']['code']=200;
                $response['data'] = $query;
            }else{
                $response['metadata']['message']='failed data not found';
                $response['metadata']['code']=400;
            }
        }
        return response()->json($response);
    }

    public function booked_room(Request $request){
        $response = array();
        $params = $request->all();
        DB::beginTransaction();
        $memberName = DB::select("SELECT first_name,last_name FROM member WHERE id ='". $params['member_id']."'");
        $booking_code = $this->get_order_code();
        $data['member_id'] = $params['member_id'];
        $data['booking_code'] = $booking_code;
        $data['created_at'] = date("Y-m-d H:i:s");
        $data['created_by'] = $memberName[0]->first_name.' '.$memberName[0]->last_name;
        $save_booking = DB::table('room_booking')->insertGetId($data);
        if($save_booking){
            DB::commit();
            $saveDetail['booked_id'] = $save_booking;
            $saveDetail['room_schedule_id'] = $params['room_schedule_id'];
            $saveDetail['time_booked'] = $params['time_booked'];
            $saveDetail['date_booked'] = $params['date_booked'];
            $save_detail_booking = DB::table('room_booking_detail')->insertGetId($saveDetail);
            if($save_detail_booking){
                DB::commit();
                $response['metadata']['message']='booked';
                $response['metadata']['code']=200;
                $response['booking_code']=$booking_code;
            }else{
                DB::rollBack();
                $response['metadata']['message']='save failed !';
                $response['metadata']['code']=400;
            }

        }else{
            DB::rollBack();
            $response['metadata']['message']='save failed !';
            $response['metadata']['code']=400;
        }
        return response()->json($response);
    }

    private function get_order_code(){
        $query = DB::select("SELECT max(id) AS id FROM room_booking WHERE created_at ='".date("Y-m-d H:i:s")."' ");
        if(count($query) < 0){
            $retVal= 1;
        }else{
            $retVal= $query[0]->id+1;
        }
        if (strlen($retVal) == 1) {
            $retValreal = "0000".$retVal;
        }else if (strlen($retVal) == 2){
            $retValreal = "0000".$retVal;
        }else if (strlen($retVal) == 3){
            $retValreal = "000".$retVal;
        }else if (strlen($retVal) == 4){
            $retValreal = "00".$retVal;
        }else if (strlen($retVal) == 5){
            $retValreal = "0".$retVal;
        }else if (strlen($retVal) == 6){
            $retValreal = $retVal;
        }else{
            $retValreal = $retVal;
        }
        return date("mdHi").$retValreal;
    }
}
