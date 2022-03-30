{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Invoices')

{{-- page content --}}
@section('content')
<div class="section">
    <div class="card">
        <div class="card-content">
            <p class="caption mb-0">
                <table id="myTable">
                    <thead>
                        <tr>
                            <th scope="col">Api Title</th>
                            <th scope="col">Api Key</th>
                            <th scope="col">Created At</th>
                        </tr>
                    </thead>
                    <tbody id="table_container">
                        @if(!empty($res['data']))
                        @foreach($res['data'] as $keys)
                        <tr>
                            <th scope="row">{{$keys['api_title']}}</th>
                            <td>{{$keys['api_key']}}</td>
                            <td>{{date('Y-m-d',strtotime($keys['created_at']))}}</td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </p>
        </div>
    </div>
</div>
@endsection


@section('page-style')
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
@endsection
@section('page-script')
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready( function () {
    $('#myTable').DataTable({
        "searching": false
    });
} );



</script>
@endsection