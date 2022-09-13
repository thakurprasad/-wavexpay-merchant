@extends('newlayout.app')
@section('title','Payment Links')
@section('content_header')
<div class="row mb-2">
	<div class="col-sm-6">
	<h1>Affiliate Accounts</h1>
	</div>
	<div class="col-sm-6">
	<ol class="breadcrumb float-sm-right">
		<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
		<li class="breadcrumb-item active">Affiliate Accounts</li>
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
        <div class="card-body">
            <a href="#" data-toggle="modal" data-target="#modal1" onclick="create_referral_link()">Share Referral Link</a>
            &nbsp;&nbsp;
            <a class="btn btn-sm btn-primary" href="{{ url('/create-payment-links') }}">+Create Affiliate Accounts</a>
        </div>
        <form class="col s12" method="POST" id="search-form" action="<?php url('/') ?>/searchinvoice">
            @csrf
            <div class="card-body">
                <div class="row">                 
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="first_name">Account Name</label>
                            <input placeholder="Account Name" name="payment_link_id" id="payment_link_id" type="text" class="form-control">
                        </div>
                    </div>

                    
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="first_name">Account Id</label>
                            <input placeholder="Account Id" name="account_id" id="account_id" type="text" class="form-control">
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="first_name">Email Id</label>
                            <input placeholder="Email Id" name="email_id" id="email_id" type="text" class="form-control">
                        </div> 
                    </div>
                   
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="first_name">&nbsp;</label><br>
                            <button class="btn btn-sm btn-primary" type="button" name="action" onclick="reset_page()">Reset</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-responsive-sm" id="myTable">
                <thead>
                    <tr>
                    <th scope="col">Payment Link Id</th>
                    <th scope="col">Created Date</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Reference Id</th>
                    <th scope="col">Customer</th>
                    <th scope="col">Payment Links</th>
                    </tr>
                </thead>
                <tbody id="table_container">
                    
                </tbody>
            </table>
        </div>
    </div>

<div id="modal1" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="width: 600px;">
      <div class="modal-header">
        <h5 class="modal-title">Share Referral Link</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card">
            <div class="card-header">
                Wavexpay Payments
            </div>
            <div class="card-body">
                <h5 class="card-title">Referral Link</h5>
                <p class="card-text">Invites Affiliates to use Wavexpay Payments products to collect payment from their customer</p>
                <input type="text" readonly class="form-control" name="referral_link" id="referral_link">
                <br />
                <a href="#" class="btn btn-primary btn-sm">Copy</a>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>




@endsection

@section('page-style')
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
@endsection
@section('page-script')
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>
<script>
function create_referral_link()
{
    $.ajax({
        url: '{{route("create-referral-link")}}',
        type: "POST",
        headers: {
            'X-CSRF-Token': '{{ csrf_token() }}',
        },
        success: function(data){
            var link = '{{ url('/') }}'+'/register-as-partner?ref='+data.link_text;
            alert(link);
            $("#referral_link").val(link);
        }
    });
}
</script>
@endsection