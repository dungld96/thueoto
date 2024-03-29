    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
    </div>
    <div class="modal-body">
        <div class="form_container">
            <h2>Xác nhận đặt xe</h2>
            <h4>Ford Transit 2019</h4>
            <hr>
            <form id="confirm_form" method="post">
                    {{ csrf_field() }}
                <input type="hidden" name="id" value="{{$car->id}}">
                <input type="hidden" name="start_date" value="{{$dataBooking['startDateTt']}}">
                <input type="hidden" name="end_date" value="{{$dataBooking['endDateTt']}}">
                <input type="hidden" name="address" value="{{$dataBooking['placeDelivery']}}">
                <input type="hidden" name="costs" value="{{$car->costs}}">
                <input type="hidden" name="promotion_costs" value="{{$car->promotion_costs}}">
                <input type="hidden" name="service_costs" value="{{$dataBooking['serviceCosts']}}">
                <input type="hidden" name="sum_amount" value="{{$dataBooking['sumAmount']}}">
                <input type="hidden" name="coupon_code" value="{{isset($dataBooking['coupon_code']) ? $dataBooking['coupon_code'] : ''}}">
                <input type="hidden" name="coupon_discount" value="{{isset($dataBooking['coupon_discount']) ? $dataBooking['coupon_discount'] : ''}}">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                        <img src="{{asset('uploads/'.$car->thumbnail)}}" alt="Vĩnh Tín AUTO - Thuê xe sân bay Nội bài, xe tự lái giá rẻ">
                        </div>
                        <div class="col-md-8 info-date-dress">
                            <div class="form-group">
                                <label>Thời gian thuê xe</label>
                                <div class="group m-b-lg">
                                    <div class="row">
                                            <div class="col-md-6">Bắt đầu: {{$dataBooking['startDate']}}</div>
                                            <div class="col-md-6">Kết thúc: {{$dataBooking['endDate']}}</div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Địa điểm giao nhận xe</label>
                                <div>{{$dataBooking['placeDelivery']}}</div>
                            </div>
                            <div class="form-group">
                                <label>Lời nhắn</label>
                                <textarea name="description" class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12 m-b-lg">
                            <label>Bảng giá</label>
                            <div class="panel panel-default bill_wrap">
                                <div class="panel-body">
                                    <div class="car_bill">
                                        <div class="group @if (isset($car->promotion_costs)) gach-ngang @endif"">
                                            <p>Đơn giá thuê</p>
                                            <p>{{$car->costs}}.000 / ngày</p>
                                        </div>

                                        @if (isset($car->promotion_costs))
                                            <div class="group">
                                                <p>Giá khuyến mãi</p>
                                                <p>{{number_format($car->promotion_costs,0,",",".")}}.000 / ngày</p>
                                            </div>
                                        @endif

                                        <div class="group">
                                            <p>Phí dịch vụ <i class="far fa-question-circle" data-toggle="tooltip" title="" data-original-title="Phí dịch vụ"></i></p>
                                            <p>{{$dataBooking['serviceCosts']}}.000 / ngày</p>
                                        </div>
                                        <div class="group line">
                                            <p>Tổng phí thuê xe</p>
                                            <p><span>
                                                @if (isset($car->promotion_costs))
                                                {{number_format($car->promotion_costs + $dataBooking['serviceCosts'],0,",",".")}}.000
                                                @else
                                                {{number_format($car->costs + $dataBooking['serviceCosts'],0,",",".")}}.000
                                                @endif
                                                </span> × <span class="days">{{$dataBooking['diffDays']}} ngày</span></p>
                                        </div>
                                        @if (isset($dataBooking['coupon_code']))
                                            <div class="group">
                                                <p>Khuyến mãi mã <span class="in-dam">{{$dataBooking['coupon_code']}}</span></p>
                                                <p>-{{$dataBooking['coupon_discount']}}.000</p>
                                            </div>
                                        @endif
                                        <div class="group line">
                                            <p><b>Tổng cộng</b></p>
                                            <p><span class="sum_amount">{{number_format($dataBooking['sumAmount'], 0, ',', '.')}}.000</span><b>đ</b></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-default btn-lg btn-block" data-dismiss="modal">Hủy</button>
                        </div>
                        <div class="col-md-6 btn-cf-book">
                            <button class="btn btn-success btn-lg btn-block">Đặt xe</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>