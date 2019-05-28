<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Touch Massage (admin)</title>

		<meta name="description" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
         	<meta name="csrf-token" content="{{ csrf_token() }}">
		<!-- bootstrap & fontawesome -->
		<link rel="icon" type="image/ico" href="{!! asset('admin_assets/images/gallery/adminLogo.png')!!}" />
		<link rel="stylesheet" href="{!! asset('adminassets/css/bootstrap.min.css')!!}" />
		<link rel="stylesheet" href="{!! asset('adminassets/font-awesome/4.5.0/css/font-awesome.min.css')!!}" />

		<!-- page specific plugin styles -->
		 <link href="{!! asset('adminassets/datatables/dataTables.bootstrap.css')!!}" rel="stylesheet" type="text/css" />
   <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
	 <!-- DataTables -->
	 <link href="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" rel="stylesheet" type="text/css" />
		<!-- text fonts -->
		<link rel="stylesheet" href="{!! asset('adminassets/fonts.googleapis.com.css')!!}" />
 <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
		<!-- ace styles -->
		<link rel="stylesheet" href="{!! asset('adminassets/css/ace.min.css')!!}" class="ace-main-stylesheet" id="main-ace-style" />
		<link rel="stylesheet" href="{!! asset('adminassets/css/ace-skins.min.css')!!}" />
		<link rel="stylesheet" href="{!! asset('adminassets/css/ace-rtl.min.css')!!}" />
		<script src="{!! asset('adminassets/js/ace-extra.min.js')!!}"></script>

	</head>

	<body class="no-skin">
		<div id="navbar" class="navbar navbar-default          ace-save-state">
			<div class="navbar-container ace-save-state" id="navbar-container">
				<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
					<span class="sr-only">Toggle sidebar</span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>
				</button>

				<div class="navbar-header pull-left">
					<a href="<?php echo url('/')?>/admin" class="navbar-brand">
						<small>
							<i class="fa fa-leaf"></i>
							Touch Massage
						</small>
					</a>
				</div>

				<div class="navbar-buttons navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">
				 
                <!--**********************Notifications****************************-->

                    <?php
                        $reason=DB::table("reasons")->where('read_status','=','0')->get(); 
                        $postdata=DB::table("post_services")->where('read_status','=','0')->get();
                        $reasoncount=count($reason);
                        $postdatacount=count($postdata);
                        $total_count=$reasoncount+$postdatacount;

                        foreach ($postdata as $k => $value){
                        $result_datas = DB::table('users')->where('id',$value->user_id)->first();  
		                $postdata[$k]->username = $result_datas->user_name;
                      
                    }  ?>

						<li class="purple dropdown-modal">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<i class="ace-icon fa fa-bell icon-animated-bell"></i>
								<span class="badge badge-important"><?php echo $total_count; ?></span>
							</a>

							<ul class="dropdown-menu-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close">
								<li class="dropdown-header">
									<i class="ace-icon fa fa-exclamation-triangle"></i>
									<?php echo $total_count; ?> Notifications
								</li>

								<li class="dropdown-content">
									<ul class="dropdown-menu dropdown-navbar navbar-pink">


                                    <?php foreach ($reason as $key => $value) { 
                                           $user_name=DB::table('users')->where('id',$value->user_id)->select('user_name')->first();
                                     ?>
                                    	
										<li>
											<a href="<?php echo url('/');?>/admin/rejection_reason/{{$value->id}}">
												<div class="clearfix">
													<span class="pull-left">
														<i class="btn btn-xs no-hover btn-pink fa fa-comment"></i>
														<?php 
														  echo $user_name->user_name; 
														if($value->status=='R'){ echo ' Reject'; }else{ echo ' cancel'; }?> the job
													</span>
													<span class="pull-right badge badge-info"></span>
												</div>
											</a>
										</li>
                                      <?php } foreach ($postdata as $key => $value) { ?>
										<li>
											<a href="<?php echo url('/');?>/admin/postnoti/{{$value->id}}">
												<i class="btn btn-xs btn-primary fa fa-user"></i>
												{{$value->username}} add a new post
											</a>
										</li>
                                    <?php } ?>

										<!--<li>
											<a href="#">
												<div class="clearfix">
													<span class="pull-left">
														<i class="btn btn-xs no-hover btn-success fa fa-shopping-cart"></i>
														New Orders
													</span>
													<span class="pull-right badge badge-success">+8</span>
												</div>
											</a>
										</li>

										<li>
											<a href="#">
												<div class="clearfix">
													<span class="pull-left">
														<i class="btn btn-xs no-hover btn-info fa fa-twitter"></i>
														Followers
													</span>
													<span class="pull-right badge badge-info">+11</span>
												</div>
											</a>
										</li> -->




									</ul>
								</li>

								<!-- <li class="dropdown-footer">
									<a href="#">
										See all notifications
										<i class="ace-icon fa fa-arrow-right"></i>
									</a>
								</li> -->
							</ul>
						</li>
              <!--**********************Message Notifications****************************-->
                  <?php  $datas = DB::table('contact_us')->where('read_status','=','0')->get();   
                            foreach ($datas as $k => $value){
                     $result_datas = DB::table('user_profiles')->where('user_id',$value->user_id)->first();  
		            if($result_datas->profile_picture){
		                $datas[$k]->profile_picture = url('/').'/public/uploads/profile/'.$result_datas->profile_picture;
                      }
                    } ?>

						<li class="green dropdown-modal">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<i class="ace-icon fa fa-envelope icon-animated-vertical"></i>
								<span class="badge badge-success"><?php echo count($datas); ?></span>
							</a>

							<ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
								<li class="dropdown-header">
									<i class="ace-icon fa fa-envelope-o"></i>
									<?php echo count($datas); ?> Messages
								</li>

								<li class="dropdown-content">
									<ul class="dropdown-menu dropdown-navbar">
                                    <?php foreach ($datas as $key => $value) { ?>
										<li>
											<a href="<?php echo url('/');?>/admin/single_message/{{$value->id}}" class="clearfix">
												 <img src="{{$value->profile_picture}}" class="msg-photo" alt="Alex's Avatar" /> 
												<span class="msg-body">
													<span class="msg-title msg_inbox">
														<span class="blue">{{$value->subject}}</span>
														<span class="message_inbox">{{$value->message}}</span>
													</span>
												</span>
											</a>
										</li>
										<?php } ?>
									</ul>
								</li>

								<li class="dropdown-footer">
									<a href="<?php echo url('/');?>/admin/report_management">
										See all messages
										<i class="ace-icon fa fa-arrow-right"></i>
									</a>
								</li>
							</ul>
						</li>
              <!--********************************Admin Profile**********************************-->
                <?php  $datas = DB::table('users')->where('user_type','=','A')->first(); ?>
						<li class="light-blue dropdown-modal">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								<img class="nav-user-photo" src="<?php echo url('/').'/public/uploads/profile/'.$datas->profile_picture;?>" alt="Jason's Photo" />
								<span class="user-info">
									<small>Welcome,</small>
									{{$datas->user_name}}
								</span>

								<i class="ace-icon fa fa-caret-down"></i>
							</a>

							<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
								<li>
									<a href="<?php echo url('/')?>/admin/change_password_view">
										<i class="ace-icon fa fa-cog"></i>
										Change Password
									</a>
								</li>

								<li>
									<a href="<?php echo url('/')?>/admin/adminProfileForm">
										<i class="ace-icon fa fa-user"></i>
										Profile
									</a>
								</li>

								<li class="divider"></li>

								<li>
									<a href="<?php echo url('/')?>/admin/logout">
										<i class="ace-icon fa fa-power-off"></i>
										Logout
									</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</div><!-- /.navbar-container -->
		</div>
