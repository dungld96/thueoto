@extends('layout.admin.admin')
@section('title', 'Danh sách chuyến xe')
@section('content')
    <div class="row content-header">
        <div class="col-md-8">
            <h3 class="page-title">
                Danh sách người kiểm duyệt
            </h3>
        </div>
        <div class="col-md-4">
            <div class="actions">
                <a data-href="{{route('users.createmod')}}" data-target="#addUser" data-toggle="modal" class="btn red-sunglo btn-sm"><i class="fa fa-plus"></i> Thêm mới </a>
            </div>
        </div>
    </div>

    <div class="row content-table">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <table class="table table-hover table-bordered table-striped datatable" id="UsersTable" style="width:100%">
                        <thead>
                            <tr>
                                <th width="25px">STT</th>
                                <th>Tên hiển thị</th>
                                <th>Email</th>
                                <th>Số điện thoại</th>
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
    <div id="modelUser" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            </div>
        </div>
    </div>
@endsection

@section('script-datatable')
<script src="{{asset('js/admin/users.js')}}" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
    var usersTable = $('#UsersTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{route('users.list.getdata')}}',
        language: {url: '{{asset('lang/datatable.json')}}'},
        columns: [
            { data: 'DT_Row_Index', name: 'DT_Row_Index' },
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'phone_number', name: 'phone_number'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });
});

</script>
@endsection