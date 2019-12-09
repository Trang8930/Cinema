<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <base href="{{ asset('') }}">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ADMIN</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="all,follow">
  <!-- Bootstrap CSS-->
  <link rel="stylesheet" href="/admin_assets/vendor/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome CSS-->
  <link rel="stylesheet" href="/fontawesome/css/all.css">
  <!-- orion icons-->
  <link rel="stylesheet" href="/admin_assets/css/orionicons.css">
  <!-- theme stylesheet-->
  <link rel="stylesheet" href="/admin_assets/css/style.default.css" id="theme-stylesheet">
  <!-- Custom stylesheet - for your changes-->
  <link rel="stylesheet" href="/admin_assets/css/custom.css">
  <link rel="stylesheet" href="/admin_assets/css/style.css">
  <!-- Favicon-->
  <link rel="shortcut icon" href="/admin_assets/img/favicon.png?3">
  <script src="/admin_assets/vendor/jquery/jquery.min.js"></script>

</head>
<body>
  <!-- navbar-->
  <header class="header">
    <nav class="navbar navbar-expand-lg px-4 py-2 bg-white shadow"><div class="sidebar-toggler text-gray-500 mr-4 mr-lg-5 lead" style="cursor: pointer;"><i class="fas fa-align-left"></i></div><a href="{{url('admin')}}" class="navbar-brand font-weight-bold text-uppercase text-base">ADMIN Dashboard</a>
      <ul class="ml-auto d-flex align-items-center list-unstyled mb-0">
        <li class="nav-item">
          <form id="searchForm" class="ml-auto d-none d-lg-block">
            <div class="form-group position-relative mb-0">
              <button type="submit" style="top: -3px; left: 0;" class="position-absolute bg-white border-0 p-0"><i class="o-search-magnify-1 text-gray text-lg"></i></button>
              <input type="search" placeholder="Search ..." class="form-control form-control-sm border-0 no-shadow pl-4">
            </div>
          </form>
        </li>
        @if (Auth::check())
        <li class="nav-item dropdown ml-auto"><a id="userInfo" href="http://example.com" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle"><img src="/admin_assets/img/avatar-6.jpg" alt="Jason Doe" style="max-width: 2.5rem;" class="img-fluid rounded-circle shadow"></a>
          <div aria-labelledby="userInfo" class="dropdown-menu"><a href="#" class="dropdown-item"><strong class="d-block text-uppercase headings-font-family">{{Auth::user()->name}}</strong><small>Web Developer</small></a>
            <div class="dropdown-divider"></div><a href="{{url('/')}}" class="dropdown-item">Trang chủ</a>
            <div class="dropdown-divider"></div><a href="{{url('dangxuat')}}" class="dropdown-item">Logout</a>
          </div>
        </li>
        @else
          {{-- false expr --}}
        @endif
        
      </ul>
    </nav>
  </header>
  <div class="d-flex align-items-stretch">
    <div id="sidebar" class="sidebar py-3">
      <div class="text-gray-400 text-uppercase px-3 px-lg-4 py-4 font-weight-bold small headings-font-family">MAIN</div>
      <ul class="sidebar-menu list-unstyled">
        <li class="sidebar-list-item"><a href="{{url('admin')}}" class="sidebar-link text-dark"><i class="o-home-1 mr-3 text-gray"></i><span>Home</span></a></li>
        <li class="sidebar-list-item"><a href="{{url('admin/qlyphim')}}" class="sidebar-link text-dark"><i class="o-table-content-1 mr-3 text-gray"></i><span>Quản Lý Phim</span></a></li>
        <li class="sidebar-list-item"><a href="{{url('admin/qlyve')}}" class="sidebar-link text-dark"><i class="o-table-content-1 mr-3 text-gray"></i><span>Quản Lý Vé</span></a></li>
        <li class="sidebar-list-item"><a href="{{url('admin/qlytintuc')}}" class="sidebar-link text-dark"><i class="o-survey-1 mr-3 text-gray"></i><span>Quản Lý Tin Tức</span></a></li>
        <li class="sidebar-list-item"><a href="{{url('admin/qlylichchieu')}}" class="sidebar-link text-dark"><i class="o-survey-1 mr-3 text-gray"></i><span>Quản Lý Lịch Chiếu</span></a></li>
        <li class="sidebar-list-item"><a href="{{url('admin/qlyrap')}}" class="sidebar-link text-dark"><i class="o-survey-1 mr-3 text-gray"></i><span>Quản Lý Rạp</span></a></li>
        <li class="sidebar-list-item"><a href="{{url('admin/qlyphong')}}" class="sidebar-link text-dark"><i class="o-survey-1 mr-3 text-gray"></i><span>Quản Lý Phòng</span></a></li>
        <li class="sidebar-list-item"><a href="{{url('admin/qlyghe')}}" class="sidebar-link text-dark"><i class="o-survey-1 mr-3 text-gray"></i><span>Quản Lý Ghế</span></a></li>
        <li class="sidebar-list-item"><a href="{{url('admin/qlycombo')}}" class="sidebar-link text-dark"><i class="o-survey-1 mr-3 text-gray"></i><span>Quản Lý Combo</span></a></li>
        <li class="sidebar-list-item"><a href="{{url('admin/users')}}" class="sidebar-link text-dark"><i class="o-survey-1 mr-3 text-gray"></i><span>Quản Lý User</span></a></li>
      </ul>

    </div>
    @section('content')
    @show
  </div>
  <!-- JavaScript files-->
  <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
  <script src="/ckfinder/ckfinder.js"></script>
 {{--  <script>CKFinder.config( { connectorPath: '/ckfinder/connector' } );</script> --}}
  <script>
    CKEDITOR.replace( 'noidungtt',{
    filebrowserBrowseUrl: "{{asset('/ckfinder/ckfinder.html')}}",
    filebrowserUploadUrl: "{{asset('/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files')}}"});
  </script>
  <script>
    CKEDITOR.replace( 'ttrap',{
    filebrowserBrowseUrl: "{{asset('/ckfinder/ckfinder.html')}}",
    filebrowserUploadUrl: "{{asset('/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files')}}"});
  </script>
  
  
  <script src="/admin_assets/vendor/popper.js/umd/popper.min.js"> </script>
  <script src="/admin_assets/vendor/bootstrap/js/bootstrap.min.js"></script>
  <script src="/admin_assets/vendor/jquery.cookie/jquery.cookie.js"> </script>
  {{-- <script src="/admin_assets/vendor/chart.js/Chart.min.js"></script> --}}
  <script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
  <script src="/admin_assets/js/charts-home.js"></script>
  <script src="/admin_assets/js/front.js"></script>
  <script src="/js/adminjs.js"></script>
</body>
</html>