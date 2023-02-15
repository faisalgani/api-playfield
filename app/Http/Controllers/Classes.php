<?php

namespace App\Http\Controllers;
// use App\Models\M_message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RSAService;

class classes extends Controller
{
    public function get_classes($type){
        $response = array();
        $query = DB::select("SELECT a.*, b.class_category FROM class a inner join class_category b on a.category_id = b.id WHERE class_type ='".$type."'");
        if(count($query) > 0){
            foreach($query as $row){
                $data['class_name'] = $row->class_name;
                $data['class_type'] = $row->class_type; 
                $data['class_category'] = $row->class_category; 
                $data['description'] = $row->description; 
                $data['start_time'] = $row->start_time; 
            }
            $response['metadata']['message']='success';
            $response['metadata']['code']=200;
            $response['data'] = $data;
        }else{
            $response['metadata']['message']='failed data not found';
            $response['metadata']['code']=400;
        }
        return response()->json($response);
    }

    public function booking_class(Request $request){
        $response = array();
        $params = $request->all();
        DB::beginTransaction();
        $booking_code = $this->get_booking_code($params['class_id']);
        $data['class_id'] = $params['class_id'];
        $data['member_id'] = $params['member_id'];
        $data['created_at'] = $params['booking_date'];
        $data['status'] = 1;
        $data['booking_code'] = $booking_code;
        $save = DB::table('class_booking')->insertGetId($data);
        if($save){
            DB::commit();
            $response['metadata']['message']='booking processed';
            $response['metadata']['code']=200;
            $response['metadata']['booking_code']=$booking_code;
        }else{
            DB::rollBack();
            $response['metadata']['message']='booking failed';
            $response['metadata']['code']=400;
        }

        
        return response()->json($response);
    }

    private function get_booking_code($class_id){
        $query = DB::select("SELECT max(a.id) AS id FROM class_booking WHERE class_id='".$class_id."' ");
        if(count($query) < 0){
            $retVal= 1;
        }else{
            $retVal= $query[0]->id+1;
        }
        if (strlen($retVal) == 1) {
            $retValreal = "00000".$retVal;
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
        return 'GC/'.date("Y-m-d H:i").'/'.$retValreal;
    }
    


}
