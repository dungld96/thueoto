@extends('layout.admin.admin')
@section('title', 'Danh sách xe')
@section('style-page')
    <link href="{{asset('assets/global/plugins/dropzone/css/dropzone.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css')}}" rel="stylesheet" type="text/css"/>
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
                <a data-href="{{route('car.create')}}" data-target="#addCar" data-toggle="modal" class="btn red-sunglo btn-sm"><i class="fa fa-plus"></i> Thêm xe </a>
            </div>
        </div>
    </div>
    <div class="row table-filter">
        <form role="form" id="formCarsFilter">
            <div class="form-body">
                <div class="form-group">
                    <div class="checkbox-list">
                        <label class="checkbox-inline">
                        <input type="checkbox" class="car-is-top" id="isTop"  name="is_top" value="T">Xe nổi bật</label>
                        <label class="checkbox-inline">
                    </div>
                </div>
            </div>
        </form>
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
                                <th>Tên xe</th>
                                <th width="180px">Giá xe</th>
                                <th width="180px">Giá khuyến mãi</th>
                                <th width="150px">Trạng thái</th>
                                <th width="120px">Tùy chọn</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>   
    </div>

    <!-- /.modal -->
    <div id="addCar" class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-90">
            <div class="modal-content">
                    
            </div>
        </div>
    </div>
@endsection

@section('script-datatable')
<script src="{{asset('js/admin/cars.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js')}}" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
    var carsTable = $('#carsdata').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
          url: '{{route('admin_cars_getdata')}}',
          type: 'GET',
          data: function (d) {
            d.car_filter_params = $('#formCarsFilter').serializeArray();
          }
         },
        language: {url: '{{asset('lang/datatable.json')}}'},
        columns: [
             { data: 'DT_Row_Index', name: 'DT_Row_Index' },
            {data: 'code', name: 'code'},
            {data: 'name', name: 'name'},
            {data: 'costs', costs: 'name'},
            {data: 'promotion_costs', name: 'promotion_costs'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });
});

</script>
@endsection