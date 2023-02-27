<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\M_class_category;
use App\Models\M_class;

class C_class extends Controller
{

    public function get_group_class(){
        $response = array();
        $query = M_class_category::with('category_to_class')->orderBy('order','ASC')->get();
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

    public function get_detail_class($id){
        $response = array();
        $query = M_class::with('class_to_gallery')->where('id','=',$id)->get();
      
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

    public function group_class_booked(Request $request){
        $response = array();
        $params = $request->all();
        DB::beginTransaction();
        $memberName = DB::select("SELECT first_name,last_name FROM member WHERE id ='". $params['member_id']."'");
        $booking_code = $this->get_booking_group_class_code();
        $data['member_id'] = $params['member_id'];
        $data['class_id'] = $params['class_id'];
        $data['status'] = 1;
        $data['booking_code'] = $booking_code;
        $data['created_at'] = date("Y-m-d H:i:s");
        $data['created_by'] = $memberName[0]->first_name.' '.$memberName[0]->last_name;

        $save = DB::table('class_booking')->insertGetId($data);
        if($save){
            DB::commit();
            $response['metadata']['message']='group class has been booked';
            $response['metadata']['code']=200;
            $response['booking_code'] = $booking_code;
        }else{
            DB::rollBack();
            $response['metadata']['message']='failed booked group class';
            $response['metadata']['code']=200;
        }
        return response()->json($response);
    }

    private function get_booking_group_class_code(){
        $query = DB::select("SELECT max(id) AS id FROM class_booking WHERE created_at ='".date("Y-m-d H:i:s")."' ");
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
        return 'GroupClass-'.date("mdHi").$retValreal;
    }   
}
