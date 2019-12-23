@extends('master')
@section('title','Liên hệ')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-sm-8 col-xs-12">
            <h2>Bạn có gì muốn nhắn nhủ?</h2>
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            @if(Session::has('msg'))
            <div class="alert alert-success">
                {{Session::get('msg')}}
            </div>
            @endif
            <form action="{{route('postLienHe')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <input type="text" class="form-control" placeholder="Họ tên" name="ho_ten">
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <input type="text" class="form-control" placeholder="Email" name="email">
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <input type="text" class="form-control" placeholder="Số điện thoại" name="sdt">
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <textarea rows="10" placeholder="Nội dung" class="w-100 mt-5" name="noi_dung" style="border: 1px solid #ddd;"></textarea>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                        <button type="submit" class="btn btn-primary">Gửi</button>
                    </div>
                </div>

            </form>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-12">
            <section id="movieSidebar" class="hidden-xs">
                <h3>Phim đang chiếu</h3>
                @foreach($phimdc as $pdc)
                <div class="row movies-group">
                    <div class="col-md-13 col-sm-12 col-xs-12 movie-item">
                        <div class="moviedangchieu">
                            <img src="/anhda4/phim/{{$pdc->image}}" width="100%" height="300px">
                            <a href="{{url('phim',$pdc->id)}}">
                                <div class="decription-hover overlay">
                                    <div class="decription-content">
                                        <button class="btn btn-outline-danger">MUA VÉ</button>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="tieudephimdc mt-2">
                            <h6 class="text-uppercase mb-0">{{$pdc->tenphim}}</h6>
                            <h6 class="text-uppercase en">{{$pdc->tentienganh}}</h6>
                        </div>
                    </div>
                </div>
                @endforeach
        </div>
    </div>
</div>
@endsection