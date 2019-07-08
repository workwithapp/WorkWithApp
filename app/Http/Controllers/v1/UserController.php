<?php

namespace App\Http\Controllers\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use App\User;
use Auth;
use DB;
use Crypt;
use Mail;
use DateTime;
use File;
use Response;
use Carbon\Carbon;
use App\v1\Webservice;
use App\notification;
use Redirect;

class UserController extends Controller
{

  private $required_field_error = "Please fill all fields!";
  private $unauthorized         = array('message' => 'Email or password is incorrect');
  private $logoutSuccess        = array('message' => 'You are logged out successfully');
  private $tokenExpire          = array('message' => 'Authentication failed');
  private $badRequest           = array('message' => 'Request failed');
  private $updateapp            = array('message' => 'An updated version of Workwith is available. Please update unless your application will not work.');
  private $emailrequest         = array('message' => 'Email has already been taken.');
  private $emailnotregister     = array('message' => 'The email is not registered with us.');
  private $nocontent            = array('message' => 'No data found');
   
  public function __construct(Request $req){
    date_default_timezone_set("Asia/kolkata");
    $this->webservice = new Webservice;

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: PUT, GET, POST");
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

    /*$version      = $req->header('version');
    $device_type  = $req->header('devicetype');


    if($version <= 2 && $device_type == 'A'){

      echo json_encode(array('status' => 426, 'message' => 'An updated version  of Touchmassage is available please update unless your application will not work.'));
      die;

    }elseif($version <= 2.0 && $device_type == 'I'){

      echo json_encode(array('status' => 426, 'message' => 'An updated version of Touchmassage is available please update unless your application will not work.'));
      die;

    }*/

  } //end of constructor



	/****************************************/
	/*Get All Int*/
	/**************************************/
public function getInterests(){
	$interests = DB::table('interests')->where('status',1)->select('id','name')->get();
  
    if (!$interests) {
      return response(array('data' => []), SUCCESS)->header('Content-Type', 'application/json');
    }else{
       return response(array('data' => $interests), SUCCESS)->header('Content-Type', 'application/json');
    }
}


    /********************************/
    /* RANDOM STRING GENERATE 
    /********************************/
  function generateRandomString($length) {
    
    $pool = array_merge(range(0,9),range('A', 'Z'));
      
    for($i=0; $i < $length; $i++){
      @$key .= $pool[mt_rand(0, count($pool) - 1)];
    }

    $ran   = md5(uniqid(rand(), true));  
    $srtrs = round(microtime(true));
    return $key.substr($ran,3,3).substr($srtrs,3,3);
  }


    /***************************************/
    /* FUNCTION FOR CHECK TOKEN EXPIRED OR NOT
    /***************************************/
  function GetCheckToken($user,$login_token)
  {
    $user = DB::table('users')->where('id','=',$user)->where('token','=', $login_token)->select('id')->first();
    
    if (!$user) {
      return response(array('message' => 'Session expired!.Please login again.'), UNAUTHORIZED)->header('Content-Type', 'application/json');
    }else{
      return true;
    }

  }  


    /***********************************************/
    /* FUNCTION FOR CHECK User Login Another Device
    /***********************************************/
  function UserLoginanotherDevice($user,$token)
  {
    $user = DB::table('users')->where('id','=',$user)->where('token','=', $token)->select('id')->first();
    
    if (!$user) {

      echo json_encode(array('status' => 401, 'message' => 'It seems like you have logged in from another device. Please sign in again.'));
      die;
    }else{

      return true;
    }
  }
    
    /********************************/
    /* Signup 
    /********************************/
  public function signup(Request $req){

    $validator = Validator::make($req->all(), [  
                'email'                     => 'required',
                'password'                  => 'required',
                'device_type'               => 'required',
                'device_id'                 => 'required'

                ]);

    if ($validator->fails()) {

      return response(['error' => $validator->errors()->first()], BAD_REQUEST)->header('Content-Type', 'application/json');

    }else{
      
      $User = new User;
      $get_user  = DB::table('users')->where('email',$req->input('email'))->where('register_type','O')->first();
      $token_key = $this->generateRandomString(10);
      
      if(empty($get_user)){

        $User->email              = $req->input('email');
        $User->device_type        = $req->input('device_type');
        $User->device_id          = $req->input('device_id');
        $User->token              = $token_key;
        $User->version            = $req->input('version');
        $User->password           = Hash::make($req->input('password'));
        $User->version            = 1.0;
        $User->status             = 1;
        $User->verifiy_email      = 1;
        $User->save();                
        $id = $User->id;

        $datas = DB::table('users')->where('id',$id)->select('id','email','token','device_id','device_type')->first();
        /*$app_url = "http://142.4.10.93/~vooap/workwith/account-verify/".base64_encode($User->id);
        $content = "Thankyou for you your registration,<a href='".$app_url."'>Click here</a> to verify your account"; 

        $email = $User->email;
        Mail::send(array(), array(), function ($message) use ($content,$email) 
        {
          
          $from  = 'info@workwith.com';
          $message->to($email ,'Workwith verify account')
                  ->subject('Workwith verify account')
                  ->setBody($content, 'text/html');

        });*/
        return response(array('message' => 'Registration successfully','data' => $datas), SUCCESS)->header('Content-Type', 'application/json');           
        //return response(array('message' => 'Registration successfully,Please check your mail address to verify you account'), SUCCESS)->header('Content-Type', 'application/json');           
      }else{
        return response($this->emailrequest, SUCCESS)->header('Content-Type', 'application/json'); 
      }
    }
  }


  public function verify_email($user_id){
   
     $user_id = base64_decode($user_id);
     $User  = User::find($user_id);
     if($User){
      if($User->verifiy_email == 0){
        User::where("id",$User->id)->update(["verifiy_email"=>1]);
          return Redirect::to("http://142.4.10.93/~vooap/workwith/email_verified")->with("success","email verified");


      }else if($User->verifiy_email == 1){
        return Redirect::to("http://142.4.10.93/~vooap/workwith/email_verified")->with("success","email verified");
      }
     }else {

        return Redirect::to("http://142.4.10.93/~vooap/workwith/email_verified")->with("success","Invalid account");
     }
  }

  public function socialSignup(Request $req){

    $validator  = Validator::make($req->all(), [  
                    'email'         => 'required',
                    'password'      => 'required',
                    'device_id'     => 'required',
                    'device_type'   => 'required',
                    ]);

    if ($validator->fails()) {
      return response(['error' => $validator->errors()->first()], BAD_REQUEST)->header('Content-Type', 'application/json');
    }else{
      $User = new User;
      $get_user  = DB::table('users')->where('social_id', $req->social_id)->where('register_type', $req->register_type)->first();
      $token_key = $this->generateRandomString(10);

      if(empty($get_user)){

        $User->email              = $req->input('email','');
        $User->device_type        = $req->input('device_type', '');
        $User->device_id          = $req->input('device_id', '');
        $User->register_type      = $req->input('register_type', '');
        $User->token              = $token_key;
        $User->version            = 1.0;
        $User->social_id          = $req->input('social_id','');
        
        $User->save();                
        $id = $User->id;

        $datas = DB::table('users')->where('id',$id)->select('id','email','token','device_id','device_type')->first();
              
        return response(array('data' => $datas), SUCCESS)->header('Content-Type','application/json');           
      }else{

        $this->webservice->UpdateLoginToken($get_user->id,$token_key,$req->device_type,$req->device_id);
         
        $datas = User::find($get_user->id);

        return response(array('data' => $datas), SUCCESS)->header('Content-Type', 'application/json');
      }
    }
  }

    /********************************/
    /* Login 
    /********************************/

