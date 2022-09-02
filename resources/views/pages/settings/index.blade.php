@extends('newlayout.app')

@section('content_header')
<div class="row mb-2">
	<div class="col-sm-6">
	<h1>Dashboard Header</h1>
	</div>
	<div class="col-sm-6">
	<ol class="breadcrumb float-sm-right">
		<li class="breadcrumb-item"><a href="{{ route('home')}}">Home</a></li>
		<li class="breadcrumb-item active">Dashboard Header</li>
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
	@if ($message = Session::get('error'))
	<div class="alert alert-danger">
		<ul class="margin-bottom-none padding-left-lg">
			<li>{{ $message }} </li>
		</ul>
	</div>
	@endif
	<div class="card">
		<div class="card-header">
			<div class="pull-left">
				General Settings
	        </div>
	        <div class="pull-right">
			
	        </div>
        </div>

		<div class="card-body">
			<table class="table table-bordered table-sm" id="datatable">
				<thead>
					<tr class="text-center">
						<th>Theme Color</th>
						<th>Logo</th>
                        <th>Language</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					
				@foreach ($general_settings as $value)				
				<tr>
					<td>{{ $value->theme_color }}</td>
					<td><image src="{{ url('/') }}/images/logo/{{ $value->logo }}" style="height: 50px; width: 50px;" /></td>
					<td>{{ $value->language }}</td>
					<td class="text-center">
						<a class="btn btn-primary btn-sm" href="{{ url('/general-settings',$value->id) }}"  title="Edit"><i class="fas fa-edit"></i></a>
					</td>
				</tr>
				@endforeach
				</tbody>
			</table>
		</div>
	</div>

@endsection
@section('css')
@endsection
@section('js')

@endsection
