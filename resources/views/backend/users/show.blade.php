@extends('backend.layouts.main')

@section('title', __('Users'))

@section('content')

<link href='{{asset("css/user.css")}}' rel='stylesheet' type='text/css'>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h2>
        {{ __('User Information')  }}
      </h2>
      <ol class="breadcrumb">
        <li><a href="{{ route('home.index') }}"><i class="fa fa-dashboard"></i>{{ __('HomePage')  }}</a></li>
        <li class="active">{{ __('User Information') }}</li>
      </ol>
    </section>
      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              @if ($user != null)
              <div class="col-md-8  col-xs-12">
                  <img src="{{$user->image != null ? asset($user->image) : asset(config('image.default_image'))}}" class="user-info"/>
                  <div class="content-info">
                      <h1>{{$user->fullname}}</h1>
                      
                      @if ($user->role == \App\Models\User::IS_ADMIN)
                        @if ($user->id == \App\Models\User::ID_MASTER)
                          <b class="btn btn-primary">
                            Super Admin
                          </b>
                        @else
                        <b class="btn btn-success">
                            Admin
                          </b>
                        @endif
                      @else
                        <b class="btn btn-danger">
                          User
                        </b>
                      @endif 

                      @if ($user->is_active == \App\Models\User::IS_ACTIVE)
                          <b class="btn btn-warning">
                            Active
                          </b>
                      @else
                        <b class="btn btn-default">
                          Not
                        </b>
                      @endif 

                      <div>
                        <label>Username: </label>
                        <span>{{$user->username}}</span>
                      </div>
                      
                      <div>
                        <label>Email: </label>
                        <span>{{$user->email}}</span>
                      </div>

                      <div>
                        <label>Join date: </label>
                        <span>{{\Carbon\Carbon::parse($user->created_at)->format('d-m-Y')}}</span>
                      </div>
                  </div>
              </div> 
              @else 
              <h3>User is not exist</h3>  
              @endif
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
