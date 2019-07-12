                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">Thêm xe</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-7">
                                    <form class="form-horizontal" role="form" id="carInfoForm">
                                        {{csrf_field()}}
                                        @if (isset($car->id))
                                        <input type="hidden" name="id" value="{{old('id', $car->id)}}"/>
                                        @endif
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Mã xe <span class="required">
                                        * </span></label>
                                            <div class="col-md-9">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" class="form-control input-full" name="code" 
                                                    placeholder="Mã xe" value="{{old('code', $car->code)}}"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Tên Xe <span class="required">
                                        * </span></label>
                                            <div class="col-md-9">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" class="form-control input-full" name="name" 
                                                    placeholder="Tên xe" value="{{old('name', $car->name)}}"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Hãng xe <span class="required">
                                        * </span></label>
                                            <div class="col-md-9">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" class="form-control input-full" name="car_manufacturer" placeholder="Hãng xe" value="{{old('car_manufacturer', $car->car_manufacturer)}}"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Số ghế <span class="required">
                                        * </span></label>
                                            <div class="col-md-9">
                                                 <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <select name="seats" class="form-control input-full" data-placeholder="Số ghế">
                                                        @for ($i = 1; $i < 30; $i++)
                                                            <option 
                                                            @if($car->seats == $i) selected
                                                            @endif
                                                            value="{{$i}}">{{$i}}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
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
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Mô tả</label>
                                            <div class="col-md-9">
                                                <textarea class="form-control input-full" rows="3" name="description" placeholder="Mô tả">{{$car->description}}</textarea>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-5">
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
