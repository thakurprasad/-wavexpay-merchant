@extends('newlayout.app')
@section('page-style')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<link href="{{ url('/') }}/dashboard-signup/css/style.css" rel="stylesheet" type="text/css"/>
<link href="{{ url('/css/my-card.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
<div class="container-fluid"> 
    <x-notification/> 
       
    <div class="row">
        <x-my-card type="1" title="New Order" value="102" icon="calendar" />
        <x-my-card type="2" title="Total Payments Amount" value="542" icon="dollar-sign" />
        <x-my-card type="3" title="Success Rate" value="982" icon="clipboard-list" />
        <x-my-card type="4" title="Total Transactions" value="1008" icon="chart-area" />
    </div>
@endsection
