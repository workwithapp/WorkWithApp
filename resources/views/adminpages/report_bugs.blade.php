@extends('adminpages/inner_template')
@section('main')
    <div class="row">
		<div class="col-xs-12">
         <!--    <h3 class="header smaller lighter blue">Users Listing</h3>
                <div class="clearfix">
					<div class="pull-right tableTools-container"></div>
				</div> -->
					<div class="table-header">
						Results for "Registered users"
					</div>
               <div>
	    	        <table id="user_table" class="table table-striped table-bordered table-hover">
				       <thead>
					     <tr>
							<th width="30px">#</th>
				                <th>Email</th>
				                <th>Subject</th>
								<th>Message</th>
							</tr>
						</thead>

						<tbody>
				 			<?php $no=0; foreach($data as $datas){ ++$no; ?>
			     		<tr>	
                            <td>{{$no}}</td>	
              				<td><a href="mailto:{{$datas->email}}">{{$datas->email}}</a></td>  
              				<td>{{$datas->subject}}</td>  
							<td>{{$datas->message}}</td>	
							
                      </tr>                    
            			<?php } ?>
				
				    </tbody>
					</table>
				</div>			
			</div><!-- /.span -->
		</div><!-- /.row -->
@stop
