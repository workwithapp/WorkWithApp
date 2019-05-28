@extends('adminpages/inner_template')
@section('main')
    <div class="row">
      <div class="col-xs-12">
      <!--   <h3 class="header smaller lighter blue">Report management listing</h3>
          <div class="clearfix">
            <div class="pull-right tableTools-container"></div>
          </div> -->
        <div class="table-header">
       Results for "Report management"
        </div>
           <div>  
              <table id="reportmanag" class="table table-hover table-bordered table-striped">
                     <thead>
                      <tr>
                        <th width="30px">#</th>
                        <th>Email</th>
                        <th>subject</th>
                        <th>message</th>
                        <th>Reply</th>
                      </tr>
                    </thead>
                           <tbody>
             
                     <?php 
                       $no=0;
                     foreach($data as $datas){ ++$no; ?>
            <tr>  
              <td>{{$no}}</td>  
              <td>{{$datas->email}}</td>  
              <td>{{$datas->subject}}</td>  
              <td>{{$datas->message}}</td>    
              <td> <a class="edit_button_reply"  data-id="<?php echo $datas->id;?>" data-name="<?php echo $datas->email; ?>"  data-toggle="modal" data-target="#myModal" class="btn btn-info">
              <i class="glyphicon glyphicon-edit icon-white"></i>Reply</a></td>
                      </tr>                    
                  <?php } ?>
                    </tbody>
                  </table>
                    </div>
                  </div><!-- /.span -->
                </div><!-- /.row -->

                <div class="hr hr-18 dotted hr-double"></div>


<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header modalHeader">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Message</h4>
      </div>
      <div class="modal-body form_inner">
        <form method="post" action="<?php echo url('/')?>/admin/reply_report"  enctype="multipart/form-data" id="myform1">    
        {{ csrf_field() }}

      <input type="hidden" class="form-control" name="email" id="email" >
      
      <div class="form-group">
      <label>Subject </label> 
      <input type="text" class="form-control" name="subject"  required="" placeholder="Subject">
      </div>
      
      <div class="form-group">
      <label>Message </label>   
      <textarea class="form-control" row='5' col='5' name="message" style="resize:none"></textarea>
      </div>

     <div class="text-center">
       <button name="submit" type="submit" class="btn btn-info del_btns replymodalbtn"> Send </button>
      </div>
        </form>
      <div class="clearfix"></div>
    </div>
  </div>
  </div>
</div>

@stop
