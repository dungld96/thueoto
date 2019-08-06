@extends('layout.client.client')
@section('title', 'Thông tin chi tiết xe cho thuê')
@section('content')
    <div class="section content-detail">
        <div class="container">
        <h1 class="car_title">{{$car->name}}</h1>
            <div class="row">
                <div class="col-md-7" >
                    <div class="album">
                        <div id="owl-album_car_detail" class="owl-carousel">
                            @foreach ($carImages as $image)
                                <div class="item car-item">
                                   <div class="car_image">
                                       <img src="{{asset('uploads/'.$image->name)}}" alt="Vĩnh Tín AUTO - Thuê xe sân bay Nội bài, xe tự lái giá rẻ">
                                   </div>
                               </div>
                           @endforeach
                        </div>
                    </div>
                    <div class="car_info">
                        <div class="group">
                            <div class="col_title">
                                Đặc điểm
                            </div>
                            <div class="col_content">
                                <ul class="features">
                                    <li>Số ghế: {{$car->seats}}</li>
                                    <li>Truyền động: {{getNameTransmission($car->transmission)}}</li>
                                    <li>Nhiên liệu: {{getNameFuel($car->fuel)}}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="booking-info">
                        <div class="car_booking">
                            <form id="booking_form" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" name="id" value="{{$car->id}}">
                                <input type="hidden" name="start_date" value="">
                                <input type="hidden" name="end_date" value="">
                                <!-- <input type="hidden" name="days" value=""> -->
                                <div class="price">
                                    <h3>{{$car->costs}}K<span> / ngày</span></h3>
                                </div>
                                <div class="form-group">
                                    <label>Ngày bắt đầu</label>
                                    <div class="input-group input-group-lg datetime start_date">
                                        <span class="input-group-addon date">00/00/0000</span>
                                        <select class="form-control time">
                                            <option value="00:00:00">00:00</option><option value="00:30:00">00:30</option><option value="01:00:00">01:00</option><option value="01:30:00">01:30</option><option value="02:00:00">02:00</option><option value="02:30:00">02:30</option><option value="03:00:00">03:00</option><option value="03:30:00">03:30</option><option value="04:00:00">04:00</option><option value="04:30:00">04:30</option><option value="05:00:00">05:00</option><option value="05:30:00">05:30</option><option value="06:00:00">06:00</option><option value="06:30:00">06:30</option><option value="07:00:00">07:00</option><option value="07:30:00">07:30</option><option value="08:00:00">08:00</option><option value="08:30:00">08:30</option><option value="09:00:00">09:00</option><option value="09:30:00">09:30</option><option value="10:00:00">10:00</option><option value="10:30:00">10:30</option><option value="11:00:00">11:00</option><option value="11:30:00">11:30</option><option value="12:00:00">12:00</option><option value="12:30:00">12:30</option><option value="13:00:00">13:00</option><option value="13:30:00">13:30</option><option value="14:00:00">14:00</option><option value="14:30:00">14:30</option><option value="15:00:00">15:00</option><option value="15:30:00">15:30</option><option value="16:00:00">16:00</option><option value="16:30:00">16:30</option><option value="17:00:00">17:00</option><option value="17:30:00">17:30</option><option value="18:00:00">18:00</option><option value="18:30:00">18:30</option><option value="19:00:00">19:00</option><option value="19:30:00">19:30</option><option value="20:00:00">20:00</option><option value="20:30:00">20:30</option><option value="21:00:00">21:00</option><option value="21:30:00">21:30</option><option value="22:00:00">22:00</option><option value="22:30:00">22:30</option><option value="23:00:00">23:00</option><option value="23:30:00">23:30</option>                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Ngày kết thúc</label>
                                    <div class="input-group input-group-lg datetime end_date">
                                        <span class="input-group-addon date">00/00/0000</span>
                                        <select class="form-control time">
                                            <option value="00:00:00">00:00</option><option value="00:30:00">00:30</option><option value="01:00:00">01:00</option><option value="01:30:00">01:30</option><option value="02:00:00">02:00</option><option value="02:30:00">02:30</option><option value="03:00:00">03:00</option><option value="03:30:00">03:30</option><option value="04:00:00">04:00</option><option value="04:30:00">04:30</option><option value="05:00:00">05:00</option><option value="05:30:00">05:30</option><option value="06:00:00">06:00</option><option value="06:30:00">06:30</option><option value="07:00:00">07:00</option><option value="07:30:00">07:30</option><option value="08:00:00">08:00</option><option value="08:30:00">08:30</option><option value="09:00:00">09:00</option><option value="09:30:00">09:30</option><option value="10:00:00">10:00</option><option value="10:30:00">10:30</option><option value="11:00:00">11:00</option><option value="11:30:00">11:30</option><option value="12:00:00">12:00</option><option value="12:30:00">12:30</option><option value="13:00:00">13:00</option><option value="13:30:00">13:30</option><option value="14:00:00">14:00</option><option value="14:30:00">14:30</option><option value="15:00:00">15:00</option><option value="15:30:00">15:30</option><option value="16:00:00">16:00</option><option value="16:30:00">16:30</option><option value="17:00:00">17:00</option><option value="17:30:00">17:30</option><option value="18:00:00">18:00</option><option value="18:30:00">18:30</option><option value="19:00:00">19:00</option><option value="19:30:00">19:30</option><option value="20:00:00">20:00</option><option value="20:30:00">20:30</option><option value="21:00:00">21:00</option><option value="21:30:00">21:30</option><option value="22:00:00">22:00</option><option value="22:30:00">22:30</option><option value="23:00:00">23:00</option><option value="23:30:00">23:30</option>                        </select>
                                    </div>
                                    <div class="error error_end_date text-danger hidden"><i class="fas fa-exclamation-circle"></i> Vui lòng chọn thời gian kết thúc!</div>
                                </div>
                                <div class="form-group">
                                    <label>Địa điểm giao nhận xe</label>
                                    <div class="place_wrap">
                                        <input type="text" name="address" class="form-control input-lg address" placeholder="Nhập địa chỉ...">
                                    </div>
                                    <div class="error error_address text-danger hidden"><i class="fas fa-exclamation-circle"></i> Vui lòng chọn địa điểm giao nhận xe!</div>
                                </div>
                                <div class="form-group">
                                    <label>Chi tiết giá</label> 
                                    <div class="car_bill">
                                        <div class="group @if (isset($car->promotion_costs)) gach-ngang @endif">
                                            <p>Đơn giá thuê</p>
                                            <p>{{number_format($car->costs,0,",",".")}}.000 / ngày</p>
                                        </div>

                                        @if (isset($car->promotion_costs))
                                            <div class="group">
                                                <p>Giá khuyến mãi</p>
                                                <p>{{number_format($car->promotion_costs,0,",",".")}}.000 / ngày</p>
                                            </div>
                                        @endif

                                        <div class="group">
                                            <p>Phí dịch vụ <i class="far fa-question-circle" data-toggle="tooltip" title="Phí dịch vụ"></i></p>
                                            <p>{{$serviceCosts}}.000 / ngày</p>
                                        </div>
                                        <div class="group line">
                                            <p>Tổng phí thuê xe</p>
                                            <p><span class="amount">
                                                @if (isset($car->promotion_costs))
                                                {{number_format($car->promotion_costs + $serviceCosts,0,",",".")}}
                                                @else
                                                {{number_format($car->costs + $serviceCosts,0,",",".")}}
                                                @endif
                                                .000</span> × <span class="days">1 ngày</span></p>
                                        </div>
                                        <div class="group line">
                                            <p><b>Tổng cộng</b></p>
                                            <p><span class="sum_amount"></span><b>đ</b></p>
                                        </div>

                                        <div class="group use-coupon">
                                            <a href="javascript:void(0);" id="useCoupon">Mã khuyến mãi</a>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success btn-lg btn-block">Đặt xe</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section similar-wrap">
        <div class="container">
            <h2>Xe liên quan</h2>
            <div id="owl-similar_car" class="owl-carousel cars-owl-carousel">
                    @foreach ($carSimilars as $car)
                        <div class="item car-item">
                           <a href="{{URL::to('/car/'.$car->slug)}}">
                            <div class="car-item-image">
                                <img src="{{asset('uploads/'.$car->thumbnail)}}" alt="Vĩnh Tín AUTO - Thuê xe sân bay Nội bài, xe tự lái giá rẻ">
                                <div class="car-price">
                                        @if (isset($car->promotion_costs))
                                        <span class="real">{{$car->costs}}K</span>                                    
                                        {{$car->promotion_costs}}K
                                        @else
                                        {{$car->costs}}K
                                        @endif
                                </div>
                                @if (isset($car->promotion_costs))
                                <span class="label-pos"><span class="car-discount">Giảm {{intval((1-$car->promotion_costs/$car->costs)*100)}}%</span></span>
                                @endif
                            </div>
                            <div class="desc-car-item">
                                <h3>{{$car->name}}</h3>
                                <div class="group-label"><span>{{getNameTransmission($car->transmission)}}</span><span>Giao xe tận nơi</span></div>
                                <div class="group-label location">
                                        <p><i class="fas fa-map-marked-alt"></i></i>{{$infoSystemCf->address}}</p>
                                </div>
                            </div>
                           </a>
                        </div>
                    @endforeach
                </div>
        </div>
    </div>
    <div id="confirmBookingModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            </div>
        </div>
    </div>
    <div id="useCouponModel" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                
            </div>
        </div>
    </div>
@endsection

@section('script-client')
<script src="{{asset('js/client/booking-detail.js')}}" type="text/javascript"></script>
@endsection
