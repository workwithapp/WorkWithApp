<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
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
use App\v1\WebserviceModel;
use App\notification;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;
use Stripe\Token;

class Adminpaymentcontroller extends Controller
{

 private $required_field_error = "Please fill all fields!";
    

    public function __construct(Request $req){

    $this->webserviceModel = new WebserviceModel;

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: PUT, GET, POST");
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

    $version = $req->header('appversion');
    $device_type=$req->header('devicetype');


     if($version <= 2 && $device_type == 'A'){

      echo json_encode(array('status' => 426, 'message' => 'An updated version  of Touchmassage is available please update unless your application will not work.'));
      die;

    }elseif($version <= 2.0 && $device_type == 'I'){

      echo json_encode(array('status' => 426, 'message' => 'An updated version of Touchmassage is available please update unless your application will not work.'));
      die;

    }

    } //end of constructor

    /***************************************/
    /* FUNCTION FOR CHECK TOKEN EXPIRED OR NOT
    /***************************************/

    function GetCheckToken($user,$login_token)
    {
       $user = DB::table('users')->where('id','=',$user)->where('token','=', $login_token)->select('id')->first();
        if (!$user) {
            echo json_encode(array('status' => 401, 'message' => 'Wrong token entered!.Please try again.'));
                die;
         }else{
             return true;
         }
    }  

  /**************************************/
              /* Card Save */
  /***************************************/
  function card_save(Request $req){
    
    $expmnt_year = $req->input('expiry_date');  // 2020-01 format 
    $year_month = explode("-", $expmnt_year);
    $exp_year=$year_month[0];
    $exp_month=$year_month[1];
    
       
            $user_id     = $req->input('user_id');
            $card_number = $req->input('card_number');
            $exp_month   = $exp_month;
            $exp_year    = $exp_year;
            $cvv_number  = $req->input('cvv_number');
            $cardHoldername  = $req->input('cardholder_name');

        $customers_id = DB::table('customer')->where('user_id',$user_id)->select('customer_id')->first();
 
        if($customers_id){
          $customer_id = $customers_id->customer_id;
            $customer_id = $customer_id;
        }else{
          
            $customer_id = $this->create_customer($req->input('user_id'));

        }

       $saveCard = $this->token_create($card_number,$exp_year,$exp_month,$cvv_number,$user_id,$customer_id,$cardHoldername);

        if($saveCard){
             $result  = "Your card save Successfully";    
          return Redirect::to('admin/adminAddCard')->with('success', $result);
        }
  }