  public function login(Request $req)
  {

    $email      = $req->input('email');
    $password   = $req->input('password');
    $deviceId   = $req->input('device_id');
    $deviceType = $req->input('device_type');
    $validator  = Validator::make($req->all(), [  
                    'email'         => 'required',
                    'password'      => 'required',
                    'device_id'     => 'required',
                    'device_type'    =>  'required'
                    ]);

    if ($validator->fails()) {          
      
      return response(['error' => $validator->errors()->first()], BAD_REQUEST)->header('Content-Type', 'application/json');

    }else{
 
      $User = User::where("email",$email)->where("register_type",'O')->first();

      if($User && !empty($User)){
        if(Hash::check($password,$User->password)){
          $status = $User->status;

          if($User->verifiy_email == 0){
              return response(array('error'=> "Your account is not verified"), SUCCESS)->header('Content-Type', 'application/json');
          }


          if($status == 0){
            return response(array('error'=> "Your account is not active"), SUCCESS)->header('Content-Type', 'application/json');
          } else if($status == 3){
          return response(array('error'=> "Your account has been deleted"), SUCCESS)->header('Content-Type', 'application/json');
         }else {

            if($status == 2){
                User::where("id",$userId)->update(array("status" => 1));
            }


            if(Auth::loginUsingId($User->id)){
              $data = Auth::user();
              $token_key   = $this->generateRandomString(10);

              $this->webservice->UpdateLoginToken($data->id,$token_key,$deviceType,$deviceId);
               $data->token = $token_key;
              return response(array('data'=> $data), SUCCESS)->header('Content-Type', 'application/json');
            }else {
              return response(array('error'=> "Login failed"), SUCCESS)->header('Content-Type', 'application/json');
            }
         }
        }else {
          return response(array('error'=> "Wrong password"), SUCCESS)->header('Content-Type', 'application/json');
        }
      }else {
        return response(array('error'=> "Email Address doesn't exists in our Database"), BAD_REQUEST)->header('Content-Type', 'application/json');
      }


      /*if (Auth::attempt(['email' => $email, 'password' => $password])){
        $userId = Auth::id();
        $data   = User::find($userId);
        $status = $data->status;

        if($status == 2){
          User::where("id",$userId)->update(array("status" => 1));
          $data["status"] = 1;
        }

        if($status == 0){
          return response(array('error'=> "Your account is not active"), SUCCESS)->header('Content-Type', 'application/json');    
        }else if($status == 3){
          return response(array('error'=> "Your account has been deleted"), SUCCESS)->header('Content-Type', 'application/json');
        }

        $token_key   = $this->generateRandomString(10);
        $this->webservice->UpdateLoginToken($data->id,$token_key,$deviceType,$deviceId);
         $data->token = $token_key;
        return response(array('data'=> $data), SUCCESS)->header('Content-Type', 'application/json');

      }






      else{
        return response($this->unauthorized, UNAUTHORIZED)->header('Content-Type', 'application/json');
      }*/
    }
  }

    /********************************/
    /* Logout
    /********************************/
  public function logout(Request $req){

      $userId  = $this->webservice->getUserIdFromToken($req->header('token'));
      $User = new User();
      $User = User::find($userId); 
      $User->token = '';
      $User->device_id   = '';
      $User->device_type = '';

      if($User->save()){
        return response($this->logoutSuccess, SUCCESS)->header('Content-Type','application/json');
      
      }else{
        return response($this->unauthorized, NOT_ACCEPTABLE)->header('Content-Type', 'application/json');
      } 
    }
  


    /********************************/
    /* Get Interest List
    /********************************/
  public function getInterest(){

    $interest = DB::table('interests')->where('status', '1')->get(); 
   
    if($interest){

      return response(['data' => $interest], SUCCESS)->header('Content-Type', 'application/json');
    
    }else{

      return response(['data' => []], NO_CONTENT)->header('Content-Type', 'application/json');
    
    } 
  }





 public function getWorkplace(){

    $workplace = DB::table('workplace')->where('status', '1')->get(); 
    if($workplace){

      return response([ 'data' => $workplace], SUCCESS)->header('Content-Type', 'application/json');
    
    }else{

      return response(['data' => []], NO_CONTENT)->header('Content-Type', 'application/json');
    
    } 
  }

    /********************************/
    /* Get Days List
    /********************************/
  public function getDays(){

    $day = DB::table('days')->where('status', '1')->get(); 

    if($day) {
      return response([ 'data' => $day], SUCCESS)->header('Content-Type', 'application/json');
    
    }else{

      return response(['data' => []], NO_CONTENT)->header('Content-Type', 'application/json');
    
    } 
  }

    /********************************/
    /* Get Time List
    /********************************/
  public function getTimes(){

    $time = DB::table('times')->where('status', '1')->get(); 
   
    if(!$time->isEmpty()){

      return response(['data' => $time], SUCCESS)->header('Content-Type', 'application/json');
    
    }else{

      return response(['message' => 'No result found'], NO_CONTENT)->header('Content-Type', 'application/json');
    
    } 
  }
   
      /********************************/
      /* Forgot Password API
      /********************************/
  public function forgotPassword(Request $req)
  {

    $validator  = Validator::make($req->all(), [  
                    'email'         => 'required'
                    ]);
    if ($validator->fails()) {          
      
      return response(['error' => $validator->errors()->first()], BAD_REQUEST)->header('Content-Type', 'application/json');

    }else {
      $email = $req->get('email');
      $user = DB::table('users')->where('email',$email)->where('register_type', 'O')->first();

      if($user){

        $password_token = $this->generateRandomString(10);

        $update_user_data = DB::table('users')
                            ->where('email',$email)
                            ->where('register_type', 'O')
                            ->update(array('password' => Hash::make($password_token)));

        $content = "Please use this password for login into the app :- ".$password_token; 

        Mail::send(array(), array(), function ($message) use ($content,$email) 
        {
          
          $from  = 'info@workwith.com';
          $message->to($email ,'Workwith forgot password')
                  ->subject('Request for change password')
                  ->setBody($content, 'text/html');

        });

        return response(array('message' => 'Please check your mail address to reset your password'), SUCCESS)->header('Content-Type', 'application/json');  

      }else{
        return response($this->emailnotregister, BAD_REQUEST)->header('Content-Type', 'application/json');
      }
  }
}


    /**************************************
     Reset password when user click 
     on click from mail 
  ***********************************/  

  public function resetPasswordForm($token)
  {
      $tokenn = explode("-", $token);
      $user_id=$tokenn[2];
      $password_token=$tokenn[3];
      $error= '';
  
     $result_data = $this->webservice->GetPasswordToken($password_token,$user_id);

    if(!$result_data){
      $error = 'Password token has been expired!!';
      
    }
     return View::make('emails.resetpasswordform', ['error' => $error,'token' => $password_token,'user_id'=>$user_id]);
  }


  /************************************
     Set New password after fill the
     reset password form by user
  **************************************/

