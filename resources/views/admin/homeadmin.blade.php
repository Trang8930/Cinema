@extends('admin.layout')
@section('content')
<div class="page-holder w-100 d-flex flex-wrap">
  <div class="container-fluid px-xl-5">
    <section class="py-5">
      <div class="row">
        <div class="col-xl-3 col-lg-6 mb-4 mb-xl-0">
          <div class="bg-white shadow roundy p-4 h-100 d-flex align-items-center justify-content-between">
            <div class="flex-grow-1 d-flex align-items-center">
              <div class="dot mr-3 bg-violet"></div>
              <div class="text">
                <h6 class="mb-0">Phim Đang Chiếu</h6><span class="text-gray">{{$phimdc}}</span>
              </div>
            </div>
            <div class="icon text-white bg-violet"><i class="fas fa-film"></i></div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-6 mb-4 mb-xl-0">
          <div class="bg-white shadow roundy p-4 h-100 d-flex align-items-center justify-content-between">
            <div class="flex-grow-1 d-flex align-items-center">
              <div class="dot mr-3 bg-green"></div>
              <div class="text">
                <h6 class="mb-0">Phim Sắp Chiếu</h6><span class="text-gray">{{$phimsc}}</span>
              </div>
            </div>
            <div class="icon text-white bg-green"><i class="fas fa-film"></i></div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-6 mb-4 mb-xl-0">
          <div class="bg-white shadow roundy p-4 h-100 d-flex align-items-center justify-content-between">
            <div class="flex-grow-1 d-flex align-items-center">
              <div class="dot mr-3 bg-blue"></div>
              <div class="text">
                <h6 class="mb-0">Tin Tức</h6><span class="text-gray">{{$tintuc}}</span>
              </div>
            </div>
            <div class="icon text-white bg-blue"><i class="fa fa-dolly-flatbed"></i></div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-6 mb-4 mb-xl-0">
          <div class="bg-white shadow roundy p-4 h-100 d-flex align-items-center justify-content-between">
            <div class="flex-grow-1 d-flex align-items-center">
              <div class="dot mr-3 bg-red"></div>
              <div class="text">
                <h6 class="mb-0">Thành Viên</h6><span class="text-gray">{{$thanhvien}}</span>
              </div>
            </div>
            <div class="icon text-white bg-red"><i class="fas fa-receipt"></i></div>
          </div>
        </div>
      </div>
    </section>
    <section>
      <div class="row mb-4">
        <div class="col-lg-10 mb-4 mb-lg-0">
          <div class="card">
            <div class="card-header">
              <h2 class="h6 text-uppercase mb-0">Thống Kê số lượng vé đã bán theo phim</h2>
            </div>
            <div class="card-body">
              <table class="table">
                <tr>
                  <th>STT</th>
                  <th>Tên Phim</th>
                  <th>SL vé đã bán</th>
                </tr>
                @php
                  $stt=0;
                  if (isset($_GET['page'])) {
                    $a=$_GET['page'];
                  }
                  else{
                    $a=1;
                  }
                  $stt=($a-1)*10;
                  @endphp
                @foreach ($lichchieu as $l)
                @php
                  $stt++;
                  @endphp  
                <tr>
                  <td>{{$stt}}</td>
                  <td>{{$l->phim->tenphim}}</td>
                  <td>{{$l->id_rap}}</td>
                </tr>
                @endforeach
                
              </table>
              {{ $lichchieu->links()}}
            </div>
          </div>
        </div>
        {{-- <div class="col-lg-5 mb-4 mb-lg-0 pl-lg-0">
          <div class="card mb-3">
            <div class="card-body">
              <div class="row align-items-center flex-row">
                <div class="col-lg-5">
                  <h2 class="mb-0 d-flex align-items-center"><span>86.4</span><span class="dot bg-green d-inline-block ml-3"></span></h2><span class="text-muted text-uppercase small">Work hours</span>
                  <hr><small class="text-muted">Lorem ipsum dolor sit</small>
                </div>
                <div class="col-lg-7">
                  <canvas id="pieChartHome1"></canvas>
                </div>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-body">
              <div class="row align-items-center flex-row">
                <div class="col-lg-5">
                  <h2 class="mb-0 d-flex align-items-center"><span>1.724</span><span class="dot bg-violet d-inline-block ml-3"></span></h2><span class="text-muted text-uppercase small">Server time</span>
                  <hr><small class="text-muted">Lorem ipsum dolor sit</small>
                </div>
                <div class="col-lg-7">
                  <canvas id="pieChartHome2"></canvas>
                </div>
              </div>
            </div>
          </div>
        </div> --}}
      </div>
    </section>
  </div>
</div>
@endsection
