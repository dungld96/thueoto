
@extends('layout.client.client')
@section('title', 'Thuê xe sân bay Nội Bài, xe tự lái giá rẻ')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-offset-3 col-md-6 col-sm-offset-3 col-sm-6">
			<div class="form_container" id="signupContainer">
				<form id="signup_form" method="post">
                    {{csrf_field()}}
					<h2>Đăng ký tài khoản</h2>
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon"><i class="fas fa-phone-alt fa-fw"></i></span>
							<input type="text" name="phone_number" class="form-control input-lg" placeholder="Điện thoại hoặc email">
						</div>
					</div>
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon"><i class="fas fa-user fa-fw"></i></span>
							<input type="text" name="name" class="form-control input-lg" placeholder="Tên hiển thị">
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 form-group">
							<input type="password" name="password" class="form-control input-lg" placeholder="Mật khẩu" >
						</div>
						<div class="col-md-6 form-group">
							<input type="password" name="password_confirm" class="form-control input-lg" placeholder="Xác nhận mật khẩu">
						</div>
					</div>
					<button type="submit" class="btn btn-success btn-lg btn-block">Đăng ký</button>
				</form>
				<hr>
				<div class="row login-social">
					<p>Hoặc đăng nhập bằng tài khoản</p>
					<div class="col-md-6 form-group">
						<a type="button" href="{{ route('login.facebook')}}" target="_blank" class="btn btn-primary btn-lg" id="loginFb"><i class="fab fa-facebook-f"></i> Facebook</a>
					</div>
					<div class="col-md-6 form-group">
						<a type="button" href="{{ route('login.google')}}" target="_blank" class="btn btn-danger btn-lg" id="loginGg"><i class="fab fa-google"></i> Google</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
