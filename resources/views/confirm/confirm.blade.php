@extends('frontend.layouts.main')

@section('content')
<div class="error-404">
    <div class="error-code m-b-10 m-t-20 text-danger">Please check your mail to confirm registation <i class="fa fa-warning"></i></div>
    <div class="error-desc">
        <div><br/>
            <!-- <a class=" login-detail-panel-button btn" href="http://vultus.de/"> -->
            <a href="/" class="btn btn-primary"><span class="glyphicon glyphicon-home"></span> Quay lại trang chủ</a>
        </div>
    </div>
</div>
<style>
.error-404 {
  margin: 0 auto;
  text-align: center;
  min-height: 550px;
}
.error-404 .error-code {
  bottom: 60%;
  color: red;
  font-size: 30px;
  line-height: 100px;
  font-weight: bold;
}
.error-404 .error-desc {
  font-size: 12px;
  color: #647788;
}
.error-404 .m-b-10 {
  margin-bottom: 10px!important;
}
.error-404 .m-b-20 {
  margin-bottom: 20px!important;
}
.error-404 .m-t-20 {
  margin-top: 20px!important;
}
</style>
@endsection
