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
                        <tr>
                            <th scope="row">1</th>
                            <td>250</td>
                            <td>123</td>
                            <td>25th sept, 2022</td>
                            <td>
                                <a class="waves-effect waves-light btn-small">Active</a>
                                <a class="waves-effect waves-light btn-flat">Breakup</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </p>
        </div>
    </div>
</div>
@endsection