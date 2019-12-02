<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
	<a href="/" class="navbar-brand p-0"><img src="/anhda4/logo/logo4.png" alt="" width="150px" height="40px"></a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="menu">
		<ul class="navbar-nav m-auto">
			<li class="nav-item dropdown pl-5">
				<a href="/" class="nav-link dropdown-toggle" id="menu2" data-toggle="dropdown">Phim</a>
				<div class="dropdown-menu">
					<a href="{{url('phimdangchieu')}}" class="dropdown-item">Phim đang chiếu</a>
					<a href="{{url('phimsapchieu')}}" class="dropdown-item">Phim sắp chiếu</a>
				</div>
			</li>
			<li class="nav-item pl-5">
				<a href="#" class="nav-link">Mua vé</a>
			</li>
			<li class="nav-item pl-5">
				<a href="#" class="nav-link">Tin Tức</a>
			</li>
			<li class="nav-item pl-5">
				<a href="#" class="nav-link">Rạp</a>
			</li>
			<li class="nav-item pl-5">
				<a href="#" class="nav-link">Hỗ Trợ</a>
			</li>
			<li class="nav-item pl-5">
				<a href="" class="nav-link">Liên Hệ</a>
			</li>
		</ul>
		@if (!Auth::check())
		<div class="dangki">
			<a href="{{ url('dangnhap') }}">Đăng Nhập</a>&nbsp;<span class="text-white">|</span>&nbsp;<a href="{{ url('dangky') }}">Đăng Ký</a>
		</div>
		@else
		<div class="dropdown">
			<span class="text-white dropdown-toggle mr-4" data-toggle="dropdown">{{Auth::user()->name}}</span>
			<div class="dropdown-menu">
				<a class="dropdown-item" href="/user">Profile</a>
				@if (Auth::user()->level==1)
					<a class="dropdown-item" href="{{url('admin')}}">Admin Quản lý</a>
				@else

				@endif
				<a class="dropdown-item" href="{{url('dangxuat')}}">Log out</a>
				
			</div>
		</div>
		@endif
		
	</div>
</nav>