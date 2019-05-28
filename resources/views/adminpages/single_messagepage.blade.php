@extends('adminpages/inner_template')
@section('main')
<div class="row">
	<div class="col-xs-12">
    <div class="col-xs-12 col-sm-12 widget-container-col" id="widget-container-col-6">
			<div class="widget-box widget-color-dark light-border" id="widget-box-6">
				<div class="widget-header">
						<h5 class="widget-title smaller">Message</h5>
						<div class="widget-toolbar">
							 <a class="edit_button_reply"  data-id="<?php echo $data->id;?>" data-name="<?php echo $data->email; ?>"  data-toggle="modal" data-target="#myModal" class="btn btn-info"><span class="badge badge-danger">Reply</span></a>
						</div>
				</div>
        		<div class="widget-body">
								<div class="widget-main padding-6">
									<div class="alert alert-info"> {{$data->message}}</div>
								</div>
						</div>
			</div>
		</div>
	</div><!-- /.span -->
</div><!-- /.row -->


<!--*****  Modal  *****-->
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
