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
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                        <img src="{{asset('uploads/'.$car->thumbnail)}}">
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
                                        <div class="group">
                                            <p>Đơn giá thuê</p>
                                            <p>{{$car->costs}}.000 / ngày</p>
                                        </div>
                                        <div class="group">
                                            <p>Phí dịch vụ <i class="far fa-question-circle" data-toggle="tooltip" title="" data-original-title="Phí dịch vụ"></i></p>
                                            <p>30.000 / ngày</p>
                                        </div>
                                        <div class="group line">
                                            <p>Tổng phí thuê xe</p>
                                            <p><span>{{$car->costs+30}}.000</span> × <span class="days">{{$dataBooking['diffDays']}} ngày</span></p>
                                        </div>
                                        <div class="group line">
                                            <p><b>Tổng cộng</b></p>
                                            <p><span class="sum_amount">{{$dataBooking['sumAmount']}}.000</span><b>đ</b></p>
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