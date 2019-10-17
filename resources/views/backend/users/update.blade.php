@extends('backend.layouts.main')

@section('title', __('Update User'))

@section('content')
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <h1 class="title-page text-success">
        {{ __('Update User') }}
      </h1>
      <div class="row margin-center">
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title lead">{{ __('Update information') }}</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            @if (!empty($user))
            <form role="form" method="POST" action="{{ route('users.update', $user->access_token) }}" enctype='multipart/form-data'>
              {!! csrf_field() !!}
              @method('PUT')
              <div class="box-body">
                <div class="form-group has-feedback {{ $errors->has('username') ? ' has-error' : '' }}">
                  <label for="username">{{ __('Username') }}</label>
                  <input type="text" class="form-control" name= "username" id="username" value="{{ $user->username }}" disabled>
                  <small class="text-danger">{{ $errors->first('username') }}</small>
                </div>

                <div class="form-group has-feedback {{ $errors->has('password') ? ' has-error' : '' }}">
                  <label for="password">{{ __('Password') }}</label>
                  <input type="password" class="form-control" name= "password" id="password" placeholder="{{ __('Enter password') }}" >
                  <small class="text-danger">{{ $errors->first('password') }}</small>
                </div>

                <div class="form-group has-feedback {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                  <label for="password_confirmation">{{ __('Confirm password!') }}</label>
                  <input type="password" class="form-control" name= "password_confirmation" id="password_confirmation" placeholder="{{ __('Enter password') }}">
                  <small class="text-danger">{{ $errors->first('password_confirmation') }}</small>
                </div>

                <div class="form-group{{ $errors->has('fullname') ? ' has-error' : '' }}">
                  <label for="fullname">{{ __('Full name') }}</label>
                  <input type="text" class="form-control" name= "fullname" id="fullname" value="{{ old('fullname', $user->fullname) }}"> 
                  <small class="text-danger">{{ $errors->first('fullname') }}</small>
                </div>

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                  <label for="email">{{ __('Email') }}</label>
                  <input type="text" class="form-control" name= "email" id="email" data-toggle="tooltip" value="{{ $user->email }}" disabled>
                  <small class="text-danger">{{ $errors->first('email') }}</small>
                </div>
                <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                  <label for="image">{{ __('Image') }}</label>
                  <p id="show-img">
                    <img id="img-db" class="img-100-100" src="{{asset(!empty($user->image) ? $user->image : config('image.default_image'))}}" value="{{old('image', $user->image)}}">
                    <img id="img-local" class="img-100-100" src="">
                  </p>
                  <input type="file" class="form-control" name= "image" id="image" placeholder="{{ __('Enter Your Image') }}">
                  <small class="text-danger">{{ $errors->first('image') }}</small>
                </div>
                <div class="form-group{{ $errors->has('birthday') ? ' has-error' : '' }}">
                  <label for="birthday">{{ __('Birthday') }}</label>
                  <input type="date" class="form-control" name= "birthday" id="birthday" placeholder="{{ __('Enter Your birthday') }}" value="{{ old('birthday', $user->birthday) }}">
                  <small class="text-danger">{{ $errors->first('birthday') }}</small>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer" id="btn-back">
                <a href="{{ route('users.index') }}" class="btn btn-default">
                  {{ __('Back') }}
                </a>
                <button type="reset" class="btn btn-warning mr-10 btn-reset">{{ __('Reset') }}</button>
                <button type="submit" class="btn btn-primary mr-10 pull-right">{{ __('Submit') }}</button>
              </div>
            </form>
            @else 
            <h3>User is not Exist</h3>
            @endif
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection

@section('script')
<script src="{{asset('js/user.js')}}"></script>
@endsection