  public function setNewPassword()
  {
    $password_token   = htmlspecialchars(trim(Input::get('token')));
    $user_id          = htmlspecialchars(trim(Input::get('user_id')));
    $password         = htmlspecialchars(trim(Input::get('password')));
    $repeat_password  = htmlspecialchars(trim(Input::get('repeat_password')));

      $result_data = $this->webservice->GetPasswordToken($password_token,$user_id);      
    if($result_data && $password_token !='')
    {
      if($password == $repeat_password && $password != '' && $repeat_password != '')
      { 
        $UpdateDetailObj = DB::table('users')
         ->where('id',$user_id)
         ->limit(1)
         ->update(array('password' =>Hash::make($password),'password_token' =>''));
      
      $message = "Password Reset Successfully!";      
      return View::make('emails.resetpasswordform', ['message' => $message]);

      }else{

        $error = "Password Not Match!";
        $password_token = $password_token;

        return View::make('emails.resetpasswordform', ['error' => $error,'token' => $password_token,'user_id'=>$user_id]); 
      }

    }else{     
      $expire_token = "Password token expired! Please resend mail to get new token.";
        return View::make('emails.resetpasswordform', ['expire_token' => $expire_token]);    
    }
  }
 /**************************************/
    /* Create profile api */
    /**************************************/
  public function createProfile(Request $req){

    $validator = validator::make($req->all(),[
                'name'              => 'required',
                'dob'               => 'required',
                'interest'          => 'required',
                'latitude'          => 'required',
                'longitude'         => 'required'
                ]
               ); 
            
    if ($validator->fails()) {          
               
      return response(['error' => $validator->errors()->first()], BAD_REQUEST)->header('Content-Type', 'application/json');
    
    }else{


     $userId = $this->webservice->getUserIdFromToken($req->header('token'));
     
      if(!$userId){/* check user id with token valid'--*/
        return response(array('error'=>'Invalid Token'), UNAUTHORIZED)->header('Content-Type', 'application/json');
      }

      $req->user_id = $userId;
      $name = $req->input('name');
      $uname = (!empty($name) && $name != "undefined")?$name:"";

      $gender = $req->input('gender');
      $ugender = (!empty($gender) && $gender != "undefined")?$gender:"";

       $dob = $req->input('dob');
      $udob = (!empty($dob) && $dob != "undefined")?$dob:"";

       $job_title = $req->input('job_title');
      $ujob_title = (!empty($job_title) && $job_title != "undefined")?$job_title:"";

       $name = $req->input('name');
      $uname = (!empty($name) && $name != "undefined")?$name:"";

       $bio = $req->input('bio');
      $ubio = (!empty($bio) && $bio != "undefined")?$bio:"";

       $project = $req->input('project');
      $uproject = (!empty($project) && $project != "undefined")?$project:"";

      $address = $req->input('address');
      $uaddress = (!empty($address) && $address != "undefined")?$address:"";

      $goal = $req->input('goal');
      $ugoal = (!empty($goal) && $goal != "undefined")?$goal:"";




      $data = array(
                  'name'        =>  $uname,
                  'gender'      =>  $ugender,
                  'dob'         =>  $udob,
                  'job_title'   =>  $ujob_title,
                  'bio'         =>  $ubio,
                  'project'     =>  $uproject,
                  //'work_place'  =>  $req->input('work_place', ''),
                  'address'     =>  $uaddress,
                  'latitude'    =>  $req->input('latitude'),
                  'longitude'   =>  $req->input('longitude'),
                  //'day'         =>  $req->input('day', ''),
                  //'time'        =>  $req->input('time', ''),
                  'updated_at'  =>  date("Y-m-d H:i:s"),
                  'goal'        =>  $ugoal
              );
      $result = false;
      if($req->hasFile('profile_pic')){
        $extension       = Input::file('profile_pic')->getClientOriginalExtension(); 
        $destinationPath = base_path('/') . '/public/uploads/profile';
        $profileImage    = uniqid(mt_rand(1,10)).'.'.$extension;
        Input::file('profile_pic')->move($destinationPath, $profileImage);

        $data['profile_pic'] = $profileImage;
      }
        if(!DB::table("user_prefer_distance")->where("user_id",$req->user_id)->exists()) { 
            DB::table("user_prefer_distance")->insert(["user_id" => $req->user_id, "distance" => 35 ]);
        }
       $result = DB::table('users')->where('id', $req->user_id)->update($data);
    

    if($result){

      $interest = $req->input('interest');

      if($interest){

        $interest_id = explode(',', $interest);

        DB::table('user_interests')->where(['user_id' => $req->user_id])->update(['status' => '0']);

        foreach ($interest_id as $key => $value) {
          
          $user_interest_id = DB::table('user_interests')->where(['user_id' => $req->user_id, 'interest_id' => $value])->first();

          if($user_interest_id){
            DB::table('user_interests')->where(['id' => $user_interest_id->id])->update(['status' => '1']);
          }else{

            $interest_data = array(
                                'user_id'     => $req->user_id,
                                'interest_id' => $value,
                                'updated_at'  => date('Y-m-d H:i:s'),
                                'created_at'  => date('Y-m-d H:i:s'));
            
            DB::table('user_interests')->insert($interest_data);
          }
        }

      }

       /****** User days ***** */

      if(($req->has('day'))) { 
      $Uday      = $req->input('day');
      if($Uday){

        $Uday = explode(',', $Uday);

        DB::table('user_days')->where(['user_id' => $req->user_id])->update(['status' => '0']);

        foreach ($Uday as $key => $value) {
          
          $Uday_id = DB::table('user_days')->where(['user_id' => $req->user_id, 'day_id' => $value])->first();

          if($Uday_id){
            DB::table('user_days')->where(['id' => $Uday_id->id])->update(['status' => '1']);
          }else{

            $day_data = array(
                                'user_id'     => $req->user_id,
                                'day_id'    => $value,
                                'updated_at'  => date('Y-m-d H:i:s'),
                                'created_at'  => date('Y-m-d H:i:s'));
            
            DB::table('user_days')->insert($day_data);
          }
        }
      }
    }

      /* Not used */
      /*if(empty($Uday)){
        DB::table("user_days")->where("user_id",$userId)->update(["status" => '0']);
      }
      $newday   = explode(",",$Uday);*/

      /*$exist_days  = DB::table("user_days")->select(DB::raw("group_concat(day_id) as days"))->where("user_id",$req->user_id)->where("status",'1')->first()->days;
      if($exist_days){
        $existday = explode(",",$exist_days);
      }else {
        $existday = null;
      }
      
      foreach($newday as $value) {
        if($existday) {
          if(($keys = array_search($value,$existday)) !== false){
            unset($newday[$keys]);
            unset($existday[$keys]);
          }
        }
      }

      if($existday) {
          $existday  = array_values($existday);
          DB::table("user_days")->where("user_id",$userId)->whereIn("day_id",$existday)->update(["status" => '0']);
      }

      $j = $i = 0;
      if($newday && count($newday) > 0){
        foreach ($newday as $value) {
          if(!empty($value)) {
            $update = $this->webservice->updateDays($userId,$value);
            if($update){
              $j++;
            }
            $i++;
          }
        }
      }*/
       /* Not used */
    //}
    /*Times*/

    if(($req->has('time'))) { 
      $Utime      = $req->input('time');

      if($Utime){

        $Utime = explode(',', $Utime);

        DB::table('user_times')->where(['user_id' => $req->user_id])->update(['status' => '0']);

        foreach ($Utime as $key => $value) {
          
          $Utime_id = DB::table('user_times')->where(['user_id' => $req->user_id, 'time_id' => $value])->first();

          if($Utime_id){
            DB::table('user_times')->where(['id' => $Utime_id->id])->update(['status' => '1']);
          }else{

            $time_data = array(
                                'user_id'     => $req->user_id,
                                'time_id'    => $value,
                                'updated_at'  => date('Y-m-d H:i:s'),
                                'created_at'  => date('Y-m-d H:i:s'));
            
            DB::table('user_times')->insert($time_data);
          }
        }
      }
    }
 /* Not used */
      /*if(empty($Utime)){
          DB::table("user_times")->where("user_id",$userId)->update(["status" => '0']);
      }
      $newUtime   = explode(",",$Utime);
      $exist_times  = DB::table("user_times")->select(DB::raw("group_concat(time_id) as times"))->where("user_id",$req->user_id)->where("status",'1')->first()->times;
      if($exist_times){
        $existTimes = explode(",",$exist_times);
      }else {
        $existTimes = null;
      }
    
      foreach($newUtime as $value) {
        if($existTimes) {
          if(($keys = array_search($value,$existTimes)) !== false){
            unset($newUtime[$keys]);
            unset($existTimes[$keys]);
          }
        }
      }
     
      if($existTimes) {
          $existTimes  = array_values($existTimes);
          DB::table("user_times")->where("user_id",$userId)->whereIn("time_id",$existTimes)->update(["status" => '0']);
      }

      $j = $i = 0;
      if($newUtime && count($newUtime) > 0){
        foreach ($newUtime as $value) {
          if(!empty($value)) {
            $update = $this->webservice->updateTimes($userId,$value);
            if($update){
              $j++;
            }
            $i++;
          }
        }
      }*/
       /* Not used */
    //}

    /*workplace*/
    if(($req->has('work_place'))) { 
      $Uwork      = $req->input('work_place');
       if($Uwork){

        $Uwork = explode(',', $Uwork);

        DB::table('user_workplace')->where(['user_id' => $req->user_id])->update(['status' => '0']);

        foreach ($Uwork as $key => $value) {
          
          $Uwork_id = DB::table('user_workplace')->where(['user_id' => $req->user_id, 'workplace_id' => $value])->first();

          if($Uwork_id){
            DB::table('user_workplace')->where(['id' => $Uwork_id->id])->update(['status' => '1']);
          }else{

            $workplace_data = array(
                                'user_id'     => $req->user_id,
                                'workplace_id'    => $value,
                                'updated_at'  => date('Y-m-d H:i:s'),
                                'created_at'  => date('Y-m-d H:i:s'));
            
            DB::table('user_workplace')->insert($workplace_data);
          }
        }
      }
    }

 /* Not used */
      /*if(empty($Uwork)){
          DB::table("user_workplace")->where("user_id",$userId)->update(["status" => '0']);
      }
      $newUwork   = explode(",",$Uwork);
      $exist_work = DB::table("user_workplace")->select(DB::raw("group_concat(workplace_id) as works"))->where("user_id",$req->user_id)->where("status",'1')->first()->works;
      if($exist_work){
        $existWorks = explode(",",$exist_work);
      }else {
        $existWorks = null;
      }
    
      foreach($newUwork as $value) {
        if($existWorks) {
          if(($keys = array_search($value,$existWorks)) !== false){
            unset($newUwork[$keys]);
            unset($existWorks[$keys]);
          }
        }
      }
     
      if($existWorks) {
          $existWorks  = array_values($existWorks);
          DB::table("user_workplace")->where("user_id",$userId)->whereIn("workplace_id",$existWorks)->update(["status" => '0']);
      }
      $j = $i = 0;
      if($newUwork && count($newUwork) > 0){
        foreach ($newUwork as $value) {
          if(!empty($value)) {
            $update = $this->webservice->updateWorkplace($userId,$value);
            if($update){
              $j++;
            }
            $i++;
          }
        }
      }*/
       /* Not used */
    //}

   

 
      return response(array('message'=>'Profile create Successfully'), SUCCESS)->header('Content-Type', 'application/json');  
    }else{
      return response(array('error'=>'Failed to create profile'), BAD_REQUEST)->header('Content-Type', 'application/json');
    }
   }
  }

  /**************************************/
  /*       View profile***************/
  /************************************/
  public function viewProfile($userid){
      $exist = User::where("id",$userid)->exists();
      if($exist) {
          $user_profile   =  $this->webservice->otherUserProfile($userid);
        return response(array('data'=>$user_profile), SUCCESS)->header('Content-Type', 'application/json');
      }else {
        return response(array('error' => "User not exists"),BAD_REQUEST)->header('Content-Type', 'application/json');
      }
  }
  /**************************************/
  /*       View profile***************/
  /************************************/
  public function myProfile(Request $req){
    
      $userId =  $this->webservice->getUserIdFromToken($req->header('token'));
      if(!$userId && empty($userId)){
        return response(array('error'=>'Invalid Token'), UNAUTHORIZED)->header('Content-Type', 'application/json');
      }else {
        $user_profile   =  $this->webservice->userProfile($userId);
        return response(array('data'=>$user_profile), SUCCESS)->header('Content-Type', 'application/json');
      }
      
  }

  /**************************************/
  /*       Update profile***************/
  /************************************/
  public function updateProfile(Request $req){

    $validator = validator::make($req->all(),[
                'name'              => 'required',
                ]); 
            
    if($validator->fails()) { 
      return response(['error' => $validator->errors()->first()], BAD_REQUEST)->header('Content-Type', 'application/json');
    }else{
     $userId =  $this->webservice->getUserIdFromToken($req->header('token'));
    
      if(!$userId){/* check user id with token valid'--*/
        return response(array('error'=>'Invalid Token'), UNAUTHORIZED)->header('Content-Type', 'application/json');
      }
      $req->user_id = $userId;


      $data = array();
      if($req->has('name') && !empty($req['name'])){
        $data['name'] = $req->input('name');
      }


      if($req->has('gender') && !empty($req['gender'])){
        $data['gender'] = $req->input('gender');
      }

      if($req->has('dob') && !empty($req['dob'])){
        $data['dob'] = $req->input('dob');
      }
      if($req->has('job_title') && !empty($req['job_title'])){
        $data['job_title'] = $req->input('job_title');
      }
      if($req->has('bio') && !empty($req['bio'])){
        $data['bio'] = $req->input('bio');
      }
      if($req->has('project') && !empty($req['project'])){
        $data['project'] = $req->input('project');
      }
      if($req->has('address') && !empty($req['address'])){
        $data['address'] = $req->input('address');
      }
      if($req->has('goal') && !empty($req['goal'])){
        $data['goal'] = $req->input('goal');
      }

      $data['updated_at'] = date("Y-m-d H:i:s");



    /*  $data = array(
                  'name'        =>  $req->input('name'),
                  'gender'      =>  $req->input('gender'),
                  'dob'         =>  $req->input('dob'),
                  'job_title'   =>  $req->input('job_title'),
                  'bio'         =>  $req->input('bio'),
                  'project'     =>  $req->input('project'),
                  //'work_place'  =>  $req->input('work_place'),
                  'address'     =>  $req->input('address'),
                 // 'day'         =>  $req->input('day'),
                 // 'time'        =>  $req->input('time'),
                  'updated_at'  =>  date("Y-m-d H:i:s"),
                  'goal'        =>  $req->input("goal")
              );*/
      if($req->has('latitude') && !empty($req['latitude'])){
        $data['latitude'] = $req->input('latitude');
      }
      if($req->has('longitude') && !empty($req['longitude'])) {
        $data['longitude'] = $req->input('longitude');
      }
      if($req->hasFile('profile_pic')){
        $extension       = Input::file('profile_pic')->getClientOriginalExtension(); 
        $destinationPath = base_path('/') . '/public/uploads/profile';
        $profileImage    = uniqid(mt_rand(1,10)).'.'.$extension;
        Input::file('profile_pic')->move($destinationPath, $profileImage);

        $data['profile_pic'] = $profileImage;
      }

      $preference   = $this->webservice->preference($userId);
      if($req->has('interest') && !empty($req['interest'])) {
            $Uinterest    = $req->get("interest");
            
            $newInterest   = explode(",",$Uinterest);
            $existInterest = explode(",",$preference["interest"]);
            
            foreach($newInterest as $value) {
                if(($keys = array_search($value,$existInterest)) !== false){
                  unset($newInterest[$keys]);
                  unset($existInterest[$keys]);
                }
            }
            $newInterest    = array_values($newInterest);
            $existInterest  = array_values($existInterest);

            /* Inactive/ delete  id if database ids not exists in input*/
            $inactiveNotExist = $this->webservice->deleteInterestIds($userId,$existInterest);
            $j = $i = 0;
            if($newInterest && count($newInterest) > 0){
              foreach ($newInterest as $value) {
                if(!empty($value)) {
                  $update = $this->webservice->updateInterests($userId,$value);
                  if($update){
                    $j++;
                  }
                  $i++;
                }
              }
            }

      }
      if($req->has('distance') && !empty($req['distance'])) {
              $Udistance    = $req->get("distance");
              $update_distance = $this->webservice->updateDistance($userId,$Udistance);
      }

/****** User days ***** */

      if(($req->has('day')) && !empty($req['interest'])) { 
          $Uday      = $req->input('day');
          if(empty($Uday)){
            DB::table("user_days")->where("user_id",$userId)->update(["status" => '0']);
          }
          $newday   = explode(",",$Uday);
          $exist_days  = DB::table("user_days")->select(DB::raw("group_concat(day_id) as days"))->where("user_id",$req->user_id)->where("status",'1')->first()->days;
          if($exist_days){
            $existday = explode(",",$exist_days);
          }else {
            $existday = null;
          }
      
          foreach($newday as $value) {
            if($existday) {
              if(($keys = array_search($value,$existday)) !== false){
                unset($newday[$keys]);
                unset($existday[$keys]);
              }
            }
          }

          if($existday) {
              $existday  = array_values($existday);
              DB::table("user_days")->where("user_id",$userId)->whereIn("day_id",$existday)->update(["status" => '0']);
          }

          $j = $i = 0;
          if($newday && count($newday) > 0){
            foreach ($newday as $value) {
              if(!empty($value)) {
                $update = $this->webservice->updateDays($userId,$value);
                if($update){
                  $j++;
                }
                $i++;
              }
            }
          }
    }
    /*Times*/
    if(($req->has('time')) && !empty($req['time'])) { 
          $Utime      = $req->input('time');
          if(empty($Utime)){
              DB::table("user_times")->where("user_id",$userId)->update(["status" => '0']);
          }
          $newUtime   = explode(",",$Utime);
          $exist_times  = DB::table("user_times")->select(DB::raw("group_concat(time_id) as times"))->where("user_id",$req->user_id)->where("status",'1')->first()->times;
          if($exist_times){
            $existTimes = explode(",",$exist_times);
          }else {
            $existTimes = null;
          }
        
          foreach($newUtime as $value) {
            if($existTimes) {
              if(($keys = array_search($value,$existTimes)) !== false){
                unset($newUtime[$keys]);
                unset($existTimes[$keys]);
              }
            }
          }
     
          if($existTimes) {
              $existTimes  = array_values($existTimes);
              DB::table("user_times")->where("user_id",$userId)->whereIn("time_id",$existTimes)->update(["status" => '0']);
          }

          $j = $i = 0;
          if($newUtime && count($newUtime) > 0){
            foreach ($newUtime as $value) {
              if(!empty($value)) {
                $update = $this->webservice->updateTimes($userId,$value);
                if($update){
                  $j++;
                }
                $i++;
              }
            }
          }
      }

    /*workplace*/
    if(($req->has('work_place')) && !empty($req['work_place'])) { 
            $Uwork      = $req->input('work_place');
            if(empty($Uwork)){
                DB::table("user_workplace")->where("user_id",$userId)->update(["status" => '0']);
            }
            $newUwork   = explode(",",$Uwork);
            $exist_work = DB::table("user_workplace")->select(DB::raw("group_concat(workplace_id) as works"))->where("user_id",$req->user_id)->where("status",'1')->first()->works;
            if($exist_work){
              $existWorks = explode(",",$exist_work);
            }else {
              $existWorks = null;
            }
          
            foreach($newUwork as $value) {
              if($existWorks) {
                if(($keys = array_search($value,$existWorks)) !== false){
                  unset($newUwork[$keys]);
                  unset($existWorks[$keys]);
                }
              }
            }
           
            if($existWorks) {
                $existWorks  = array_values($existWorks);
                DB::table("user_workplace")->where("user_id",$userId)->whereIn("workplace_id",$existWorks)->update(["status" => '0']);
            }
            $j = $i = 0;
            if($newUwork && count($newUwork) > 0){
              foreach ($newUwork as $value) {
                if(!empty($value)) {
                  $update = $this->webservice->updateWorkplace($userId,$value);
                  if($update){
                    $j++;
                  }
                  $i++;
                }
              }
            }
    }

     

      if($req->hasFile('profile_pic')){
          $extension = Input::file('profile_pic')->getClientOriginalExtension(); 
          $destinationPath = base_path('public/uploads/profile');
          if(!is_writable($destinationPath)){
            chmod($destinationPath,0777);
          }

          $profileImage = round(microtime(true)).'.'.$extension;
          Input::file('profile_pic')->move($destinationPath, $profileImage);

          $data['profile_pic'] = $profileImage;
      }
       $result = DB::table('users')->where('id', $req->user_id)->update($data);
       if($data) {
          return response(array('message' => "User profile updated"), SUCCESS)->header('Content-Type', 'application/json');
        }else {
          return response(array('message' => "Unable to update profile"), BAD_REQUEST)->header('Content-Type', 'application/json');
        }
    }
    
  }

