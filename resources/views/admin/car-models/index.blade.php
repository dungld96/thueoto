@extends('layout.admin.admin')
@section('title', 'Mẫu xe')
@section('content')
    <div class="row content-header">
        <div class="col-md-4">
            <h3 class="page-title">
                Danh sách mẫu xe
            </h3>
        </div>
        <div class="col-md-8 car-make-header-right">
            <div class="select-make">
                    <div class="form-group">
                            <div class="input-icon right form-inline">
                                    <i class="fa"></i>
                                    <select name="make_code" class="form-control input-full" id="inpSelectMake" data-placeholder="Hãng xe">
                                        @foreach ($makes as $make)
                                            <option 
                                            @if($make->code == 'AUDI') selected
                                            @endif
                                            value="{{$make->code}}">{{$make->name}}</option>
                                        @endforeach
                                    </select>
                                </div>        
                    </div>
            </div>
            <div class="actions">
                <a data-href="{{route('cars.models.create')}}" data-target="#addCModels" data-toggle="modal" class="btn red-sunglo btn-sm"><i class="fa fa-plus"></i> Thêm mẫu xe </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <table class="table table-hover table-bordered table-striped datatable" id="carModelTable" style="width:100%">
                        <thead>
                            <tr>
                            	<th width="35px">STT</th>
                                <th>Hãng xe</th>
                                <th>Tên mẫu</th>
                                <th>Kiểu xe</th>
                                <th width="80px">Tùy chọn</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>   
    </div>

    <!-- /.modal -->
    <div id="viewCarModel" class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                    
            </div>
        </div>
    </div>
@endsection

@section('script-datatable')
<script src="{{asset('js/admin/car_model.js')}}" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
    var carModelTable = $('#carModelTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
          url: '{{route('cars.models.getdata')}}',
          type: 'GET',
          data: function (d) {
            d.make_code = $('#inpSelectMake').val();
          }
        },
        language: {url: '{{asset('lang/datatable.json')}}'},
        columns: [
             { data: 'DT_Row_Index', name: 'DT_Row_Index' },
            {data: 'makeName', name: 'makeName'},
            {data: 'name', name: 'name'},
            {data: 'type', name: 'type'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });
});

// </script>
@endsection