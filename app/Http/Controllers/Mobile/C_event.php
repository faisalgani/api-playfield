<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\M_event;

class C_event extends Controller
{

    public function get(Request $request){
        $name = $request->query('eventName');
        $response = array();
        if($name == null){
            $query =  M_event::orderBy('event_date','DESC')->get();
        }else{
            $query =  M_event::where('name', 'like', "%".$name."%")->orderBy('event_date','DESC')->get();
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
    public function get_detail_event(Request $request){
        $response = array();
        $id = $request->query('id');
        if($id == '' || $id == null){
            $response['metadata']['message']='id cannot be null';
            $response['metadata']['code']=400;
        }else{
            $query = M_event::with('event_to_gallery')->where('id','=',$id)->get();
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
