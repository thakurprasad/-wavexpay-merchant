{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Page Collapse')

{{-- vendor style --}}
@section('vendor-style')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/flag-icon/css/flag-icon.min.css')}}">
@endsection

{{-- page content --}}
@section('content')

<div class="section">
     <!-- Form with icon prefixes -->


     <div class="col s12 m12 l12">
      <div id="prefixes" class="card card card-default scrollspy">
        <div class="card-content">
          <h4 class="card-title">Create New User</h4>
          
        {!! Form::open(array('route' => 'users.store','method'=>'POST')) !!}

        @include('alerts.message')
  
            <div class="row">

              <div class="input-field col m4 s6">
                <i class="material-icons prefix">account_circle</i>
               {!! Form::text('name', null, array('class' => 'form-control validate')) !!}
                <label for="name">Name</label>
                 @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror 
              </div>
            
              <div class="input-field col m4 s6">
                <i class="material-icons prefix">email</i>
                 {!! Form::text('email', null, array('class' => 'form-control validate')) !!}
                 <label for="email">Email</label>
              </div>
          
              <div class="input-field col m4 s6">
                <i class="material-icons prefix">lock</i>
                  {!! Form::password('password', array('class' => 'form-control')) !!}
                <label for="password">Password</label>
              </div>
           
             <div class="input-field col m4 s6">
                <i class="material-icons prefix">lock</i>
                  {!! Form::password('confirm-password', array('class' => 'form-control')) !!}
                <label for="confirm-password">Confirm Password</label>
              </div>

              <div class="input-field col m4 s6">
                <i class="material-icons prefix">vpn_key</i>
                    {!! Form::select('roles[]', $roles,[], array('class' => 'form-control','multiple')) !!}
                <label for="confirm-password">Select Role</label>
              </div>


              <div class="input-field col m4 s6">
                <i class="material-icons prefix">account_circle</i>
                    {!! Form::select('type', Helper::getUserTypes(),null, array('class' => 'form-control')) !!}
                <label for="confirm-password">Select Type</label>
              </div>
              

              <div class="row">
                <div class="input-field col s12">
                  <button class="btn cyan waves-effect waves-light right" type="submit" name="action">Submit
                    <i class="material-icons right">send</i>
                  </button>
                </div>
              </div>
            </div>
          
{!! Form::close() !!}
        </div>
      </div>
    </div>

</div> 

@endsection