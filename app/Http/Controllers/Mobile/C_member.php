<?php
namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\M_member;

class C_member extends Controller
{
    public function get_member_profile(Request $request){
        $response = array();
        $id = $request->query('memberId');
        if($id == '' || $id == null){
            $response['metadata']['message']='id cannot be null';
            $response['metadata']['code']=400;
        }else{
            // $query = DB::select("SELECT first_name,last_name,phone_number,email,profile_picture,address,member_code from member WHERE id ='".$id."' ");
            $query = M_member::with('member_to_recomendation')->where('id','=',$id)->get();
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

    public function get_membership(Request $request){
        $response = array();
        $id = $request->query('memberId');
        if($id == '' || $id == null){
            $response['metadata']['message']='id cannot be null';
            $response['metadata']['code']=400;
        }else{
            $query = DB::select("SELECT b.*, a.start_date,a.end_date, c.type_skin from membership a inner join member b on a.member_id = b.id 
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
                    $data['type_skin'] = $row->type_skin;
                }
                $response['metadata']['message']='success';
                $response['metadata']['code']=200;
                $response['data'] = $data;
            }else{
                $response['metadata']['message']='failed data not found';
                $response['metadata']['code']=400;
            }
        }
        return response()->json($response);
    }

    public function edit_my_profile(Request $request){
        $response = array();
        $params = $request->all();
        DB::beginTransaction();
        $data['first_name'] = $params['first_name'];
        $data['last_name'] = $params['last_name'];
        $data['phone_number'] = $params['phone_number'];
        $data['email'] = $params['email'];
        $data['updated_at'] = date("Y-m-d H:i:s");
        $data['updated_by'] =  $params['first_name'].' '.$params['last_name'];

        $query = M_member::where("id", "=", $params['member_id']);
        $query = $query->update($data);
        if($query){
            DB::commit();
            $response['metadata']['message']='profile has been updated';
            $response['metadata']['code']=200;
        }else{
            DB::rollBack();
            $response['metadata']['message']='failed update profile';
            $response['metadata']['code']=400;
        }
        return response()->json($response);
    }   

    public function save_business_index(Request $request){
        $response = array();
        $params = $request->all();
        DB::beginTransaction();
        $memberName = DB::select("SELECT first_name,last_name FROM member WHERE id ='". $params['member_id']."'");
       
        $data['name'] = $params['name'];
        $data['company'] = $params['company'];
        $data['email'] = $params['email'];
        $data['phone_number'] = $params['phone_number'];
        $data['website'] = $params['website'];
        $data['created_at'] = date("Y-m-d H:i:s");
        $data['created_by'] = $memberName[0]->first_name.' '.$memberName[0]->last_name;

        $query = DB::table('bussiness_references')->insertGetId($data);
        if($query){
            DB::commit();
            $updateMember = DB::statement("UPDATE member SET id_business_index = '".$query."' where id = '".$params['member_id']."' ");
            if($updateMember){
                DB::commit();
                $response['metadata']['message']='bussiness references index has been created';
                $response['metadata']['code']=200;
            }else{
                DB::rollBack();
                $response['metadata']['message']='failed create bussiness references index';
                $response['metadata']['code']=400;
            }
        }else{
            DB::rollBack();
            $response['metadata']['message']='failed create bussiness references index';
            $response['metadata']['code']=400;
        }
        return response()->json($response);
    }

    public function get_member_class_booking(Request $request){
        $response = array();
        $id = $request->query('memberId');
        if($id == '' || $id == null){
            $response['metadata']['message']='id cannot be null';
            $response['metadata']['code']=400;
        }else{
            $query = DB::select("SELECT b.id,b.class_name,c.class_category,b.start_time,b.end_time,b.cover_image,b.location FROM class_booking a 
            INNER JOIN class b ON a.class_id=b.id INNER JOIN class_category c ON b.category_id=c.id WHERE a.member_id=".$id."");
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

    public function get_member_room_booking(Request $request){
        $response = array();
        $id = $request->query('memberId');
        if($id == '' || $id == null){
            $response['metadata']['message']='id cannot be null';
            $response['metadata']['code']=400;
        }else{
            $query = DB::select("SELECT a.date_booked,b.start_time,b.end_time,c.room_name,c.location,c.cover_image FROM room_booking_detail a 
            INNER JOIN room_schedule b ON a.room_schedule_id=b.id INNER JOIN room c ON b.room_id=c.id 
            INNER JOIN room_booking d ON a.booked_id=d.id WHERE d.member_id='".$id."' ");
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
