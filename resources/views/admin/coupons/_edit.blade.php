<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <h4 class="modal-title">Thêm Mã Giảm Giá</h4>
</div>
<div class="modal-body">
    <div class="form-body">
        <div class="infoCar">
                <form class="form-horizontal" role="form" id="couponForm">
                    {{csrf_field()}}
                    @if (isset($coupon->id))
                    <input type="hidden" name="id" value="{{old('id', $coupon->id)}}"/>
                    @endif
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="col-md-3 control-label">Mã coupon <span class="required">*</span></label>
                            <div class="col-md-9">
                                <div class="input-icon right">
                                    <i class="fa"></i>
                                    <input type="text" class="form-control input-full" name="code" 
                                    placeholder="Mã coupon" value="{{old('code', $coupon->code)}}"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-md-3 control-label">Tên <span class="required">*</span></label>
                            <div class="col-md-9">
                                <div class="input-icon right">
                                    <i class="fa"></i>
                                    <input type="text" class="form-control input-full" name="name" 
                                    placeholder="Tên coupon" value="{{old('name', $coupon->name)}}"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="col-md-3 control-label">Mô tả</label>
                            <div class="col-md-9">
                                <div class="input-icon right">
                                    <i class="fa"></i>
                                    <input type="text" class="form-control input-full" name="description" 
                                    placeholder="Mô tả" value="{{old('description', $coupon->description)}}"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="col-md-3 control-label">Phần trăm<span class="required">*</span></label>
                            <div class="col-md-9">
                                <div class="input-icon right">
                                    <i class="fa"></i>
                                    <input type="text" class="form-control input-full" name="discount_amount" 
                                    placeholder="Phần trăm giảm" value="{{old('discount_amount', $coupon->discount_amount)}}"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-md-3 control-label">Giảm tối đa </label>
                            <div class="col-md-9">
                                <div class="input-icon right input-group">
                                    <input type="text" class="form-control input-full" name="max_discount" 
                                            placeholder="Giảm tối đa" value="{{old('max_discount', $coupon->max_discount)}}"/>
                                    <span class="input-group-addon">.000đ</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="col-md-3 control-label">Bắt đầu <span class="required">*</span></label>
                            <div class="col-md-9">
                                    <div class="input-group input-full date" id="startDatePicker">
                                        <input type="text" name="starts_at" value="{{old('starts_at', $coupon->starts_at)}}" class="form-control">
                                        <span class="input-group-btn">
                                            <button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
                                        </span>
                                    </div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-md-3 control-label">Kết thúc <span class="required">
                                * </span></label>
                            <div class="col-md-9">
                                <div class="input-group input-full date" id="endDatePicker">
                                    <input type="text" name="expires_at"  value="{{old('expires_at', $coupon->expires_at)}}" class="form-control">
                                    <span class="input-group-btn">
                                        <button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="col-md-3 control-label">Trạng thái<span class="required">
                        * </span></label>
                            <div class="col-md-9">
                                <div class="input-icon right form-inline">
                                    <i class="fa"></i>
                                        <select name="status" class="form-control input-full" data-placeholder="Trạng thái">
                                            <option {{$coupon->status == 'active' ? 'selected' : null}} value="active">Hoạt động</option>
                                            <option {{$coupon->status == 'inactive' ? 'selected' : null}} value="inactive">Không hoạt động</option>
                                        </select>
                                    </div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            
                        </div>
                    </div>
                </form>
        </div>
       
    </div>
</div>
<div class="modal-footer">
    <button type="button" data-dismiss="modal" class="btn">Hủy</button>
    @if (isset($coupon->id))
    <button type="button" id="btnUpdateCoupon" class="btn green">Lưu</button>
    @else
    <button type="button" id="btnAddCoupon" class="btn green">Thêm</button>
    @endif
</div>

<script src="{{asset('js/admin/coupon_edit.js')}}" type="text/javascript"></script>
