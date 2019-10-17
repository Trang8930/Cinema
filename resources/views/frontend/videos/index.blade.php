@extends('frontend.layouts.main')

@section('title', __('Videos'))

@section('css')
<link href="{{asset('fe_css/popuo-box.css')}}" rel="stylesheet" type="text/css" media="all" />
@endsection

@section('content')
<div class="header">
	<div class="top-header">
		<div class="logo">
			<a href="{{ route('homepage') }}"><img src="{{ asset('fe_images/logo.png')}}" alt="" /></a>
			<p style="font-size:3em;">CINEMA</p>
		</div>
		@include("frontend.layouts.partials.login-register")
		<div class="clearfix"></div>
	</div>
</div>

<br> <br>
<div class="content-grids">
	@foreach ($videos as $video)
		<div id="small-dialog-{{ $video->id }}" class="mfp-hide video-dialog">
			<iframe  src="https://www.youtube.com/embed/{{ $video->video_url }}" frameborder="0" allowfullscreen></iframe>
		</div>
		<div class="content-grid">
			<a href="/videos/{{$video->id}}"><img src="{{ asset('fe_images/'. $video->image) }}" title="allbum-name"/></a>
			<h3 style="font-size:12px; font-weight:bold; color:red">{{ $video->name }}</h3>
			<a class="button play-icon popup-with-zoom-anim" href="#small-dialog-{{ $video->id }}">Xem Trailer</a>
		</div>
	@endforeach
	<div class="clearfix"> </div>
	{{ $videos->links() }}
	<div class="clearfix"> </div>
</div>
@endsection
@section("script")
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<script src="{{asset('fe_js/jquery.magnific-popup.js')}}" type="text/javascript"></script>
<script>
	$(document).ready(function() {
		$('.popup-with-zoom-anim').magnificPopup({
			type: 'inline',
			fixedContentPos: false,
			fixedBgPos: true,
			overflowY: 'auto',
			closeBtnInside: true,
			preloader: false,
			midClick: true,
			removalDelay: 300,
			mainClass: 'my-mfp-zoom-in'
		});
	});
</script>		
@endsection