    /************************************/
    /* create_customer(stripe) */
   /*************************************/
   function create_customer($user_id){

      $getemail=DB::table('users')->where('id','=',$user_id)->select('email')->first();
        
      if(empty($getemail->email)){
         $result  = "Email not found";    
        return Redirect::to('admin/adminAddCard')->withInput()->with('error', $result);
      die;

    }try{

      
      \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
      $customers = \Stripe\Customer::create(array("email" => $getemail->email));

      $data = array(
            'user_id' => $user_id,
            'customer_id' => $customers->id);

      DB::table('customer')->insert($data);
            return $customers->id;

    } catch(\Stripe\Error\Card $e) {
       
        $body = $e->getJsonBody();   // Since it's a decline, \Stripe\Error\Card will be caught
        $err  = $body['error'];

        $results['status'] = $e->getHttpStatus();
        $results['type']   = $err['type'];
        $results['code']   = $err['code'];
       // param is '' in this case
        $results['param']  = $err['param'];
        $results['message'] = $err['message'];
       
       $result  = $results['message'];    
        return Redirect::to('admin/adminAddCard')->withInput()->with('error', $result); die;
        //echo json_encode(array('status' => false, 'message' =>$results['message'],'data' =>$results));  die;
    
    } catch (\Stripe\Error\RateLimit $e) {

        // Too many requests made to the API too quickly

        $body = $e->getJsonBody();
        $err  = $body['error'];

        $results['message'] = 'Too many requests made to the API too quickly';
      //echo json_encode(array('status' => false, 'message' => $results['message'], 'data' => $err)); die;
    $result  = $results['message'];    
        return Redirect::to('admin/adminAddCard')->withInput()->with('error', $result); die;
    } catch (\Stripe\Error\InvalidRequest $e) {

      // Invalid parameters were supplied to Stripe's API
      $body = $e->getJsonBody();
        $err  = $body['error'];

      $results['message']  = "Invalid parameters were supplied to Stripe's API";
     // echo json_encode(array('status' => false, 'message' => $results['message'], 'data' => $err)); die;
$result  = $results['message'];    
        return Redirect::to('admin/adminAddCard')->withInput()->with('error', $result); die;
    } catch (\Stripe\Error\Authentication $e) {

      // Authentication with Stripe's API failed
      // (maybe you changed API keys recently)
      $body = $e->getJsonBody();
        $err  = $body['error'];

     // echo json_encode(array('status' => false, 'message' => "Authentication with Stripe's API failed (maybe you changed API keys recently)", 'data' => $err)); die;  
    $result  = "Authentication with Stripe's API failed (maybe you changed API keys recently)";    
        return Redirect::to('admin/adminAddCard')->withInput()->with('error', $result); die;
    } catch (\Stripe\Error\ApiConnection $e) {
      // Network communication with Stripe failed

      $body = $e->getJsonBody();
        $err  = $body['error'];

      $results['message']  =  "Network communication with Stripe failed";
       // echo json_encode(array('status' => false, 'message' => $results['message'], 'data' => $err)); die;
$result  = $results['message'];    
        return Redirect::to('admin/adminAddCard')->withInput()->with('error', $result); die;
    } catch (\Stripe\Error\Base $e) {
      // Display a very generic error to the user, and maybe send
      // yourself an email

      $body = $e->getJsonBody();
        $err  = $body['error'];

      $results['message']  =  "Error";
      //echo json_encode(array('status' => false, 'message' => $results['message'], 'data' => $err)); die;
    $result  = $results['message'];    
        return Redirect::to('admin/adminAddCard')->withInput()->with('error', $result); die;
    } catch (Exception $e) {
      // Something else happened, completely unrelated to Stripe
      $results['message']  = "Something else happened, completely unrelated to Stripe";
      
      $body = $e->getJsonBody();
        $err  = $body['error'];

     // echo json_encode(array('status' => false, 'message' => $results['message'], 'data' => $err)); die;
    $result  = $results['message'];    
        return Redirect::to('admin/adminAddCard')->withInput()->with('error', $result); die;
    }
  }

   /************************************/
    /* token_create(stripe) */
    /*************************************/

