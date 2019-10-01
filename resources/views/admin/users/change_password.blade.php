@extends('layout.admin.admin')
@section('title', 'Đổi mật khẩu')
@section('content')
    <div class="row content-header">
        <div class="col-md-8">
            <h3 class="page-title">
                    Đổi mật khẩu
            </h3>
        </div>
        <div class="col-md-4">
           
        </div>
    </div>
	<div class="row">
        <div class="form-admin-change-password col-md-6">
                <form class="form-horizontal" id="adChangePwForm">
                        {{csrf_field()}}

                        <div class="form-group">
                            <label class="col-md-3 control-label">Mật khẩu cũ <span class="required">* </span></label>
                            <div class="col-md-9">
                                <div class="input-icon right">
                                    <input type="password" class="form-control input-medium" name="current_password" placeholder="Mật khẩu cũ"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Mật khẩu mới<span class="required">* </span></label>
                            <div class="col-md-9">
                                <div class="input-icon right">
                                    <input id="password" type="password" class="form-control input-medium" name="password" placeholder="Mật khẩu mới"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Nhập lại mật khẩu mới<span class="required">* </span></label>
                            <div class="col-md-9">
                                <div class="input-icon right">
                                    <input type="password" class="form-control input-medium" name="password_confirm" placeholder="Nhập lại mật khẩu mới"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <a type="button" href="{{route('dashboard')}}" class="btn">Hủy</a>
                            <button type="submit" class="btn btn-primary">Lưu</button>
                        </div>
        </form>
        </div>
    </div>
   
@endsection

@section('script-admin-custom')
<script src="{{asset('js/admin/ad-change-password.js')}}" type="text/javascript"></script>
@endsection
