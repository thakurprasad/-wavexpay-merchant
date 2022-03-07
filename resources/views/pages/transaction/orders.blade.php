{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Orders')

{{-- page content --}}
@section('content')
<div class="section">
    <div class="card">
        <div class="card-content">
            <p class="caption mb-0">
                <div class="row">
                    <form class="col s12" method="POST" action="<?php url('/') ?>/transactions/searchorder">
                        @csrf
                        <div class="row">
                            <div class="input-field col s3">
                                <input placeholder="Order Id" name="order_id" id="order_id" type="text" class="validate">
                                <label for="first_name">Order Id</label>
                            </div>
                            <div class="input-field col s3">
                                <input placeholder="Reciept" name="reciept" id="reciept" type="text" class="validate">
                                <label for="first_name">Reciept</label>
                            </div>
                            <div class="input-field col s3">
                                <input placeholder="Notes" id="notes" name="notes" type="text" class="validate">
                                <label for="last_name">Notes</label>
                            </div>
                            <div class="input-field col s3">
                                <select name="status">
                                <option value="" disabled selected>Choose your option</option>
                                <option value="created">Created</option>
                                <option value="accepted">Accepted</option>
                                <option value="paid">Paid</option>
                                </select>
                                <label>Status</label>
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
                        <th scope="col">Order Id</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Attempts</th>
                        <th scope="col">Receipt</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>250</td>
                            <td>0</td>
                            <td>fsTMXX5zk6PSanoRvMPk</td>
                            <td>25th sept, 2022</td>
                            <td>
                                <a class="waves-effect waves-light btn-small">Accepted</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </p>
        </div>
    </div>
</div>
@endsection