  /**************************************/
  /*       Suggestions ****************/
  /************************************/
  public function getSuggestions(Request $request){

  
  if(!$request->header('token')){/* check token send--*/
    return response(array('error'=>'Token not found'), UNAUTHORIZED)->header('Content-Type', 'application/json');
  }
  $token = $request->header('token'); 
  $userId = $this->webservice->getUserIdFromToken($token);
 
  if(!$userId){/* check user id with token valid'--*/
    return response(array('error'=>'Invalid Token'), UNAUTHORIZED)->header('Content-Type', 'application/json');
  }

/* check how many suggestions are seen by user--*/
 $getSuggestionUsed = $this->webservice->getSuggestionUsed($userId);
 if($getSuggestionUsed >= 10){
  /* Get the next date for which suggestion enabled--*/
  $getNextSuggestionTime = DB::table("user_suggestion")
                        ->where("user_id",$userId)
                        ->first();

   $currentDateTime = date("Y-m-d H:i:s");
   $next_suggesion_date = $getNextSuggestionTime->next_suggesion_date;
  /* calculate remaning time--*/
  if(strtotime($next_suggesion_date) > strtotime($currentDateTime)){
    /* if date is passed--*/
    $start = date_create($currentDateTime);
    $end   = date_create($next_suggesion_date);
    $diff  = date_diff($end,$start);
   
     $hours   = $diff->h < 10 ? "0".$diff->h : $diff->h;
     $minutes = $diff->i < 10 ? "0".$diff->i : $diff->i;
     $seconds = $diff->s < 10 ? "0".$diff->s : $diff->s;
  
  
     return response(array('message'=>'Your suggested matches for the day are over now','data' =>['hours' =>$hours, "minutes" => $minutes, "seconds" => $seconds]), LIMIT_REACHED)->header('Content-Type', 'application/json');
   }else{
    /*deleted record if time passed--*/
     DB::table('user_suggestion')->where("user_id",$userId)->delete();
   }
 }

 $getBlockedUsers = $this->webservice->getBlockedUsers($userId);
/*Get random user id--*/
  $suggestionId = DB::table('users')
                  ->where('id','!=',$userId)
                  ->whereNotIn('id', $getBlockedUsers)
                  ->select('id as suggested_id')
                  ->orderByRaw("RAND()")->first();

  if(empty($suggestionId)){/* if no user found to show--*/
    return response(array('message'=>'No matched found'), NO_CONTENT)->header('Content-Type', 'application/json');
  }

     //echo $request->header('token');
     $suggested_id = $suggestionId->suggested_id;
     $userArray = [];
     $getUserDetails = $this->webservice->getSuggestedUserDetails($suggested_id);
     $userArray['user_details'] = $getUserDetails;
     $userArray['user_details']->my_goals = "Lorium ipsum simple dummy text";
     $userArray['user_details']->location = "Chandigarh, India";


     $userInterests   = $this->webservice->getSuggestedUserInterests($suggested_id);
     $userArray['user_interests'] = $userInterests;


     $suggestionUsed = $this->webservice->suggestonUsed($userId);


     return response(array('message'=>'Suggesion detail','data'=>$userArray), SUCCESS)->header('Content-Type', 'application/json');  

  }


/*****************************************/
/*-----------------Match-----------------*/
/****************************************/
public function matchUser($other_user_id,Request $req){
      $status = $req->get("status");
      $validator = Validator::make($req->all(), ['status'   => 'required']);

    if($validator->fails()) {
      return response(['error' => $validator->errors()->first()], BAD_REQUEST)->header('Content-Type', 'application/json');
    }else {
      $userId = $this->webservice->getUserIdFromToken($req->header('token'));
      $match = $this->webservice->insertMatching($userId,$other_user_id,$status);
      if($match == "Pass"){
          return response(array('message'=>'Suggestion passed'),SUCCESS)->header('Content-Type', 'application/json'); 
      }else if($match == "409"){
        return response(array('message'=>'Matched request already sent'), 409)->header('Content-Type', 'application/json');  
      }else if($match == "accept"){
        $this->sendNotification($userId,$other_user_id);
          return response(array('message'=>'Match request accepted'), SUCCESS)->header('Content-Type', 'application/json');
      }elseif($match == "unmatch"){
        return response(array('message'=>'Unmatch successfully'), SUCCESS)->header('Content-Type', 'application/json');
      }else if($match == "insert"){
        return response(array('message'=>'Match request sent'), SUCCESS)->header('Content-Type', 'application/json');
      }else if($match == "failed"){
        return response(array('message'=>'failed match request'), BAD_REQUEST)->header('Content-Type', 'application/json');
      }else if($match == "cancel"){
        return response(array('message'=>'match cancelled'), BAD_REQUEST)->header('Content-Type', 'application/json');
      }
        /* Push Notifications of match request have to implement here--*/

        /* status => 0 new match request sent, 1=> Matched, 2=>Match canceled--*/
      } 
    }
  



/*****************************************/
/*********Reports Profile------------*/
/*****************************************/
function reportUser($userId,Request $req){

   $validator = validator::make($req->all(),[
         'other_user_id'    => 'required',
        ]
      );

   if ($validator->fails()) {          
      return response(['error' => $validator->errors()->first()], BAD_REQUEST)->header('Content-Type', 'application/json');
    }else{
      $reportMessage = $req->input('message', '');
      $other_user_id = $req->input('other_user_id');

      $reportUser = $this->webservice->reportUser($userId,$other_user_id,$reportMessage);
      if($reportUser){
         return response(array('message'=>'Reported Successfully'), SUCCESS)->header('Content-Type', 'application/json');  
      }else{
         return response(array('message'=>'Failed to report,Try again'), BAD_REQUEST)->header('Content-Type', 'application/json');  
      }
    }
  }


    /************************************/
    /* Send Message */
    /**************************************/
  public function send_message(Request $request)
  {

	  $validator = validator::make($req->all(),[
                    'sender_id'     => 'required',
                    'reciver_id'    => 'required',
                    'message'       => 'required']);
    
    if ($validator->fails()) {          
      return response(['error' => $validator->errors()->first()], BAD_REQUEST)->header('Content-Type', 'application/json');
    }else{

      $sender_id   = $request->input('sender_id');
      $receiver_id = $request->input('reciver_id');
      $message     = $request->input('message');

      $result=$this->webservice->checkConnection($sender_id,$receiver_id);
       
      if(!empty($result)){
        $connection_id=$result->id;
      }else{
        $this->webservice->add_connection($sender_id,$receiver_id);
      }

      $result=$this->webservice->checkConnection($sender_id,$receiver_id);
      if(!empty($result)){
        $connection_id=$result->id;
        $this->webservice->insert_message($sender_id,$message,$connection_id);
      }
         
      return response(array('message'=>'Data save succssfully'), SUCCESS)->header('Content-Type', 'application/json');  
    }
  }

    /******************************/
    /*get My Connection*/
    /******************************/
  public function getMyConnection($user_id){
      
    $data = DB::table('connection')
                   ->where('del','!=',$user_id)
                   ->where('del','!=','on')
                   ->where('sender_id',$user_id)
                   ->orwhere('reciver_id',$user_id)
                   ->select('*')
                   ->get();

    $mydata=array();

    foreach ($data as  $value) {
      
      $sender_id = $value->sender_id;
      
      if($sender_id == $user_id){
        
        $userInfo = $this->webservice->getUserInfo($value->reciver_id);

        $myconnection['connection_id'] = $value->id;
                   
        if(!empty($userInfo)){
          $myconnection['name'] = $userInfo->user_name;
          
          if(!empty($userInfo->profile_picture)){
            
            $myconnection['profile_picture'] = URL('/').'/public/uploads/profile/'.$userInfo->profile_picture;
          }else{
            $myconnection['profile_picture'] = "";
          }

          $mydata[]=$myconnection;
        }
      
      }else{
        
        $myconnection['connection_id']=$value->id;
        $userInfo=$this->webservice->getUserInfo($value->sender_id);

        if(!empty($userInfo)){

          $myconnection['name'] = $userInfo->user_name;
          
          if(!empty($userInfo->profile_picture)){

            $myconnection['profile_picture'] = URL('/').'/public/uploads/profile/'.$userInfo->profile_picture;

          }else{

            $myconnection['profile_picture'] = "";
          }

          $mydata[]=$myconnection;
        }
      }
    }

    return response(array('message'=>'Data found','data'=>$mydata), SUCCESS)->header('Content-Type', 'application/json');    
  }


      /****************************/
      /*jobNotification */
      /****************************/
  public function jobNotification($job_id,$sp_id){
    
    $data = DB::table('post_services')->where('id',$job_id)->select('user_id','services_id')->get();
    
    foreach ($data as $k => $value) {

      $moreservices = $this->getOtherServices($value->services_id);
      $data[$k]->more_services = $moreservices;

    }

    $sp_data = DB::table('serviceprovider_profiles')->where('user_id',$sp_id)->select('first_name','last_name')->first();

    $message = $sp_data->first_name.' '.$sp_data->last_name.' assigned for your booking appoitment.';
    $label = "job_forword";
    $type  = 'U';
    $sender_id = $sp_id;

    $this->Sent_notification($data[0]->user_id,$sender_id,$label,$message,$type);

    return true;
  }


