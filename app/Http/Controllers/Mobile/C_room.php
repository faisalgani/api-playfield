<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\M_room;

class C_room extends Controller
{

    public function get_room(){
        $response = array();
        $query = M_room::where('active','=',1)->orderBy('room_name','ASC')->get();
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

    public function get_detail_room($id){
        $response = array();
        $query = M_room::with('room_to_gallery')->where('id','=',$id)->get();
      
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

    public function get_room_schedule($id,$date){
        $response = array();
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
        return response()->json($response);
    }
}
