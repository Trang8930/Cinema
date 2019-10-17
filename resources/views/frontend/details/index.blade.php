@extends('frontend.layouts.main')

@section('title', __('Film Detail'))

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
<div class="single-content">
	<div class="reviews-section">
		<h3 class="head detail-css">Thông tin chi tiết</h3>
			<div class="col-md-9 reviews-grids">
				<div class="review">
					<div class="movie-pic">
						<a href="#"><img src="{{ asset('fe_images/'. $film->image) }}" alt="" /></a>
					</div>
					<div class="review-info">
						<h3><b style="font-family:Cerebri Sans,sans-serif; font-size:2em;">{{$film->name}}</b> &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i style="border-radius:8px; background-color:red; color:white; padding:10px;">{{$film->year}}</i></h3>
						<div class="clearfix"></div>
						<div class="yrw">
							<div id="small-dialog" class="mfp-hide">
								<iframe  src="https://www.youtube.com/embed/{{ $film->video_url}}" frameborder="0" allowfullscreen style="width:400px; height:300px"></iframe>
							</div>
							
							<!-- <div class="clearfix"></div> -->
						</div>
						<p class="info" style="font-size: 2em;">Diễn viên:&nbsp;&nbsp;{{$film->actor}}</p>
						<p class="info" style="font-size: 2em;">Đạo diễn: &nbsp;&nbsp;{{$film->author}}</p>
						<p class="info" style="font-size: 2em;">Thể loại:;&nbsp;&nbsp; {{$film->genre}}</p>
						<p class="info" style="font-size: 2em;">Thời lượng:&nbsp; &nbsp; {{$film->time_limit}} minutes</p>
						
						@include("frontend.details.partials.booking-ticket")
						<a href="#booking-ticket" class="book book-ticket" data-toggle="modal" style="width:35%"><i class="book book-ticket"></i>Đặt vé</a>
					</div>
					<div class="clearfix"></div>
				</div>
				<br> <br>
				<div class="story-review" style="font-size: 2em;
				font-family: Cerebri Sans,sans-serif;">
					<h4>Chi tiết:</h4>
					<p>{{$film->content}}</p>
				</div>
							<!-- comments-section-starts -->
	    <div class="comments-section">
	        <div class="comments-section-head">
				<div class="comments-section-head-text" style="font-size: 2em;
				font-family: Cerebri Sans,sans-serif;">
					<h3>{{count($comments)}} Bình luận</h3>
				</div>
				<div class="clearfix"></div>
		    </div>
			<div class="comments-section-grids" id="comment-section">
				@foreach ($comments as $comment)
				<div class="comments-section-grid">
					<div class="col-md-2 comments-section-grid-image">
						<img src="{{ $comment->user->image ? '/'.$comment->user->image : '/no-image.png' }}" class="img-responsive" alt="" />
					</div>
					<div class="col-md-10 comments-section-grid-text">
						<h4><a href="#">{{$comment->user->fullname}}</a></h4>
						@if(\Auth::check())
							@if (\Auth::user()->role == 1 || \Auth::user()->id == $comment->user_id)
								<button type="button" class="pull-right glyphicon glyphicon-pencil edit-comment" id="edit-comment-{{$comment->id}}" data-id="{{$comment->id}}" data-content="{{ $comment->content }}"></button>
								<button type="button" class="pull-right glyphicon glyphicon-trash delete-comment" id="delete-comment-{{$comment->id}}" data-id="{{$comment->id}}"></button>
							@endif
						@endif
						<label>{{date_format($comment->updated_at, 'd/m/Y')}} at {{date_format($comment->updated_at, 'H:i')}}</label>
						<p id="comment-{{$comment->id}}">{{$comment->content}}</p>
					</div>
					<div class="clearfix"></div>
				</div>
				@endforeach
			</div>
			{{ $comments->links() }}
	    </div>
	  <!-- comments-section-ends -->
		  <div class="reply-section">
			  <div class="reply-section-head">
				  <div class="reply-section-head-text">
					  <h3>Bình luận</h3>
				  </div>
			  </div> 
			<div class="blog-form">
				<input type="text" class="create-comment" value="" placeholder="{{!\Auth::check() ? 'Bạn phải đăng nhập để bình luận' : 'Nhập bình luận'}}" user-img="{{ \Auth::check() ? \Auth::user()->image ? \Auth::user()->image : 'no-image.png' : ''}}" fullname="{{ \Auth::check() ? \Auth::user()->fullname : ''}}" {{ \Auth::check() ? '' :'disabled'}} user-id="{{  \Auth::check() ? Auth::user()->id : ''}}">
			 </div>
		  </div>
		  </div>
			<div class="col-md-3 side-bar">
				<div class="entertainment">
					<h3>Top tháng</h3>
					@foreach($films as $film)
					<ul>
						<li class="ent">
							<a href="{{ route('videos.show', $film->id) }}"><img src="{{ asset('fe_images/'.$film->image) }}" alt="" /></a>
						</li>
						<li style="font-size: 2em;">
							<a href="{{ route('videos.show', $film->id) }}">{{ $film->name }}</a>
						
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
                    visibleItems: 1
                }, 
                landscape: { 
                    changePoint:640,
                    visibleItems: 2
                },
                tablet: { 
                    changePoint:768,
                    visibleItems: 3
                }
            }
        });
        });
</script>
<script type="text/javascript" src="{{asset('fe_js/jquery.flexisel.js')}}"></script>	

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
<script src="{{ asset('fe_js/comment.js') }}"></script>	
<script>
	$(".img-click").click(function(){
		$filmID = $(this).attr("data-id")
		window.location="/videos/" + $filmID
	});
</script>
@endsection

