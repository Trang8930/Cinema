@extends('master')
@section('content')
<div class="container mt-5">
	<div class="row">
		@foreach ($review as $r)
			<div class="col-sm-9">
			<h2>{{$r->tieude}}</h2>
			<div class="mt-5">
				@php
					echo $r->noidung;
				@endphp
			</div>
		</div>
		@endforeach
		
	</div>
</div>
@endsection