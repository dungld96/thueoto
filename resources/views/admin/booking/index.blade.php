@extends('layout.admin.admin')
@section('title', 'Danh sách xe')
@section('style-page')
    <link href="{{asset('assets/global/plugins/dropzone/css/dropzone.css')}}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
    <div class="row content-header">
        <div class="col-md-8">
            <h3 class="page-title">
                Danh sách chuyến xe
            </h3>
        </div>
        <div class="col-md-4">
            
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
                                {{-- <th width="180px">Tên khách hàng</th>
                                <th width="180px">Số điện thoại</th>
                                <th>Tên xe</th> --}}
                                <th>Ngày nhận xe</th>
                                <th>Ngày trả xe</th>
                                <th>Ngày tạo</th>
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
                    
            </div>
        </div>
    </div>
@endsection

@section('script-datatable')
<script type="text/javascript">
$(document).ready(function() {
    var carsTable = $('#carsdata').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{route('booking.list.getdata')}}',
        language: {url: '{{asset('lang/datatable.json')}}'},
        columns: [
            { data: 'DT_Row_Index', name: 'DT_Row_Index' },
            // {data: 'name', name: 'name'},
            // {data: 'phone', name: 'phone'},
            // {data: 'carName', name: 'carName'},
            {data: 'startDate', name: 'startDate'},
            {data: 'endDate', name: 'endDate'},
            {data: 'bookingDate', name: 'bookingDate'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });
});

</script>
@endsection