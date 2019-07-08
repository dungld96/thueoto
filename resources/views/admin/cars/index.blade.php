@extends('layout.admin.admin')
@section('title', 'Danh sách xe')
@section('style-page')
    <link href="{{asset('admin-assets/global/plugins/dropzone/css/dropzone.css')}}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
    <div class="row content-header">
        <div class="col-md-8">
            <h3 class="page-title">
                Danh sách xe
            </h3>
        </div>
        <div class="col-md-4">
            <div class="actions">
                <a data-target="#addCar" data-toggle="modal" class="btn red-sunglo btn-sm"><i class="fa fa-plus"></i> Thêm xe </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <table class="table table-hover table-bordered table-striped datatable" id="carsdata" style="width:100%">
                        <thead>
                            <tr>
                            	<th width="80px">STT</th>
                                <th width="180px">Code</th>
                                <th>Name</th>
                                <th width="150px">Status</th>
                                <th width="120px">Acticon</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>   
    </div>

    <!-- /.modal -->
    <div id="addCar" class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
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
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Mã xe <span class="required">
                                        * </span></label>
                                            <div class="col-md-10">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" class="form-control input-full" name="code" placeholder="Mã xe"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Tên Xe <span class="required">
                                        * </span></label>
                                            <div class="col-md-10">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" class="form-control input-full" name="name" placeholder="Tên xe"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Hãng xe <span class="required">
                                        * </span></label>
                                            <div class="col-md-10">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" class="form-control input-full" name="car_manufacturer" placeholder="Hãng xe"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Số ghế <span class="required">
                                        * </span></label>
                                            <div class="col-md-10">
                                                 <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" class="form-control input-full" name="seats" placeholder="Số ghế"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Mô tả</label>
                                            <div class="col-md-10">
                                                <textarea class="form-control input-full" rows="3" name="description" placeholder="Mô tả"></textarea>
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
                        <button type="button" id="btnAddCar" class="btn green">Thêm</button>
                    </div>
            </div>
        </div>
    </div>
@endsection

@section('script-datatable')
<script src="{{asset('js/admin/cars.js')}}" type="text/javascript"></script>
<script type="text/javascript">
	$(document).ready(function() {
	    $('#carsdata').DataTable({
	        processing: true,
	        serverSide: true,
	        ajax: '{{ route('admin_cars_getdata') }}',
            language: {url: '{{asset('lang/datatable.json')}}'},
	        columns: [
	         	{ data: 'DT_Row_Index', name: 'DT_Row_Index' },
	            {data: 'code', name: 'code'},
	            {data: 'name', name: 'name'},
	            {data: 'status', name: 'status'},
	            {data: 'action', name: 'action', orderable: false, searchable: false}
	        ]
	    });

    
        
        

	});

</script>
@endsection