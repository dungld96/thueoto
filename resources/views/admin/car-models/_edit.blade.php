<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Thêm Mẫu Xe</h4>
    </div>
    <div class="modal-body">
        <div class="form-body">
            <div class="infoCar">
                    <form class="form-horizontal" role="form" id="carModelForm">
                        {{csrf_field()}}
                        @if (isset($c_model->id))
                        <input type="hidden" name="id" value="{{old('id', $c_model->id)}}"/>
                        @endif
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="col-md-3 control-label">Hãng xe <span class="required">*</span></label>
                                <div class="col-md-9">
                                    <div class="input-icon right">
                                        <i class="fa"></i>
                                        <input id="makeCode" type="text" class="form-control input-full" name="make_code" 
                                        placeholder="Hãng xe" value="" readonly/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="col-md-3 control-label">Tên mẫu xe <span class="required">*</span></label>
                                <div class="col-md-9">
                                    <div class="input-icon right">
                                        <i class="fa"></i>
                                        <input type="text" class="form-control input-full" name="name" 
                                        placeholder="Tên mẫu xe" value="{{old('name', $c_model->name)}}"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="col-md-3 control-label">Kiểu xe <span class="required">*</span></label>
                                    <div class="col-md-9">
                                        <div class="input-icon right">
                                            <i class="fa"></i>
                                            <select name="type" class="form-control input-full" data-placeholder="Kiểu xe">
                                                    @foreach ($c_seats as $c_seat)
                                                        <option 
                                                        @if($c_model->type == $c_seat->number) selected
                                                        @endif
                                                        value="{{$c_seat->number}}">{{$c_seat->number}}</option>
                                                    @endforeach
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
        @if (isset($c_model->id))
        <button type="button" id="btnUpdateCModel" class="btn green">Lưu</button>
        @else
        <button type="button" id="btnAddCModel" class="btn green">Thêm</button>
        @endif
    </div>
    
    <script src="{{asset('js/admin/car_model_edit.js')}}" type="text/javascript"></script>
    