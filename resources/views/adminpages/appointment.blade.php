@extends('adminpages/inner_template')
@section('main')
<div class="row">
		<div class="col-xs-12">
   <!--      <h3 class="header smaller lighter blue">Appointment Listing</h3>
          <div class="clearfix">
            <div class="pull-right tableTools-container"></div>
      </div> -->
      <div class="table-header">
        Results for "Appointments"
      </div>
        <div>  
           <table id="appointment_management" class="table table-hover table-bordered table-striped">
      <thead>
          <tr>
         
            <th width="30px">#</th>
            <th>Client Name</th>
            <th>Services Name</th>
            <th>Therapist Gender</th>
            <th>Massage length</th>
            <th>Start date</th>
            <th>Start time</th>
            <th>Price</th>			       
            <th>Job Forword</th>
            <th>Job status</th>

          </tr>
        </thead>
          <tbody>
           <?php $no=0; foreach($data as $datas){ ++$no; ?>
					  <tr>	
              <td>{{$no}}</td>  
             <td><a href="<?php echo url('/'); ?>/admin/getuserdetails/{{$datas->user_id}}/U">{{$datas->first_name}} {{$datas->last_name}}</a></td> 
              <td>{{$datas->services_name}}</td>  
              <td>@if($datas->therapist_gender == 'M') {{"Male"}} @elseif($datas->therapist_gender == 'F') {{"Female"}} @else  {{"Others"}} @endif</td>  
              <td>{{$datas->massage_length}}</td>  
              <td>{{$datas->start_date}}</td>  
              <td>{{$datas->start_time}}</td>  
							<td>{{$datas->price}}</td>	
               <td>


               
                  <div class="btn-group">
                    <?php if($datas->job_status=='N' || $datas->job_status=='R'){
                    $result='Accept';
                    $buttonStyle="btn-primary";
                    ?>
                     <a href="<?php echo url('/'); ?>/admin/job_forword/{{$datas->post_id}}"><button type="button" class="btn <?php echo $buttonStyle;?>">Job Forword</button></a>
                  <?php }if($datas->job_status=='Com'){  $buttonStyle="btn-danger"; ?>  
                     <a href="<?php echo url('/'); ?>/admin/sendsp_payment/{{$datas->post_id}}"><button type="button" class="btn <?php echo $buttonStyle;?>">Payment</button></a>
                     <?php }if($datas->job_status=='C'){  $buttonStyle="btn-danger"; ?>  
                     <a href="<?php echo url('/'); ?>/admin/refund_amount/{{$datas->post_id}}"><button type="button" class="btn <?php echo $buttonStyle;?>">Refund</button></a>
                     <?php } ?>




                </div>






              </td>
              <td>
              <div class="btn-group">
                <?php if($datas->job_status=='AC'){
                    $result='Accept';
                    $buttonStyle="btn-warning";
                    $s_tatus="A";
                }elseif($datas->job_status=='C'){
                  $result='Cancel';
                    $buttonStyle="btn-danger";
                    $s_tatus= "S";
                }
                elseif($datas->job_status=='Com'){
                    $result='Complete';
                    $buttonStyle="btn-success";
                    $s_tatus= "S";
                }
                elseif($datas->job_status=='R'){
                    $result='Reject';
                    $buttonStyle="btn-danger";
                    $s_tatus= "S";
                }
                elseif($datas->job_status=='ST'){
                    $result='Start';
                    $buttonStyle="btn-primary";
                    $s_tatus= "S";
                }
                elseif($datas->job_status=='N'){
                    $result='New';
                    $buttonStyle="btn-info";
                    $s_tatus= "S";
                }
                else{
                    $result='inprogress';
                    $buttonStyle="btn-primary";
                    $s_tatus= "S";
              }
                 ?>  
               <button type="button" class="btn <?php echo $buttonStyle;?>"><?php echo $result;?></button>
              </div>  
              </td>
            </tr>                    
            <?php } ?>
        </tbody>
      </table>
		</div>		
	</div><!-- /.span -->
</div><!-- /.row -->
@stop
