@extends('adminpages/inner_template')
@section('main')
  <div class="row">
    <div class="col-xs-12">

			@if ($alert = Session::get('error'))
				<div class="alert alert-danger alert-dismissible">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
               {{ $alert }}
                 </div>
			@endif
			@if ($alert = Session::get('success'))
				<div class="alert alert-success alert-dismissible">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
               {{ $alert }}
                 </div>
			@endif	

    
    <div>  
      <form method="post" action="{{url('admin/insert_services/')}}" enctype="multipart/form-data">
        {{ csrf_field() }}
          <div class="widget-box">
            <div class="widget-header">
              <h4 class="widget-title">ADD SERVICES</h4>
            </div>
              <div class="widget-body">
                <div class="widget-main">
                  <div class="form-group">
                    <div class="col-xs-12">
                        <?php $base_url = url('/');?>
                        <div>
                          <?php

                           if(empty($data)){
                                  $admin_img = $base_url.'/public/static/services.jpg';
                              }else{
                                  $admin_img = $base_url.'/public/uploads/services_images/'.$data->service_image;
                              }?>
                             <img height="100px" width="150px" style="margin-bottom:5px;" src="<?php echo $admin_img;?>">
                        </div> 
                    </div>
                   </div>
                            <div class="file-field">
                               <label>Add services images</label>
                               <input type="file" name="service_image"/>
                            </div>                           
                          <div class="form-group" style="margin-top: 8px">
                           <label>Title</label>
                              <div class="col-xs-12">
                               <input type="text" name="title" id="title" value="@if(isset($data)) {{$data->title}} @endif" required ="required" class="form-control adminname">

                              <input type="hidden" name="services_id" id="services_id" value="@if(isset($data)) {{$data->serviceid}} @endif" required ="required" class="form-control">

                              </div>
                            </div>
                           <div class="form-group">
                            <label>Description</label>
                              <div class="col-xs-12">
                                   <input type="text" name="description" id="description" value="@if(isset($data)) {{$data->description}} @endif" required ="required" class="form-control adminname">
                              </div>
                            </div>  



           <div class="table-responsive1">  
                     <table class="table table-bordered" id="dynamic_field1">  
                      <tr>  

                    <?php 
                        if(isset($services_time)){
                        foreach ($services_time as $key => $value) { ?>
                        	
                         <th>Price</th>
                            <td> 
                               <input type="text" name="price[]" value="{{$value->price}}" placeholder="Enter your price" class="form-control name_list" required="" />
                              
                            </td> 
                        <th>Time</th>
                           <td>
                           <input type="text" name="time[]" value="{{$value->service_length}}" placeholder="Enter your time" class="form-control name_list" required="" /></td>   
                           <input type="hidden" name="timepriceId[]" value="{{$value->service_length_timeId}}" class="form-control name_list" required="" />
                        <td>
                    <?php } }else{ ?>

                        <th>Price</th>
                            <td> 
                               <input type="text" name="price[]" placeholder="Enter your price" class="form-control name_list" required="" />
                              
                            </td> 
                        <th>Time</th>
                           <td>
                           <input type="text" name="time[]" placeholder="Enter your time" class="form-control name_list" required="" /></td>   
                        <td>


                         	<?php } ?>
                        <button type="button" name="add" id="addmorebutn1" class="btn btn-success">Add More</button></td>  
                       
                    </tr>  
                   </table> 

                </div>
                    




                             <input type="submit" class="btn btn-primary add_services_btn" value="Submit" name="submit">                          
                        </div>
                    </div>
                </div> 
     
                   
                    
            </form>
          </div>
        </div><!-- /.span -->
    </div><!-- /.row -->

@stop
