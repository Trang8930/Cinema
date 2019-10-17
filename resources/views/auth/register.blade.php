@extends('frontend.layouts.main')
@section('content')
<?php
  $cities = \App\Models\City::get();
?>
<div class="login-container">
  <div class="tab-login-line">
    <ul class="nav nav-tabs">
      <li class="active"><a id="a_tab_login_2" href="#tab_login_2" data-toggle="tab" aria-expanded="false">Đăng ký</a></li>
    </ul>
    <div class="row">
      <div class="col-md-12">
        <div class="tab-content">
          <div id="tab_login_2" class="tab-pane active">
            <div class="login-tab-wrapper">
              <div class="login-form">
                @if ($errors->any())
                  <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                  </div>
                @endif
                <form method="POST" action="{{ route('register') }}" enctype='multipart/form-data' class="ng-pristine ng-invalid ng-invalid-required ng-valid-maxlength ng-valid-email">
                  <input placeholder="Họ tên" name="fullname" value="{{ old('fullname') }}" required="" class="login first ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required" >
                  <input type="email" placeholder="Email" name="email" value="{{ old('email') }}" required="" class="login ng-pristine ng-untouched ng-empty ng-valid-email ng-invalid ng-invalid-required">
                  <input placeholder="Tên đăng nhập" name="username" value="{{ old('username') }}" required="" class="login ng-pristine ng-untouched ng-empty ng-valid-email ng-invalid ng-invalid-required">
                  <div class="row city">
                    <div class="col-md-6 col-sm-6 col-xs-6 first-col">
                      <input type="password" name="password" placeholder="Mật khẩu" required="" class="login ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required">
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6 second-col">
                      <input type="password" name="password_confirmation" placeholder="Xác nhận mật khẩu" required="" class="login ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required">
                    </div>
                  </div>
                  <div class="row birthday-signup">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <galaxy-select class="ng-pristine ng-untouched ng-valid ng-isolate-scope ng-not-empty">
                        <a class="btn btn-select login location">
                          <span class="btn-select-value ng-binding">Chọn thành phố</span>
                          <span class="btn-select-arrow"></span>
                          <select class="ng-pristine ng-untouched ng-valid ng-not-empty" name="city_id">
                            @foreach ($cities as $city)
                              <option value="{{$city->id}}" {{ (old('city_id') == $city->id) ? 'selected' : '' }}>{{$city->name}}</option>
                            @endforeach
                          </select>
                        </a>
                      </galaxy-select>
                    </div>
                  </div>
                  <input type="date" name="birthday" class="form-control" placeholder="Chọn ngày (dd/mm/yyyy)" style="border-radius: 0px" value="{{ old('birthday') }}">
                  <br>
                  <input type="file" name="image" class="form-control" style="border-radius: 0px">
                  <br>
                  <p class="text-confirm-signup">Tôi đã đọc và đồng ý với&nbsp;<a data-toggle="modal" data-target="#popupPolicies"><b>CHÍNH SÁCH&nbsp;</b></a>của chương trình.&nbsp;</p>
                  <br>
                  <button class="btn primary input" type="submit">
                    Đăng ký
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

<style>
  .login-container {
    margin: auto;
    width: 600px;
    padding: 10px;
    min-height:550px;
    margin-top: 50px;
  }
  .form-control {
    border-radius: 0px;
  }
</style>
