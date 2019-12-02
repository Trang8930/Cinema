@extends('master')
@section('content')
<div class="container mt-5">
	<div class="row">
		@foreach ($blog as $b)
			<div class="col-sm-9">
			<h2>{{$b->tieude}}</h2>
			<div class="mt-5">
				@php
					echo $b->noidung;
				@endphp
			</div>
		</div>
		@endforeach
		
	</div>
</div>
@endsection