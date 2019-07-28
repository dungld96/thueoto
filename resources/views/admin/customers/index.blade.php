@extends('layout.admin.admin')
@section('title', 'Danh sách khách hàng')
@section('style-page')
    <link href="{{asset('assets/global/plugins/dropzone/css/dropzone.css')}}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
    <div class="row content-header">
        <div class="col-md-8">
            <h3 class="page-title">
                Danh sách khách hàng
            </h3>
        </div>
        <div class="col-md-4">
           
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <table class="table table-hover table-bordered table-striped datatable" id="CustomerTable" style="width:100%">
                        <thead>
                            <tr>
                            	<th width="35px">STT</th>
                                <th width="180px">Tên</th>
                                <th>Số điện thoại</th>
                                <th>Email</th>
                                <th>Ngày tham gia</th>
                                <th width="120px">Tùy chọn</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>   
    </div>

    <!-- /.modal -->
    <div id="viewCustomer" class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                    
            </div>
        </div>
    </div>
@endsection

@section('script-datatable')
{{-- <script src="{{asset('js/admin/cars.js')}}" type="text/javascript"></script> --}}
<script type="text/javascript">
$(document).ready(function() {
    var customerTable = $('#CustomerTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{route('customer.list.getdata')}}',
        language: {url: '{{asset('lang/datatable.json')}}'},
        columns: [
             { data: 'DT_Row_Index', name: 'DT_Row_Index' },
            {data: 'name', name: 'name'},
            {data: 'phone_number', name: 'phone_number'},
            {data: 'email', name: 'email'},
            {data: 'created_at', name: 'created_at'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });
});

</script>
@endsection