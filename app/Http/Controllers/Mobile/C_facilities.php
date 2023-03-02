<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\M_facilities_category;
use App\Models\M_facilities;

class C_facilities extends Controller
{

    public function get(){
        $response = array();
        $query = M_facilities_category::with('category_to_facilities')->orderBy('sort_order','ASC')->get();
      
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

    public function get_detail(Request $request){
        $id = $request->query('id');
        $response = array();
        if($id == '' || $id == null){
            $response['metadata']['message']='id cannot be null';
            $response['metadata']['code']=400;
        }else{
            $query = M_facilities::where('id','=',$id)->get();
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
}
