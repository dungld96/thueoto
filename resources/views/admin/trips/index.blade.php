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
                    <table class="table table-hover table-bordered table-striped datatable" id="TripsTable" style="width:100%">
                        <thead>
                            <tr>
                            	<th width="35px">STT</th>
                                <th width="60px">Trip</th>
                                <th width="120px">Tên khách hàng</th>
                                <th width="100px">Số điện thoại</th>
                                <th>Tên xe</th>
                                <th width="110px">Ngày nhận xe</th>
                                <th width="110px">Ngày trả xe</th>
                                <th width="110px">Ngày tạo</th>
                                <th width="160px">Trạng thái</th>
                                <th width="100px">Acticon</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>   
    </div>

    <!-- /.modal -->
    <div id="viewBooing" class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                    
            </div>
        </div>
    </div>
@endsection

@section('script-datatable')
<script src="{{asset('js/admin/bookings.js')}}" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
    var tripsTable = $('#TripsTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{route('trips.list.getdata')}}',
        language: {url: '{{asset('lang/datatable.json')}}'},
        columns: [
            { data: 'DT_Row_Index', name: 'DT_Row_Index' },
            {data: 'tripCode', name: 'tripCode'},
            {data: 'name', name: 'name'},
            {data: 'phone', name: 'phone'},
            {data: 'carName', name: 'carName'},
            {data: 'startDate', name: 'startDate'},
            {data: 'endDate', name: 'endDate'},
            {data: 'bookingDate', name: 'bookingDate'},
            {data: 'bookingStatus', name: 'bookingStatus'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });
});

</script>
@endsection