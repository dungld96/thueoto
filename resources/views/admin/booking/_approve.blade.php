<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">×</button>
    <h4 class="modal-title">Thông tin chuyến xe #{{$bookingDetail->trip_code}}</h4>
</div>
<div class="modal-body">
        <div class="panel-body content-booking">
				<div class="row info-customer">
					<div class="col-md-4">
						<label>Tên khách hàng</label>
                    <div>{{$customer->name}}</div>
                    </div>
                    @if (isset($customer->phone_number))
                        <div class="col-md-4">
                            <label>Số điện thoại</label>
                            <div>{{$customer->phone_number}}</div>
                        </div>
                    @endif
                    @if (isset($customer->email))
                        <div class="col-md-4">
                            <label>Email</label>
                            <div>{{$customer->email}}</div>
                        </div>
                    @endif
				</div>
				<hr>
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label>Mẫu xe</label>
                        <div class="text-uppercase">{{$car->name}}</div>
						</div>
						<div class="form-group">
							<label>Đặt lúc</label>
                        <div>{{$bookingDetail->booking_date}}</div>
						</div>
						<div class="form-group">
							<img class="thumbnail" src="{{asset('uploads/'.$car->thumbnail)}}">
						</div>
					</div>
					<div class="col-md-8">
						<div class="form-group">
							<label>Thời gian thuê xe</label>
							<div class="row">
								<div class="col-md-6">
									<div>Bắt đầu: {{$bookingDetail->start_date}}</div>
								</div>
								<div class="col-md-6">
									<div>Kết thúc: {{$bookingDetail->end_date}}</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label>Địa điểm giao nhận xe</label>
							<div>{{$bookingDetail->place_delivery}}</div>
						</div>
						<div class="form-group">
							<label>Lời nhắn</label>
							<div>{{$bookingDetail->description}}</div>
						</div>
						<div class="form-group">
							<label>Bảng giá</label>
							<div class="panel panel-default bill_wrap">
								<div class="panel-body">
									<div class="car_bill">
										<div class="group">
											<p>Đơn giá thuê</p>
											<p>{{$car->costs}}.000 / ngày</p>
										</div>
										<div class="group">
											<p>Phí dịch vụ <i class="far fa-question-circle" data-toggle="tooltip" title="Phí dịch vụ"></i></p>
											<p>30.000 / ngày</p>
										</div>
										<div class="group line">
											<p>Tổng phí thuê xe</p>
											<p><span>{{$car->costs+30}}.000</span> × <span><b>{{$diffDays}} ngày</b></span></p>
										</div>
										<div class="group line">
											<p><b>Tổng cộng</b></p>
											<p><span><b>{{$sumAmount}}.000đ</b></span></p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="status textAlign-right"><p>Trạng thái: {{$bookingDetail->status_text}}</p></div>
			</div>
	</div>
<div class="modal-footer">
	<button type="button" data-id="{{$bookingDetail->id}}" id="approveBooking" class="btn btn-success">Duyệt</button>
	<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
</div>