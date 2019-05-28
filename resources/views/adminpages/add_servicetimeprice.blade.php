@extends('adminpages/inner_template')
@section('main')
<div class="row">
  <div class="col-xs-12">
    <div class="clearfix">
          <div class="pull-right tableTools-container"></div>
    </div>
      <div class="table-header"> Time / Price </div>
      <div>           
        <form action="<?php echo url('/')?>/admin/addServiceTimePrice" method="POST" role="form"> 
            <div class="box-body">
              {{ csrf_field() }}
                 <input type="hidden" name="service" value="@if(isset($data)) {{$data->serviceid}} @endif" placeholder="Enter your service id" class="form-control">
                 <div class="table-responsive">  
                     <table class="table table-bordered" id="dynamic_field">  
                      <tr>  
                         <th>Price</th>
                            <td> 
                               <input type="text" name="price[]" placeholder="Enter your price" class="form-control name_list" required="" />
                            </td> 
                        <th>Time</th>
                           <td>
                           <input type="text" name="time[]" placeholder="Enter your time" class="form-control name_list" required="" /></td>   
                        <td>
                        <button type="button" name="add" id="addmorebutn" class="btn btn-success">Add More</button></td>  
                    </tr>  
                </table>  
            </div>

                <div class="box-footer">
                <div class="col-md-12">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                  <div class="col-md-6">
                  <input type="submit" class="btn btn-primary" name="submit" style="width:100%;" value="Submit">
                  </div>            
                </div>
                    <div class="col-md-4"></div>
                </div>
              </div>
        </form>
      </div>
    </div><!-- /.span -->
  </div><!-- /.row -->
@stop
