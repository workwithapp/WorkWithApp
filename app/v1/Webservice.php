<?php
namespace App\v1;

use File;
use DB;
use Mail;
use Auth;
use fileupload\FileUpload;
use Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
use App\User;

class Webservice extends Model 
{

public $abc=0;
  /**************************************/
  /* Get userID from Token*****/
  /************************************/
 public function getUserIdFromToken($token){
     $getUsers = DB::table('users')
                ->where('token',$token)
                ->select('id')
                ->first();
    if($getUsers){
      return $getUsers->id;
    }return 0;
 }

 /***********************************/
 /* Suggestons used by  user ----*/
 /**********************************/
 public function getSuggestionUsed($userId){
  $getCountSuggestion = DB::table("user_suggestion")
                        ->where("user_id",$userId)
                        ->first();

    if(empty($getCountSuggestion)){
      return 0;
    }else{
      return $getCountSuggestion->suggesion_count;
    }
 }

/***********************************/
/* User interest**/
/**********************************/
public function getSuggestedUserInterests($userId){
  return DB::table("user_interests")
              ->join("interests","interests.id","=","user_interests.interest_id")
              ->where('user_id',$userId)
              ->select("interests.id",'interests.name')
              ->get();
}

/***************************************************/
/******suggestonUsed(increase 1 limit)
/***************************************************/
function suggestonUsed($userId){
  $getCountSuggestion = DB::table("user_suggestion")
                        ->where("user_id",$userId)
                        ->first();

    if(empty($getCountSuggestion)){
      $suggestionUsed = 1;
      DB::table("user_suggestion")->insert(['user_id' =>$userId, "suggesion_count" => $suggestionUsed]);
    }else{
       $suggestionUsed = $getCountSuggestion->suggesion_count+1;
       if($suggestionUsed == "10"){
         $NewDate = date('Y-m-d H:i:s', strtotime("+1 days"));
         DB::table("user_suggestion")->where('user_id',$userId)->update(["suggesion_count" => $suggestionUsed,"next_suggesion_date" => $NewDate]);
       }else{
         DB::table("user_suggestion")->where('user_id',$userId)->update(["suggesion_count" => $suggestionUsed]);
       }
    }
  }
  /*********** my profile *****/
  /*public function userProfile($userid){
    $profile = url('/').'/public/uploads/profile/';
    $dummyProfile = $profile.'dummyprofile.jpg';
    
    $data =  DB::table("users")
                ->leftjoin("days","days.id","=","users.day")
                ->leftjoin("times","times.id","=","users.time")
                ->leftjoin("workplace","workplace.id","=","users.time")
                ->select("users.*","days.name as day","times.name as time","workplace.name as workplace")
                ->where("users.id",$userid)
                ->first();
      
    
    if(!$data || $data == null || $data == ""){
      return false;
    }
    
    $data->interest = DB::table("user_interests")
                        ->join('interests',"interests.id","=","user_interests.interest_id")
                        ->select("user_interests.interest_id as ids","interests.name")
                        ->where("user_interests.user_id",$userid)
                        ->where("user_interests.status",1)
                        ->get();
    $interest = [];
    if($data->interest && !empty($data->interest) && isset($data->interest)) {
      foreach ($data->interest as $value) {
        if($value->ids && !empty($value->ids)) {
           $interest[] = $value->name;
        }
      }
    }
    $data->interest = $interest;
    
    $data->distance = DB::table("user_prefer_distance")->select("distance")->where("user_id",$userid)->first();
    if(!empty($data->distance)){
      $data->distance = $data->distance->distance;
    }
    if(empty($data->profile_pic) && $data->profile_pic == null){
      $data->profile_pic = $dummyProfile;
    }else {
      $data->profile_pic = $profile.$data->profile_pic;
    }
    return $data;
  }*/

