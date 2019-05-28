@extends('adminpages/inner_template')
@section('main')
<div class="row">
  <div class="col-xs-12">
    <div class="box-header with-border">
        <h3 class="box-title">Add New Services</h3>
    </div>
    <form method="post" action="{{url('admin/AdminProfile/')}}" enctype="multipart/form-data">
      {{ csrf_field() }}
        <div class="form-group">
           <?php $base_url = url('/');?>
            <div>
                <?php if(empty($data)){
                        $admin_img = $base_url.'/public/static/dummy.jpeg';
                    }else{
                        $admin_img = $base_url.'/public/uploads/profile/'.$data->profile_picture;
                    }?>
                   <img height="80" width="80" style="margin-bottom:5px;" src="<?php echo $admin_img;?>">
            </div> 
          <input type="file" name="profile_picture" >
       </div>
       <div class="form-group">
          <label>Name </label>        
          <input type="text" name="adminName" id="adminName" value="<?php if(isset($data)){ echo $data->user_name;}?>" required ="required" class="form-control adminname">
       </div> 
             <input type="submit" class="btn btn-primary" value="Submit" name="submit">
    </form>
  </div><!-- /.span -->
</div><!-- /.row -->
@stop
