@extends('master')
@section('title','Tin tức')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-sm-8 col-xs-12">
            @foreach($tintuc as $tin)
            <div class="movieofmonth item-post clearfix">
                <div class="item-thumb float-left">
                    <a href="blog/{{$tin->id}}" class="has-overlay">
                        <img src="/anhda4/tintuc/{{$tin->image}}" class="loading-img">
                    </a>
                </div>
                <div class="float-right content">
                    <h5>
                    <a href="blog/{{$tin->id}}">{{$tin->tieude}}</a>
                    </h5>
                    <div class="text-content hidden-xs">
                        <p>
                            {!!substr($tin->noidung,0,250)!!}...
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
            <div>
                {{$tintuc->links()}}
            </div>
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