{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Batch')

{{-- page content --}}
@section('content')
<div class="section">
    <div class="card">
        <div class="card-content">
            <p class="caption mb-0">
                <div class="row">
                    <form class="col s12" method="POST" action="<?php url('/') ?>/transactions/searchbatch">
                        @csrf
                        <div class="row">
                            <div class="input-field col s3">
                                <input placeholder="Batch Upload Id" name="batch_upload_id" id="batch_upload_id" type="text" class="validate">
                                <label for="first_name">Batch Upload Id</label>
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
                        <th scope="col">Batch Id</th>
                        <th scope="col">Count</th>
                        <th scope="col">Status</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>250</td>
                            <td>Active</td>
                            <td>25th sept, 2022</td>
                            <td>
                                <a class="waves-effect waves-light btn-small">Edit</a>
                            </td>
                        </tr>
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