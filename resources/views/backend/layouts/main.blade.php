<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{__('Admin') }} | @yield('title')</title>
  <meta name="csrf_token" content="{{ csrf_token() }}">
  <link rel="shortcut icon" href="{{ asset("favicon.png") }}">
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"> 
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  @include ('backend.layouts.partials.css')
</head>
<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <!-- start header -->
    @include('backend.layouts.partials.header')
    <!-- end header -->

    <!-- start css -->
    @yield('css')
    <!-- end css -->

    <!-- start left-bar -->
    @include ('backend.layouts.partials.left-bar')
    <!-- end left-bar -->

    <!-- start content -->
    @yield('content')
    <!-- end content -->

    <!-- start footer -->
    @include('backend.layouts.partials.footer')
    <!-- end footer -->

    <!-- start js -->
    @include('backend.layouts.partials.script')
    <!-- end js -->
  </div>
<script>
   var $baseURL = "{{ url('') }}";
</script>
    <!-- start content -->
    @yield('script')
    <!-- end content -->
</body>
</html>
