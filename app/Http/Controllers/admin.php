<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use App\User;
use \App\Adminmodel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use Mail; // Send mail function
use Carbon\Carbon; // Date time library
use DB; // Database query object
use File; // Manage files
use DateTime;
use App\notification;

class admin extends Controller
{
 private $required_field_error = "Please fill all fields!";
 public function __construct()
    {
      $this->admin    =   new Adminmodel;
    
    }
//*****************************************************//
//                login                                //
//*****************************************************//

 public function login(){
  /* Chech Auth user login */
	if (!Auth::guest()){
		return redirect('/admin/dashboard');
	}
	/* Chech Auth user login */
	 return view("adminpages/login");
	 
 }
//*****************************************************//
//                Signin                               //
//*****************************************************//
 public function signin(Request $request)
	{	
	 $email = Input::get('email');
	 $password = Input::get('password');

		 $validator = Validator::make($request->all(),[
			'email'    		    =>  'required',
			'password'          =>  'required',
				
	   ]);	
	  // try{
		   if($validator->fails()){ 
				$messages = $validator->messages();
				$messages = $messages->toArray();
				$result['status']    = false;			
				$result['error'] 	 = $messages;
				return Redirect::to('admin/login')->with('error', $result['error']);
		   }else{

		   	//echo $email.'-'.$password; die;
	       if (Auth::attempt(['email' => "$email", 'password' => "$password",'user_type' => 'A'])) {
			        $userId = Auth::id(); 
					$data = User::find($userId);
                    $result['status']  = true;
					$result['message'] = "Login Successfully";
					$result['data'] = $data;

					return redirect('admin'); 
              }else{  
			        $result['status']  = false;
					$result['error'] = array('error'=>array(0=>"Invalid username or password"));
				   return Redirect::to('admin/login')->with('error', $result['error']);
		     }
	      }
     }
//*****************************************//
//                logout                   //
//*****************************************//

     public function logout(){
		  /* Chech Auth user login */
		if (Auth::guest()){

		 return redirect('/admin/login');
		}
		/* Chech Auth user login */
		 Auth::logout();
		 return redirect('admin/login'); 
		 }
//*****************************************************//
//               dashboard                             //
//*****************************************************//

     public function dashboard(){
		/* Chech Auth user login */
		if (Auth::guest()){
		 return redirect('/admin/login');
		}
		return view("/adminpages/dashboard");
	 }

//*****************************************************//
//                     Get Users list                  //
//*****************************************************//
    public function get_users(){
    /* Chech Auth user login */
    if (Auth::guest()){
     return redirect('/admin/login');
    }
    
    $datas['data'] = DB::table('users as u')
         ->where('u.user_type','!=','A')
         ->orWhereNull('u.user_type')
         ->select('u.*')
         ->orderBy('id','desc')
        ->get();

      return view("adminpages/users_list",$datas);
  }
  public function contactUs(){
    if (Auth::guest()){
     return redirect('/admin/login');
    }
    $datas['data'] = DB::table('contact_us as c')
         ->select('c.*')
         ->orderBy('id','desc')
        ->get();

      return view("adminpages/contact_us",$datas);
  }

