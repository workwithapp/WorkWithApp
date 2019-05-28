@extends('adminpages/inner_template')
@section('main')
<div id="feed" class="tab-pane">
	<div class="profile-feed row">
		<div class="col-sm-12">
			<div class="profile-activity clearfix">
            <div>
	<div id="user-profile-1" class="user-profile row">
		<div class="col-xs-12 col-sm-3 center">
			<div>
				<span class="profile-picture">
					<img id="avatar" class="editable img-responsive editable-click editable-empty" alt="Alex's Avatar" height="200px" width="200px" src="{{@$data[0]->profile_picture}}">
				</span>

				<div class="space-4"></div>

				<div class="width-80 label label-info label-xlg arrowed-in arrowed-in-right">
					<div class="inline position-relative">
						<a href="#" class="user-title-label dropdown-toggle" data-toggle="dropdown">
						<!-- 	<i class="ace-icon fa fa-circle light-green"></i>
							&nbsp; -->
							<span class="white">{{@$data[0]->first_name}} {{@$data[0]->last_name}}</span>
						</a>
					</div>
				</div>


            <form role="form" method="post" id="admin_profile" action="{{url('admin/updatejobforword')}}" enctype="multipart/form-data">
                  {{ csrf_field() }}
                <div class="forword_job">
                  <div class="dropdown forword_job">
                    <select name="jobforword_id">
                      <option value="" disabled="" selected>Select Service provider</option>
                      
                        <?php foreach ($serviceprovider_list as $k => $value) { ?>
                            <option value="{{$value->servicesProviderId}}">{{$value->first_name}} {{$value->last_name}}</option>
                        <?php } ?>                
                    </select>
                      </div>
                </div>

                <input type="hidden" name="post_id" value="{{@$data[0]->post_id}}">
                <div class="forword_submitbtn">
                      <input type="submit" class="btn btn-primary" value="Submit" name="submit">
                </div>
                </form>
			</div>

			<div class="space-6"></div>
		</div>

		<div class="col-xs-12 col-sm-9">
	

			<div class="space-12"></div>

			<div class="profile-user-info profile-user-info-striped">
				<div class="profile-info-row">
					<div class="profile-info-name"> Username </div>

					<div class="profile-info-value">
						<span class="editable editable-click" id="username">{{@$data[0]->first_name}} {{@$data[0]->last_name}}</span>
					</div>
				</div>

			

				<div class="profile-info-row">
					<div class="profile-info-name">Therapist Gender </div>

					<div class="profile-info-value">
						<span class="editable editable-click" id="age">@if(@$data[0]->therapist_gender == 'M')
                                {{"Male"}}
                            @elseif(@$data[0]->therapist_gender == 'F')
                                {{"Female"}}
                            @else
                                {{"Others"}}
                            @endif
                        </span>
					</div>
				</div>

				<div class="profile-info-row">
					<div class="profile-info-name"> Services name </div>

					<div class="profile-info-value">
						<span class="editable editable-click" id="signup">{{$data[0]->services_name}}</span>
					</div>
				</div>

				<div class="profile-info-row">
					<div class="profile-info-name">Massage length</div>

					<div class="profile-info-value">
						<span class="editable editable-click" id="login">{{$data[0]->massage_length}}</span>
					</div>
				</div>

			<div class="profile-info-row">
					<div class="profile-info-name">Start date</div>

					<div class="profile-info-value">
						<span class="editable editable-click" id="login">{{$data[0]->start_date}}</span>
					</div>
				</div>

				<div class="profile-info-row">
					<div class="profile-info-name">Start time</div>

					<div class="profile-info-value">
						<span class="editable editable-click" id="login">{{$data[0]->start_time}}</span>
					</div>
				</div>

				<div class="profile-info-row">
					<div class="profile-info-name">Price</div>

					<div class="profile-info-value">
						<span class="editable editable-click" id="login">{{$data[0]->price}}</span>
					</div>
				</div>
			</div>
</div>
	            <?php if($data[0]->job_forword !='NA'){ ?>
              <div class="col-sm-12">
              
                <div class="table-header">
                     Assigned Service provider
               </div>
                 <table  class="table table-hover table-bordered table-striped">
                    <thead>
                      <tr>
                         <th width="30px">#</th>
                        <th>Name</th>
                        <th>Experience</th>
                        <th>About</th>
                        <?php if($data[0]->job_status=="R" && $data[0]->rejectreason != ''){?>
                        <th>Action</th>
                        <?php } ?>
                      </tr>
                    </thead>
                    <tbody>         
                        <tr>  
                          <td>1</td>  
                          <td>{{$data[0]->job_forword->first_name}} {{$data[0]->job_forword->last_name}}</a></td>  
                          <td>{{$data[0]->job_forword->experience}}</td>  
                          <td>{{$data[0]->job_forword->about}}</td>  

                           <?php if($data[0]->job_status=='R' && $data[0]->rejectreason != ''){?>


               <td> <a class="reason_viewlink" data-toggle="modal" data-target="#myModal" class="btn btn-info">
              <i class="glyphicon glyphicon-edit icon-white"></i>View Reason</a></td>
                          <?php } ?>
                        </tr>                    
             
                    </tbody>
                  </table>
            </div>
            <?php } ?>
</div>
</div>
</div>
</div>
</div>
</div>




<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header modalHeader">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Reason</h4>
      </div>
      <div class="modal-body form_inner">
       <?php if($data[0]->job_status=="R" && $data[0]->rejectreason != ''){?>
       <p>{{$data[0]->rejectreason->reasons}}  </p>
       <?php } ?>
      <div class="clearfix"></div>
    </div>
  </div>
  </div>
</div>

@stop