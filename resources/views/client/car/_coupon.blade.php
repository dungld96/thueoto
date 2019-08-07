<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
    </div>
    <div class="modal-body modal-coupon">
        <div class="controller">
            <h3 class="title-model">Sử dụng mã khuyến mãi</h3>
            <div class="search-coupons">
                <form id="searchCouponForm">
                    {{csrf_field()}}
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" name="code" value="" class="form-control input-lg" placeholder="Nhập mã khuyễn mãi">
                            <span class="input-group-addon"><i class="fas fa-search"></i></span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="body-promo">
                    @foreach ($myCoupons as $myCoupon)
                    <div class="box-promo">
                            <div class="left"><img class="img-promo" src="{{asset('images/percent.jpg')}}" alt="Mioto - Thuê xe tự lái"></div>
                            <div class="center">
                                <p class="code">{{$myCoupon->code}}</p>
                                <p class="desc">Giảm <span>{{$myCoupon->discount_amount}}%. </span>
                                    @if (isset($myCoupon->max_discount))(tối đa<span> {{$myCoupon->max_discount}}K</span>)@endif</p>
                                <p class="desc">Bắt đầu từ: <span>{{$myCoupon->starts_at}} </span> - Tới: <span> {{$myCoupon->expires_at}}</span></p>
                                {{-- <a class="link-desc">Chi tiết <i class="fas fa-chevron-down"></i></a> --}}
                            </div>
                            <div class="right"><a class="applyCoupon btn btn-success" data-id="{{$myCoupon->id}}">Áp dụng</a></div>
                        </div>
                    @endforeach
                </div>
        </div>
    </div>

<script src="{{asset('js/client/coupon.js')}}" type="text/javascript"></script>
    
