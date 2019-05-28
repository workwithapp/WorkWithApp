@extends('adminpages/inner_template')
@section('main')
   <div id="feed" class="tab-pane">
				<div class="profile-feed row">
					<div class="col-sm-12">

					 <div class="clearfix">
					<div class="pull-right tableTools-container"></div>
				</div>
					<div class="table-header">
						Service Provider Details
					</div>
						<div class="profile-activity clearfix">
                           <div>
                             <div id="user-profile-1" class="user-profile row">
	                           <div class="col-xs-12 col-sm-3 center">
		                          <div>
									<span class="profile-picture">
										<img id="avatar" class="editable img-responsive editable-click editable-empty" alt="Alex's Avatar" height="200px" width="200px" src="{{@$data->profile_picture}}">
									</span>

									<div class="space-4"></div>
                                    <?php //print_r($data);die; ?>
									<div class="width-80 label label-info label-xlg arrowed-in arrowed-in-right">
										<div class="inline position-relative">
											<a href="#" class="user-title-label dropdown-toggle" data-toggle="dropdown">
											<?php if($data->online =='ON'){ ?>
												<i class="ace-icon fa fa-circle light-green" title="Online"></i>
												&nbsp;
												<?php }else{ ?>
												<i class="ace-icon fa fa-circle red" title="Offline"></i>
												&nbsp;
												<?php } ?>
												<span class="white">{{@$data->first_name}} {{@$data->last_name}}</span>
											</a>
										</div>
									</div>
							</div>

						</div>

						<div class="col-xs-12 col-sm-9">
							<div class="profile-user-info profile-user-info-striped">
								<div class="profile-info-row">
									<div class="profile-info-name"> Username </div>

									<div class="profile-info-value">
										<span class="editable editable-click" id="username">{{@$data->first_name}} {{@$data->last_name}}</span>
									</div>
								</div>
								<div class="profile-info-row">
									<div class="profile-info-name"> Gender </div>

									<div class="profile-info-value">
										<span class="editable editable-click" id="age">@if(@$data->gender == 'M') {{"Male"}} @elseif(@$data->gender == 'F') {{"Female"}} @else {{"Others"}} @endif
										</span>
									</div>
								</div>

								<div class="profile-info-row">
									<div class="profile-info-name"> Address </div>

									<div class="profile-info-value">
										<span class="editable editable-click" id="signup">{{@$data->address}}</span>
									</div>
								</div>

								<div class="profile-info-row">
									<div class="profile-info-name"> Mobile Number</div>

									<div class="profile-info-value">
										<span class="editable editable-click" id="login">{{@$data->mobnumber}}</span>
									</div>
								</div>

								<div class="profile-info-row">
									<div class="profile-info-name"> About</div>

									<div class="profile-info-value">
										<span class="editable editable-click" id="login">{{@$data->about}}</span>
									</div>
								</div>

								<div class="profile-info-row">
									<div class="profile-info-name"> experience</div>

									<div class="profile-info-value">
										<span class="editable editable-click" id="login">{{@$data->experience}}</span>
									</div>
								</div>
								<div class="profile-info-row">
										<div class="profile-info-name"> services</div>

										<div class="profile-info-value">
											<span class="editable editable-click" id="login">{{@$data->experience}}</span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop