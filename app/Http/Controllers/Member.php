<?php

namespace App\Http\Controllers;
// use App\Models\M_message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RSAService;

class member extends Controller
{
    public function get_member_profile($id){
        $response = array();
        $query = DB::select("SELECT first_name,last_name,phone_number,email,profile_picture,address,member_code from member WHERE id ='".$id."' ");
        if(count($query) > 0){
            foreach($query as $row){
                $data['first_name'] = $row->first_name;
                $data['last_name'] = $row->last_name; 
                $data['phone_number'] = $row->phone_number; 
                $data['email'] = $row->email;
                $data['profile_picture'] = $row->profile_picture;
                $data['address'] = $row->address;
                $data['member_code'] = $row->member_code;
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

    public function get_membership($id){
        $response = array();
        $query = DB::select("SELECT b.*, a.start_date,b.end_date, c.skin_type from membership a inner join member b on a.member_id = b.id 
        inner join skin_type c on c.id= a.skin_type
        WHERE a.id ='".$id."'");
        if(count($query) > 0){
            foreach($query as $row){
                $data['first_name'] = $row->first_name;
                $data['last_name'] = $row->last_name; 
                $data['phone_number'] = $row->phone_number; 
                $data['email'] = $row->email;
                $data['profile_picture'] = $row->profile_picture;
                $data['address'] = $row->address;
                $data['member_code'] = $row->member_code;
                $data['start_date'] = $row->start_date;
                $data['end_date'] = $row->end_date;
                $data['skin_type'] = $row->skin_type;
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


}
