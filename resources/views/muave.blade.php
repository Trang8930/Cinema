@extends('master')
@section('title','Lịch chiếu phim các rạp')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="tab-movies-line">
                <h3>Chọn phim</h3>
                <div class="tab-content">
                    <div class="row tab_showmovie">
                        <div class="col-md-4">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">Chọn phim</h4>
                                </div>
                                <ul class="list-group">
                                    @foreach($phimdc as $phim)
                                    <li class="clear-fix item-phim" id="{{$phim->id}}">
                                        <div class="float-left show-img">
                                            <img src="/anhda4/phim/{{$phim->image}}" alt="">
                                        </div>
                                        <div class="float-right show-name">
                                            <p>{{$phim->tenphim}}</p>
                                            <p style="color: #a0a3a7;">{{$phim->tentienganh}}</p>
                                        </div>
                                    </li>
                                    @endforeach()
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">Chọn rạp</h4>
                                </div>
                                <ul class="list-group" id="dsrap">
                                    
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">Chọn suất</h4>
                                </div>
                                <ul class="list-group" id="dssuat">
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
@section('scr')
<script src="/js/muave.js"></script>
@endsection