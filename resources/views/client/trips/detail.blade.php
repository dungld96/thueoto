@extends('layout.client.client')
@section('title', 'Thông tin chi tiết chuyến xe')
@section('content')
    <div class="section trip-detail bg-gray">
        <div class="container">
            <div class="trip-detail-container">
                    <div class="trip-status-detail">
                        <p><i class="fas fa-dot-circle 
                                @if ($trip->bookingStatus < 3)
                                    orange-dot
                                @elseif($trip->bookingStatus >= 3 && $trip->bookingStatus < 6)
                                    green-dot
                                @elseif($trip->bookingStatus >= 6 && $trip->bookingStatus < 8)
                                    red-dot
                                @else
                                    green-dot
                                @endif
                                "></i> {{$trip->tripStatus}}</p>
                    </div>
                    <div class="content-trip-detail">
                            <div class="row">
                                <div class="col-md-4 col-sm-4">
                                    <div class="thumbnail">
                                        <img src="{{asset('uploads/'.$trip->carThumbnail)}}" alt="Vĩnh Tín AUTO - Thuê xe sân bay Nội bài, xe tự lái giá rẻ">
                                    </div>
                                </div>
                                <div class="col-md-8 col-sm-8 info-date-dress">
                                    <div class="form-group">
                                        <label>Thời gian thuê xe</label>
                                        <div class="group m-b-lg">
                                            <div class="row">
                                                <div class="col-md-6">Bắt đầu: {{$trip->startDate}}</div>
                                                <div class="col-md-6">Kết thúc: {{$trip->endDate}}</div>
                                            </div>
                                                    
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Địa điểm giao nhận xe</label>
                                        <div>{{$trip->bookingPlaceDelivery}}</div>
                                    </div>
                                    <div class="form-group">
                                        <label>Lời nhắn</label>
                                        <textarea name="description" class="form-control" rows="3">
                                            {{$trip->bookingDescription}}
                                        </textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 m-b-lg">
                                    <label>Bảng giá</label>
                                    <div class="panel panel-default bill_wrap">
                                        <div class="panel-body">
                                            <div class="car_bill">
                                                <div class="group">
                                                    <p>Đơn giá thuê</p>
                                                    <p>{{$trip->carCosts}}.000 / ngày</p>
                                                </div>
                                                <div class="group">
                                                    <p>Phí dịch vụ <i class="far fa-question-circle" data-toggle="tooltip" title="" data-original-title="Phí dịch vụ"></i></p>
                                                    <p>30.000 / ngày</p>
                                                </div>
                                                <div class="group line">
                                                    <p>Tổng phí thuê xe</p>
                                                    <p><span>{{$trip->carCosts+30}}.000</span> × <span class="days">{{$trip->diffDays}} ngày</span></p>
                                                </div>
                                                <div class="group line">
                                                    <p><b>Tổng cộng</b></p>
                                                    <p><span class="sum_amount">{{number_format($trip['sumAmount'], 0, ',', '.')}}.000</span><b>đ</b></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="trip-actions">
                            @if ($trip->bookingStatus < App\Models\BookingDetail::STATUS_APPROVED)
                                <a class="btn btn-default" href="{{URL::to('/trip/cancel/'.$trip->tripCode)}}">Hủy</a>
                            @elseif($trip->bookingStatus == App\Models\BookingDetail::STATUS_START)
                                <a class="btn btn-default" href="{{URL::to('/trip/return/'.$trip->tripCode)}}">Trả xe</a>
                            @endif
                        </div>
                </div>
            </div>
        </div>
    </div>  
@endsection

@section('script-client')
@endsection
