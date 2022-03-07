{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Refunds')

{{-- page content --}}
@section('content')
<div class="section">
    <div class="card">
        <div class="card-content">
            <p class="caption mb-0">
                <div class="row">
                    <form class="col s12" method="POST" action="{{ url('/') }}/transactions/searchrefunds">
                        @csrf
                        <div class="row">
                        <div class="input-field col s2">
                                <input placeholder="Refund ID" name="refund_id" id="refund_id" type="text" class="validate">
                                <label for="first_name">Refund Id</label>
                            </div>
                            <div class="input-field col s3">
                                <input placeholder="Payment ID" name="payment_id" id="payment_id" type="text" class="validate">
                                <label for="first_name">Payment Id</label>
                            </div>
                            <div class="input-field col s3">
                                <select name="status">
                                <option value="" disabled selected>Choose your option</option>
                                <option value="processed">Processed</option>
                                <option value="processing">Processing</option>
                                <option value="failed">Failed</option>
                                </select>
                                <label>Status</label>
                            </div>
                            <div class="input-field col s3">
                                <input placeholder="Notes" id="notes" name="notes" type="text" class="validate">
                                <label for="last_name">Notes</label>
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
                        <th scope="col">Refund Id</th>
                        <th scope="col">Payment Id</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <th scope="row">1</th>
                            <td>250</td>
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