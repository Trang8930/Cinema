@extends('frontend.layouts.main')

@section('title', __('Reviews'))

@section('content')
<div class="full">
	<!-- <div class="main"> -->
		<div class="review-content">
			<div class="top-header span_top">
				<div class="logo">
					<a href="/"><img src="{{ asset('fe_images/logo.png') }}" alt="" /></a>
					<p style="font-size:3em;">CINEMA</p>
				</div>
				<div class="search v-search">
					<form>
						<input type="text" value="Search.." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search..';}"/>
						<input type="submit" value="">
					</form>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="reviews-section">
				<h3 class="head detail-css">Reviews</h3>
					<div class="col-md-9 reviews-grids">
						@foreach ($films as $film)
						<div class="review">
							<div class="movie-pic">
								<a href="{{ route('videos.show', $film->id) }}"><img src="{{ asset('fe_images/'. $film->image) }}" alt="" /></a>
							</div>
							<div class="review-info">
								<h3 class="span"><b style="font-family:Cerebri Sans,sans-serif; font-size:2em;">{{$film->name}}</b> &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i style="border-radius:8px; background-color:red; color:white; padding:10px;">{{$film->year}}</i></h3>
								<div class="clearfix"></div>
								<div class="yrw">
									<div class="rtm text-center">
										<a href="{{ route('videos.show', $film->id) }}">REVIEW THIS MOVIE</a>
									</div>
									<div class="clearfix"></div>
								</div>
								<p class="info" style="font-size: 2em;">Diễn viên:&nbsp;&nbsp;{{$film->actor}}</p>
								<p class="info" style="font-size: 2em;">Đạo diễn: &nbsp;&nbsp;{{$film->author}}</p>
								<p class="info" style="font-size: 2em;">Thể loại:;&nbsp;&nbsp; {{$film->genre}}</p>
								<p class="info" style="font-size: 2em;">Thời lượng:&nbsp; &nbsp; {{$film->time_limit}} minutes</p>
							</div>
							<div class="clearfix"></div>
						</div>
						@endforeach
						{{$films->links()}}
					</div>
					<div class="col-md-3 side-bar">
							<div class="entertainment">
								<h3>Top tháng</h3>
								@foreach($topFilms as $topFilm)
								<ul>
									<li class="ent">
										<a href="{{ route('videos.show', $topFilm->id) }}"><img src="{{ asset('fe_images/'.$topFilm->image) }}" alt="" /></a>
									</li>
									<li style="font-size: 2em;">
										<a href="{{ route('videos.show', $topFilm->id) }}">{{ $topFilm->name }}</a>
									
									</li>
									<div class="clearfix"></div>
								</ul>
								@endforeach
							</div>
			
							</div>
			
							<div class="clearfix"></div>
						</div>
					</div>
					<div class="review-slider">
						 <ul id="flexiselDemo1">
								@foreach ($filmsNew as $filmNew)
								<li><img src="{{ asset('fe_images/'.$filmNew->image)}}" alt="" class="img-click" data-id="{{ $filmNew->id}}"/></li>
								@endforeach	
						</ul>
					</div>	
@endsection
@section("script")
<script type="text/javascript" src="{{asset('fe_js/jquery.flexisel.js')}}"></script>	
<script type="text/javascript">
$(window).load(function() {
			
    $("#flexiselDemo1").flexisel({
        visibleItems: 6,
        animationSpeed: 1000,
        autoPlay: true,
        autoPlaySpeed: 3000,    		
        pauseOnHover: false,
        enableResponsiveBreakpoints: true,
        responsiveBreakpoints: { 
            portrait: { 
                changePoint:480,
                visibleItems: 2
            }, 
            landscape: { 
                changePoint:640,
                visibleItems: 3
            },
            tablet: { 
                changePoint:768,
                visibleItems: 3
            }
        }
    });
});
</script>
@endsection
