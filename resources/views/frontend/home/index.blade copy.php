@extends('frontend.layouts.main')

@section('title', __('Trang chủ'))

@section('content')
<div class="header">
	<div class="top-header">
		<div class="logo">
			<a href="/"><img src="{{ asset('fe_images/logo.png')}}" alt="" /></a>
			<p style="font-size: 3em;">CINEMA</p>
		</div>
		@include("frontend.layouts.partials.login-register")
		<div class="clearfix"></div>
	</div>
	<div class="header-info">
		<h1>{{$films->first()->name}}</h1>
		<p class="age"><a href="#">Đạo diễn</a> {{$films->first()->author}}</p>
		<p class="review reviewgo">Thể loại	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : &nbsp;&nbsp; {{$films->first()->genre}}</p>
		<p class="review">Công chiếu &nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;&nbsp; {{$films->first()->year}}</p>
		<p class="special">{{$films->first()->content}}</p>
		{{-- <a class="video" href="#"><i class="video1"></i>WATCH TRAILER</a> --}}
		<a class="book" href="{{ route('videos.show', $films->first()->id) }}"><i class="book1"></i>Đặt vé</a>
	</div>
</div>
<div class="review-slider">
	<ul id="flexiselDemo1">
		@foreach ($films as $film)
		<li><img src="{{ asset('fe_images/'.$film->image)}}" alt="" class="img-click" data-id="{{ $film->id}}"/></li>
		@endforeach
	</ul>

</div>
<div class="video">
	<iframe  src="https://www.youtube.com/embed/{{$films->first()->video_url}}" frameborder="0" allowfullscreen></iframe>
</div>
<div class="news">
	<div class="col-md-6 news-left-grid">
		<h3>Đừng bỏ lỡ,</h3>
		<h2>Đặt vé ngay hôm nay!</h2>
		<h4>Dễ dàng, đơn giản & nhanh gọn.</h4>
		<a href="{{ route('videos.show', $films->first()->id) }}"><i class="book"></i>Đặt vé</a>
		<p>Khuyến mãi <strong>10%</strong> nếu bạn là thành viên!</p>
	</div>
	<div class="col-md-6 news-right-grid">
		<h3>Tin tức</h3>
		@foreach ($news as $film)
		<div class="news-grid">
			<h5>{{ $film->name }}</h5>
			<label>{{ $film->year }}</label>
			<p>{{ $film->content }}</p>
		</div>
		@endforeach
	</div>
	<div class="clearfix"></div>
</div>
<div class="more-reviews">
	<ul id="flexiselDemo2">
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
				visibleItems: 4
			}
		}
	});
	});
</script>

<script type="text/javascript">
$(window).load(function() {
	
	$("#flexiselDemo2").flexisel({
		visibleItems: 4,
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
<script>
	$(".img-click").click(function(){
		$filmID = $(this).attr("data-id")
		window.location="/videos/" + $filmID
	});
</script>
@endsection
