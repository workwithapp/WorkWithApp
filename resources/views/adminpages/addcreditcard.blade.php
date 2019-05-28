@extends('adminpages/inner_template')
@section('main')
<div class="row">
  <div class="col-xs-12">

   @if($alert = Session::get('error'))
                  <div class="alert text-danger alert-dismissable">
                   <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                   {{ $alert }}
                  </div>
                @endif 

                @if($alert = Session::get('success'))
                  <div class="alert text-success alert-dismissable">
                   <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                   {{ $alert }}
                  </div>
                @endif





  
    <div class="clearfix">
          <div class="pull-right tableTools-container"></div>
    </div>
      <div class="table-header"> Add Card </div>
      <div>           
        <form action="<?php echo url('/')?>/admin/addAdminCard" method="POST" role="form"> 
            <div class="box-body">
              {{ csrf_field() }}
                 <input type="hidden" name="service" value="@if(isset($data)) {{$data->serviceid}} @endif" placeholder="Enter your service id" class="form-control">
                 <div class="table-responsive">  
                     <table class="table table-bordered" id="">  
                      <tr>  
                         <th>Enter Debit/Credit Card Number</th>
                            <td> 
                               <input type="text" name="card_number" placeholder="Enter Your Debit/Credit Card Number" class="form-control name_list" required="" />
                               <input type="hidden" name="user_id" placeholder="Enter Your Debit/Credit Card Number" class="form-control name_list" required="" value="1" />
                               <input type="hidden" name="usert_ype" placeholder="Enter Your Debit/Credit Card Number" class="form-control name_list" required="" value="A" />
                            </td> 
                        <th>Enter Card Holder Name</th>
                           <td>
                           <input type="text" name="cardholder_name" placeholder="Enter Card Holder Name" class="form-control name_list" required="" /></td>   
                          
                    </tr>  



                 <tr>  
                         <th>Enter Expiry Date</th>
                            <td> 
                               <input type="text" name="expiry_date" placeholder="Enter Expiry Date" class="form-control name_list" required="" />
                            </td> 
                        <th>Enter CVV</th>
                           <td>
                           <input type="text" name="cvv_number" placeholder="Enter CVV number" class="form-control name_list" required="" /></td>   
                          
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
