@extends('layout.admin.admin')
@section('title', 'Coupons')
@section('style-page')
    <link href="{{asset('assets/global/plugins/dropzone/css/dropzone.css')}}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
    <div class="row content-header">
        <div class="col-md-8">
            <h3 class="page-title">
                Danh sách mã giảm giá
            </h3>
        </div>
        <div class="col-md-4">
            <div class="actions">
                <a data-href="{{route('coupons.create')}}" data-target="#addCoupon" data-toggle="modal" class="btn red-sunglo btn-sm"><i class="fa fa-plus"></i> Thêm Coupon </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <table class="table table-hover table-bordered table-striped datatable" id="couponsTable" style="width:100%">
                        <thead>
                            <tr>
                            	<th width="35px">STT</th>
                                <th width="100px">Mã</th>
                                <th>Tên</th>
                                <th>Mô tả</th>
                                <th width="120px">Giảm tối đa</th>
                                <th width="130px">Ngày bắt đầu</th>
                                <th width="130px">Ngày kết thúc</th>
                                <th width="130px">Trạng thái</th>
                                <th width="80px">Tùy chọn</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>   
    </div>

    <!-- /.modal -->
    <div id="viewCoupon" class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                    
            </div>
        </div>
    </div>
@endsection

@section('script-datatable')
<script src="{{asset('js/admin/coupon.js')}}" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
    var couponsTable = $('#couponsTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{route('coupons.list.getdata')}}',
        language: {url: '{{asset('lang/datatable.json')}}'},
        columns: [
             { data: 'DT_Row_Index', name: 'DT_Row_Index' },
            {data: 'code', name: 'code'},
            {data: 'name', name: 'name'},
            {data: 'description', name: 'description'},
            {data: 'max_discount', name: 'max_discount'},
            {data: 'starts_at', name: 'starts_at'},
            {data: 'expires_at', name: 'expires_at'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });
});

// </script>
@endsection