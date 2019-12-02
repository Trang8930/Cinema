@extends('master')
@section('content')
<div class="container">
	<h3 class="pdc mt-5" style="text-transform: uppercase;">Phim Sắp Chiếu</h3>
	<div class="row">
		@foreach ($phimsc as $psc)
		<div class="col-md-3 mt-4">
			<div class="moviedangchieu">
				<img src="/anhda4/phim/{{$psc->image}}" width="100%" height="350px">
				<a href="{{url('phim',$psc->id)}}">
					<div class="decription-hover overlay">
						<div class="decription-content">
							<button class="btn btn-outline-danger">MUA VÉ</button>
						</div>
					</div>
				</a>
			</div>
			<div class="tieudephimdc mt-2">
				<h5 class="text-uppercase ">{{$psc->tenphim}}</h5>
				<h6 class="text-uppercase ">{{$psc->tentienganh}}</h6>
			</div>
		</div>
		@endforeach
	</div>
</div>
@endsection