  function token_create($card_number,$expiry_year,$exp_month,$cvv_number,$user_id,$customer_id=null,$cardHoldername){

    try{
        
        
    \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
           
    $token = \Stripe\Token::create(array(
            "card"        => array(
            "number"    => $card_number,
            "exp_month"   => $exp_month,
            "exp_year"    => $expiry_year,
            "cvc"         => $cvv_number)));

    if(empty($customer_id)){

            return $token->id;
    }else{

    $customer = \Stripe\Customer::retrieve($customer_id);
        $cardDetails = $customer->sources->create(array("source" =>$token->id));
     
    // check card alread save or not on the bases of fingerprint
      $cardfinger=$cardDetails->fingerprint;

      $fingerprints=DB::table('add_cards')->where('user_id',$user_id)->where('fingerprint',$cardfinger)->select('fingerprint')->first();
     if($fingerprints){

       if($cardDetails->fingerprint == $fingerprints->fingerprint){
      echo json_encode(array('status' => false, 'message' =>'Card Already Exists'));die;
    }
  }else{

      $cardDetaill = array(
          'user_id'     => $user_id,
          'card_id'     => $cardDetails->id,
          'object'    => $cardDetails->object,
          'brand'     => $cardDetails->brand,
          'country'     => $cardDetails->country,
          'customer'    => $cardDetails->customer,
          'exp_month'   => $cardDetails->exp_month,
          'exp_year'    => $cardDetails->exp_year,
          'fingerprint' => $cardDetails->fingerprint,
          'last4'       => $cardDetails->last4,
          'usert_ype'   => 'U',
          'cardholder_name'   => $cardHoldername
          );

    
           DB::table('add_cards')->insert($cardDetaill);
          return $cardDetails->customer;
          }
      }
        } catch(\Stripe\Error\Card $e) {
        // Since it's a decline, \Stripe\Error\Card will be caught
        $body = $e->getJsonBody();
        $err  = $body['error'];

        $results['status'] = $e->getHttpStatus();
        $results['type']   = $err['type'];
        $results['code']   = $err['code'];
      // param is '' in this case
        $results['param']  = $err['param'];
        $results['message'] = $err['message'];

        //echo json_encode(array('status' => false, 'message' => $results['message'],'data' =>$results)); die;
    $result  = $results['message'];    
        return Redirect::to('admin/adminAddCard')->withInput()->with('error', $result); die;
    } catch (\Stripe\Error\RateLimit $e) {

        // Too many requests made to the API too quickly

        $body = $e->getJsonBody();
        $err  = $body['error'];

        $results['message'] = 'Too many requests made to the API too quickly';
      //echo json_encode(array('status' => false, 'message' => $results['message'], 'data' => $err)); die;
    $result  = $results['message'];    
        return Redirect::to('admin/adminAddCard')->withInput()->with('error', $result); die;
    } catch (\Stripe\Error\InvalidRequest $e) {

      // Invalid parameters were supplied to Stripe's API
      $body = $e->getJsonBody();
        $err  = $body['error'];

      $results['message']  = "Invalid parameters were supplied to Stripe's API";
      //echo json_encode(array('status' => false, 'message' => $results['message'], 'data' => $err)); die;
$result  = $results['message'];    
        return Redirect::to('admin/adminAddCard')->withInput()->with('error', $result); die;
    } catch (\Stripe\Error\Authentication $e) {

      // Authentication with Stripe's API failed
      // (maybe you changed API keys recently)
      $body = $e->getJsonBody();
        $err  = $body['error'];

     // echo json_encode(array('status' => false, 'message' => "Authentication with Stripe's API failed (maybe you changed API keys recently)", 'data' => $err)); die;  
    $result  =  "Authentication with Stripe's API failed (maybe you changed API keys recently)";    
        return Redirect::to('admin/adminAddCard')->withInput()->with('error', $result); die;
    } catch (\Stripe\Error\ApiConnection $e) {
      // Network communication with Stripe failed

      $body = $e->getJsonBody();
        $err  = $body['error'];

      $results['message']  =  "Network communication with Stripe failed";
        //echo json_encode(array('status' => false, 'message' => $results['message'], 'data' => $err)); die;
      $result  = $results['message'];    
        return Redirect::to('admin/adminAddCard')->withInput()->with('error', $result); die;
    } catch (\Stripe\Error\Base $e) {
      // Display a very generic error to the user, and maybe send
      // yourself an email

      $body = $e->getJsonBody();
        $err  = $body['error'];

      $results['message']  =  "Error";
      //echo json_encode(array('status' => false, 'message' => $results['message'], 'data' => $err)); die;
    $result  = $results['message'];    
        return Redirect::to('admin/adminAddCard')->withInput()->with('error', $result); die;
    } catch (Exception $e) {
      // Something else happened, completely unrelated to Stripe
      $results['message']  = "Something else happened, completely unrelated to Stripe";
      
      $body = $e->getJsonBody();
        $err  = $body['error'];

      //echo json_encode(array('status' => false, 'message' => $results['message'], 'data' => $err)); die;
     $result  = $results['message'];    
        return Redirect::to('admin/adminAddCard')->withInput()->with('error', $result); die;
    }

  }

/*************************************************/
                 /*card list*/
/*************************************************/