  public function userProfile($userid){
    $profile = url('/').'/public/uploads/profile/';
    $dummyProfile = $profile.'dummyprofile.jpg';
    
    $data =  DB::table("users")
                /*->leftjoin("days","days.id","=","users.day")
                ->leftjoin("times","times.id","=","users.time")
                ->leftjoin("workplace","workplace.id","=","users.time")*/
                ->select("users.*")
                ->where("users.id",$userid)
                ->first();
      
    
    if(!$data || $data == null || $data == ""){
      return false;
    }
    
    $data->interest = DB::table("user_interests")
                        ->join('interests',"interests.id","=","user_interests.interest_id")
                        ->select("user_interests.interest_id as ids","interests.name")
                        ->where("user_interests.user_id",$userid)
                        ->where("user_interests.status",1)
                        ->get();
    $interest = [];
    if($data->interest && !empty($data->interest) && isset($data->interest)) {
      foreach ($data->interest as $value) {
        if($value->ids && !empty($value->ids)) {
           $interest[] = $value->name;
        }
      }
    }
    $data->interest = $interest;
    /*days*/
    $data->day = DB::table("user_days")
                        ->join('days',"days.id","=","user_days.day_id")
                        ->select("user_days.day_id as ids","days.name")
                        ->where("user_days.user_id",$userid)
                        ->where("user_days.status",'1')
                        ->get();
    $day = [];
    if($data->day && !empty($data->day) && isset($data->day)) {
      foreach ($data->day as $value) {
        if($value->ids && !empty($value->ids)) {
           $day[] = $value->name;
        }
      }
    }
    $data->day = $day;

    /*work*/

    $data->work_place = DB::table("user_workplace")
                        ->join('workplace',"workplace.id","=","user_workplace.workplace_id")
                        ->select("user_workplace.workplace_id as ids","workplace.name")
                        ->where("user_workplace.user_id",$userid)
                        ->where("user_workplace.status",'1')
                        ->get();
    $work_place = [];
    if($data->work_place && !empty($data->work_place) && isset($data->work_place)) {
      foreach ($data->work_place as $value) {
        if($value->ids && !empty($value->ids)) {
           $work_place[] = $value->name;
        }
      }
    }
    $data->work_place = $work_place;
    /*times*/
    $data->time = DB::table("user_times")
                        ->join('times',"times.id","=","user_times.time_id")
                        ->select("user_times.time_id as ids","times.name")
                        ->where("user_times.user_id",$userid)
                        ->where("user_times.status",'1')
                        ->get();
    $time = [];
    if($data->time && !empty($data->time) && isset($data->time)) {
      foreach ($data->time as $value) {
        if($value->ids && !empty($value->ids)) {
           $time[] = $value->name;
        }
      }
    }
    $data->time = $time;
    
    $data->distance = DB::table("user_prefer_distance")->select("distance")->where("user_id",$userid)->first();
    if(!empty($data->distance)){
      $data->distance = $data->distance->distance;
    }
    if(empty($data->profile_pic) && $data->profile_pic == null){
      $data->profile_pic = $dummyProfile;
    }else {
      $data->profile_pic = $profile.$data->profile_pic;
    }
    return $data;
  }
  
  
  /*************** other user profile */
  public function otherUserProfile($userid){
    $profile = url('/').'/public/uploads/profile/';
    $dummyProfile = $profile.'dummyprofile.jpg';
    $data =  DB::table("users")
                 //->leftjoin("days","days.id","=","users.day")
                //->leftjoin("times","times.id","=","users.time")
                //->leftjoin("workplace","workplace.id","=","users.time")
                ->select("users.id","users.name","users.profile_pic","users.job_title","users.bio","users.project","users.address","users.latitude","users.longitude")
                ->where("users.id",$userid)
                ->first();
    
    if(!$data || $data == null || $data == ""){
      return false;
    }

    $data->interest = DB::table("user_interests")
                        ->join('interests',"interests.id","=","user_interests.interest_id")
                        ->select("user_interests.interest_id as ids","interests.name")
                        ->where("user_interests.user_id",$userid)
                        ->where("user_interests.status",1)
                        ->get();
    $interest = [];
    if($data->interest && !empty($data->interest) && isset($data->interest)) {
      foreach ($data->interest as $value) {
        if($value->ids && !empty($value->ids)) {
           $interest[] = $value->name;
        }
      }
    }
    $data->interest = $interest;
    
/*days*/
    $data->day = DB::table("user_days")
                        ->join('days',"days.id","=","user_days.day_id")
                        ->select("user_days.day_id as ids","days.name")
                        ->where("user_days.user_id",$userid)
                        ->where("user_days.status",'1')
                        ->get();
    $day = [];
    if($data->day && !empty($data->day) && isset($data->day)) {
      foreach ($data->day as $value) {
        if($value->ids && !empty($value->ids)) {
           $day[] = $value->name;
        }
      }
    }
    $data->day = $day;

    /*work*/

    $data->work_place = DB::table("user_workplace")
                        ->join('workplace',"workplace.id","=","user_workplace.workplace_id")
                        ->select("user_workplace.workplace_id as ids","workplace.name")
                        ->where("user_workplace.user_id",$userid)
                        ->where("user_workplace.status",'1')
                        ->get();
    $work_place = [];
    if($data->work_place && !empty($data->work_place) && isset($data->work_place)) {
      foreach ($data->work_place as $value) {
        if($value->ids && !empty($value->ids)) {
           $work_place[] = $value->name;
        }
      }
    }
    $data->work_place = $work_place;
    /*times*/
    $data->time = DB::table("user_times")
                        ->join('times',"times.id","=","user_times.time_id")
                        ->select("user_times.time_id as ids","times.name")
                        ->where("user_times.user_id",$userid)
                        ->where("user_times.status",'1')
                        ->get();
    $time = [];
    if($data->time && !empty($data->time) && isset($data->time)) {
      foreach ($data->time as $value) {
        if($value->ids && !empty($value->ids)) {
           $time[] = $value->name;
        }
      }
    }
    $data->time = $time;



    $data->distance = DB::table("user_prefer_distance")->select("distance")->where("user_id",$userid)->first();
    if(!empty($data->distance)){
      $data->distance = $data->distance->distance;
    }
    if(empty($data->profile_pic) && $data->profile_pic == null){
      $data->profile_pic = $dummyProfile;
    }else {
      $data->profile_pic = $profile.$data->profile_pic;
    }
    return $data;
  }
	  /*********************************
    // Get Single User
    *********************************/
  public function getusers($user_id)
  {
	     $getUsers=DB::table('users')
	              ->where('id',$user_id)
	              ->select('*')
	              ->first();

	     return $getUsers;
  }

/******************************************/
/****************New Matching Req-------------*/
/******************************************/
public function insertMatching($user_id,$matching_user_id,$status){
 
  $check_sender = DB::table("matches")
          ->where(array("user_id" => $user_id, "other_user_id" => $matching_user_id));

  $check_receiver = DB::table("matches")
                    ->where(array("user_id" => $matching_user_id, "other_user_id" => $user_id));

  if($status == 4){
    $exist  = DB::table("passUsers")
              ->where("user_id",$user_id)
              ->where("other_user_id",$matching_user_id);
    if($exist->exists()){
      DB::table("passUsers")
          ->where(["user_id" => $user_id, "other_user_id" => $matching_user_id,"id" => $exist->first()->id])
          ->update(["status" => 1,"date" => date("Y-m-d H:s:i")]);
    }else {
      DB::table("passUsers")->insert(["user_id" => $user_id, "other_user_id" => $matching_user_id,"date" => date("Y-m-d H:s:i")]);
    }
    return "Pass";
  }
  /* check is current user already sent match request */
  if($check_sender->count()  > 0 && $status >= 0){
    return 409;
  }else if($check_receiver->exists()){
    /*  if status = 1  then matched send notification to other user */
    if($check_receiver->first()->status == 0) {
      $status = 1;
    }

      $update = DB::table("matches")
            ->where(array("user_id" => $matching_user_id, "other_user_id" => $user_id))
            ->update(array("status" => $status,'updated_at' => date("Y-m-d H:i:s")));
      if($status == 1){
        return $update?"accept":"failed";
      }else if($status == 3){
        return $update?"unmatch":"failed";
      }else if($status == 2){
        return $update?"cancel":"failed";
      }
      
  }else {
     $insert = DB::table("matches")
               ->insert(                                                                                
                      array(
                          "user_id"        => $user_id,
                          "other_user_id"  => $matching_user_id,
                          "status"         => 0,
                          "created_at"     => date("Y-m-d h:i:s")
                          )
                      );
    return $insert?"insert":"failed";
  }                 
}
  /*-*******************************/
  /*  Suggested USed Details----*/
  /**********************************/
 public function getSuggestedUserDetails($suggested_id){
  $profile = url('/').'/public/uploads/profile/';
  $dummyProfile = $profile.'dummyprofile.jpg';
   $getUsers=DB::table('users')
                ->leftJoin("workplace","workplace.id" ,'=', "users.work_place")
                ->leftJoin("times","times.id","=","users.time")
                ->leftJoin("days","days.id","=","users.day")
                ->where('users.id',$suggested_id)
                ->select('users.id',DB::raw("CASE WHEN profile_pic = '' OR profile_pic is null THEN '".$dummyProfile."' ELSE CONCAT('". $profile ."', profile_pic) END as profile_pic"),'users.email','users.name','users.gender','users.dob','users.job_title','users.bio','workplace.name as workplace_name','users.project','days.days as desired_work_days','times.name   as desired_work_time')
                ->first();

       return $getUsers;
 }




  	/***********************************/
  	// Update login token
  	/***********************************/
  public function UpdateLoginToken($id,$token_key,$deviceType,$deviceId){
    
    $UpdateDetailObj = DB::table('users')
              						->where('id',$id)
              						->limit(1)  
              						->update(array('token' =>$token_key,'device_id'=>$deviceId,'device_type'=>$deviceType));

		return $UpdateDetailObj;
  }

