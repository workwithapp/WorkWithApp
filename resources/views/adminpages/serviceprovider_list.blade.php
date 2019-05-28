@extends('adminpages/inner_template')
@section('main')
<div class="row">
	<div class="col-xs-12">
		<!-- <h3 class="header smaller lighter blue">Service Provider Listing</h3>
            <div class="clearfix">
				<div class="pull-right tableTools-container"></div>
			</div> -->
				<div class="table-header">
					Results for "Registered Service Provider"
				</div>
                    <div>
                        <table id="user_table" class="table table-hover table-bordered table-striped">
                    <thead>
                      <tr>
                         <th width="30px">#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>                
                     <?php 
                       $no=0;
                     foreach($data as $datas){ ++$no; ?>
					  <tr>	
							<td>{{$no}}</td>	
				            <td><a href="<?php echo url('/'); ?>/admin/getuserdetails/{{$datas->id}}/SP">{{$datas->first_name}} {{$datas->last_name}}</a></td>  
				            <td>{{$datas->email}}</td>  
							<td>{{$datas->address}}</td>	
							<td>
							<div class="btn-group">

								<?php if($datas->status=='S'){
								    $result='Approve';
								    $buttonStyle="btn-danger";
								    $s_tatus="A";
								}else{
									$result='Suspend';
								    $buttonStyle="btn-primary";
								    $s_tatus= "S";
								} ?>	
							  <button type="button" class="btn <?php echo $buttonStyle;?>"><?php if($datas->status=='S'){ echo 'Suspend';}else{echo 'Approve';} ?></button>
							  <button type="button" class="btn <?php echo $buttonStyle;?> dropdown-toggle" data-toggle="dropdown">
								<span class="caret"></span>
							  </button>

							  <ul class="dropdown-menu" role="menu">
					 
								<li><a href="<?php echo url('/'); ?>/admin/changeStatus/{{$datas->id}}/{{$s_tatus}}/SP" onclick="return confirm('Are you sure you want to <?php echo $result;?> this user?');"><?php echo $result;?></a></li>
							  </ul>
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
