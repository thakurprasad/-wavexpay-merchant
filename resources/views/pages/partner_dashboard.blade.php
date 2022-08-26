{{-- extend layout --}}
@extends('layouts.admin')

{{-- page title --}}
@section('title','Home')

@section('content_header')

@endsection

{{-- page content --}}
@section('content')
	
	

    <div class="card">
		<div class="card-header">
			<div class="pull-left">
				<label for="first_name"><strong>Partner Dashboard</strong><For></For></label>
				
	        </div>
        </div>

		<div class="card-body">			
			<div class="row">
				Partner Dashboard
			</div>
        </div>		
	</div>


	


@endsection


@section('page-style')
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />


@endsection
@section('page-script')
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.bundle.min.js'></script>
<script type="text/javascript">

</script>
@endsection
