{{-- extend layout --}}
@extends('layouts.contentLayoutMaster-Datatable')

{{-- page title --}}
@section('title','Page Collapse')

{{-- page content --}}
@section('content')

@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif


<div class="section section-data-tables">

  <!-- Page Length Options -->
  <div class="row">
    <div class="col s12">
      <div class="card">
        <div class="card-content">
          <h4 class="card-title">Users</h4>
          <div class="row">
            <div class="col s12">
              <table id="page-length-option" class="display">
                <thead>
                  <tr>
                      <th>No</th>
                     <th>Name</th>
                     <th width="280px">Action</th>
                  </tr>
                </thead>
                <tbody>
                     @foreach ($roles as $key => $role)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $role->name }}</td>
                        <td>

      <a href="{{ route('roles.show',$role->id) }}" class="mb-6 btn-floating waves-effect waves-light purple lightrn-1"><i class="material-icons left">remove_red_eye</i></a>
       @can('role-edit')
      <a href="{{ route('roles.edit',$role->id) }}" class="mb-6 btn-floating waves-effect waves-light cyan"><i class="material-icons left">edit</i></a>
        @endcan                   
@can('role-delete')
    {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id ],'style'=>'display:inline']) !!}        
      <button class="mb-6 btn-floating waves-effect waves-light red lightrn-1">
        <i class="material-icons left">delete_sweep</i>
      </button>
    {!! Form::close() !!}
@endcan
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th width="280px">Action</th>
                  </tr>
                </tfoot>
              </table>


{!! $roles->render() !!}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Scroll - vertical, dynamic height -->

  </div>


  </div>
</div>
@endsection