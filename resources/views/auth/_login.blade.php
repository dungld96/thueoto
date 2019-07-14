        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">×</button>
        </div>
        <div class="modal-body">
            <div class="form_container">
                <form id="login_form">
                    {{csrf_field()}}
                    <h2>Đăng nhập</h2>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fas fa-phone-alt fa-fw"></i></span>
                            <input type="text" name="email" class="form-control input-lg" placeholder="Điện thoại hoặc email"  autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fas fa-user fa-fw"></i></span>
                            <input type="password" name="password" class="form-control input-lg" placeholder="Mật khẩu" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" id="btnSubmitLogin" class="btn btn-success btn-lg btn-block">Đăng nhập</button>
                    </div>
                    <div class="form-group">
                        <span class="text-muted">Bạn chưa là thành viên?</span>
                    <a href="{{route('user.signup')}}">Hãy đăng ký ngay!</a>
                    </div>
                </form>
            </div>
        </div>
<script src="{{asset('js/client/login.js')}}" type="text/javascript"></script>
