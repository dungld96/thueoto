
@extends('layout.client.client')
@section('content')
<div class="container content-change-pass">
	<div class="row">
		<div class="col-md-offset-3 col-md-6 col-sm-offset-3 col-sm-6">
			<div class="form_container">
				<form id="changePassForm" method="post">
                    {{csrf_field()}}
					<h2>Đổi mật khẩu</h2>
					<div class="form-group">
						<div class="input-group margin-top-m">
							<span class="input-group-addon"><i class="fas fa-lock"></i></span>
							<input type="password" name="current_password" class="form-control input-lg" placeholder="Mật khẩu hiện tại">
						</div>
						<div class="input-group margin-top-m">
							<span class="input-group-addon"><i class="fas fa-lock"></i></span>
                            <input id="password" type="password" name="password" class="form-control input-lg" placeholder="Mật khẩu mới" >
						</div>
						<div class="input-group margin-top-m">
							<span class="input-group-addon"><i class="fas fa-lock"></i></span>
                            <input type="password" name="password_confirm" class="form-control input-lg" placeholder="Xác nhận mật khẩu mới">
						</div>
					</div>
					<button type="submit" class="btn btn-success btn-lg btn-block">Cập nhật</button>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
