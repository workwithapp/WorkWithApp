@extends('adminpages/inner_template')
@section('main')
                                 <div class="row">
                  <div class="col-xs-12">
                                     
                    <div class="box-header with-border">
                  <h3 class="box-title">Change Password</h3>
                </div>
            <!-- /.box-header -->
            <!-- form start -->
           <form role="form" method="post" id="changepass" action="<?php echo url('/')?>/admin/change_password" enctype="multipart/form-data">
                   {{ csrf_field() }}
  
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
          <div class="form-group">
            <div class="icon_inputs">
              <input type="password" name="oldPassword" placeholder="Enter Old Password" value="" class="form-control" required="" />
              
            </div>
          </div>
          <div class="form-group">
            <div class="icon_inputs">
              <input type="password" name="newPassword" placeholder="Enter New Password" value="" id="newPassword" class="form-control" required="" />
              
            </div>
          </div>
          <div class="form-group">
            <div class="icon_inputs">
              <input type="password" name="confirm_password" placeholder="Confirm New Password" value="" class="form-control" required="" />
              
            </div>
          </div> 
                    <input type="submit" class="btn btn-primary" value="Submit" name="submit">

                </form>
                    
                  </div><!-- /.span -->
                </div><!-- /.row -->

                <div class="hr hr-18 dotted hr-double"></div>
@stop
