@extends('master')
@section('content')
<div class="container">
	<h3 class="pdc mt-5" style="text-transform: uppercase;">Phim Đang Chiếu</h3>
	<div class="row">
		@foreach ($phimdc as $pdc)
		<div class="col-md-3 mt-4">
			<div class="moviedangchieu">
				<img src="/anhda4/phim/{{$pdc->image}}" width="100%" height="350px">
				<a href="{{url('phim',$pdc->id)}}">
					<div class="decription-hover overlay">
						<div class="decription-content">
							<button class="btn btn-outline-danger">MUA VÉ</button>
						</div>
					</div>
				</a>
			</div>
			<div class="tieudephimdc mt-2">
				<h5 class="text-uppercase ">{{$pdc->tenphim}}</h5>
				<h6 class="text-uppercase ">{{$pdc->tentienganh}}</h6>
			</div>
		</div>
		@endforeach
	</div>
</div>
@endsection