    /*********************/
    /* Time Ago */
    /********************/
  function timeago($time_ago){

    $time_ago = strtotime($time_ago);
    $cur_time   = strtotime(date('Y-m-d H:i:s'));
    $time_elapsed   = $cur_time - $time_ago;
    $seconds    = $time_elapsed ;
    $minutes    = round($time_elapsed / 60 );
    $hours      = round($time_elapsed / 3600);
    $days       = round($time_elapsed / 86400 );
    $weeks      = round($time_elapsed / 604800);
    $months     = round($time_elapsed / 2592000);
    $years      = round($time_elapsed / 31536000);
        
      // Seconds
    if($seconds <= 60){
      return "just now";
    }
    //Minutes
    else if($minutes <=60){
      if($minutes==1){
        return "one min ago";
      }else{
        return "$minutes min ago";
      }
    }
    //Hours
    else if($hours <=24){
      if($hours==1){
        return "an hour ago";
      }else{
        return "$hours hours ago";
      }
    }
      //Days
    else if($days <= 7){
        if($days==1){
        return "yesterday";
        }else{
        return "$days days ago";
        }
    }
      //Weeks
    else if($weeks <= 4.3){
      if($weeks==1){
      return "1 week ago";
      }else{
      return "$weeks weeks ago";
      }
    }
      //Months
    else if($months <=12){
        if($months==1){
        return "1 month ago";
        }else{
        return "$months months ago";
        }
    }
    //Years
    else{
      if($years==1){
      return "1 year ago";
      }else{
      return "$years years ago";
      }
    }
  }  

    /******************************
      Get Notification List
    ********************************/
  function get_notification_list($user_id,$token){
      
    $this->GetCheckToken($user_id,$token);

    $get_noti = DB::table('notifications')
                      ->where('status','=',1)
                      ->where('receiver_id','=',$user_id)
                      ->orderBy('id', 'desc')
                      ->get();
            
    foreach ($get_noti as $key => $value) {
      $get_noti[$key]->timeago=$this->timeago($value->created_at);
    }

    if($get_noti){

      return response(array('message' => 'Data found', 'data' => $get_noti), SUCCESS)->header('Content-Type', 'application/json'); 

    }else{

      return response(array('message' => 'Data not found'), BAD_REQUEST)->header('Content-Type', 'application/json');

    }
  }

    /*---------------------------------
    Update Notification status
    -----------------------------------*/
  public function notification_on_off(Request $req){
    
    $validator = Validator::make($req->all(),[
                  'user_id'              => 'required',
                  'notification_status'  => 'required']);   
    
    if ($validator->fails()) {      
       
      return response(['error' => $validator->errors()->first()], BAD_REQUEST)->header('Content-Type', 'application/json');
      
    }else{

      $this->GetCheckToken(Input::get('user_id'),$req->header('token'));  
              
      $User = new User();
      $User = User::find($req->user_id); 
      $User->notification_status = $req->input('notification_status');

      if($User->save()){  
        return response(array('message' => 'Toggel on Successfully'), SUCCESS)->header('Content-Type', 'application/json');    
      }else{

        return response(array('message' => 'Failed to on Toggel'), BAD_REQUEST)->header('Content-Type', 'application/json');    
      }
    }
  }





  ##############  kranti API's Start 



  /*---------------------------------
  Change Password
  -----------------------------------*/

  public function changePassword(Request $req){
    $userId  = $this->webservice->getUserIdFromToken($req->header('token'));
    $validator    =   Validator::make($req->all(),[
                      'oldPassword'          => 'required',
                      'newPassword'          => 'required'
                      ]);   
    
    if ($validator->fails()) {      
       
      return      response(['error' => $validator->errors()->first()], BAD_REQUEST)
                  ->header('Content-Type', 'application/json');
      
    }else{
      $User     =     new User();
      $User     =     User::find($userId);

      if($User->register_type == 'O'){
            $pass    =   $req->input('oldPassword');
        
        if (Hash::check($pass, $User->password)) {

            $pass        =   $req->input('newPassword');
            $password    =   Hash::make($pass);
            $User->password = $password;

            if($User->save()){  
              return response(array('message' => 'password update Successfully'), SUCCESS)->header('Content-Type', 'application/json');    
            }else{

              return response(array('message' => 'Failed to update'), BAD_REQUEST)->header('Content-Type', 'application/json');    
            }

        }else{
            return response(array('message' => 'Old password is not matched'), BAD_REQUEST)->header('Content-Type', 'application/json');
          }
      }else{
        return response(array('message' => 'This Is A Social Account'), BAD_REQUEST)
                ->header('Content-Type', 'application/json');    
      }
    }

  }





  /*---------------------------------
  Subscription Plan
  -----------------------------------*/
 
  public function subscriptionPlan(Request $req){

    $validator    =   Validator::make($req->all(),[
                      'user_id'              => 'required']
                      );   
    
    if ($validator->fails()) {      
       
      return   response(['error' => $validator->errors()->first()], BAD_REQUEST)
              ->header('Content-Type', 'application/json');
      
    }else{

      $this->GetCheckToken(Input::get('user_id'),$req->header('token'));

      $result =  $this->webservice->subscriptionPlan();
      return response(array('message' => 'Data found', 'data' => $result), SUCCESS)
              ->header('Content-Type', 'application/json');          
    }

  }
  /*---------------------------------
  notification  (for on of notification)
  -----------------------------------*/
 
  public function notification(Request $req){

    $validator    =   Validator::make($req->all(),[
                      'user_id'              => 'required',
                      'notification_status'  => 'required']
                      );   
    
    if ($validator->fails()) {      
       
      return   response(['error' => $validator->errors()->first()], BAD_REQUEST)
              ->header('Content-Type', 'application/json');
      
    }else{
      $this->GetCheckToken(Input::get('user_id'),$req->header('token'));
      $User     =     new User();
      $User     =     User::find($req->user_id);
/*      print_r($User); die;
*/      $User->notification_status = $req->input('notification_status');
      if($User->save()){  
        return response(array('message' => 'Notification Status update Successfully'), SUCCESS)->header('Content-Type', 'application/json');    
      }else{

        return response(array('message' => 'Failed to update'), BAD_REQUEST)->header('Content-Type', 'application/json');    
      } 
    }

  }


  /*---------------------------------
  blockUser  
  -----------------------------------*/
 
  public function blockUser($blockUserId,Request $req){
        $token = $req->header('token'); 
        $userId = $this->webservice->getUserIdFromToken($token);

        $result =  $this->webservice->blockUser($userId,$blockUserId);
        if($result){
          return response(array('message' => 'User blocked'), SUCCESS)
                ->header('Content-Type', 'application/json');
        }else{
          return response(array('message' => 'Failed to block'), SUCCESS)
                ->header('Content-Type', 'application/json');          
        }   
    }
  

  /*---------------------------------
  contactUs  
  -----------------------------------*/
  public function contactUs(Request $req){

    $validator    =   Validator::make($req->all(),[
                      'user_id'             => 'required',
                      'email'               => 'required',
                      'subject'             => 'required',
                      'message'             => 'required']
                      );   
    
    if ($validator->fails()) {      
       
      return   response(['error' => $validator->errors()->first()], BAD_REQUEST)
              ->header('Content-Type', 'application/json');
      
    }else{
        $data['user_id']          =  $req->input('user_id');
        $data['email']            =  $req->input('email');
        $data['subject']          =  $req->input('subject');
        $data['message']          =  $req->input('message');
        $tablename     =   'contact_us';
        
        $result =  $this->webservice->insertdata($tablename,$data);
          return response(array('message' => 'message send successfully'), SUCCESS)
                ->header('Content-Type', 'application/json');

    }
  }


  /*---------Report Bus---*/
  function reportABug(Request $req){
    $validator    =   Validator::make($req->all(),[
                      'email'               => 'required',
                      'subject'             => 'required',
                      'message'             => 'required']
                      );   
    
    if ($validator->fails()) {      
       
      return   response(['error' => $validator->errors()->first()], BAD_REQUEST)
              ->header('Content-Type', 'application/json');
      
    }else{
        $data['email']            =  $req->input('email');
        $data['subject']          =  $req->input('subject');
        $data['message']          =  $req->input('message');
        $tablename     =   'report_bug';
        
        $result =  $this->webservice->insertdata($tablename,$data);
          return response(array('message' => 'message send successfully'), SUCCESS)
                ->header('Content-Type', 'application/json');

    }
  }


