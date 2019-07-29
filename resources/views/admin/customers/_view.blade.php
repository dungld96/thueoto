<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">×</button>
    <h4 class="modal-title">Thông tin khách hàng</h4>
</div>
<div class="modal-body">
        <div class="panel-body content-customer">
            <p><span class="in_dam">Tên khách hàng: </span> {{$customer->name}}</p>
            <p><span class="in_dam">Số điện thoại: </span> {{$customer->phone_number}}</p>
            <p><span class="in_dam">Email: </span> {{$customer->email}}</p>
            @if (isset($customer->social_type) && $customer->social_type == 'facebook')
                <p><span class="in_dam">Facebook: </span> https://fb.com/{{$customer->social_id}}</p>                
            @endif
            <p><span class="in_dam">Số chuyến xe thành công: </span> {{$countTripSuccess}}</p>
            <p><span class="in_dam">Trạng thái: </span> {{$customer->status}}</p>
        </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
</div>