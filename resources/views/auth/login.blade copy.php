@extends('frontend.layouts.main')

@section('title', __('Login'))

@section('content')
<div class="header">
	<div class="top-header">
		<div class="logo">
			<a href="/"><img src="{{ asset('fe_images/logo.png')}}" alt="" /></a>
			<p>CINEMA</p>
        </div>
        @include("frontend.layouts.partials.login-register")
		<div class="clearfix"></div>
	</div>
	<div class="header-info-form">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="color:white">{{ __('Đăng Nhập') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="username" class="col-sm-4 col-form-label text-md-right">{{ __('Tên đăng nhập') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autofocus>

                                @if ($errors->has('username'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Mật khẩu') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required minlength="6">

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-6">
                                <button type="submit" class="btn btn-success">
                                    Đăng Nhập
                                </button>
                            </div>
                            <div class="col-md-8 offset-md-4">
                                <a class="" href="{{ route('register') }}">
                                    Không có tài khoản?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
	</div>
</div>
@endsection
