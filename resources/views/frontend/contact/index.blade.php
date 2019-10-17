@extends('frontend.layouts.main')

@section('title', __('Contact'))

@section('content')
<div class="header">
	<div class="top-header">
		<div class="logo">
			<a href="/"><img src="{{ asset('fe_images/logo.png')}}" alt="" /></a>
			<p>Movie Theater</p>
		</div>
		@include("frontend.layouts.partials.login-register")
		<div class="search">
			<form>
				<input type="text" value="Search.." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search..';}"/>
				<input type="submit" value="">
			</form>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
<div class="main-contact">
    <input type="hidden" value="{{request()->has('check') ? request()->check : ''}}" id="show-message">
    <h3 class="head">{{__("CONTACT")}}</h3>
    <p>{{__("WE'RE ALWAYS HERE TO HELP YOU")}}</p>
    <div class="contact-form">
        <form method="POST" action="{{route('contact.store')}}">
            @csrf
            <div class="col-md-6 contact-left">
                <input type="text" placeholder="Name" name="name" required/>
                <input type="text" placeholder="E-mail" name="email" required/>
                <input type="text" placeholder="Phone" name="phone" required/>
            </div>
            <div class="col-md-6 contact-right">
                <textarea placeholder="Message" name="message"></textarea>
                <input type="submit" value="SEND"/>
            </div>
            <div class="clearfix"></div>
        </form>
    </div>
    <div class="contact_info">
        <h3>{{__("Find Us Here")}}</h3>
        <div class="map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3833.9836929035832!2d108.18493231485844!3d16.066335988882702!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31421901da0acdbf%3A0x6fea898ba4d1ac8d!2sGalaxy+Cinema!5e0!3m2!1sen!2s!4v1533625587536" width="100%" frameborder="0" style="border:0" allowfullscreen></iframe><br><small><a href="https://goo.gl/maps/HDac4kmGGfS2" style="color:#000;text-align:left;font-size:12px">View Larger Map</a></small>
    </div>
</div>
@endsection
