<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class C_business_index extends Controller
{

    public function get($name = null){
        $response = array();
        if($name == null){
            $query = DB::select("SELECT id, name,created_at,company FROM bussiness_references ORDER BY name ASC");
        }else{
            $query = DB::select("SELECT id, name,created_at,company FROM bussiness_references WHERE name like '%".$name."%' ORDER BY name ASC");
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


    public function get_detail($id){
        $response = array();
        $query = DB::select("SELECT * FROM bussiness_references WHERE id='".$id."'");
      
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
