@extends('.login.header')
@section('content')
<div class="container-login100" style="background-image: url('public/admin_assets/images/bg-01.jpg');">
		<div class="wrap-login100 p-l-55 p-r-55 p-t-80 p-b-30">
			<form class="login100-form validate-form" action="{{url('dangky')}}" method="post">
				{{csrf_field()}}
				<span class="login100-form-title p-b-37">
					Sign up
				</span>

				<div class="wrap-input100 validate-input m-b-20"
				data-validate = "Enter Your Name">
					<input class="input100" type="text" name="name" placeholder="name">
					<span class="focus-input100"></span>
				</div>
				<div class="wrap-input100 validate-input m-b-20"
				data-validate = "Enter Email">
					<input class="input100" type="text" name="email" placeholder="email">
					<span class="focus-input100"></span>
				</div>

				<div class="wrap-input100 validate-input m-b-25" data-validate = "Enter password">
					<input class="input100" type="password" name="pass" placeholder="password">
					<span class="focus-input100"></span>
				</div>
				<div class="wrap-input100 validate-input m-b-25" data-validate = "Enter Re-password">
					<input class="input100" type="password" name="repass" placeholder="Re-password">
					<span class="focus-input100"></span>
				</div>

				<div class="container-login100-form-btn">
					<button type="submit" class="login100-form-btn">
						Sign Up
					</button>
				</div>
			</form>

			
		</div>
	</div>
@endsection