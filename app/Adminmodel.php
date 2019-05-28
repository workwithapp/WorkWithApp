<?php

namespace App;
use File;
use DB;
use Mail;
use Auth;
use fileupload\FileUpload;
use Hash;
use Redirect;
use Illuminate\Database\Eloquent\Model;

class Adminmodel extends Model
{
  
/**************************************/
           /*change password*/
/***************************************/

   public function change_pass($user_id){
   $profile_data = DB::table('users AS u')      
                ->where('u.id', '=', $user_id)
                ->where('u.user_type','A')
                ->select('u.password','u.id')
                ->first();
               
      return $profile_data;
           }


public function static_page($name){
    $result=DB::table('static_page')->where('page',$name)->select('*')->first();
    return $result;

  }
   /******************************/
  // Update data
  /******************************/

   public function updateData($tbl,$where,$data){
    $update = DB::table($tbl)
        ->where($where)
        ->update($data);
   }




   /****************************/
/* Get My Profile */
/****************************/
public function getMyProfiles($user_id,$user_type){
    if($user_type=='SP'){
                $result_data=DB::table('serviceprovider_profiles as sp') 
                 ->where('sp.user_id',$user_id)
                ->select('sp.first_name','sp.last_name','sp.online','sp.address','sp.mobnumber','sp.gender','sp.profile_picture','sp.user_id','sp.about','sp.experience','sp.services',DB::raw("CASE WHEN sp.profile_picture is NULL OR sp.profile_picture = '' THEN CONCAT('',sp.profile_picture) ELSE CONCAT('".url('/').'/public/uploads/profile/'."',sp.profile_picture) END AS profile_picture,CASE WHEN sp.id_card is NULL OR sp.id_card = '' THEN CONCAT('',sp.id_card) ELSE CONCAT('".url('/').'/public/uploads/idCard/'."',sp.id_card) END AS id_card"))
               ->first();
          
              }else{

                $result_data=DB::table('user_profiles as up')   
                ->where('up.user_id',$user_id)
                ->select('up.first_name','up.last_name','up.address','up.mobnumber','up.gender','up.profile_picture','up.user_id',DB::raw("CASE WHEN up.profile_picture is NULL OR up.profile_picture = '' THEN CONCAT('',up.profile_picture) ELSE CONCAT('".url('/').'/public/uploads/profile/'."',up.profile_picture) END AS profile_picture"))
               ->first();
                
                }
   
   return $result_data;
}


/****************************/
/*get appointment details*/
/***************************/
public function getappointmentdetails($post_id){
 $datas['data']=DB::table('post_services as ps')
         ->join('user_profiles as up','up.user_id','=','ps.user_id')
         ->where('ps.id','=',$post_id)
         ->select('ps.id as post_id','ps.services_id','ps.offer_name','ps.job_forword','ps.therapist_gender','ps.massage_length','ps.created_at','ps.start_date','ps.start_time','ps.price','ps.job_status','up.first_name','up.last_name','up.profile_picture',DB::raw("CASE WHEN up.profile_picture is NULL OR up.profile_picture = '' THEN CONCAT('',up.profile_picture) ELSE CONCAT('".url('/').'/public/uploads/profile/'."',up.profile_picture) END AS profile_picture"))
         ->orderBy('created_at','desc')
        ->get();

    foreach ($datas['data'] as $k => $value) {
     $moreservices=$this->getOtherServices($value->services_id);
     $datas['data'][$k]->services_name = implode(",",$moreservices);

     $start_date= $value->start_date;  
     $job_start_date = date("jS F, Y" , strtotime($start_date)); 
      $datas['data'][$k]->start_date = $job_start_date;
 
      if($value->job_forword !='NA'){
       $result_data=$this->getData('serviceprovider_profiles',$value->job_forword);
       $datas['data'][$k]->job_forword = $result_data;
      }else{
       $datas['data'][$k]->job_forword = 'NA';       
      }
      
       if($value->job_status =='R'){
       $result_data=$this->getreasonData('reasons',$value->post_id);
       $datas['data'][$k]->rejectreason = $result_data;
      }
  }


return $datas;
}
/*********************************************/
/*Get More services */
/**********************************************/

  Public function getOtherServices($data){
       $services_id=explode(',', $data);
       $result_data= array();
       foreach ($services_id as $key => $value) {
             $result=DB::table('services_list')
                         ->where('id',$value)
                         ->select('title')
                         ->first();                         
            if($result){
              $result_data[]=$result->title;
        }
    }

           return $result_data;
   }


   /***********************************************/
   /* Get service Provider */
   /***********************************************/
   public function getServiceProvider($post_id){
/*    $userIds = array();

    $start_date = DB::table('post_services')->where('id',$post_id)->select('start_date')->first();
    
    $users = DB::table('post_services')->where('job_status','AC')->where('start_date',$start_date->start_date)->orWhere('job_status','ST')->orWhere('job_status','IP')->select('job_forword')->get();

    foreach ($users as $key => $value) {
      if($value->job_forword && $value->job_forword != 'NA') {
        $userIds[] = $value->job_forword;
      }
    }
    //print_r($userIds); die;
      $u = DB::table('serviceprovider_profiles')
             ->whereNotIn('user_id', $userIds)
             ->select('user_id as servicesProviderId','first_name','last_name')
             ->get();
   
       return $u;*/

     $u = DB::table('serviceprovider_profiles')
             ->where('online','ON')
             ->select('user_id as servicesProviderId','first_name','last_name')
             ->get();
   
       return $u;



   }

   /***************************************/
   /*getData*/
   /***************************************/
public function getData($table,$id){
  $result_data=DB::table($table)->where('user_id',$id)->select('first_name','last_name','experience','about','gender')->first();
  return $result_data;
}
  /***************************************/
   /*getreasonData*/
   /***************************************/
public function getreasonData($table,$id){
  $result_data=DB::table($table)->where('job_id',$id)->select('reasons')->first();
  return $result_data;
}
/**End Main Class**/
        }
/*****************/