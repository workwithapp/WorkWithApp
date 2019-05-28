@extends('adminpages/inner_template')
@section('main')
<div class="row">
	<div class="col-xs-12">
    <!-- <h3 class="header smaller lighter blue">Services Listing</h3>
      <div class="clearfix">
        <div class="pull-right tableTools-container"></div>
      </div> -->
          <div class="table-header">
            Results for "Services Listing"
          </div>
              <div>  
								<table id="view_serviceTable" class="table table-hover table-bordered table-striped">
                    <thead>
                      <tr>
                        <th width="40px">#</th>
                        <th>Services Title</th>
                        <th>Services Description</th>   
                        <!-- <th>Add Price/Time</th>  -->
                        <th>Actions </th>         
                      </tr>
                    </thead>
                    <tbody>
                     <?php $no=0; foreach($data as $datas){ ++$no; ?>
                    <tr>  
                      <td>{{$no}}</td>
                      <td>{{$datas->title}}</td> 
                      <?php  $desc=substr($datas->description,0,200);?> 
                      <td title="{{$datas->description}}">{{$desc}}</td>
                     <!--  <td><a alt="edit" href="<?php echo url('/'); ?>/admin/addPriceTime/{{$datas->serviceid}}"><button type="button" class="btn btn-info">Add time/price</button></a></td> -->


                      <td><a alt="edit" href="<?php echo url('/'); ?>/admin/edit_services_list/{{$datas->serviceid}}"><button type="button" class="btn btn-warning">Edit</button></a></td>
                      
                    </tr>  
                     <?php } ?>                  
                    </tbody>
                  </table>
								</div>
							</div><!-- /.span -->
						</div><!-- /.row -->
								
@stop
