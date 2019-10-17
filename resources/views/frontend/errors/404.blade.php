@extends('frontend.layouts.main')

@section('title', __('HomePage'))

@section('content')
<div class="header">
		<div class="error-content">
			<div class="top-header span_top">
				<div class="logo">
					<a href="/"><img src="{{ asset('fe_images/logo.png') }}" alt="" /></a>
					<p>Movie Theater</p>
				</div>
				<div class="search v-search">
					<form>
						<input type="text" value="Search.." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search..';}"/>
						<input type="submit" value="">
					</form>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="error-404 text-center">
				<h2>404</h2>
				<p>Sorry this was unexpected</p>
				<a class="b-home" href="{{ url('/') }}">Back to Home</a>
            </div>
        </div>	
</div>
@endsection