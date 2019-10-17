@extends('backend.layouts.main')

@section('title', __('Users'))

@section("css")
<style>
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input {display:none;}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
@endsection

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        {{ __('List Users')  }}
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('home.index') }}"><i class="fa fa-dashboard"></i>{{ __('HomePage')  }}</a></li>
        <li class="active">{{ __('Users') }}</li>
      </ol>
    </section>
      <!-- Main content -->
      <section class="content">
        <input type="hidden" value="{{request()->has('check') ? request()->check : ''}}" id="show-message">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              {{-- Modal --}}
               @include('backend.users.partials.modal')
               @include('backend.layouts.partials.delete-modal')
             {{-- \Modal --}}

              <section>
                <div class="create-area">
                  <a href="{{route('users.create')}}" class="btn btn-primary glyphicon glyphicon-plus"></a>
                </div>
              </section>
             <div class="box-body">
              <table id="table-datatable" class="table table-bordered table-hover col-xs-12" data-table="users">
                <thead>
                  <tr>
                    <th>{{ __('ID') }}</th>
                    <th>{{ __('Username') }}</th>
                    <th>{{ __('Email') }}</th>
                    <th>{{ __('Fullname') }}</th>
                    <th>{{ __('Birthday') }}</th>
                    <th>{{ __('Image') }}</th>
                    <th>{{ __('City') }}</th>
                    @if (Auth::user()->role == App\Models\User::IS_ADMIN)
                    <th>{{ __('Is Active') }}</th>
                    <th>{{ __('Role') }}</th>
                    <th>{{ __('Option') }}</th>
                    @endif
                  </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td class="name"><a href="{{route('users.show', $user->access_token)}}">{{ $user->username }}</a></td>
                        <td><a href="{{route('users.show', $user->access_token)}}">{{ $user->email }}</a></td>
                        <td><a href="{{route('users.show', $user->access_token)}}">{{ $user->fullname }}</a></td>
                        <td>{{ \Carbon\Carbon::parse($user->birthday)->format('d-m-Y') }}</td>
                        <td class="text-center"><img style="width: 60px; height: 50px" {{$user->image ? $url = $user->image : $url = config('image.default_image')}} src="{{ asset($url) }}" alt=""></td>
                        <td>{{ $user->city->name }}</td>
                        <td class="text-center">
                          <label class="switch">
                            <input type="checkbox" 
                            class="btn-change-active"
                            data-token='{{$user->access_token}}' 
                            data-action="updateActive" 
                            {{$user->role == \App\Models\User::IS_ADMIN && \Auth::user()->id != \App\Models\User::IS_ADMIN ? 'disabled' : ''}}
                            {{ $user->is_active == \App\Models\User::IS_ACTIVE ? 'checked' : ''}}>
                            <span class="slider round" ></span>
                          </label>
                        </td>
                        <td class="text-center">
                          @if ($user->role == App\Models\User::IS_ADMIN)
                            <a href="#" id="role-{{$user->id}}" 
                              class="btn-change-admin btn btn-success"
                              data-title="{{__('Change Role')}}"
                              data-content="{{__('Do you want to change Role of <b>') . $user->fullname . '</b>'}}" 
                              data-token='{{$user->access_token}}' 
                              data-action="updateRole" 
                              {{$user->role == \App\Models\User::IS_ADMIN && \Auth::user()->id != \App\Models\User::IS_ADMIN ? 'disabled' : 'data-toggle=modal data-target=#confirmModal'}}>
                              Admin
                            </a>
                          @else
                            <a href="#" id="role-{{$user->id}}" 
                              class="btn-change-admin btn btn-danger"
                              data-title="{{__('Change Role')}}"
                              data-content="{{__('Do you want to change Role of <b>') . $user->fullname . '</b>'}}"
                              data-token='{{$user->access_token}}' 
                              data-action="updateRole" 
                              {{$user->role == \App\Models\User::IS_ADMIN && \Auth::user()->id != \App\Models\User::IS_ADMIN ? 'disabled' : 'data-toggle=modal data-target=#confirmModal'}}>
                              User
                            </a>
                          @endif                            
                        </td>
                    <td class="text-center col-sm-1">
                        <a href="{{ \Auth::user()->id != App\Models\User::ID_MASTER && $user->id == App\Models\User::ID_MASTER ? '#' : route('users.edit', $user->access_token) }}"
                          class="glyphicon glyphicon-pencil bg-green option"></a>

                        <form action="{{ route('users.destroy', $user->access_token) }}" method="POST" >
                            @method('DELETE')
                            @csrf

                            @if ($user->role == App\Models\User::IS_ADMIN && \Auth::user()->id == \App\Models\User::ID_MASTER
                             || $user->role == App\Models\User::IS_USER)
                            <button type="button"
                              class="glyphicon glyphicon-remove bg-purple option btn-delete"
                              id="btn-delete-{{$user->id}}"
                              data-title="{{__('Delete Account')}}"
                              data-content="{{__('Do you want to delete account <b>') . $user->fullname . '</b>'}}"
                              data-toggle="modal"
                              data-target="#confirmModalDelete">
                            </button>
                            @else
                            <button type="button"
                              class="glyphicon glyphicon-remove bg-gray option"
                              id="btn-delete-{{$user->id}}"
                              disabled>
                            </button>
                            @endif
                        </form>
                    </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
                <section>
                  <div class="create-area pull-right">
                    <a href="{{route('users.create')}}" class="btn btn-primary glyphicon glyphicon-plus"></a>
                  </div>
                </section>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  <!-- /.content-wrapper -->
@endsection

@section('script')
<script src="{{asset('js/user.js')}}"></script>
@endsection
