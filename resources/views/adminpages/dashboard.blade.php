@extends('adminpages/inner_template')
@section('main')
  <div class="row">
		<div class="col-xs-12">
     <!-- Main content -->
        <section class="content">
          <div class="row">
             <div class="col-lg-6 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua dashtotaluser">
            <div class="inner">

       
<h3><?php
  $totalUsers= DB::table('users as u')
         ->where('u.user_type','!=','A')
         ->orWhereNull('u.user_type')
         ->select('u.*')
         ->orderBy('id','desc')
        ->count(); ?> {{$totalUsers}}</h3>
              <p>Total Users</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="<?php echo url('/')?>/admin/get_users" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      
          </div>
        </div>
        <!-- ./col -->
        <!-- <div class="col-lg-6 col-xs-6">
          
             <div class="small-box bg-yellow dashtotalspuser">
            <div class="inner">
               <?php $date = date("Y-m-d");?>
              <h3> <?php echo $users = DB::table('users')->where([['user_type', '=', 'SP'],['status', '=', 'A']])->count();?></h3>

              <p>Service Providers</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
           <a href="<?php echo url('/')?>/admin/get_spList" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div> -->
        <!-- ./col -->
    </div>
</section><!-- /.content -->
    				</div><!-- /.span -->
								</div><!-- /.row -->
@stop
