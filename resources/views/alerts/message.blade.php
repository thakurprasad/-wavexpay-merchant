<?php /*
 @if (count($errors) > 0)
    <div class="alert alert-danger">
      <strong>Whoops!</strong> There were some problems with your input.<br><br>
      <ul>
         @foreach ($errors->all() as $error)
           <li>{{ $error }}</li>
         @endforeach
      </ul>
    </div>
  @endif
*/ ?>


<div class="col s12 m12">

@if ($errors->any())
      <div class="card-alert card gradient-45deg-red-pink">
        <div class="card-content white-text">
          <p><i class="material-icons">error</i> <strong>Whoops! </strong> There were some problems with your input.</p> 
             <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
@endif


      @if(session()->has('news'))
        <div class="card-alert card gradient-45deg-purple-deep-orange">
          <div class="card-content white-text">
            <p><i class="material-icons">notifications</i> <strong>NEWS : </strong> {{ session()->get('news') }}</p>
          </div>
          <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
      @endif

      @if(session()->has('info'))
      <div class="card-alert card gradient-45deg-light-blue-cyan">
        <div class="card-content white-text">
          <p>
            <i class="material-icons">info_outline</i> <strong>INFO : </strong> {{ session()->get('info') }}</p>
        </div>
        <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      @endif

      @if(session()->has('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>SUCCESS!</strong> {{ session()->get('success') }}.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      @endif

      @if(session()->has('error'))
      <div class="card-alert card gradient-45deg-red-pink">
        <div class="card-content white-text">
          <p>
            <i class="material-icons">error</i> <strong>DANGER :</strong> {{ session()->get('error') }}</p>
        </div>
        <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      @endif

    @if(session()->has('warning'))
      <div class="card-alert card gradient-45deg-amber-amber">
        <div class="card-content white-text">
          <p>
            <i class="material-icons">warning</i> <strong>WARNING :</strong> {{ session()->get('warning') }}</p>
        </div>
        <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
    @endif  
</div>