  	/***********************************/
  	// Get Password Token 
  	/***********************************/
	public function GetPasswordToken($password_token,$user_id){

    $result_data = DB::table('users')
              			  ->where('password_token',$password_token)
              			  ->where('id',$user_id)
              			  ->select('*')
              			  ->first();

		return $result_data;
	}


    /***********************************/
    /* Insert Data */
    /***********************************/
  Public function insertdata($tablename,$data){
  	
    $result=DB::table($tablename)->insert($data);
    return $result;

  }

    /***********************************/
    /* update Data */
    /***********************************/
  Public function addprofile($tablename,$data){
  	$result=DB::table($tablename)->update($data);
    return $result;
  }

    /************************************/
    /* Check Connection */
    /**************************************/    
  public function checkConnection($sender_id,$receiver_id){
    
    $checkConnection = DB::table('connection')
                            ->where([['sender_id','=',"$sender_id"],['reciver_id','=',"$receiver_id"]])
                            ->orwhere([['sender_id','=',"$receiver_id"],['reciver_id','=',"$sender_id"]])
                            ->first();
    return  $checkConnection;
  }
 

    /**********************************/
    /* Add Connection  */
    /**********************************/
  public function add_connection($sender_id,$receiver_id){
    
    $addConnection = DB::table('connection')->insert(['sender_id'=>$sender_id,'reciver_id'=>$receiver_id]);
  }

      /**********************************/
      /* Insert Message */
      /***********************************/
  public function insert_message($sender_id,$message,$connection_id){
    
    $addConnection = DB::table('conversation')
                             ->insert([
                             	   'user_id'=>$sender_id,
                             	   'connection_id'=>$connection_id,
                             	   'message'=>$message]);
  }

    /********************************/
    /*Get user info*/
    /*******************************/
  public function getUserInfo($user_id){
     
    $result=DB::table('users')->where('id',$user_id)->select('user_name','profile_picture')->first();
    return $result;
  }

    /******************************/
    /*get Conversation data*/
    /******************************/
  public function getdata($tblname,$conversation_id,$user_id){
	  
    $result = DB::table($tblname)->where(['id'=>$conversation_id])->select('*')->first();
	  return $result;
  }

    /******************************/
    /*get cinnection data*/
    /******************************/
  public function getchatdata($tblname,$connection_id,$user_id){
    
    $result=DB::table($tblname)->where(['connection_id'=>$connection_id])->select('*')->first();
    return $result;
  }

    /****************************/
    /* Get My Profile */
    /****************************/
  public function getMyProfiles($user_id,$user_type){
    
    if($user_type=='SP'){

      $result_data = DB::table('serviceprovider_profiles as sp')
              ->leftJoin('feedbacks as fd','sp.user_id','=','fd.ratable_id')
              ->where('sp.user_id',$user_id)
              ->select('sp.first_name','sp.last_name','sp.address','sp.mobnumber','sp.gender','sp.profile_picture','sp.user_id','sp.about','sp.experience','sp.services',DB::raw("(select case WHEN avg(rating) IS NULL THEN 0 ELSE avg(rating) END AS rating from feedbacks where ratable_id=sp.user_id) as user_rating,CASE WHEN sp.profile_picture is NULL OR sp.profile_picture = '' THEN CONCAT('',sp.profile_picture) ELSE CONCAT('".url('/').'/public/uploads/profile/'."',sp.profile_picture) END AS profile_picture,CASE WHEN sp.id_card is NULL OR sp.id_card = '' THEN CONCAT('',sp.id_card) ELSE CONCAT('".url('/').'/public/uploads/idCard/'."',sp.id_card) END AS id_card,(Select count(comments) from feedbacks where ratable_id=sp.user_id ) as reviews"))
              ->get();

      foreach ($result_data as $k => $value) 
      {
        $moreservices=$this->getMyServices($value->services);           
        $result_data[$k]->services = $moreservices;
      }

    }else{

      $result_data=DB::table('user_profiles as up')   
      ->leftJoin('feedbacks as fd','up.user_id','=','fd.ratable_id')
      ->where('up.user_id',$user_id)
      ->select('up.first_name','up.last_name','up.address','up.mobnumber','up.gender','up.profile_picture','up.user_id',DB::raw("(select case WHEN avg(rating) IS NULL THEN 0 ELSE avg(rating) END AS rating from feedbacks where ratable_id=up.user_id) as user_rating,CASE WHEN up.profile_picture is NULL OR up.profile_picture = '' THEN CONCAT('',up.profile_picture) ELSE CONCAT('".url('/').'/public/uploads/profile/'."',up.profile_picture) END AS profile_picture,(Select count(comments) from feedbacks where ratable_id=up.user_id ) as reviews"))
     ->first();
    }
   
    return $result_data;
  }


  Public function getMyServices($data){
    
    $services_id=explode(',', $data);
    $result_data= array();
    
    foreach ($services_id as $key => $value) {
      
      $result=DB::table('services_list')
                         ->where('id',$value)
                         ->select('title')
                         ->first();                         
        if($result){
          $result_data[]=$result;
        }
      }

    return $result_data;
  }

    /*********************************/
    /**updateProfile/
    /*********************************/
  public function updateProfile($tblname,$service_provider,$user_id){
    
    $data = DB::table($tblname)
            ->where('user_id',$user_id)
            ->update($service_provider);
    return $data;
  }

    /************************************/
    /* Get Services */
    /*************************************/
  public function getServices($data){
    
    $services_id=explode(',', $data);
    $result_data= array();
    foreach ($services_id as $key => $value) {
      
      $result = DB::table('services_list')
                        ->where('id',$value)
                        ->select('title',DB::raw("CASE WHEN service_image is NULL OR service_image = '' THEN CONCAT('',service_image) ELSE CONCAT('".url('/').'/public/uploads/services_images/'."',service_image) END AS service_image"))
                        ->first();                         
      if($result){
        $result_data[]=$result;
      }
    }
    
    return $result_data;
  }

    /***********************************/
    /*Get FeedBack*/
    /***********************************/
  public function getFeedBack($job_id,$user_id){
    
    $result_data=DB::table('feedbacks')->where('job_id',$job_id)->where('rater_id',$user_id)->select('rating','comments')->first();
    
    if(!empty($result_data)){
      return $result_data;
    }

    return false;
  }


    /*********************/
    /* user home page  */
    /*********************/
  public function userHome(){
    
    $result_data=DB::table('services_list as sl')
                 ->select('sl.id as services_id','sl.title','sl.service_image','sl.description',DB::raw("CASE WHEN sl.service_image is NULL OR sl.service_image = '' THEN CONCAT('',sl.service_image) ELSE CONCAT('".url('/').'/public/uploads/services_images/'."',sl.service_image) END AS service_image"))->get();

    foreach ($result_data as $k => $value) {
      $results=DB::table('service_length_time')->where(['service_id'=>$value->services_id])->select('service_length','price')->get();
      $result_data[$k]->service_length_time = $results;
    }

    return $result_data;
  }