  /***********************************/
  /********* Send message ***********/
  /*********************************/
  public function insertMessages($receiverId,Request $req){
    $userId = $this->webservice->getUserIdFromToken($req->header('token'));
    $inserted = $this->webservice->InsertMessage($userId,$receiverId,$req->input("message"," "));

    if($inserted == "blocked"){
      return response(array('message' => 'User blocked'), SUCCESS)
                ->header('Content-Type', 'application/json');
    }else if($inserted == 1){
      return response(array('message' => 'message send successfully'), SUCCESS)
                ->header('Content-Type', 'application/json');
    }else {
      return response(array('message' => 'Failed to send message'), SUCCESS)
                ->header('Content-Type', 'application/json');
    }
  }
  /***********************************/
  /********* Send message ***********/
  /*********************************/
  public function hideMyMessages($other_user,Request $req){
    $userId = $this->webservice->getUserIdFromToken($req->header('token'));
    $hide = $this->webservice->HideMyMessages($userId,$other_user);

    if($hide){
      return response(array('message' => 'Hide message successfully'), SUCCESS)
                ->header('Content-Type', 'application/json');
    }else {
      return response(array('message' => 'Failed to hide message'), SUCCESS)
                ->header('Content-Type', 'application/json');
    }
  }

  /***********************************/
  /****** get single user message ***/
  /*********************************/
  public function getMessages($other_user,Request $req){
    $token = $req->header('token'); 
    $userId = $this->webservice->getUserIdFromToken($token);
    $data = $this->webservice->GetMessages($other_user,$userId);
    if($data){
      return response(array('data' => $data), SUCCESS)->header('Content-Type', 'application/json');
    }else {
      return response(array('message' => "No message found"), 204)->header('Content-Type', 'application/json');
    }
  }


  /***********************************/
  /*    get last Message          **/
  /*********************************/

  /********** confusion ****/
  public function getLastMessage(Request $req){
    $token = $req->header('token');
    $userId = $this->webservice->getUserIdFromToken($token);
    $data = $this->webservice->get_lastMessage($userId);

    if($data && !empty($data) && count($data) > 0) {
      return response($data, SUCCESS)->header('Content-Type', 'application/json');
    }else {
      return response(array("message"=>"not data found"),204)->header('Content-Type', 'application/json');
    }
  }

  /***********************************/
  /*    delete account            **/
  /*********************************/
  public function deleteAccount(Request $req){
      $token = $req->header('token'); 
      $message = $req->get("message","");
      $userId = $this->webservice->getUserIdFromToken($token);
      $delete = $this->webservice->deleteAccount($userId,$message);
     
      if($delete){
        return response(array("message" => "Account deleted succcessfully"), SUCCESS)->header('Content-Type', 'application/json');
      }else {
        return response(array("message" => "Unable to delete account"), 500)->header('Content-Type', 'application/json');
      }
  }
  /***********************************/
  /*    disable account*           **/
  /*********************************/
  public function disableUser(Request $req){
    $token = $req->header('token');
    $userId = $this->webservice->getUserIdFromToken($token);
    $disable = User::where("id",$userId)->update(["status"=>2,"token"=>""]);
    if(!$disable){
        return response(array("message" => "Your account has been disabled"), SUCCESS)->header('Content-Type', 'application/json');
      }else {
        return response(array("error" => "Unable to disable account"), 500)->header('Content-Type', 'application/json');
      }
  }

  /********** Unmatch (remove from matched users list) user */
  public function unmatchUser($other_user_id,Request $req){
    $userId  = $this->webservice->getUserIdFromToken($req->header('token'));
    $data    = array(
              "user_id"         => $userId,
              "other_user_id"   => $other_user_id,
              "message"         => $req->get("message")

      );
    $unmatch = $this->webservice->unmatchUser($data);

      if($unmatch == 3){
        return response(array("message" => "User already Unmatched"), SUCCESS)->header('Content-Type', 'application/json');
      }else if($unmatch == 1){
        return response(array("message" => "User has beeen Unmatched"), SUCCESS)->header('Content-Type', 'application/json');
      }elseif($unmatch == 0) {
        return response(array("message" => "Failed to unmatch"), SUCCESS)->header('Content-Type', 'application/json');
      }else if($unmatch == 2){
        return response(array("message" => "Match not found"), SUCCESS)->header('Content-Type', 'application/json');
      }
  }
  /*************** user(current) all match (user) list */
  public function getAllMatch(Request $req){
      $userId  = $this->webservice->getUserIdFromToken($req->header('token'));
      $matches = $this->webservice->getAllMatches($userId);
      if(!empty($matches)){
        return response(array("data" => $matches), SUCCESS)->header('Content-Type', 'application/json');
      }else {
        return response(array("data" => "No match found"), SUCCESS)->header('Content-Type', 'application/json');
      }
  }

  /*************** users who are blocked by this(current) user list */
  public function AllBlockedUser(Request $req){
      $userId  = $this->webservice->getUserIdFromToken($req->header('token'));
      $matches = $this->webservice->getBlockedUsers($userId);
      if(!empty($matches)){
        return response(array("data" => $matches), SUCCESS)->header('Content-Type', 'application/json');
      }else {
        return response(array("data" => "No block user found"), SUCCESS)->header('Content-Type', 'application/json');
      }
  }
  /************** unblock user *********/
  public function unblockUser($other_user_id,Request $req){
    $userId  = $this->webservice->getUserIdFromToken($req->header('token'));
    $unblock = $this->webservice->blockUser($userId,$other_user_id,0);

    if($unblock == 0){
        return response(array("message" => "User not found in block list"), SUCCESS)->header('Content-Type', 'application/json');
      }else if($unblock){
        return response(array("message" => "User unblock"), SUCCESS)->header('Content-Type', 'application/json');
      }else {
        return response(array("message" => "Failed"), SUCCESS)->header('Content-Type', 'application/json');
      }
  }

  /****************** user preference ***/
  public function userPreference(Request $req){
    $userId       = $this->webservice->getUserIdFromToken($req->header('token'));
    $user_Preference  = $this->webservice->preference($userId);
    return response(array("data" => $user_Preference), SUCCESS)->header('Content-Type', 'application/json');
  }

