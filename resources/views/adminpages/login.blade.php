<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
    <title>Work with(admin)</title>

    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
          <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- bootstrap & fontawesome -->
    <link rel="stylesheet" href="{!! asset('adminassets/css/bootstrap.min.css')!!}" />
    <link rel="stylesheet" href="{!! asset('adminassets/font-awesome/4.5.0/css/font-awesome.min.css')!!}" />

    <!-- page specific plugin styles -->
   <link rel="stylesheet" href="https://cdn.datatables.net/responsive/1.0.0/css/dataTables.responsive.css">
   <!-- DataTables -->
   <link href="{!! asset('admin_assets/plugins/datatables/dataTables.bootstrap.css')!!}" rel="stylesheet" type="text/css" />
    <!-- text fonts -->
    <link rel="stylesheet" href="{!! asset('adminassets/fonts.googleapis.com.css')!!}" />

    <!-- ace styles -->
    <link rel="stylesheet" href="{!! asset('adminassets/css/ace.min.css')!!}" class="ace-main-stylesheet" id="main-ace-style" />
    <link rel="stylesheet" href="{!! asset('adminassets/css/ace-skins.min.css')!!}" />
    <link rel="stylesheet" href="{!! asset('adminassets/css/ace-rtl.min.css')!!}" />
    <script src="{!! asset('adminassets/js/ace-extra.min.js')!!}"></script>
   <link href="{!! asset('adminassets/css/custom.css')!!}" rel="stylesheet" type="text/css" />

  </head>
  <style type="text/css">
   /* .loginback1{
 background: url("<?php echo url('/')?>/public/static/login_bg.png");
 background-size: cover;
 background-repeat: no-repeat;
 }*/
  </style>

<body class="hold-transition login-page">
<div class="loginback1">
<!-- <center><h2 class="welcome_login">Welcome to AppNiff</h2></center> -->
<div class="login_inner">
<div class="login-box login_sctn">
      
      <div class="login-logo">
       <h2 style="color:#fff; padding:10px; margin-bottom: 0px;">Login</h2>
	   
      </div><!-- /.login-logo -->
      <div class="login-box-body">
		 <div class="alert alert-danger" id="error" style="display:none;"></div>
            @if ($alert = Session::get('error'))
              <div class="alert alert-danger">
              <?php foreach($alert as $val){
                echo $val[0]."<br>";
              } ?>
              </div>
            @endif
            @if ($alert = Session::get('success'))
              <div class="alert alert-success">
                  {{ $alert }}
              </div>
            @endif  
	   	<form class="" action="<?php echo url('/')?>/admin/signin" method="post">
		      <input type="hidden" name="_token" value="{{ csrf_token() }}" class="form-control">
			 
          <div class="form-group has-feedback">
            <input type="email" class="form-control" name="email" placeholder="Email">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" name="password" placeholder="Password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="form-group">
              <button type="submit" class="btn btn-block btn-flat admin_loginbtn" style="font-size:18px;">Sign In</button> 
          </div>
      </form>
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->
	</div>
	
	<!-- REQUIRED JS SCRIPTS -->

    <!-- jQuery 2.1.4 -->
    <script src="{!! asset('admin_assets/plugins/jQuery/jQuery-2.1.4.min.js')!!}"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="{!! asset('admin_assets/bootstrap/js/bootstrap.min.js')!!}"></script>
    <!-- AdminLTE App -->
    <script src="{!! asset('admin_assets/dist/js/app.min.js')!!}"></script>
    </div>
</body>
</html>