  /*********************/
  /* subscriptionPlan */
  /*********************/
  public function subscriptionPlan(){

      $result  =  DB::table('subscription_plans')->get();
      return $result;
  }


  /*********************/
  /* blockUser */
  /*********************/
  public function blockUser($block_id,$blocked_id,$status = 1){
    $exist = DB::table("blocks")
            ->where("user_id",$block_id)
            ->where("other_user_id",$blocked_id)
            ->count();
      if($exist == 1){
        return DB::table("blocks")
                  ->where(array("user_id" => $block_id, "other_user_id" => $blocked_id))
                  ->update(array("status" => $status));
      }elseif($status == 0){
          return 0;
      }else{
         return DB::table("blocks")
              ->insert(array("user_id" => $block_id, "other_user_id" => $blocked_id));
      }     
    }
   

  /* Report User------*/
  function reportUser($userId,$other_user_id,$reportMessage){
    $checkAlready = DB::table("report_users")->where("user_id",$userId)->where("other_user_id",$other_user_id)->select("id")->first();
    if(empty($checkAlready)){
      DB::table("report_users")->insert(['user_id' => $userId, 'other_user_id' => $other_user_id, 'message' => $reportMessage, 'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s') ]);
    }
    return true;
  }

  /*********************/
  /* Insert message */
  /*********************/

  public function InsertMessage($sender,$receiver,$message){
    
    $isBlocked = DB::select(DB::raw("SELECT count(*) as exist FROM `blocks` where ((user_id = $sender and other_user_id = $receiver) or (user_id = $receiver and other_user_id = $sender)) and status = 1"));
    
    if($isBlocked && $isBlocked[0]->exist != 0){
      return "blocked";
    }else {
      $insert = DB::table("chats")->insert([
                                          "sender_id"    =>  $sender,
                                          "receiver_id"  =>  $receiver,
                                          "message"      =>  $message,
                                          "created_at"   =>  date("Y-m-d H:i:s")
                                        ]);
      return $insert?1:0;
  }
}

  protected function GetUserName($userid){
    $profile = url('/').'/public/uploads/profile/';
    $dummyProfile = $profile.'dummyprofile.jpg';
    return DB::table("users")->where("id",$userid)->select("name",DB::raw("CASE WHEN profile_pic = '' OR profile_pic is null THEN '".$dummyProfile."' ELSE CONCAT('". $profile ."', profile_pic) END as profile_pic"))->first();
  }
  /*********************/
  /* get one user message */
  /*********************/
  public function GetMessages($receiver,$sender){
    $data = DB::table("chats")
          ->where(function($q) use ($receiver,$sender){
            $q->where("chats.sender_id",$sender)
                ->where("chats.receiver_id",$receiver);
          })
          ->orwhere(function($q1) use ($receiver,$sender){
            $q1->where("chats.sender_id",$receiver)
                ->where("chats.receiver_id",$sender);
          })
          ->orderBy("id","asc")
          ->get();

      if(count($data) > 0 ) {
        foreach($data as $key=>$val){
          $sender = $this->GetUserName($val->sender_id);
          $data[$key]->currentUser_name    = $sender->name;
          $data[$key]->currentUser_profile = $sender->profile_pic;
        }
        return $data;
    }
         
  }

   /*********************/
  /* get user all message */
  /*********************/

    public function get_lastMessage($userid){
      $profile = url('/').'/public/uploads/profile/';
      $dummyProfile = $profile.'dummyprofile.jpg';

      $ids = array();
      $query = DB::select("SELECT max(id) as ids FROM chats where (receiver_id = $userid or sender_id = $userid) group by sender_id");
      if(!empty($query)){
        foreach($query as $k => $val) {
          $ids[] = $val->ids;
        }
      }

      /* make sub query and pass max id of chats according to sender id in whereIn */
      return DB::table("chats")
          ->leftjoin("users","users.id","=","chats.sender_id")
          ->select("chats.*","users.name as receiverName",DB::raw("CASE WHEN profile_pic = '' OR profile_pic is null THEN '".$dummyProfile."' ELSE CONCAT('". $profile ."', profile_pic) END as profile_pic"))
          ->whereIn("chats.id",function($query) use ($userid){
              $query->select(DB::raw("max(id) as id"))
                      ->from("chats")
                      ->where("receiver_id",$userid)
                      ->orwhere("sender_id",$userid);
          })
          ->where("chats.sender_status",1)
          ->where(function($q) use ($userid){
              $q->where("chats.sender_id",$userid)
                  ->orwhere("chats.receiver_id",$userid);
           }) 
          ->orderBy("chats.id","asc")
          ->get();
    }

    /**************** delete user account ****/
    public function deleteAccount($userid,$message){
      User::where("id",$userid)->update(["status" => 3,"token" => ""]);
      $exits = DB::table("delete_account")->where("user_id",$userid);
      if($exits->count() > 0){
        if($message == $exits->first()->message){
          return true;
        }
        return DB::table("delete_account")->where("id",$exits->first()->id)->update(["message" => $message]);
      }else {
        return  DB::table("delete_account")->insert(["user_id" => $userid,"message" => $message]);
      }
    }

    /**************** unmatch user account ****/
    public function unmatchUser($data){
      $exits = DB::table("matches")
              ->where(array("user_id" => $data["user_id"],"other_user_id" => $data["other_user_id"]));

      if($exits->count() > 0){
        if($exits->first()->status == 3){
          return 3;
        }
        $update = DB::table("matches")
                  ->where(array("user_id" => $data["user_id"],"other_user_id" => $data["other_user_id"]))
                  ->update(array("status" => 3,"message" => $data["message"])); 
          return ($update)?1:0;

      }else {
        return 2;
      }

    }
    /******************** all match of user */
    public function getAllMatches($userid){
      $profile = url('/').'/public/uploads/profile/';
      $dummyProfile = $profile.'dummyprofile.jpg';

      return DB::table("matches")
                //->join("users","users.id","=","matches.user_id")
                ->join("users",function($join){
                    $join->on("users.id","=","matches.user_id")
                        ->oron("users.id","=","matches.other_user_id");
                        
                })
                ->select(DB::RAW('DISTINCT(users.id) as userId'),"matches.created_at","users.job_title","users.name as usename",DB::raw("CASE WHEN users.profile_pic = '' OR users.profile_pic is null THEN '".$dummyProfile."' ELSE CONCAT('". $profile ."', users.profile_pic) END as profile_pic"))
                ->where(function($q) use ($userid){
                    $q->where("matches.user_id",$userid)
                        ->orwhere("matches.other_user_id",$userid);
                })
                ->where("users.id","!=",$userid)
                ->where("matches.status",1)
                ->orderBy("matches.id","desc")
                ->get();
    }
    /******************** users which are blocked by current user */
    public function getBlockedUsers($userid){
      $profile = url('/').'/public/uploads/profile/';
      $dummyProfile = $profile.'dummyprofile.jpg';

      return DB::table("blocks")
                ->leftjoin("users","users.id","=","blocks.other_user_id")
                ->select("users.id","users.name as blockUserName","blocks.created_at as blockDate","users.job_title",DB::raw("CASE WHEN users.profile_pic = '' OR users.profile_pic is null THEN '".$dummyProfile."' ELSE CONCAT('". $profile ."', users.profile_pic) END as profile_pic"))
                ->where(["blocks.user_id" => $userid,"users.status" => 1,"blocks.status" => 1])
                ->orderBy("blocks.id","desc")
                ->get();
    }

    /****************** hide my side messages (hide msg thats i sent but still visible at other side) ****/
    public function HideMyMessages($sender,$receiver){
      return DB::table("chats")
              ->where(array("sender_id" => $sender, "receiver_id" => $receiver))
              ->update(array("sender_status" => 0));
    }

 

      /*********** User preference *******/
  public function preference($userid){
    $data = ["interest" => "","distance" => ""];
    $userInterest = DB::table("user_interests")
                        ->select(DB::raw("(group_concat(interest_id)) as ids"))
                        ->where(["user_id" => $userid,"status" => 1])
                        ->first();
    if($userInterest && !empty($userInterest)){
      $data["interest"] = $userInterest->ids;
    }
    
    $prefDistance = DB::table("user_prefer_distance")
                ->select("distance")
                ->where("user_id",$userid)
                ->first();
    if($prefDistance && !empty($prefDistance)){
      $data["distance"] = $prefDistance->distance;
    }
    return $data;
  }

  /*************** update user distance ****/
  public function updateDistance($userid,$distance){
    if(DB::table("user_prefer_distance")->where("user_id",$userid)->exists()){
      return DB::table("user_prefer_distance")->where("user_id",$userid)->update(["distance" => $distance]);
    }else {
      return DB::table("user_prefer_distance")->insert(["user_id" => $userid, "distance" => $distance]);
    }
  }
  
  /****************** insert new interest *****/
  public function insertInterest($userid,$value,$status){
    $exist = DB::table("user_interests")->where("user_id",$userid)->first();
     
    if(!empty($exist) && $exist){
     return DB::table("user_interests")
                ->where([ 
                        "user_id" => $userid,
                        "interest_id" => $value,
                        "id"        =>  $exist->id
                      ])
                ->update([
                        "updated_at" => date("Y-m-d H:i:s"),
                        "status"     => 0
                    ]);
    }else {
      return DB::table("user_interests")
                  ->insert(
                      [
                        "user_id" => $userid,
                        "interest_id" => $value,
                        "status" => $status,
                        "created_at" => date("Y-m-d H:i:s")
                      ]
                    );
    }
  }


    /****** get user lat long interset*/
  private function getLatLong($userid){

    $distance = DB::table("user_prefer_distance")
                ->select("distance")
                ->where("user_id",$userid)
                ->where("status",1);

    $userDetail = User::find($userid);

    $lat      = @$userDetail->latitude;
    $long     = @$userDetail->longitude;
    $interest = @$userDetail->interest;

    if($distance->exists()){
      $userDis = $distance->first()->distance;
    }else {
      $userDis = 35;
    }

    return [
            "distance" => $userDis,
            "lat"      => $lat,
            "long"     => $long,
            "interest" => $interest];
  }


  public function user_suggest($userid) {

    $userDetail = $this->getLatLong($userid);
    
    
    $interest   = $userDetail['interest'];
    $userDis    = $userDetail['distance'];
    
    if(!empty($long) && !empty($lat)) {
    $profile = url('/').'/public/uploads/profile/';
    $dummyProfile = $profile.'dummyprofile.jpg';

    $ByInterest = DB::table('users as u')
                  ->join('user_interests as i','u.id','=','i.user_id')
                  ->select('u.id as user_id',DB::raw("CASE WHEN round((3959  * acos(cos(radians($lat)) * cos(radians(u.latitude)) * cos(radians(u.longitude) - radians($long)) + sin(radians($lat)) * sin(radians(u.latitude))))) IS NULL THEN 0 ELSE round((3959 * acos(cos(radians($lat)) * cos(radians(u.latitude)) * cos(radians(u.longitude) - radians($long)) + sin(radians($lat)) * sin(radians(u.latitude))))) END AS distance"))
    /*DB::table('users as u')
                  ->join('user_interests as i','u.id','=','i.user_id')
                  ->select('u.id as user_id','u.social_id','u.email','u.name','u.gender','u.job_title','u.bio','u.project','u.work_place','u.address','u.latitude','u.longitude','u.day','u.time',DB::raw("CASE WHEN round((3959  * acos(cos(radians($lat)) * cos(radians(u.latitude)) * cos(radians(u.longitude) - radians($long)) + sin(radians($lat)) * sin(radians(u.latitude))))) IS NULL THEN 0 ELSE round((3959 * acos(cos(radians($lat)) * cos(radians(u.latitude)) * cos(radians(u.longitude) - radians($long)) + sin(radians($lat)) * sin(radians(u.latitude))))) END AS distance"),DB::raw('group_concat(i.interest_id) as matchedInterest'),DB::raw("CASE WHEN u.profile_pic = '' OR u.profile_pic is null THEN '".$dummyProfile."' ELSE CONCAT('". $profile ."', u.profile_pic) END as profile_pic")) */
                  ->whereIn("i.interest_id",function($q) use ($userid){
                      $q->select("interest_id")
                        ->from("user_interests")
                        ->where("user_id",$userid);
                  })
                  ->where(["u.status" => 1,"i.status" => 1])
                  ->where("u.id","!=",$userid)
                  ->where("i.user_id","!=",$userid)
                  ->groupBy("i.user_id")
                  ->having('distance','<=',$userDis)
                  ->orderBy('distance','asc')
                  ->get();
}else {
  $ByInterest = "";
}

   $ByDistance =  DB::table('users as u')
              ->join('user_prefer_distance as d','u.id','=','d.user_id')
              ->select('u.id as user_id','d.distance')

   /*DB::table('users as u')
            ->join('user_prefer_distance as d','u.id','=','d.user_id')
            ->select('u.id as user_id','u.social_id','u.email','u.name','u.gender','u.job_title','u.bio','u.project','u.work_place','u.address','u.latitude','u.longitude','u.day','u.time',DB::raw("CASE WHEN u.profile_pic = '' OR u.profile_pic is null THEN '".$dummyProfile."' ELSE CONCAT('". $profile ."', u.profile_pic) END as profile_pic"),"d.distance",DB::raw("(select group_concat(interest_id) from user_interests where user_id = u.id) as matchedInterest"))*/
            ->where(["u.status" => 1,"d.status" => 1])
            ->where("u.id","!=",$userid)
            ->where("d.user_id","!=",$userid)
            ->where("d.distance","<=",$userDis)
            ->orderBy("distance","asc")
            ->get();

        if($ByInterest && !empty($ByInterest) && count($ByInterest) > 0) {
          if(count($ByInterest) < 10 && count($ByDistance) > 0 && !empty($ByDistance)){
            foreach ($ByInterest as $value) {
              $Users1[] = $value->user_id;
            }
            foreach ($ByDistance as $value1) {
              $Users2[] = $value1->user_id;
            }
            
           $allUsers  =  array_merge($Users1,$Users2); 
           return array_unique($allUsers);
          }else {
            return $ByInterest;
          }  
        }else {
          return $ByDistance;
        }
    
  
}

    public function updateSuggestion($userid,$users,$count) {
      $exists = DB::table("user_suggestion")
                  ->where("user_id",$userid);

      $users     = array_unique($users);
      $insertNew = array_chunk($users,10);
      $count = count($insertNew);
      if(!$exists->exists() || $exists->exists() == false){
        $j = 0;
        for($i = 0; $i < $count; $i++) {
            DB::table("user_suggestion")
                ->insert([
                    "user_id"          =>  $userid,
                    "suggestions_ids"  =>  implode(",",$insertNew[$i]),
                    "suggestion_count" =>  count($insertNew[$i]),
                    "todays"           =>  date('Y-m-d H:i:s', strtotime('+'.$i.'days')),
                    "next_date"        =>  date('Y-m-d H:i:s', strtotime('+'.($i+1).'days'))
                  ]);
          $j++;
        }
        if($j > 0){
          return "inserted";
        }
      }elseif($exists->exists()) {
          $_old       =  $exists->select(DB::raw("(group_concat(suggestions_ids)) as olds"))->first();
          $oldIds     = $_old->olds;
          $last_row   = $exists->select("*")->orderBy("id","desc")->limit(1)->first();
          $diff       = array_diff($users,explode(",",$oldIds)); 
          $diff       = array_values($diff);
          $diff_count = count($diff);
          if(!$diff || $diff_count == 0){
            return true;
          }else if($diff || $diff_count > 0){
            $users = array();
            $_NewUser = array_chunk($diff,10);

            if($last_row->suggestions_ids && !empty($last_row->suggestions_ids)){
              $last_users = explode(",",$last_row->suggestions_ids);
              $count_ids  = count($last_users);
              $count_split   = count($_NewUser);
              $last_next_day = $last_row->next_date;
              if($count_ids == 10){
                $j = 0;
                for($i = 0; $i < $count_split; $i++) {
                  DB::table("user_suggestion")
                      ->insert([
                          "user_id"          =>  $userid,
                          "suggestions_ids"  =>  implode(",",$_NewUser[$i]),
                          "suggestion_count" =>  count($_NewUser[$i]),
                          "todays"           =>  date("Y-m-d H:i:s", strtotime($i." day", strtotime($last_next_day))),
                          "next_date"        =>  date("Y-m-d H:i:s", strtotime(($i+1)." day", strtotime($last_next_day)))
                        ]);
                    $j++;
                  }
                  if($j > 0){
                    return true;
                  }
                }else if($count_ids < 10){
                  $insertNew1 = false;
                  $_newUser    = array_merge($last_users,$diff);
                  $split_users = array_chunk($_newUser,10);
                  $count_update = count($split_users);

                  if($split_users && !empty($split_users)) {
                    if(!empty($split_users[0]) || $count_update == 1){
                    
                      $insertNew1 = DB::table("user_suggestion")
                                    ->where([
                                            "user_id" => $userid,
                                            "id"      => $last_row->id
                                            ])
                                    ->update([
                                        "suggestions_ids"   => implode(",",$split_users[0]),
                                        "suggestion_count"  => count($split_users[0])

                                      ]);
                        
                      }
                      if($count_update > 1 || isset($split_users[1])){
                        unset($split_users[0]);
                        $split_users    = array_values($split_users);
                          $j = 0;
                          for($i = 0; $i < $count_update - 1; $i++) {
                           $insertNew1 = DB::table("user_suggestion")
                                        ->insert([
                                            "user_id"          =>  $userid,
                                            "suggestions_ids"  =>  implode(",",$split_users[$i]),
                                            "suggestion_count" =>  count($split_users[$i]),
                                            "todays"           =>  date("Y-m-d H:i:s", strtotime($i." day", strtotime($last_next_day))),
                                            "next_date"        =>  date("Y-m-d H:i:s", strtotime(($i+1)." day", strtotime($last_next_day))),
                                          ]);
                              $j++;
                            }
                            if($j > 0){
                              $insertNew1 = true;
                            }
                        }
                    }
                    return $insertNew1;
                }  
            }
          }
      }   
  }
  /***** INsert interests ****/
  public function deleteInterestIds($userid,$existIds){
    return DB::table("user_interests")
                          ->where("user_id",$userid)
                          ->whereIn("interest_id",$existIds)
                          ->update(["status" => 0,"updated_at" => date("Y-m-d H:i:s")]);
  }
  /**************** insert interests ****/
  public function updateInterests($userid,$val){
    $exist = DB::table("user_interests")
                ->where(["user_id" => $userid,"interest_id" => $val])
                ->first();
    if($exist && !empty($exist)){
      return DB::table("user_interests")
                ->where(["id" => $exist->id])
                ->update(["status" => 1,"updated_at" => date("Y-m-d H:i:s")]);
    }else {
    return DB::table("user_interests")
                ->insert([
                      "user_id"       => $userid,
                      "interest_id"   => $val,
                      "status"        => 1,
                      "created_at"    => date("Y-m-d H:i:s")
                  ]);
        }
    }

    /*added 02/04/2019*/
    /**************** insert days ****/
  public function updateDays($userid,$val){

    $exist = DB::table("user_days")
                ->where(["user_id" => $userid,"day_id" => $val])
                ->first();

    if($exist && !empty($exist)){
      return DB::table("user_days")
                ->where(["id" => $exist->id])
                ->update(["status" => '1',"updated_at" => date("Y-m-d H:i:s")]);
    }else {
    return DB::table("user_days")
                ->insert([
                      "user_id"       => $userid,
                      "day_id"        => $val,
                      "status"        => '1',
                      "created_at"    => date("Y-m-d H:i:s")
                  ]);
        }
    }/*added 02/04/2019*/
    /**************** insert times ****/
  public function updateTimes($userid,$val){

    $exist = DB::table("user_times")
                ->where(["user_id" => $userid,"time_id" => $val])
                ->first();

    if($exist && !empty($exist)){
      return DB::table("user_times")
                ->where(["id" => $exist->id])
                ->update(["status" => '1',"updated_at" => date("Y-m-d H:i:s")]);
    }else {
    return DB::table("user_times")
                ->insert([
                      "user_id"       => $userid,
                      "time_id"       => $val,
                      "status"        => '1',
                      "created_at"    => date("Y-m-d H:i:s")
                  ]);
        }
    }

    /*added 02/04/2019*/
    /**************** insert workplace ****/
  public function updateWorkplace($userid,$val){

    $exist = DB::table("user_workplace")
                ->where(["user_id" => $userid,"workplace_id" => $val])
                ->first();

    if($exist && !empty($exist)){
      return DB::table("user_workplace")
                ->where(["id" => $exist->id])
                ->update(["status" => '1',"updated_at" => date("Y-m-d H:i:s")]);
    }else {
    return DB::table("user_workplace")
                ->insert([
                      "user_id"       => $userid,
                      "workplace_id"  => $val,
                      "status"        => '1',
                      "created_at"    => date("Y-m-d H:i:s")
                  ]);
        }
    }

    
    /********** showing suggestion according to date*/

    public function getCurrentList($userid,$otherUser){
      $userDetail = $this->getLatLong($userid);
      $lat        = $userDetail['lat'];
      $long       = $userDetail['long'];
      $interest   = $userDetail['interest'];
      $userDis    = $userDetail['distance'];

      $result =  $returnResult = "";
      $profile = url('/').'/public/uploads/profile/';
      $dummyProfile = $profile.'dummyprofile.jpg';
      if(!empty($lat) && !empty($long)) {
      $result =  DB::table('users as u')
                ->leftjoin('user_interests as i','u.id','=','i.user_id')
                ->select('u.id as user_id','u.social_id','u.email','u.name','u.gender','u.job_title','u.bio','u.project','u.work_place','u.address','u.latitude','u.longitude','u.day','u.time',DB::raw("CASE WHEN round((3959  * acos(cos(radians($lat)) * cos(radians(u.latitude)) * cos(radians(u.longitude) - radians($long)) + sin(radians($lat)) * sin(radians(u.latitude))))) IS NULL THEN 0 ELSE round((3959 * acos(cos(radians($lat)) * cos(radians(u.latitude)) * cos(radians(u.longitude) - radians($long)) + sin(radians($lat)) * sin(radians(u.latitude))))) END AS distance"),DB::raw('group_concat(i.interest_id) as matchedInterest'),DB::raw("CASE WHEN u.profile_pic = '' OR u.profile_pic is null THEN '".$dummyProfile."' ELSE CONCAT('". $profile ."', u.profile_pic) END as profile_pic"))
                ->where(["u.status" => 1,"i.status" => 1,"u.id" => $otherUser])
               // ->having("distance","<=",$userDis)
                //->having()
                ->first();
          $returnResult = $result;
  }
      if(empty($result)){
        $result1 = DB::table('users as u')
              ->LeftJoin('user_prefer_distance as d','u.id','=','d.user_id')
              ->select('u.id as user_id','u.social_id','u.email','u.name','u.gender','u.job_title','u.bio','u.project','u.work_place','u.address','u.latitude','u.longitude','u.day','u.time',DB::raw("CASE WHEN u.profile_pic = '' OR u.profile_pic is null THEN '".$dummyProfile."' ELSE CONCAT('". $profile ."', u.profile_pic) END as profile_pic"),"d.distance",DB::raw("(select group_concat(interest_id) from user_interests where user_id = u.id) as matchedInterest"))
              ->where(["u.status" => 1,"d.status" => 1,"u.id" => $otherUser])
              //->where("distance","<=",$userDis)
              ->first();

        if($result1 && !empty($result1)){
          $returnResult = $result1;
        }
      }
      return [
              "user_id"         => $returnResult->user_id,
              "social_id"       => $returnResult->social_id,
              "email"           => $returnResult->email,
              "name"            => $returnResult->name,
              "gender"          => $returnResult->gender,
              "job_title"       => $returnResult->job_title,
              "bio"             => $returnResult->bio,
              "project"         => $returnResult->project,
              "work_place"      => $returnResult->work_place,
              "longitude"       => $returnResult->longitude,
              "latitude"        => $returnResult->latitude,
              "day"             => $returnResult->day,
              "time"            => $returnResult->time,
              "distance"        => $returnResult->distance,
              "matchedInterest" => $returnResult->matchedInterest,
              "profile_pic"     => $returnResult->profile_pic,
            ];
    }
  
    /********************************* END MODEL *********************************************/
  
  

  private function getLatLongs($userid){

    $interests = DB::table("user_interests")
                  ->select(DB::raw("group_concat(interest_id) as interest"))
                  ->where("user_id",$userid)
                  ->where("status",1)
                  ->first()->interest;

    $distance = DB::table("user_prefer_distance")
                ->select("distance")
                ->where("user_id",$userid)
                ->where("status",1);

    $userDetail = User::find($userid);
    if(!$userDetail){
      return false;
    }
    $lat      = isset($userDetail->latitude)?$userDetail->latitude:null;
    $long      = isset($userDetail->longitude)?$userDetail->longitude:null;
    $interest = $interests;

    if($distance->exists()){
      $userDis = $distance->first()->distance;
    }else {
      $userDis = 35;
    }

    return [
            "distance" => $userDis,
            "lat"      => $lat,
            "long"     => $long,
            "interest" => $interest
          ];
}