  /************ update interest (pending)*****/
  public function updateUserPreference(Request $req){
    $validator = Validator::make($req->all(),[
        "distance"    => "required"
      ]);
    if($validator->fails()){
      return response(['error' => $validator->errors()->first()], BAD_REQUEST)->header('Content-Type', 'application/json');
    }else {
      $userId       = $this->webservice->getUserIdFromToken($req->header('token'));

      $preference   = $this->webservice->preference($userId);

      $Uinterest    = $req->get("interests","");
      $Udistance    = $req->get("distance");
      $newInterest   = explode(",",$Uinterest);
      $existInterest = explode(",",$preference["interest"]);
      
      foreach($newInterest as $value) {
          if(($keys = array_search($value,$existInterest)) !== false){
            unset($newInterest[$keys]);
            unset($existInterest[$keys]);
          }
      }
      $newInterest    = array_values($newInterest);
      $existInterest  = array_values($existInterest);

      /* Inactive/ delete  id if database ids not exists in input*/
      $inactiveNotExist = $this->webservice->deleteInterestIds($userId,$existInterest);
      $j = $i = 0;
      if($newInterest && count($newInterest) > 0){
        foreach ($newInterest as $value) {
          if(!empty($value)) {
            $update = $this->webservice->updateInterests($userId,$value);
            if($update){
              $j++;
            }
            $i++;
          }
        }
      }

      $update_distance = $this->webservice->updateDistance($userId,$Udistance);

      if($i == $j){
        return response(array("message" => "User preference updated"), SUCCESS)->header('Content-Type', 'application/json');
      }else {
        return response(array("message" => "Failed to update interests"), BAD_REQUEST)->header('Content-Type', 'application/json');
      }
    }
  }
  /************** user all suggestion ****/
 public function userSuggest(Request $req){

   $userId   = $this->webservice->getUserIdFromToken($req->header('token'));
   $userLatLong = array(
            "lats" => $req->get("latitude"),
            "longi"=> $req->get("longitude") 
       );
       
   $suggestion = $this->webservice->getUserSuggestions($userId,$userLatLong);
   if($suggestion == 0 && empty($suggestion)){
        return response(['message' => 'No result found'], 204)->header('Content-Type', 'application/json');
   }else if((empty($suggestion["byInterest"]) || $suggestion["byInterest"] == NULL)  && ((empty($suggestion["byDistance"]) || $suggestion["byDistance"] == NULL) )){
       return response(['message' => 'No result found'], 204)->header('Content-Type', 'application/json');
   }else {

      $profile = url('/').'/public/uploads/profile/';
      $dummyProfile = $profile.'dummyprofile.png';
      $suggestion_id = array();
    $byInterests = $suggestion['byInterest'];
    $byDistance = $suggestion['byDistance'];
    $suggestionInterest = array();
    $suggestionDistance = array();
    if($byInterests && !empty($byInterests)) {
     foreach($byInterests as $key => $value) {
      
      if($value->user_id != $userId) {
          array_push($suggestion_id,$value->user_id);
            $suggestionInterest[$key] = array(
                                  "username"      =>  $value->name,
                                  "user_id"       =>  $value->user_id,
                                  "social_id"     =>  $value->social_id,
                                  "email"         =>  $value->email,
                                  "gender"        =>  $value->gender,
                                  "job_title"     =>  $value->job_title,
                                  "bio"           =>  $value->bio,
                                  "project"       =>  $value->project,
                                  "work_place"    =>  $value->work_place,
                                  "address"       =>  $value->address,
                                  "longitude"     =>  $value->longitude,
                                  "latitude"      =>  $value->latitude,
                                  "day"           =>  $value->day,
                                  "time"          =>  $value->time,
                                  "distance"      =>  $value->distance,
                                  "matchedInterest" =>  $value->matchedInterest,
                                  "profile_pic"   =>  ($value->profile_pic && !empty($value->profile_pic))?$profile.$value->profile_pic:$dummyProfile,
              );
      }
     }
     
   }
   if($byDistance && !empty($byDistance)){
    foreach($byDistance as $key => $value) {
      
      if($value->user_id != $userId) {
          array_push($suggestion_id,$value->user_id);
            $suggestionDistance[$key] = array(
                                  "username"      =>  $value->name,
                                  "user_id"       =>  $value->user_id,
                                  "social_id"     =>  $value->social_id,
                                  "email"         =>  $value->email,
                                  "gender"        =>  $value->gender,
                                  "job_title"     =>  $value->job_title,
                                  "bio"           =>  $value->bio,
                                  "project"       =>  $value->project,
                                  "work_place"    =>  $value->work_place,
                                  "address"       =>  $value->address,
                                  "longitude"     =>  $value->longitude,
                                  "latitude"      =>  $value->latitude,
                                  "day"           =>  $value->day,
                                  "time"          =>  $value->time,
                                  "distance"      =>  $value->distance,
                                  "matchedInterest" =>  $value->matchedInterest,
                                  "profile_pic"   =>  ($value->profile_pic && !empty($value->profile_pic))?$profile.$value->profile_pic:$dummyProfile,
              );
      }
     }
     //print_r($suggestionDistance);
    // suggestionDistance = array_unique(array_map(function($elems){return $elems['user_id'];}, $suggestionDistance));
    // print_r($suggestionDistance);
    // die;
   }
  
   if(count($suggestion_id) > 0){
   $suggestion_id =  array_unique($suggestion_id);
    $this->webservice->updateSuggestion($userId,$suggestion_id,count($suggestion_id));
  }
   
   if($suggestionInterest){
    if(count($suggestionInterest) >= 12){
    return  response(array("data" => $suggestionInterest), SUCCESS)->header('Content-Type', 'application/json');
   }else if($suggestionDistance){
      $merge = array_merge($suggestionInterest,$suggestionDistance);
      return  response(array("data" => $merge), SUCCESS)->header('Content-Type', 'application/json');
   }elseif($suggestionInterest && !$suggestionDistance) {
        return  response(array("data" => $suggestionInterest), SUCCESS)->header('Content-Type', 'application/json');
   }else {
        return  response(array("message" => "No result found"), 204)->header('Content-Type', 'application/json');
   }
 }elseif($suggestionDistance && !empty($suggestionDistance)) {
    return  response(array("data" => $suggestionDistance), SUCCESS)->header('Content-Type', 'application/json');
 }else {
  return  response(array("message" => "No result found"), 204)->header('Content-Type', 'application/json');
 }
}
}

public function sendNotification($sender_id,$receiver_id){
          $getSenderInfo = User::find($sender_id);
       $getReceiverInfo = User::find($receiver_id);
     
       if($getSenderInfo && $getReceiverInfo) {

          $SenderName = $getSenderInfo->name;
          $notificationdata = array(
                            'sender_id'     => $sender_id,
                            'receiver_id'   => $receiver_id,
                            'title'         => 'meet match',
                            'body'          => "You got a meet match",
                            'label'         => "Meet match",
                            'sound'         => 'default');

        $url = "https://fcm.googleapis.com/fcm/send";
        $token = $getReceiverInfo->device_id;
         // $token = "few3_MmnbSw:APA91bEyANW8NLlQAgEThDXbEcW8XtjBUY5Y9R96znHzZvMWlacmIxufMveMZgasNS2lXVbrBXZXe3ag14QYyexth22-q7245lZOjhi0H-MXmEDlsltihLMNmj4t4qP3EpSlP69VwoAH";
          
        $serverKey = 'AAAA_gbLwP8:APA91bG_WV_lmctm19_TTPbvjzJElBQF88bAy-r1DRFS7GCa8TWSo5aA6Uv269NMc3smwKpZSiA3bXKCA_u8xQV_EcmAnWqLS1R4fIQI97tVNlCfmMo5IdHA1Vsc8kCMB33IsdsMIQog';
            
            if($getReceiverInfo->notification_status == '1' && !empty($token)){

                if($getReceiverInfo->device_type == 'A'){

                    $arrayToSend = array(
                                'to'                =>  $token,
                                'notification'      =>  $notificationdata,
                                'data'              =>  $notificationdata,
                                'priority'          =>  'high');
                
                    $json = json_encode($arrayToSend);

                    $headers = array('Content-Type: application/json',
                     'Authorization: key='.$serverKey);
               

                 $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_POSTFIELDS,$json);     
                    $response = curl_exec($ch);
                    print_r($response);
                    curl_close($ch);

                  $notification = new notification();
                  $notification->sender_id = $sender_id;
                  $notification->receiver_id = $receiver_id;
                  $notification->message = "You got a meet match";
                  $notification->label = "meet match";
                  $notification->read_status = 1;
                  $notification->created_at = date("Y-m-d H:i:s");
                  $notification->updated_at = date("Y-m-d H:i:s");
                  $notification->save();
                  return true;
                }else {
                  return false;
                }
            }else {
              return false;
            }
         }else {
          return false;
         }
    }

 public function notifyMe($other_user_id, Request $req){
      $userId   = $this->webservice->getUserIdFromToken($req->header('token'));
      $send = $this->sendNotification($userId,$other_user_id);

      if($send){
        return response(array('message' => 'Notification sent successfully'), SUCCESS)
              ->header('Content-Type', 'application/json');
      }else {
        return response(array('message' => 'Unable to send notification'), 404)
              ->header('Content-Type', 'application/json');
      }
}


  /*************** suggested users profile ****/

      /*---------------------------------
    contactUs  
    -----------------------------------*/
  public function articleList(Request $req){

    $data = DB::table('articles')->where('status', '1')->select('*', DB::raw("CASE WHEN image is NULL OR image = '' THEN CONCAT('',image) ELSE CONCAT('".url('/').'/public/uploads/article/'."',image) END AS image"))->get();

    if(!$data->isEmpty()){
      return response(array('message' => 'Get articles successfully', 'data' => $data), SUCCESS)
                ->header('Content-Type', 'application/json');
    }else{
      return response(['message' => 'No result found'], NO_CONTENT)->header('Content-Type', 'application/json');
    }
    
  }

    /*---------------------------------
      contactUs  
    -----------------------------------*/
  public function articleDetails(Request $req){

    $data = DB::table('articles')->where(['status' => '1', 'id' => $req->article_id])->select('*', DB::raw("CASE WHEN image is NULL OR image = '' THEN CONCAT('',image) ELSE CONCAT('".url('/').'/public/uploads/article/'."',image) END AS image"))->first();
    
    if($data){
      return response(array('message' => 'Get article successfully', 'data' => $data), SUCCESS)
                ->header('Content-Type', 'application/json');
    }else{
      return response(['message' => 'No result found'], NO_CONTENT)->header('Content-Type', 'application/json');
    }
  }


  /*Subscriptions--*/
  public function subscriptions(Request $req){
     $userId       = $this->webservice->getUserIdFromToken($req->header('token'));
     $validator = Validator::make($req->all(), [  
                'plan_id'                     => 'required',
                'transation_id'                  => 'required'
               
      ]);

      if ($validator->fails()) {
        return response(['error' => $validator->errors()->first()], BAD_REQUEST)->header('Content-Type', 'application/json');
      }else{
         $planId = $req['plan_id'];
         $transation_id = $req['transation_id'];

         $checkAlreadySubscriptions = DB::table("subscribers")->where("user_id",$userId)->first();
         if(empty($checkAlreadySubscriptions)){
            DB::table("subscribers")->insert(['user_id' => $userId, 'plan_id' => $planId, 'transation_id' => $transation_id, 'subscribe_date'=> date("Y-m-d"), 'created_at' => date("Y-m-d H:i:s")]);
            return response(array('message' => 'Subscriptions added successfully'), SUCCESS)
              ->header('Content-Type', 'application/json'); 
         }else{
            DB::table("subscribers")->where("user_id",$userId)->update(['plan_id' => $planId, 'transation_id' => $transation_id, 'subscribe_date'=> date("Y-m-d"), 'created_at' => date("Y-m-d H:i:s") ]);
            return response(array('message' => 'Subscriptions updated successfully'), SUCCESS)
              ->header('Content-Type', 'application/json');
         }
         
      }
  }







  ################ API's End 
}


