@extends("la.layouts.app")

@section("contentheader_title", "Configuration")
@section("contentheader_description", "")
@section("section", "Configuration")
@section("sub_section", "")
@section("htmlheader_title", "Configuration")

@section("headerElems")
@endsection

@section("main-content")

@if (count($errors) > 0)
	<div class="alert alert-danger">
		<ul>
			@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
@endif
<form action="{{route(config('laraadmin.adminRoute').'.la_configs.store')}}" method="POST">
	<!-- general form elements disabled -->
	<div class="box box-warning">
		<div class="box-header with-border">
			<h3 class="box-title">GUI Settings</h3>
		</div>
		<!-- /.box-header -->
		<div class="box-body">
			{{ csrf_field() }}
			<!-- text input -->
			<div class="form-group">
				<label>Sitename</label>
				<input type="text" class="form-control" placeholder="Lara" name="sitename" value="{{$configs->sitename}}">
			</div>
			<div class="form-group">
				<label>Sitename First Word</label>
				<input type="text" class="form-control" placeholder="Lara" name="sitename_part1" value="{{$configs->sitename_part1}}">
			</div>
			<div class="form-group">
				<label>Sitename Second Word</label>
				<input type="text" class="form-control" placeholder="Admin 1.0" name="sitename_part2" value="{{$configs->sitename_part2}}">
			</div>
			<div class="form-group">
				<label>Sitename Short (2/3 Characters)</label>
				<input type="text" class="form-control" placeholder="LA" maxlength="2" name="sitename_short" value="{{$configs->sitename_short}}">
			</div>
			<div class="form-group">
				<label>Site Description</label>
				<input type="text" class="form-control" placeholder="Description in 140 Characters" maxlength="140" name="site_description" value="{{$configs->site_description}}">
			</div>
			<!-- checkbox -->
			<div class="form-group">
				<div class="checkbox">
					<label>
						<input type="checkbox" name="sidebar_search" @if($configs->sidebar_search) checked @endif>
						Show Search Bar
					</label>
				</div>
				<div class="checkbox">
					<label>
						<input type="checkbox" name="show_messages" @if($configs->show_messages) checked @endif>
						Show Messages Icon
					</label>
				</div>
				<div class="checkbox">
					<label>
						<input type="checkbox" name="show_notifications" @if($configs->show_notifications) checked @endif>
						Show Notifications Icon
					</label>
				</div>
				<div class="checkbox">
					<label>
						<input type="checkbox" name="show_tasks" @if($configs->show_tasks) checked @endif>
						Show Tasks Icon
					</label>
				</div>
				<div class="checkbox">
					<label>
						<input type="checkbox" name="show_rightsidebar" @if($configs->show_rightsidebar) checked @endif>
						Show Right SideBar Icon
					</label>
				</div>
			</div>
			<!-- select -->
			<div class="form-group">
				<label>Skin Color</label>
				<select class="form-control" name="skin">
					@foreach($skins as $name=>$property)
						<option value="{{ $property }}" @if($configs->skin == $property) selected @endif>{{ $name }}</option>
					@endforeach
				</select>
			</div>
			
			<div class="form-group">
				<label>Layout</label>
				<select class="form-control" name="layout">
					@foreach($layouts as $name=>$property)
						<option value="{{ $property }}" @if($configs->layout == $property) selected @endif>{{ $name }}</option>
					@endforeach
				</select>
			</div>

			<div class="form-group">
				<label>Default Email Address</label>
				<input type="text" class="form-control" placeholder="To send emails to others via SMTP" maxlength="100" name="default_email" value="{{$configs->default_email}}">
			</div>
		</div><!-- /.box-body -->
		<div class="box-footer">
			<button type="submit" class="btn btn-primary">Save</button>
		</div><!-- /.box-footer -->
	</div><!-- /.box -->
</form>

@endsection

@push('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('la-assets/plugins/datatables/datatables.min.css') }}"/>
@endpush

@push('scripts')
<script src="{{ asset('la-assets/plugins/datatables/datatables.min.js') }}"></script>

@endpush
