<!-- All the files that are required -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link href='http://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

<script src="<?php echo Url('/');?>/admin_assets/js/jquery-1.8.3.min.js"></script>
<script src="<?php echo Url('/');?>/admin_assets/js/validate.js"></script>
<!-- <script src="<?php echo Url('/');?>/admin_assets/js/jquery.validate.min.js"></script> -->
<div class="back">
<div class="container">
<h1 class="text-center text-danger"><?php if(!empty($expire_token)){echo $expire_token;die;}?></h1>
<div class="row">
<!-- <div class="col-sm-12">
<h1 class="text-center">Change Password</h1>
</div> -->
</div>
<div class="row">
<div class="col-sm-12">
<h3 class="text-center text-success"><?php if(!empty($message)){echo $message;}?></h3>
</div>
<div class="col-sm-12">
<h3 class="text-center text-danger"><?php if(!empty($error)){echo $error;}?></h3>
</div>
<div class="col-sm-6 col-sm-offset-3">
<center><img class="logo_n" src="<?php echo url('/')?>/public/static/touch_massage_logo.png"></center>
<form method="post" id="changepassw" name="form1" action="{{url('/api/webservices/setNewPassword')}}"  class="edit_pro login">

<div class="row">
<input type="hidden" name="token" id="token" value="<?php if(!empty($token)){echo $token;} ?>" >
<input type="hidden" name="user_id" id="user_id" value="<?php if(!empty($user_id)){echo $user_id;} ?>" >
<input type="password" class="input-lg form-control" name="password" id="password" placeholder="New Password" autocomplete="off">
</div><br>

<div class="row">
<input type="password" class="input-lg form-control" name="repeat_password" id="repeat_password" placeholder="Repeat Password" autocomplete="off">

</div><br>
<input type="submit" id="subm" class="btn btn-primary btn-load btn-lg" data-loading-text="Changing Password..." value="Change Password">
</form>

</div><!--/col-sm-6-->
</div><!--/row-->
</div>
</div>
  <style>
.back {
 background: url("<?php echo url('/')?>/public/static/login_bg.png");
 background-size: cover;
  height: 100%;
  min-height: 100%;
  position: fixed;
  width: 100%;
}
.edit_pro.login {
  max-width: 425px;
  padding: 50px 30px 54px;
  width: 100%;
  /*border: 2px solid #27a3a3;*/
    box-shadow: 0 0 22px 0 #000;
}
.edit_pro {
  border-radius: 1px;
  margin: 0 auto;
}
body {
  margin: 0;
}
input {
    border: none !important;
    border-radius: 5px;
    margin: 0 0 15px;
    padding: 11px 10px;
    width: 100%;
    font-size: 14px;
    background: transparent !important;
    box-shadow: none !important;
    color: #fff !important;
    border-bottom: 1px solid #fff !important;
    border-radius: 0px !important;
}
#subm {
  background: #fff none repeat scroll 0 0 !important;
  color: #000 !important;
  font-size: 14px;
  width: 150px;
  border: none;
  border-radius: 5px !important;
}
.logo_n {
  padding-bottom: 50px;
  width: 70%;
  
}
::-webkit-input-placeholder { /* Chrome/Opera/Safari */
  color: #fff !important;
}
::-moz-placeholder { /* Firefox 19+ */
  color: #fff !important;
}
:-ms-input-placeholder { /* IE 10+ */
  color: #fff !important;
}
:-moz-placeholder { /* Firefox 18- */
  color: #fff !important;
}
.logo_n {
    width: 123px !important;
}
label.error {
    color: #8b0113;
}
</style>
	



<script>
  $().ready(function() {
  
    $("#changepassw").validate({
      rules: {   
        password: {
          required: true,
          minlength: 6,
                maxlength: 20,
                nowhitespace:true
          //alphanumeric: true,
        },
        repeat_password: {
          required: true,
          equalTo: "#password"
        },
      },
      messages: {
      
        password: {
          required: "Please enter a new password",
          minlength: "Your password must be at least 8 characters long",
                maxlength: "Your password must be at most 20 characters long",
          //alphanumeric: "Password must be alphanumeric with minimum 8 characters"
        },
      
        repeat_password: {
          required: "Please confirm the new password",
          equalTo: "Please enter the same password as above"
        },
      }
    });

  $.validator.addMethod("lettersonly", function(value, element) {
        return this.optional(element) || /^[a-z]+$/i.test(value);
    }, "Letters only please");

    $.validator.addMethod( "nowhitespace", function( value, element ) {
          return this.optional( element ) || /^\S+$/i.test( value );
      }, "No white space please" );

    $.validator.addMethod("alphanumeric", function(value, element) {
          return this.optional(element) || /^[a-zA-Z0-9]{8,}$/.test(value);
        },'Password must be alphanumeric with minimum 8 characters'); 
    // validate signup form on keyup and submit

});

</script>