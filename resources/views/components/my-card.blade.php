
<div class="col-3">
     <div id="card_{{ $type }}" class="card shadow my-card my-card-{{$type}}">
         <div class="card-body">
             <div class="row no-gutters align-items-center">
             <div class="col mr-2">
                 <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><strong>{{$title}}</strong></div>
                 <div class="h3 mb-0 font-weight-bold">
                    <strong id="card_value_{{ $type }}">{{$value}}</strong>
                </div>
             </div>
             <div class="col-auto">
                 <i class="fas fa-{{$icon}} fa-4x"></i>
             </div>
             </div>
         </div>
     </div>
</div>