  /*--Report Bugs--*/
  function reportBugs(){
    if (Auth::guest()){
     return redirect('/admin/login');
    }
    $datas['data'] = DB::table('report_bug as r')
         ->select('r.*')
         ->orderBy('id','desc')
        ->get();

      return view("adminpages/report_bugs",$datas);
  }
   //*****************************************************//
//           Get Service Provider list                  //
//*****************************************************//
    public function get_spList(){
    /* Chech Auth user login */
    if (Auth::guest()){
     return redirect('/admin/login');
    }
          $datas['data'] = DB::table('users as u')
         ->join('serviceprovider_profiles as up','u.id','=','up.user_id')
         ->where('u.user_type','=','SP')
         ->select('u.id','up.first_name','up.last_name','u.email','up.address','u.created_at','u.status')
         ->orderBy('created_at','desc')
        ->get();

    return view("adminpages/serviceprovider_list",$datas);
    
    
    
   }   
//*****************************************************//
//           Get user  details page //
//*****************************************************//
	  public function getuserdetails($user_id,$user_type){
		/* Chech Auth user login */
    
    		if (Auth::guest()){
		 return redirect('/admin/login');
		}

    $datas['data'] = $this->admin->getMyProfiles($user_id,$user_type);
    if($user_type=='U'){
    return view("adminpages/user_details",$datas);
    }else{
      return view("adminpages/spuser_details",$datas);
    }
	  
	  
	 }
 //*****************************************************//
//                Change Status                        //
//*****************************************************//
         public function changeStatus($id,$status,$user_type){
         if (Auth::guest()){
		     return redirect('/admin/login');
		 }
         DB::table('users')->where('id', $id)->update(array('status' =>$status,'token'=>''));

          $message='Your account has been suspended by admin, Please contact admin@gmail.com to approve your account.';
          $label = "account_suspend";
          $type=$user_type;
          $sender_id=1;

    if($status=='S'){
         $this->Sent_notification($id,$sender_id,$type,$label,$message);
    }
    if($user_type=='U'){
      return Redirect::to('admin/get_users');
    }else{
      return Redirect::to('admin/get_spList');
    }
  
}

/************************************************/
// Sent Notification
/************************************************/
public function Sent_notification($id,$sender_id,$type,$label,$message){

        if($sender_id != $id){

  $datas = DB::table('users')->where('id',$id)->select('device_type','device_id','notification_status')->first();

      if($datas->notification_status == 'ON')
      {
      if($datas->device_id != '')
      {
        if($datas->device_type == 'A')
        {
          
        $insert_id=$this->save_notification($sender_id,$id,$message,$label,$type);
              
        $url = 'https://fcm.googleapis.com/fcm/send';
        $reg = $datas->device_id;
        
        if(!empty($reg)){ 
         $headers = array(
          'Content-Type:application/json',
          'Authorization:key=AIzaSyBFmJUyV1UkM31uVd-hkRkz98jsnAqVtuw'
         );

        //This should be in this format only else it doesn't work and shows no error 
        if($insert_id)
        { 
              $row = array(
                'to' => $reg,
                'data' => array(
                            'id'=>$insert_id,
                            'label'=>$label,
                            'msg' => $message,
                            'sender_id'=>$sender_id,
                            'receiver_id'=>$id
              ));

           
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($row));     
      // print_r($row);die;
        $response = curl_exec($ch);
        
        curl_close($ch);
        }//end of if
  
                     
      }elseif($datas->device_type == 'I'){

          if($datas->device_id != ''){

          

              $insert_id=$this->save_notification($sender_id,$id,$message,$label,$type);

            if($insert_id){
            $row['id'] = $insert_id;
            $row['sender_id'] = $sender_id;
            $row['receicer_id'] = $id;
            $row['message'] = $message;
            $row['label'] = $label;
          }

          $passphrase = '';
          $ctx = stream_context_create();
          stream_context_set_option($ctx,'ssl','local_cert','public/appNiff.pem');
          stream_context_set_option($ctx,'ssl','passphrase', $passphrase);

          // Open a connection to the APNS server
                         
          $fp = stream_socket_client('ssl://gateway.sandbox.push.apple.com:2195', $err,$errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);
                                                  //print_r($fp);die;

          if (!$fp)
          exit("Failed to connect: $err $errstr" . PHP_EOL);

          $body['aps'] = array('alert' => $message,'sound' => 'default');
            $body['data']=$row;
                                     // Encode the payload as JSON
          $payload = json_encode($body);

          $msg = chr('o') . pack('n', 32) . pack('H*',$datas->device_id) . pack('n', strlen($payload)) . $payload;

          $dataa = fwrite($fp, $msg, strlen($msg));
                 //print_r($dataa);die;
                        // Save Notifications
          fclose($fp);
               
        }
       }
      } 
    }
    }
}





   /**************************************************
             Save Notification
    *************************************************/
    function save_notification($sender_id,$receiver_id,$message,$label,$type){

          $notification =  new notification();  
          $notification->sender_id   = $sender_id;
          $notification->receiver_id = $receiver_id;
          $notification->message     = $message;
          $notification->label       = $label;
          $notification->user_type   = $type;
          $notification->save();
          $id = $notification->id;
          return $id;
      }
//*****************************************************//
//               Admin Profile                             //
//*****************************************************//

