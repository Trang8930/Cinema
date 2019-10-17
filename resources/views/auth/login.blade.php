@extends('frontend.layouts.main')
@section('content')
<?php
  $cities = \App\Models\City::get();
?>
<div class="login-container">
  <div class="tab-login-line">
    <ul class="nav nav-tabs">
      <li class="active"><a id="a_tab_login_1" href="#tab_login_1" data-toggle="tab" aria-expanded="true">Đăng nhập</a></li>
    </ul>
    <div class="row">
      <div class="col-md-12">
        <div class="tab-content">
          <div id="tab_login_1" class="tab-pane active">
            <div class="login-tab-wrapper">
              <div class="login-heading">
                <div class="text-heading"><!-- ngIf: !enableSkip -->
                  <span ng-if="!enableSkip" class="sub-text ng-scope">Vui lòng đăng nhập trước khi mua vé để tích luỹ điểm, cơ hội nhận thêm nhiều ưu đãi từ chương trình thành viên Galaxy Cinema.</span>
                  @if ($errors->has('username'))
                    <div class="alert alert-danger alert-dismissible" style="margin-top:10px">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>{{ $errors->first('username') }}</strong>
                    </div>
                  @endif
                </div>
              </div>
              <form method="POST" action="{{ route('login') }}" class="login-form ng-pristine ng-valid-email ng-invalid ng-invalid-required">
                <input placeholder="Tên đăng nhập" name="username" value="{{ old('username') }}" required="" class="login ng-pristine ng-untouched ng-empty ng-valid-email ng-invalid ng-invalid-required">
                <input placeholder="Mật khẩu" type="password" name="password" required="" class="login ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required">
                <div class="login-remember">
                  <div class="forget-pass">
                    <a id="forgetPass" href="" ng-click="closeModel()">Quên mật khẩu?</a>
                  </div>
                </div>
                <br>
                <button type="submit" class="btn primary input">
                  <i class="fa fa-pulse fa-spinner ng-hide"></i>Đăng nhập
                </button>
              </form>
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
