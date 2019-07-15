<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">×</button>
</div>
<div class="modal-body">
    <div class="form_container">
        <h2>Thông báo</h2>
        <div class="textAlign-center paddingBottom-30"><i class="fas fa-exclamation-triangle"></i>{{$message}}</div>
        <div class="form-group">
            <a class="btn btn-success btn-lg btn-block" href="{{route($route)}}" role="button">Cập nhật</a>
        </div>
    </div>
</div>