     public function adminProfileForm(){
		/* Chech Auth user login */
		if (Auth::guest()){
		 return redirect('/admin/login');
		}
		
	$datas['data'] = DB::table('users')
				->where('user_type','=','A')
				->first();
 
	  return view("adminpages/adminProfile",$datas);
	 }

//*****************************************************//
//              update admin pofile                    //
//*****************************************************//

     public function AdminProfile(Request $request){
     	
     	   if(Auth::guest()){
          
            return redirect('admin/login');

        }else{
             $user_id = 1;
            //print_r($request->all());die;
            $data = [
                        'user_name'        => $request->input('adminName')
                    ];

            if($request->hasFile('profile_picture')){

                $extension = $request->file('profile_picture')->getClientOriginalExtension();
                $destination_path = base_path().'/public/uploads/profile';
                $image = round(microtime(true)).'.'.$extension;
                $request->file('profile_picture')->move($destination_path, $image); 
                $data['profile_picture'] = $image;
            }        

            $update = DB::table('users')->where('id',$user_id)
                    ->update($data);

            if($update){
                $success = "Profile updated successfully";
                return Redirect::to('admin/adminProfileForm')->with('success',$success);
            }
        } 
	 }


/****************************/
      /*change password*/
/***************************/

      public function change_password_view(Request $request){
        
         return view('adminpages/change_password_view');
       }
/**************************/
// change password
/**************************/
      public function change_password(Request $request){
        $user_id = 1;
       // print_r($user_id);die;
        $newpass = Hash::make(Input::get('newPassword'));

        $profile_data =$this->admin->change_pass($user_id);

    if(Hash::check(Input::get('oldPassword'), $profile_data->password)) {          
        if(Input::get('oldPassword') == Input::get('newPassword')){ 
          $result  = 'Your old password is same as new!';
           return Redirect::to('admin/change_password_view')->withInput()->with('error',$result );
          }

          $credentials = User::find($profile_data->id);
          $credentials->updated_at   = date('Y-m-d H:i:s');               
          $credentials->password     = $newpass;
          $credentials->save();   

          $result  = "Your password has been updated Successfully";    
          return Redirect::to('admin/change_password_view')->with('success', $result);

        }else{

          $result  = "Old password is mismatched ,Your password has failed to update. Please try again!";

        }
        return Redirect::to('admin/change_password_view')->withInput()->with('error', $result);
       
      }

/******************************/
/********************************/
    public function add_services(){
        if (Auth::guest()){
         return redirect('/admin/login');
     }
       
           return view("adminpages/add_services");
        }


/**************************/
// Report Management
/**************************/
public function report_management(){
	if (Auth::guest()){
		 return redirect('/admin/login');
	}
	$datas['data'] = DB::table('contact_us') ->orderBy('created_at','desc')
				->get();
	  return view("adminpages/report_management",$datas);
}


//*****************************************************//
//                     Get appointment_management         //
//*****************************************************//
    public function appointment_management(){
    
    if (Auth::guest()){
     return redirect('/admin/login');
    }
    
    $datas['data'] = DB::table('post_services as ps')
         ->join('user_profiles as up','up.user_id','=','ps.user_id')
         /*->where('ps.job_forword','=','NA')*/
         ->select('ps.id as post_id','ps.user_id','ps.services_id','ps.offer_name','ps.therapist_gender','ps.massage_length','ps.created_at','ps.start_date','ps.start_time','ps.price','up.first_name','up.last_name','ps.job_status')
         ->orderBy('created_at','desc')
        ->get();

  foreach ($datas['data'] as $k => $value) {
     $moreservices=$this->admin->getOtherServices($value->services_id);

     $datas['data'][$k]->services_name = implode(",",$moreservices);

     $start_date= $value->start_date;  
     $job_start_date = date("jS F, Y" , strtotime($start_date)); 
      $datas['data'][$k]->start_date = $job_start_date;
  }
 return view("adminpages/appointment",$datas);
 
   }



/********************************/
// Admin Reply to user by mail
/*******************************/
    public function reply_report(Request $req){
	    $subject = $req->input('subject');
	    $email   = $req->input('email');
		$content = $req->input('message');

         Mail::send(array(), array(), function ($message) use ($content,$email,$subject){
			$from  = 'info@TouchMassage.com';
			$message->to($email ,'TouchMassage')->subject($subject)->setBody($content, 'text/html');

			});
           $result="Email sent successfully";
          return Redirect::to('admin/report_management')->withInput()->with('success', $result);
    }

/************************************/
/* getappointmentdetails */
/************************************/
public function getappointmentdetails($post_id){
       if (Auth::guest()){
      return redirect('/admin/login');
    }

    $datas = $this->admin->getappointmentdetails($post_id);

 return view("adminpages/appointment_details",$datas);

}

/************************************/
/* job_forword */
/************************************/
public function job_forword($post_id){
       if (Auth::guest()){
      return redirect('/admin/login');
    }

    $datas = $this->admin->getappointmentdetails($post_id);
    $datas['serviceprovider_list'] = $this->admin->getServiceProvider($post_id);

 return view("adminpages/job_forword",$datas);

}

/************************************/
/* updatejobforword */
/************************************/
public function updatejobforword(Request $req){
       if (Auth::guest()){
      return redirect('/admin/login');
    }

    $services_provider_id=$req->input('jobforword_id');
    $post_id=$req->input('post_id');
    $updateData = array('job_forword' => $services_provider_id,'job_status'=>'N' );
    $result_data=DB::table('post_services')->where('id',$post_id)->update($updateData);

    $message='Admin assigned you a new booking';
    $label = "job_forword";
    $type='SP';
    $sender_id=1;

         $this->Sent_notification($services_provider_id,$sender_id,$type,$label,$message);
    
      $result="Job forword Successfully";
      return Redirect::to('admin/appointment_management')->withInput()->with('success', $result);
}




//*****************************************************//
//            Insert Services                  //
//*****************************************************//
        public function insert_services(Request $req){
      if (Auth::guest()){
		 return redirect('/admin/login');
		}

		//update the data
		$services_id=$req->input('services_id');
        if($services_id){ // check for update the data
      $user_profile = array(
                  'title' =>$req->input('title'),
                  'description' =>$req->input('description'));


                  If(Input::hasFile('service_image')){
                 
                          $extension = Input::file('service_image')->getClientOriginalExtension(); 
                          $destinationPath = base_path('/') . '/public/uploads/services_images';
                          $profileImage = round(microtime(true)).'.'.$extension;
                          Input::file('service_image')->move($destinationPath, $profileImage); 
                          $user_profile['service_image']=$profileImage;
                      }

             
              DB::table('services_list')->where('id',$services_id)->update($user_profile);
                    
         $price=$req->input('price');     // update date and price of the services
         $timepriceId=$req->input('timepriceId');
         $time=$req->input('time');
       foreach ($price as $key => $value) {

         $insert_data = array(
                      'price' => $value,
                      'service_length' => $time[$key]);

         DB::table('service_length_time')->where('id',$timepriceId[$key])->update($insert_data);
       }

      $result="Services update Successfully";
      return Redirect::to('admin/add_services')->withInput()->with('success', $result);


		}else{

		 $services_list = array(
                  'title' =>$req->input('title'),
                  'description' =>$req->input('description'));


                    If(Input::hasFile('service_image')){
                 
                          $extension = Input::file('service_image')->getClientOriginalExtension(); 
                          $destinationPath = base_path('/') . '/public/uploads/services_images';
                          $profileImage = round(microtime(true)).'.'.$extension;
                          Input::file('service_image')->move($destinationPath, $profileImage); 
                          $services_list['service_image']=$profileImage;
                      }

             $services_id=DB::table('services_list')->insertGetId($services_list);


         /*$services_id=$req->input('service');*/
         $price=$req->input('price');
         $time=$req->input('time');
       foreach ($price as $key => $value) {
         $insert_data = array(
                      'service_id' => $services_id,
                      'price' => $value,
                      'service_length' => $time[$key]);

         DB::table('service_length_time')->insert($insert_data);
       }
        $result="Services insert Successfully";
      return Redirect::to('admin/add_services')->withInput()->with('success', $result);
            }
        }
//*****************************************************//
//                View Services list                       //
//*****************************************************//
     public function view_services(){ 
        if (Auth::guest()){
		     return redirect('/admin/login');
		 }
		 	$datas['data'] = DB::table('services_list')->select('id as serviceid','title','description')
				->get();
				//print_r($datas);die;
		     return view("adminpages/view_services",$datas);
        }