	public function cards_list($user_id){  
     
        $cust_id=DB::table('customer')->where('user_id',$user_id)->select('customer_id')->first();
	    $cusromer_id=$cust_id->customer_id;
	
		try {
		
            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            $carddetail_list =    \Stripe\Customer::retrieve($cusromer_id)->sources->all(array(
            'object' => 'card'));

   
        $card_list_data=array();
        foreach ($carddetail_list->data as $k => $val){
	           $data['card_id'] = $val->id;
	           $data['customer'] = $val->customer;
	           $data['exp_month'] = $val->exp_month;
	           $data['exp_year'] = $val->exp_year;
	           $data['last4'] = $val->last4;
	           $data['brand'] = $val->brand;
               $card_list_data[]=$data;
            }
        
	    echo json_encode(array('status' => true, 'message' =>'card list','data' =>$card_list_data));	
	  		

 
	  	} catch(\Stripe\Error\Card $e) {
		  	// Since it's a decline, \Stripe\Error\Card will be caught
		  	$body = $e->getJsonBody();
		  	$err  = $body['error'];

		  	$results['status'] = $e->getHttpStatus();
		  	$results['type']   = $err['type'];
		  	$results['code']   = $err['code'];
		 	 // param is '' in this case
		  	$results['param']  = $err['param'];
		  	$results['message'] = $err['message'];

		  	//echo json_encode(array('status' => 204, 'message' =>$results['message'],'data' =>$results));	die;
		    $result  = $results['message'];    
        return Redirect::to('admin/adminAddCard')->withInput()->with('error', $result); die;
		} catch (\Stripe\Error\RateLimit $e) {

		  	// Too many requests made to the API too quickly

		  	$body = $e->getJsonBody();
		  	$err  = $body['error'];

		  	$results['message'] = 'Too many requests made to the API too quickly';
		  //	echo json_encode(array('status' => 201, 'message' => $results['message'], 'data' => $err));	die;
		$result  = $results['message'];    
        return Redirect::to('admin/adminAddCard')->withInput()->with('error', $result); die;
		} catch (\Stripe\Error\InvalidRequest $e) {

		  // Invalid parameters were supplied to Stripe's API
			$body = $e->getJsonBody();
		  	$err  = $body['error'];

			$results['message']	 = "Invalid parameters were supplied to Stripe's API";
			//echo json_encode(array('status' => 204, 'message' => $results['message'], 'data' => $err));die;
$result  = $results['message'];    
        return Redirect::to('admin/adminAddCard')->withInput()->with('error', $result); die;
		} catch (\Stripe\Error\Authentication $e) {

		  // Authentication with Stripe's API failed
		  // (maybe you changed API keys recently)
			$body = $e->getJsonBody();
		  	$err  = $body['error'];

			//echo  json_encode(array('status' => 204, 'message' => "Authentication with Stripe's API failed (maybe you changed API keys recently)", 'data' => $err));die;	
		$result  =  "Authentication with Stripe's API failed (maybe you changed API keys recently)";    
        return Redirect::to('admin/adminAddCard')->withInput()->with('error', $result); die;
		} catch (\Stripe\Error\ApiConnection $e) {
		  // Network communication with Stripe failed

			$body = $e->getJsonBody();
		  	$err  = $body['error'];

			$results['message']	 =  "Network communication with Stripe failed";
		    //echo json_encode(array('status' => 204, 'message' => $results['message'], 'data' => $err));die;
$result  = $results['message'];    
        return Redirect::to('admin/adminAddCard')->withInput()->with('error', $result); die;
		} catch (\Stripe\Error\Base $e) {
		  // Display a very generic error to the user, and maybe send
		  // yourself an email

			$body = $e->getJsonBody();
		  	$err  = $body['error'];

			$results['message']	 =  "Error";
			//echo json_encode(array('status' => 204, 'message' => $results['message'], 'data' => $err));	die;
		$result  = $results['message'];    
        return Redirect::to('admin/adminAddCard')->withInput()->with('error', $result); die;
		} catch (Exception $e) {
		  // Something else happened, completely unrelated to Stripe
			$results['message']	 = "Something else happened, completely unrelated to Stripe";
			
			$body = $e->getJsonBody();
		  	$err  = $body['error'];

			//echo json_encode(array('status' => 204, 'message' => $results['message'], 'data' => $err));die;
		$result  = $results['message'];    
        return Redirect::to('admin/adminAddCard')->withInput()->with('error', $result); die;
    }
	}

/**************************/
/* Payment */
/**************************/
public function payment(Request $req){
       
       $card_id=$req->input('card_id');
       $user_id=$req->input('user_id');
       $amount=$req->input('price');
       $services_id=$req->input('services_id');

    $rememberToken = $req->header('token');
    $this->GetCheckToken($req->input('user_id'),$rememberToken);

     $card_customer_id=DB::table('add_cards')->where('user_id',$user_id)->where('card_id',$card_id)->select('customer')->first();
  

	  try {		
			\Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
           
            if($card_id){
				$source = "customer"; // obtained with Stripe.js
			}else{
				$source = "source";
			}

		$charge = \Stripe\Charge::create(array(
				"amount" => $amount*100,
				"currency" => "usd",
				$source 	=> $card_customer_id->customer,						
				"description" => "Charge for TouchMasage"
				));
    
		$payment = array(
             
        'charge_id' => $charge->id,
        'object' => $charge->object,
        'created' => $charge->created,
        'currency' => $charge->currency,
        'customer' => $charge->customer,
        'stripe_transaction_id' => $charge->balance_transaction,
        'card_id' => $charge->source->id,
				'fingerprint' => $charge->source->fingerprint,
				'funding' => $charge->source->funding,
				'last4' => $charge->source->last4,
				'exp_month' => $charge->source->exp_month,
				'exp_year' => $charge->source->exp_year,
				'brand' => $charge->source->brand,
        'user_id' => $user_id,
        'services_id' => $services_id,
        'amount' => $amount
	            );

        $payment_result=DB::table('payment')->insert($payment);

        if($payment_result){
          $data = array(
              'user_id' =>$req->input('user_id'),
              'services_id' =>$req->input('services_id'),
              'therapist_gender' =>$req->input('therapist_gender'),
              'massage_length' =>$req->input('massage_length'),
              'start_date' =>$req->input('start_date'),
              'start_time' =>$req->input('start_time'),
              'street' =>$req->input('street'),
              'city' =>$req->input('city'),
              'zip' =>$req->input('zip'),
              'state' =>$req->input('state'),
              'parking_instruction' =>$req->input('parking_instruction'),
              'price' =>$req->input('price'),
              'offer_name' =>$req->input('offer_name'),
              'offer_price' =>$req->input('offer_price'),
              'job_forword' =>'NA',
              'job_status' =>'N');

          $result_data=DB::table('post_services')->insert($data);

        if($result_data){
          $result['status']   = 200;
          $result['message']  = "Post job Successfully";
           return $result;   
        }else{

        $result['status']    = 204;     
        $result['message']   ='Failed to post job';
          return $result;
      }
        
    }
		echo json_encode(array('status'=>200,'message'=>'Payment successfully'));
					
        } catch(\Stripe\Error\Card $e) {
		  	// Since it's a decline, \Stripe\Error\Card will be caught
		  	$body = $e->getJsonBody();
		  	$err  = $body['error'];

		  	$results['status'] = $e->getHttpStatus();
		  	$results['type']   = $err['type'];
		  	$results['code']   = $err['code'];
		 	// param is '' in this case
		  	$results['param']  = $err['param'];
		  	$results['message'] = $err['message'];

		  	//echo json_encode(array('status' => false, 'message' =>$results['message'],'data' =>$results));	die;
		$result  = $results['message'];    
        return Redirect::to('admin/adminAddCard')->withInput()->with('error', $result); die;
		} catch (\Stripe\Error\RateLimit $e) {

		  	// Too many requests made to the API too quickly

		  	$body = $e->getJsonBody();
		  	$err  = $body['error'];

		  	$results['message'] = 'Too many requests made to the API too quickly';
			//echo json_encode(array('status' => false, 'message' => $results['message'], 'data' => $err));	die;
		$result  = $results['message'];    
        return Redirect::to('admin/adminAddCard')->withInput()->with('error', $result); die;
		} catch (\Stripe\Error\InvalidRequest $e) {

		  // Invalid parameters were supplied to Stripe's API
			$body = $e->getJsonBody();
		  	$err  = $body['error'];

			$results['message']	 = "Invalid parameters were supplied to Stripe's API";
			//echo json_encode(array('status' => false, 'message' => $results['message'], 'data' => $err)); die;
$result  = $results['message'];    
        return Redirect::to('admin/adminAddCard')->withInput()->with('error', $result); die;
		} catch (\Stripe\Error\Authentication $e) {

		  // Authentication with Stripe's API failed
		  // (maybe you changed API keys recently)
			$body = $e->getJsonBody();
		  	$err  = $body['error'];

			//echo json_encode(array('status' => false, 'message' => "Authentication with Stripe's API failed (maybe you changed API keys recently)", 'data' => $err)); die;	
		$result  =  "Authentication with Stripe's API failed (maybe you changed API keys recently)";    
        return Redirect::to('admin/adminAddCard')->withInput()->with('error', $result); die;
		} catch (\Stripe\Error\ApiConnection $e) {
		  // Network communication with Stripe failed

			$body = $e->getJsonBody();
		  	$err  = $body['error'];

			$results['message']	 =  "Network communication with Stripe failed";
		    //echo json_encode(array('status' => false, 'message' => $results['message'], 'data' => $err)); die;
$result  = $results['message'];    
        return Redirect::to('admin/adminAddCard')->withInput()->with('error', $result); die;
		} catch (\Stripe\Error\Base $e) {
		  // Display a very generic error to the user, and maybe send
		  // yourself an email

			$body = $e->getJsonBody();
		  	$err  = $body['error'];

			$results['message']	 =  "Error";
			//echo json_encode(array('status' => false, 'message' => $results['message'], 'data' => $err));	die;
		$result  = $results['message'];    
        return Redirect::to('admin/adminAddCard')->withInput()->with('error', $result); die;
		} catch (Exception $e) {
		  // Something else happened, completely unrelated to Stripe
			$results['message']	 = "Something else happened, completely unrelated to Stripe";
			
			$body = $e->getJsonBody();
		  	$err  = $body['error'];

		//	echo json_encode(array('status' => false, 'message' => $results['message'], 'data' => $err));die;
		 $result  = $results['message'];    
        return Redirect::to('admin/adminAddCard')->withInput()->with('error', $result); die;
    }

        /*}else{
	         echo json_encode(array('status' => 'False', 'message' => 'please fill all fields'));
            }*/

       
}

/***********************************/
/* Refund amount */
/***********************************/
 public function refund_amount($job_id){
 $result_data=DB::table('post_services')->where('id',$job_id)->first();
 $get_charge=DB::table('payment')->where('job_id',$job_id)->first();
  
  $created_at=$result_data->created_at;
  $get_chargeid=$get_charge->charge_id;
  $amount=$get_charge->amount;
  $remaning_amonunt=$amount*30/100;

  $time=$this->timeago($created_at);
  if($time >= '45 min'){
   
  try {      
    
         \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
         $re = \Stripe\Refund::create(array(
           "charge" => "ch_1DMsQe2eZvKYlo2CJZCc4y6N"
          
         ));
       
        print_r($re);die;

 
      } catch(\Stripe\Error\Card $e) {
        // Since it's a decline, \Stripe\Error\Card will be caught
        $body = $e->getJsonBody();
        $err  = $body['error'];

        $results['status'] = $e->getHttpStatus();
        $results['type']   = $err['type'];
        $results['code']   = $err['code'];
       // param is '' in this case
        $results['param']  = $err['param'];
        $results['message'] = $err['message'];

        //echo json_encode(array('status' => 204, 'message' =>$results['message'],'data' =>$results));  die;
        $result  = $results['message'];    
        return Redirect::to('admin/adminAddCard')->withInput()->with('error', $result); die;
    } catch (\Stripe\Error\RateLimit $e) {

        // Too many requests made to the API too quickly

        $body = $e->getJsonBody();
        $err  = $body['error'];

        $results['message'] = 'Too many requests made to the API too quickly';
      //  echo json_encode(array('status' => 201, 'message' => $results['message'], 'data' => $err)); die;
    $result  = $results['message'];    
        return Redirect::to('admin/adminAddCard')->withInput()->with('error', $result); die;
    } catch (\Stripe\Error\InvalidRequest $e) {

      // Invalid parameters were supplied to Stripe's API
      $body = $e->getJsonBody();
        $err  = $body['error'];

      $results['message']  = "Invalid parameters were supplied to Stripe's API";
      //echo json_encode(array('status' => 204, 'message' => $results['message'], 'data' => $err));die;
$result  = $results['message'];    
        return Redirect::to('admin/adminAddCard')->withInput()->with('error', $result); die;
    } catch (\Stripe\Error\Authentication $e) {

      // Authentication with Stripe's API failed
      // (maybe you changed API keys recently)
      $body = $e->getJsonBody();
        $err  = $body['error'];

      //echo  json_encode(array('status' => 204, 'message' => "Authentication with Stripe's API failed (maybe you changed API keys recently)", 'data' => $err));die;  
    $result  =  "Authentication with Stripe's API failed (maybe you changed API keys recently)";    
        return Redirect::to('admin/adminAddCard')->withInput()->with('error', $result); die;
    } catch (\Stripe\Error\ApiConnection $e) {
      // Network communication with Stripe failed

      $body = $e->getJsonBody();
        $err  = $body['error'];

      $results['message']  =  "Network communication with Stripe failed";
        //echo json_encode(array('status' => 204, 'message' => $results['message'], 'data' => $err));die;
$result  = $results['message'];    
        return Redirect::to('admin/adminAddCard')->withInput()->with('error', $result); die;
    } catch (\Stripe\Error\Base $e) {
      // Display a very generic error to the user, and maybe send
      // yourself an email

      $body = $e->getJsonBody();
        $err  = $body['error'];

      $results['message']  =  "Error";
      //echo json_encode(array('status' => 204, 'message' => $results['message'], 'data' => $err)); die;
    $result  = $results['message'];    
        return Redirect::to('admin/adminAddCard')->withInput()->with('error', $result); die;
    } catch (Exception $e) {
      // Something else happened, completely unrelated to Stripe
      $results['message']  = "Something else happened, completely unrelated to Stripe";
      
      $body = $e->getJsonBody();
        $err  = $body['error'];

      //echo json_encode(array('status' => 204, 'message' => $results['message'], 'data' => $err));die;
    $result  = $results['message'];    
        return Redirect::to('admin/adminAddCard')->withInput()->with('error', $result); die;
    }

  }else{
  echo $time;
 }
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
        return "one min ";
      }else{
        return "$minutes min ";
      }
    }
    //Hours
    else if($hours <=24){
      if($hours==1){
        return "an hour ";
      }else{
        return "$hours hours ";
      }
    }
      //Days
    else if($days <= 7){
        if($days==1){
        return "yesterday";
        }else{
        return "$days days ";
        }
    }
        //Weeks
      else if($weeks <= 4.3){
        if($weeks==1){
        return "1 week ";
        }else{
        return "$weeks weeks ";
        }
      }
      //Months
    else if($months <=12){
        if($months==1){
        return "1 month ";
        }else{
        return "$months months ";
        }
    }
      //Years
      else{
        if($years==1){
        return "1 year ";
        }else{
        return "$years years ";
        }
      }
    }  

/******/ 
    }
/******/