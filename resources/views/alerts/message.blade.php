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


<div class="col s12 m12 my-1">

@if ($errors->any())

      <div class="card alert alert-danger alert-dismissible fade show" role="alert">
      <p> <strong>Error! </strong> There were some problems with your input.</p>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
@endif


      @if(session()->has('news'))

        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <strong>News: </strong> {{ session()->get('news') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

      @endif

      @if(session()->has('info'))

        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <strong>Info: </strong> {{ session()->get('info') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
      @endif

      @if(session()->has('success'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success:</strong> {{ session()->get('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
      @endif

      @if(session()->has('error'))

        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error:</strong> {{ session()->get('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
      @endif
    @if(session()->get('warning'))
     <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Warning:</strong> {{ session()->get('warning') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @endif  
</div>