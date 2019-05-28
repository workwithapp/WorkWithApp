@extends('adminpages/inner_template')
@section('main')
<div class="row">
	<div class="col-xs-12">
    <div class="col-xs-12 col-sm-12 widget-container-col" id="widget-container-col-6">
			<div class="widget-box widget-color-dark light-border" id="widget-box-6">
				<div class="widget-header">
						<h5 class="widget-title smaller">Reason</h5>
			
				</div>
        		<div class="widget-body">
								<div class="widget-main padding-6">
									<div class="alert alert-info"> {{$data->reasons}}</div>
								</div>
						</div>
			</div>
		</div>
	</div><!-- /.span -->
</div><!-- /.row -->
@stop