 //*****************************************************//
//               edit_services_list                      //
//*****************************************************//
     public function edit_services_list($services_id){ 
        if (Auth::guest()){
         return redirect('/admin/login');
     }
      $datas['data'] = DB::table('services_list')->where('id',$services_id)->select('id as serviceid','title','description','service_image')
        ->first();

      $datas['services_time'] = DB::table('service_length_time')->where('service_id',$services_id)->select('id as service_length_timeId','service_length','price')
        ->get();
       
         return view("adminpages/add_services",$datas);
        } 

//*****************************************************//
//               add Price Time List                      //
//*****************************************************//
     public function addPriceTime($services_id){ 
        if (Auth::guest()){
         return redirect('/admin/login');
     }
      $datas['data'] = DB::table('services_list')->where('id',$services_id)->select('id as serviceid','title','description','service_image')
        ->first();
        //print_r($datas);die;
         return view("adminpages/add_servicetimeprice",$datas);
        }

//*****************************************************//
//               add Service Time Price                      //
//*****************************************************//
     public function addServiceTimePrice(Request $req){ 
        if (Auth::guest()){
		     return redirect('/admin/login');
		 }
         $services_id=$req->input('service');
         $price=$req->input('price');
         $time=$req->input('time');

       foreach ($price as $key => $value) {

         $insert_data = array(
                      'service_id' => $services_id,
                      'price' => $value,
                      'service_length' => $time[$key]);

         DB::table('service_length_time')->insert($insert_data);
       }

           $result="Data insert Successfully";
      return Redirect::to('admin/addPriceTime/$services_id')->withInput()->with('success', $result);

        }

/*****************************/
/* Single Message page */
/*****************************/

public function single_message($message_id){
    if (Auth::guest()){
     return redirect('/admin/login');
    }
          $message_update= DB::table('contact_us')->where('id',$message_id)->update(['read_status'=>'1']);

          $datas['data']=DB::table('contact_us')->where('id',$message_id)->first();

    return view("adminpages/single_messagepage",$datas);
    
    }
/*****************************/
/* job cancel and reject reason */
/*****************************/

public function rejection_reason($reason_id){
    if (Auth::guest()){
     return redirect('/admin/login');
    }
          $reason_update= DB::table('reasons')->where('id',$reason_id)->update(['read_status'=>'1']);

          $datas['data']=DB::table('reasons')->where('id',$reason_id)->first();

    return view("adminpages/reason_page",$datas);
   }   
/*****************************/
/* New post notification */
/*****************************/

public function postnoti($post_id){
    
    if (Auth::guest()){
     return redirect('/admin/login');
    }
      $reason_update= DB::table('post_services')->where('id',$post_id)->update(['read_status'=>'1']);
     return Redirect::to('admin/appointment_management/');
}  

//*****************************************************//
//                 Get payment_transactions           //
//*****************************************************//
    public function view_payment_transactions(){
    /* Chech Auth user login */
    if (Auth::guest()){
     return redirect('/admin/login');
    }
    
    $datas['data'] = DB::table('payment')->get();
      foreach ($datas['data'] as $k => $value) {
     $moreservices=$this->admin->getOtherServices($value->services_id);

     $datas['data'][$k]->services_name = implode(",",$moreservices);
   }

      return view("adminpages/payment_transactions",$datas);
      
  
    
   }


/*********************************/
  /*  Add Admin Credit Card */
/**********************************/
    public function adminAddCard(){
        if (Auth::guest()){
         return redirect('/admin/login');
     }
       
           return view("adminpages/addcreditcard");
        }

/************************************/
/* SP payment */
/************************************/
public function sendsp_payment($post_id){
       if (Auth::guest()){
      return redirect('/admin/login');
    }

$datas['data']=DB::table('post_services')->where('id',$post_id)->select('work_picture')->first();

 return view("adminpages/sp_paymentsend",$datas);

}



/**End Class***/
      }
 /*************/