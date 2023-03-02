<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\M_news_category;
use App\Models\M_news;

class C_news extends Controller
{

    public function get(Request $request){
        $name = $request->query('newsTitle');
        $response = array();
        if($name == null){
            $query = M_news_category::with('category_to_news')->orderBy('order','ASC')->get();
        }else{
            $query = M_news_category::with('category_to_news')
            ->where('category', 'like', "%".$name."%")
            ->orWhereHas('category_to_news', function($q) use ($name) { 
                $q->where('title', 'like', '%'.$name.'%');
              })
            ->orderBy('order','ASC')->get();
        }
       
        if(count($query) > 0){
            $response['metadata']['message']='success';
            $response['metadata']['code']=200;
            // $response['data']['is_breaking_news'] = $query_breaking;
            $response['data'] = $query;
        }else{
            $response['metadata']['message']='failed data not found';
            $response['metadata']['code']=400;
        }
        return response()->json($response);
    }

    public function get_breaking_news(){
        $response = array();
        $query = M_news::where('is_breaking_news','=',1)->get();
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
            $query = M_news::where('id','=',$id)->get();
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
