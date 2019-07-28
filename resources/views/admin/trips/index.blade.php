@extends('layout.admin.admin')
@section('title', 'Danh sách chuyến xe')
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
    <div class="row table-filter">
        <form role="form" id="formTripsTableFilter">
            <div class="form-body">
                <div class="form-group">
                    <div class="checkbox-list">
                        <label class="checkbox-inline">
                        <input type="checkbox" class="trip-status-filter" id="statusPending"  name="statusPending" value="{{App\Models\BookingDetail::STATUS_PENDING}}"> Chờ xác nhận đặt xe</label>
                        <label class="checkbox-inline">

                        <input type="checkbox" class="trip-status-filter" id="statusApproved" name="statusApproved" value="{{App\Models\BookingDetail::STATUS_APPROVED}}"> Đã xác nhận </label>
                        <label class="checkbox-inline">

                        <input type="checkbox" class="trip-status-filter" id="statusStart" name="statusStart" value="{{App\Models\BookingDetail::STATUS_START}}"> Đang cho thuê </label>
                        <label class="checkbox-inline">

                        <input type="checkbox" class="trip-status-filter" id="statusPendingEnd" name="statusPendingEnd" value="{{App\Models\BookingDetail::STATUS_PENDING_END}}"> Chờ xác nhận trả xe </label>
                        <label class="checkbox-inline">

                        <input type="checkbox" class="trip-status-filter" id="statusEnd" name="statusEnd" value="{{App\Models\BookingDetail::STATUS_END}}"> Đã kết thúc </label>
                        <label class="checkbox-inline">

                        <input type="checkbox" class="trip-status-filter" id="statusAdCancel" name="statusAdCancel" value="{{App\Models\BookingDetail::STATUS_AD_CANCEL}}"> Quản trị viên hủy chuyến </label>
                        <label class="checkbox-inline">

                        <input type="checkbox" class="trip-status-filter" id="statusClCancel" name="statusClCancel" value="{{App\Models\BookingDetail::STATUS_CL_CANCEL}}">Khách hủy chuyến </label>
                        <label class="checkbox-inline">
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="row content-table">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <table class="table table-hover table-bordered table-striped datatable" id="TripsTable" style="width:100%">
                        <thead>
                            <tr>
                                <th width="25px">STT</th>
                                <th width="60px">Trip</th>
                                <th width="120px">Tên khách hàng</th>
                                <th width="120px">Số điện thoại</th>
                                <th>Tên xe</th>
                                <th width="100px">Ngày nhận xe</th>
                                <th width="100px">Ngày trả xe</th>
                                <th width="100px">Ngày tạo</th>
                                <th>Trạng thái</th>
                                <th width="100px">Acticon</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>   
    </div>

    <!-- /.modal -->
    <div id="modelTrip" class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            </div>
        </div>
    </div>
    <div id="modelAction" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            </div>
        </div>
    </div>
@endsection

@section('script-datatable')
<script src="{{asset('js/admin/trips.js')}}" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
    var tripsTable = $('#TripsTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
          url: '{{route('trips.list.getdata')}}',
          type: 'GET',
          data: function (d) {
            d.status_filter_params = $('#formTripsTableFilter').serializeArray();
          }
         },
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