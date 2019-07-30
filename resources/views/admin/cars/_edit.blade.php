                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">Thêm xe</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-body">
                            <div class="infoCar">
                                    <form class="form-horizontal" role="form" id="carInfoForm">
                                        {{csrf_field()}}
                                        @if (isset($car->id))
                                        <input type="hidden" name="id" value="{{old('id', $car->id)}}"/>
                                        @endif
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label class="col-md-3 control-label">Mã xe <span class="required">
                                            * </span></label>
                                                <div class="col-md-9">
                                                    <div class="input-icon right">
                                                        <i class="fa"></i>
                                                        <input type="text" class="form-control input-full" name="code" 
                                                        placeholder="Mã xe" value="{{old('code', $car->code)}}" readonly/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="col-md-3 control-label">Biển số <span class="required">
                                            * </span></label>
                                                <div class="col-md-9">
                                                    <div class="input-icon right">
                                                        <i class="fa"></i>
                                                        <input type="text" class="form-control input-full" name="number_plate" 
                                                        placeholder="Biển số" value="{{old('number_plate', $car->number_plate)}}"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label class="col-md-3 control-label">Hãng xe <span class="required">
                                            * </span></label>
                                                <div class="col-md-9">
                                                    <div class="input-icon right form-inline">
                                                        <i class="fa"></i>
                                                        <select name="car_make" class="form-control input-full" id="carMake" data-placeholder="Hãng xe">
                                                            <option value="">Chọn hãng xe</option>
                                                            @foreach ($makes as $make)
                                                                <option 
                                                                @if($car->car_make == $make->name) selected
                                                                @endif
                                                                value="{{$make->id}}">{{$make->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="col-md-3 control-label">Mẫu xe <span class="required">
                                            * </span></label>
                                                <div class="col-md-9">
                                                    <div class="input-icon right form-inline">
                                                        <i class="fa"></i>
                                                         <select name="car_model" class="form-control input-full" id="carModel" data-placeholder="Mẫu xe" disabled>
                                                                <option value="">Chọn hãng xe trước</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label class="col-md-3 control-label">Năm <span class="required">
                                            * </span></label>
                                                <div class="col-md-9">
                                                    <div class="input-icon right form-inline">
                                                        <i class="fa"></i>
                                                         <select name="car_year" class="form-control input-full" data-placeholder="Năm sản xuất">
                                                                <option value="">Chọn năm sản xuất</option>
                                                                @for ($i = 2019; $i >= 1960; $i--)
                                                                    <option 
                                                                    @if($car->car_year == $i) selected
                                                                    @endif
                                                                    value="{{$i}}">{{$i}}</option>
                                                                @endfor
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="col-md-3 control-label">Số ghế <span class="required">
                                            * </span></label>
                                                <div class="col-md-9">
                                                     <div class="input-icon right">
                                                        <i class="fa"></i>
                                                        <select name="seats" class="form-control input-full" data-placeholder="Số ghế">
                                                            @for ($i = 4; $i < 30; $i++)
                                                                <option 
                                                                @if($car->seats == $i) selected
                                                                @endif
                                                                value="{{$i}}">{{$i}}</option>
                                                            @endfor
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label class="col-md-3 control-label">Truyền động <span class="required">
                                            * </span></label>
                                                <div class="col-md-9">
                                                    <div class="input-icon right form-inline">
                                                        <i class="fa"></i>
                                                         <select name="transmission" class="form-control input-full" data-placeholder="Truyền động">
                                                                <option value="auto">Số tự động</option>
                                                                <option value="manual">Số sàn</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="col-md-3 control-label">Loại nhiên liệu<span class="required">
                                            * </span></label>
                                                <div class="col-md-9">
                                                     <div class="input-icon right">
                                                        <i class="fa"></i>
                                                        <select name="fuel" class="form-control input-full" data-placeholder="Loại nhiên liệu">
                                                                <option value="petrol">Xăng</option>
                                                                <option value="diesel">Dầu diesel</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label class="col-md-3 control-label">Giá thuê<span class="required">
                                            * </span></label>
                                                <div class="col-md-9">
                                                    <div class="input-icon right input-group">
                                                        <input type="text" class="form-control input-full" name="costs" 
                                                        placeholder="Giá thuê theo ngày" value="{{old('costs', $car->costs)}}"/>
                                                        <span class="input-group-addon">.000đ</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                       <div class="row">
                                           <div class="form-group col-md-12 input-description">
                                               <label class="control-label">Mô tả</label>
                                               <textarea class="form-control input-full" rows="3" name="description" placeholder="Mô tả">{{$car->description}}</textarea>
                                           </div>
                                       </div>
                                    </form>
                            </div>
                            <div id="uploadCarImg">
                                    <form method="post" action="{{route('admin_car_image_store')}}" enctype="multipart/form-data" class="dropzone" id="dropzone">
                                        {{csrf_field()}}
                                        <div class="dz-message">
                                            <p>Kéo file hoặc bấm vào đây để tải ảnh lên</p>
                                        </div>
                                        
                                    </form> 
                                    <div style="display: none;">
                                        <div class="dz-preview dz-file-preview well" id="dz-preview-template">
                                          <div class="dz-image"><img data-dz-thumbnail /></div>
                                          <div class="dz-details">
                                            <div class="dz-filename"><span data-dz-name></span></div>
                                            <div class="dz-size" data-dz-size></div>
                                          </div>
                                          <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div>
                                          <div class="dz-success-mark"><span></span></div>
                                          <div class="dz-error-mark"><span></span></div>
                                          <div class="dz-error-message"><span data-dz-errormessage></span></div>
                                        </div>
                                    </div>
                                    <div id="template-preview"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn">Hủy</button>
                        @if (isset($car->id))
                        <button type="button" id="btnUpdateCar" class="btn green">Lưu</button>
                        @else
                        <button type="button" id="btnAddCar" class="btn green">Thêm</button>
                        @endif
                    </div>


    @if (isset($images))
        <script>
            var $images = {!! json_encode($images->toArray()) !!};
        </script>
    @endif

    @if (isset($car->id))
        <script>
            var $carId= {!! $car->id !!};
        </script>
    @endif
    
    
    <script src="{{asset('js/admin/car_edit.js')}}" type="text/javascript"></script>
