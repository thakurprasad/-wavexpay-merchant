{{-- extend layout --}}
@extends('layouts.admin')

{{-- page title --}}
@section('title','Customers')

@section('content_header')
<div class="row mb-2">
	<div class="col-sm-6">
	<h1>Dashboard</h1>
	</div>
	<div class="col-sm-6">

	</div>
</div>
@endsection

{{-- page content --}}
@section('content')

    <div class="card">
		<div class="card-header">
			<div class="pull-left">

	        </div>
	        <div class="pull-right">

	        </div>
        </div>

		<div class="card-body">

            <br/>


		</div>
	</div>



@endsection


@section('page-style')
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
@endsection
@section('page-script')
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

@endsection
