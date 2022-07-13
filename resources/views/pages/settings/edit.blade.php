@extends('layouts.admin')
@section('content_header')
<div class="row mb-2">
	<div class="col-sm-6">
	<h1>General Setting</h1>
	</div>
	<div class="col-sm-6">
	<ol class="breadcrumb float-sm-right">
		<li class="breadcrumb-item"><a href="{{ route('home')}}">Home</a></li>
		<li class="breadcrumb-item"><a href="#">Setting</a></li>
        <li class="breadcrumb-item"><a href="#">General Setting</a></li>
		<li class="breadcrumb-item active">Edit</li>
	</ol>
	</div>
</div>
@endsection
@section('content')
	@if ($message = Session::get('success'))
	<div class="alert alert-success">
		<ul class="margin-bottom-none padding-left-lg">
			<li>{{ $message }}</li>
		</ul>
	</div>
	@endif
    @if ($errors->any())
	<div class="alert alert-danger">
		<strong>Whoops!</strong> There were some problems with your input.<br><br>
		<ul>
		@foreach ($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
		</ul>
	</div>
	@endif
	<div class="card">
		<div class="card-header">
			<div class="pull-left">
                <h5>Edit General Settings</h5>
	        </div>
        </div>

		<div class="card-body">
        <form method="post" action="{{ url('updategeneralsetting', $general_settings->id) }}" enctype="multipart/form-data">
        @csrf
		
        <div class="row">
			<div class="col-md-4">
                <div class="form-group">
					<label for="state_name">Theme Color</label>
					<input type="color" class="form-control" name="theme_color" id="theme_color" required value="{{ $general_settings->theme_color }}"/>
				</div>
            </div>
			<div class="col-md-2">
			</div>
            <div class="col-md-6">
                <div class="form-group">
					<label for="country_id">logo</label><br>
					<image src="{{ url('/') }}/images/logo/{{ $general_settings->logo }}" style="height: 50px; width: 50px;" />
					<input type="file" name="logo" id="logo" />
				</div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <button type="submit" class="btn btn-primary">Update</button>
                <a class="btn btn-warning" href="{{ route('general-settings') }}"> Back</a>
            </div>
		</div>
        </form>
	</div>
@endsection
