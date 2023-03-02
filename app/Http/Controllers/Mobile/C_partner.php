<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\M_partner;
use App\Models\M_partner_category;
use App\Models\M_partner_deals;


class C_partner extends Controller
{

    public function get_partner(Request $request){
        $response = array();
        $limit = $request->query('size');
        $offset = $request->query('page');

        if($limit == null || $offset == null){
            $response['metadata']['message']='size and page cannot be null';
            $response['metadata']['code']=400;
        }else{
            $query = M_partner_category::with('category_to_partner')
            ->skip($offset)
            ->take($limit)
            ->orderBy('category','ASC')->get();
          
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

    public function detail_category_partner(Request $request){
        $response = array();
        $id = $request->query('categoryid');
        if($id == '' || $id == null){
            $response['metadata']['message']='category id cannot be null';
            $response['metadata']['code']=400;
        }else{
            $query = M_partner_category::with('category_to_partner')
            ->where('id', '=', $id )->get();
        
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

    public function detail_partner(Request $request){
        $response = array();
        $id = $request->query('id');
        if($id == '' || $id == null){
            $response['metadata']['message']='id cannot be null';
            $response['metadata']['code']=400;
        }else{
            $query = M_partner::with('partner_to_deals')->where('id', '=', $id )->get();
      
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
