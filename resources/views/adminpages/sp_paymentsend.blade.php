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


        
          <img id="avatar" class="editable img-responsive editable-click editable-empty" alt="Alex's Avatar" height="200px" width="200px" src="<?php echo url('/')?>/public/uploads/work_picture/<?php echo $data->work_picture;?>">
        </span>

        <div class="space-4"></div>

        <div class="width-80 label label-info label-xlg arrowed-in arrowed-in-right">
          <div class="inline position-relative">
            <a href="#" class="user-title-label dropdown-toggle" data-toggle="dropdown">
            <!--  <i class="ace-icon fa fa-circle light-green"></i>
              &nbsp; -->
              <span class="white">Work Picture</span>
            </a>
          </div>
        </div>


      </div>

      <div class="space-6"></div>
    </div>








           
</div>
</div>
</div>
</div>
</div>
</div>






@stop