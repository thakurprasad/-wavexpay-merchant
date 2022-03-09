{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Settlement')

{{-- page content --}}
@section('content')
<div class="section">
    <div class="card">
        <div class="card-content">
            <p class="caption mb-0">
                <div class="row">
                    <form class="col s12" method="POST" action="<?php url('/') ?>/searchsettlements">
                        @csrf
                        <div class="row">
                            <div class="input-field col s3">
                                <input placeholder="Payment ID" name="settlement_id" id="settlement_id" type="text" class="validate">
                                <label for="first_name">Settlement Id</label>
                            </div>
                            
                            <div class="input-field col s3">                          
                                <button class="btn waves-effect waves-light" type="submit" name="action">Submit
                                    <i class="material-icons right">send</i>
                                </button>
                            </div>
        
                        </div>
                    </form>
                </div>
                <table id="myTable">
                    <thead>
                        
                        <tr>
                        <th scope="col">Settlement Id</th>
                        <th scope="col">Fees</th>
                        <th scope="col">Tax</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!empty($all_settlements->items))
                        @foreach($all_settlements->items as $settlement)
                        <tr>
                            <th scope="row">{{$settlement->id}}</th>
                            <td>{{number_format($settlement->fees/100,2)}}</td>
                            <td>{{number_format($settlement->tax/100,2)}}</td></td>
                            <td>{{date('Y-m-d',$settlement->created_at)}}</td>
                            <td>
                                <a class="waves-effect waves-light btn-small">{{$settlement->status}}</a>
                                <a class="waves-effect waves-light btn-flat">Breakup</a>
                            </td>
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