public function getUserSuggestions($userId,$latLong){
   $userDetails = $this->getLatLongs($userId);
    if(!$userDetails){
      return 0;
    }
    $interests = explode(",",$userDetails['interest']);
    $distance  = $userDetails['distance']; 
    if(isset($latLong) && $latLong){
        if(!empty($latLong["lats"]) && !empty($latLong["longi"]) && $latLong["longi"] && $latLong["lats"]){
           $lat  = $latLong["lats"];
           $long = $latLong["longi"];
          
        }else {
           $lat        = $userDetails['lat'];
           $long       = $userDetails['long'];  
        }
    }else {
       $lat        = $userDetails['lat'];
       $long       = $userDetails['long']; 
    }
    
    
    if(strlen($lat) < 1 && strlen($long) < 1){
        $lat        = $userDetails['lat'];
       $long       = $userDetails['long']; 
    }
    
    $profile = url('/').'/public/uploads/profile/';
    $dummyProfile = $profile.'dummyprofile.jpg';
    $suggestion = DB::table("users as u");
    $suggestionI = null;
    if($lat && $long){
      $suggestionI = $suggestion->Join("user_interests as i","i.user_id","=","u.id");
      $suggestionI = $suggestionI->select(DB::RAW('DISTINCT(u.id) as user_id'),'u.social_id','u.email','u.name','u.gender','u.job_title','u.bio','u.project','u.work_place','u.address','u.latitude','u.longitude','u.day','u.time','u.profile_pic',DB::raw("CASE WHEN round((3959  * acos(cos(radians($lat)) * cos(radians(u.latitude)) * cos(radians(u.longitude) - radians($long)) + sin(radians($lat)) * sin(radians(u.latitude))))) IS NULL THEN 0 ELSE round((3959 * acos(cos(radians($lat)) * cos(radians(u.latitude)) * cos(radians(u.longitude) - radians($long)) + sin(radians($lat)) * sin(radians(u.latitude))))) END AS distance"),DB::raw("(select group_concat(interest_id) from user_interests where user_id = u.id and  status = 1) as matchedInterest"));
/*block users*/
        $suggestionI = $suggestionI->whereNotIn("u.id",function($query) use ($userId){
                                    $query->select("other_user_id")
                                          ->from("blocks")
                                          ->where(function($query) use ($userId){
                                              $query->where("user_id",$userId)
                                                    ->orwhere("other_user_id",$userId);

                                          })
                                          ->where("status",1);

        });
        $suggestionI = $suggestionI->whereNotIn("u.id",function($query) use ($userId){
                                    $query->select("user_id")
                                          ->from("blocks")
                                          ->where(function($query) use ($userId){
                                              $query->where("user_id",$userId)
                                                    ->orwhere("other_user_id",$userId);

                                          })
                                          ->where("status",1);

        });

/*match user*/
        $suggestionI = $suggestionI->whereNotIn("u.id",function($query) use ($userId){
                                    $query->select("user_id")
                                          ->from("matches")
                                          ->where(function($query) use ($userId){
                                              $query->where("user_id",$userId)
                                                    ->orwhere("other_user_id",$userId);

                                          });

        });
        $suggestionI = $suggestionI->whereNotIn("u.id",function($query) use ($userId){
                                    $query->select("other_user_id")
                                          ->from("matches")
                                          ->where(function($query) use ($userId){
                                              $query->where("user_id",$userId)
                                                    ->orwhere("other_user_id",$userId);

                                          });

        });
/*Pass user check*/
       $suggestionI = $suggestionI->whereNotIn("u.id",function($query) use ($userId){
                                    $query->select("other_user_id")
                                          ->from("passUsers")
                                          ->where(function($query) use ($userId){
                                              $query->where("user_id",$userId)
                                                    ->orwhere("other_user_id",$userId);

                                          }); 
      });

       $suggestionI = $suggestionI->whereNotIn("u.id",function($query) use ($userId){
                                    $query->select("other_user_id")
                                          ->from("passUsers")
                                          ->where(function($query) use ($userId){
                                              $query->where("user_id",$userId)
                                                    ->orwhere("other_user_id",$userId);

                                          }); 
      }); 

        $suggestionI = $suggestionI->whereIn("i.interest_id",function($q) use ($userId){
                      $q->select("interest_id")
                        ->from("user_interests")
                        ->where("user_id",$userId)
                        ->where("status",1);
        });
        
        $suggestionI = $suggestionI->where("u.status",1);
        $suggestionI = $suggestionI->where([["u.id","!=",$userId],["i.id","!=",$userId]]);
        $suggestionI = $suggestionI->limit(12);
        $suggestionI = $suggestionI->orderBy("distance","asc");
        
        $suggestionI = $suggestionI->having("distance","<=",$distance);
        $suggestionI = $suggestionI->get();
      }
      

    /* By distance*/
    $suggestionD = DB::table("users as u");
    $suggestionD = $suggestionD->join('user_prefer_distance as d','u.id','=','d.user_id');

    $suggestionD = $suggestionD->select(DB::RAW('DISTINCT(u.id) as user_id'),'u.social_id','u.email','u.name','u.gender','u.job_title','u.bio','u.project','u.work_place','u.address','u.latitude','u.longitude','u.day','u.time','u.profile_pic',"d.distance",DB::raw("(select group_concat(interest_id) from user_interests where user_id = u.id and  status = 1) as matchedInterest "));
   
   /* blocks */
    $suggestionD = $suggestionD->whereNotIn("u.id",function($query) use ($userId){
                                    $query->select("other_user_id")
                                          ->from("blocks")
                                          ->where(function($query) use ($userId){
                                              $query->where("user_id",$userId)
                                                    ->orwhere("other_user_id",$userId);

                                          })
                                          ->where("status",1);

        });
    $suggestionD = $suggestionD->whereNotIn("u.id",function($query) use ($userId){
                                    $query->select("user_id")
                                          ->from("blocks")
                                          ->where(function($query) use ($userId){
                                              $query->where("user_id",$userId)
                                                    ->orwhere("other_user_id",$userId);

                                          })
                                          ->where("status",1);

    });
    /* match users*/
    $suggestionD = $suggestionD->whereNotIn("u.id",function($query) use ($userId){
                                    $query->select("user_id")
                                          ->from("matches")
                                          ->where(function($query) use ($userId){
                                              $query->where("user_id",$userId)
                                                    ->orwhere("other_user_id",$userId);

                                          });

        });
    $suggestionD = $suggestionD->whereNotIn("u.id",function($query) use ($userId){
                                    $query->select("other_user_id")
                                          ->from("matches")
                                          ->where(function($query) use ($userId){
                                              $query->where("user_id",$userId)
                                                    ->orwhere("other_user_id",$userId);

                                          });

        });
/*Pass user check*/
       $suggestionD = $suggestionD->whereNotIn("u.id",function($query) use ($userId){
                                    $query->select("other_user_id")
                                          ->from("passUsers")
                                          ->where(function($query) use ($userId){
                                              $query->where("user_id",$userId)
                                                    ->orwhere("other_user_id",$userId);

                                          }); 
      });

       $suggestionD = $suggestionD->whereNotIn("u.id",function($query) use ($userId){
                                    $query->select("other_user_id")
                                          ->from("passUsers")
                                          ->where(function($query) use ($userId){
                                              $query->where("user_id",$userId)
                                                    ->orwhere("other_user_id",$userId);

                                          }); 
      }); 
      
    $suggestionD = $suggestionD->where(["u.status" => 1,"d.status" => 1]);
    $suggestionD = $suggestionD->where("u.id","!=",$userId);
    $suggestionD = $suggestionD->where("d.user_id","!=",$userId);
    $suggestionD = $suggestionD->where("d.distance","<=",$userId);
    $suggestionD = $suggestionD->orderBy("distance","asc");
       if($suggestionI && !empty($suggestionI)){
        $ar = array();
        foreach ($suggestionI as $key => $value) {
          if($value && @$value->user_id){
            $ar[] = $value->user_id;
          }
        }
        $cnt = count($ar);
      if($cnt > 0 && !empty($ar) && $ar && $cnt < 12){
        $suggestionD = $suggestionD->whereNotIn("u.id",$ar);
       }
       if($cnt && $cnt > 0) {
          $suggestionD = $suggestionD->limit(12 - $cnt);
        }else {
          $suggestionD = $suggestionD->limit(12);
        }
      }
    
    
    $suggestionD = $suggestionD->get();
    $suggestionD = ($suggestionD && !empty($suggestionD) && count($suggestionD) > 0)?$suggestionD:null;
    return array("byInterest" => $suggestionI,"byDistance" => $suggestionD);
}
}