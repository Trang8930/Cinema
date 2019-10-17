@extends('backend.layouts.main')

@section('title', __('HomePage'))

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        {{ __('Dashboard') }}
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('home.index')}}"><i class="fa fa-dashboard"></i>{{__('Home')}}</a></li>
        <li class="active">{{ __('Dashboard') }}</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{ getCount(App\Models\City::class) }}</h3>

              <p>{{__('Cities')}}</p>
            </div>
            <div class="icon">
              <i class="ion ion-map"></i>
            </div>
            <a href="{{route('cities.index')}}" class="small-box-footer">{{__('More info')}} <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{ getCount(App\Models\Cinema::class) }}</h3>

              <p>{{__('Cinemas')}}</p>
            </div>
            <div class="icon">
              <i class="ion ion-android-home"></i>
            </div>
            <a href="{{route('cinemas.index')}}" class="small-box-footer">{{__('More info')}} <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <h3>{{ getCount(App\Models\Film::class) }}</h3>

              <p>{{__('Films')}}</p>
            </div>
            <div class="icon">
              <i class="ion ion-videocamera"></i>
            </div>
            <a href="{{route('films.index')}}" class="small-box-footer">{{__('More info')}} <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-purple">
            <div class="inner">
              <h3>{{ getCount(App\Models\Room::class) }}</h3>

              <p>{{__('Rooms')}}</p>
            </div>
            <div class="icon">
              <i class="ion  ion-easel"></i>
            </div>
            <a href="{{route('rooms.index')}}" class="small-box-footer">{{__('More info')}} <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->

        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{ getCount(App\Models\User::class) }}</h3>

              <p>{{__('Users')}}</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="{{route('users.index')}}" class="small-box-footer">{{__('More info')}} <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-fuchsia">
              <div class="inner">
                <h3>{{ getCount(App\Models\Schedule::class) }}</h3>
  
                <p>{{__('Schedule')}}</p>
              </div>
              <div class="icon">
                <i class="ion ion-calendar"></i>
              </div>
              <a href="{{route('schedules.index')}}" class="small-box-footer">{{__('More info')}} <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection
