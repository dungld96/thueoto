<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <h4 class="modal-title">Thêm người kiểm duyệt</h4>
</div>
<div class="modal-body">
    <div class="form-body">
                <form class="form-horizontal" role="form" id="adUserForm">
                    {{csrf_field()}}
                    @if (isset($user->id))
                    <input type="hidden" name="id" value="{{old('id', $user->id)}}"/>
                    @endif
                        <div class="form-group">
                            <label class="col-md-3 control-label">Tên hiển thị <span class="required">
                        * </span></label>
                            <div class="col-md-9">
                                <div class="input-icon right">
                                    <i class="fa"></i>
                                    <input type="text" class="form-control input-medium" name="name" 
                                    placeholder="Tên hiển thị" value="{{old('name', $user->name)}}"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Email<span class="required">
                        * </span></label>
                            <div class="col-md-9">
                                <div class="input-icon right">
                                    <i class="fa"></i>
                                    <input type="text" class="form-control input-medium" name="email" 
                                    placeholder="Email" value="{{old('email', $user->email)}}"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Số điện thoại<span class="required">
                        * </span></label>
                            <div class="col-md-9">
                                <div class="input-icon right">
                                    <i class="fa"></i>
                                    <input type="text" class="form-control input-medium" name="phone_number" 
                                    placeholder="Số điện thoại" value="{{old('phone_number', $user->phone_number)}}"/>
                                </div>
                            </div>
                        </div>
                </form>
    </div>
</div>
<div class="modal-footer">
    <button type="button" data-dismiss="modal" class="btn">Hủy</button>
    @if (isset($user->id))
    <button type="button" id="btnUpdateUser" class="btn green">Lưu</button>
    @else
    <button type="button" id="btnAddUser" class="btn green">Thêm</button>
    @endif
</div>
<script src="{{asset('js/admin/user_edit.js')}}" type="text/javascript"></script>
