@extends('layout.client.client')
@section('title', 'Thuê xe sân bay Nội Bài, xe tự lái giá rẻ')
@section('content')
<div class="section banner">
        <div class="cover"></div>
        <div class="overlay">
            <div class="wrap">
                <div class="container">
                    <div class="content">
                        <h1>Thuê xe tự lái - Thuê xe sân bay</h1>
                        <div class="search_form">
                            <div class="group">
                                <label>Địa điểm</label>
                                <div class="place_wrap">
                                    <input type="text" name="place" placeholder="Nhập địa điểm..." value="Hà Nội, Việt Nam">
                                </div>
                            </div>
                            <div class="group">
                                <label>Bắt đầu</label>
                                <div class="datetime">
                                    <span id="start_date" class="date">
                                        <span></span>
                                        <i class="fas fa-angle-down"></i>
                                    </span>
                                    <span class="time">
                                        <select id="startTime">
                                                <option value="00:00:00">00:00</option>
                                                <option value="00:30:00">00:30</option>
                                                <option value="01:00:00">01:00</option>
                                                <option value="01:30:00">01:30</option>
                                                <option value="02:00:00">02:00</option>
                                                <option value="02:30:00">02:30</option>
                                                <option value="03:00:00">03:00</option>
                                                <option value="03:30:00">03:30</option>
                                                <option value="04:00:00">04:00</option>
                                                <option value="04:30:00">04:30</option>
                                                <option value="05:00:00">05:00</option>
                                                <option value="05:30:00">05:30</option>
                                                <option value="06:00:00">06:00</option>
                                                <option value="06:30:00">06:30</option>
                                                <option value="07:00:00">07:00</option>
                                                <option value="07:30:00">07:30</option>
                                                <option value="08:00:00">08:00</option>
                                                <option value="08:30:00">08:30</option>
                                                <option value="09:00:00">09:00</option>
                                                <option value="09:30:00">09:30</option>
                                                <option value="10:00:00">10:00</option>
                                                <option value="10:30:00">10:30</option>
                                                <option value="11:00:00">11:00</option>
                                                <option value="11:30:00">11:30</option>
                                                <option value="12:00:00">12:00</option>
                                                <option value="12:30:00">12:30</option>
                                                <option value="13:00:00">13:00</option>
                                                <option value="13:30:00">13:30</option>
                                                <option value="14:00:00">14:00</option>
                                                <option value="14:30:00">14:30</option>
                                                <option value="15:00:00">15:00</option>
                                                <option value="15:30:00">15:30</option>
                                                <option value="16:00:00">16:00</option>
                                                <option value="16:30:00">16:30</option>
                                                <option value="17:00:00">17:00</option>
                                                <option value="17:30:00">17:30</option>
                                                <option value="18:00:00">18:00</option>
                                                <option value="18:30:00">18:30</option>
                                                <option value="19:00:00">19:00</option>
                                                <option value="19:30:00">19:30</option>
                                                <option value="20:00:00">20:00</option>
                                                <option value="20:30:00">20:30</option>
                                                <option value="21:00:00">21:00</option>
                                                <option value="21:30:00">21:30</option>
                                                <option value="22:00:00">22:00</option>
                                                <option value="22:30:00">22:30</option>
                                                <option value="23:00:00">23:00</option>
                                                <option value="23:30:00">23:30</option>	
                                        </select>
                                        <i class="fas fa-angle-down"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="group">
                                <label>Kết thúc</label>
                                <div class="datetime">
                                    <span id="end_date" class="date">
                                        <span></span>
                                        <i class="fas fa-angle-down"></i>
                                    </span>
                                    <span class="time">
                                        <select id="endTime">
                                            <option value="00:00:00">00:00</option>
                                            <option value="00:30:00">00:30</option>
                                            <option value="01:00:00">01:00</option>
                                            <option value="01:30:00">01:30</option>
                                            <option value="02:00:00">02:00</option>
                                            <option value="02:30:00">02:30</option>
                                            <option value="03:00:00">03:00</option>
                                            <option value="03:30:00">03:30</option>
                                            <option value="04:00:00">04:00</option>
                                            <option value="04:30:00">04:30</option>
                                            <option value="05:00:00">05:00</option>
                                            <option value="05:30:00">05:30</option>
                                            <option value="06:00:00">06:00</option>
                                            <option value="06:30:00">06:30</option>
                                            <option value="07:00:00">07:00</option>
                                            <option value="07:30:00">07:30</option>
                                            <option value="08:00:00">08:00</option>
                                            <option value="08:30:00">08:30</option>
                                            <option value="09:00:00">09:00</option>
                                            <option value="09:30:00">09:30</option>
                                            <option value="10:00:00">10:00</option>
                                            <option value="10:30:00">10:30</option>
                                            <option value="11:00:00">11:00</option>
                                            <option value="11:30:00">11:30</option>
                                            <option value="12:00:00">12:00</option>
                                            <option value="12:30:00">12:30</option>
                                            <option value="13:00:00">13:00</option>
                                            <option value="13:30:00">13:30</option>
                                            <option value="14:00:00">14:00</option>
                                            <option value="14:30:00">14:30</option>
                                            <option value="15:00:00">15:00</option>
                                            <option value="15:30:00">15:30</option>
                                            <option value="16:00:00">16:00</option>
                                            <option value="16:30:00">16:30</option>
                                            <option value="17:00:00">17:00</option>
                                            <option value="17:30:00">17:30</option>
                                            <option value="18:00:00">18:00</option>
                                            <option value="18:30:00">18:30</option>
                                            <option value="19:00:00">19:00</option>
                                            <option value="19:30:00">19:30</option>
                                            <option value="20:00:00">20:00</option>
                                            <option value="20:30:00">20:30</option>
                                            <option value="21:00:00">21:00</option>
                                            <option value="21:30:00">21:30</option>
                                            <option value="22:00:00">22:00</option>
                                            <option value="22:30:00">22:30</option>
                                            <option value="23:00:00">23:00</option>
                                            <option value="23:30:00">23:30</option>									
                                        </select>
                                        <i class="fas fa-angle-down"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="sub_group">
                                <a class="btn_search" href="#"><i class="fas fa-search"></i><span>Tìm xe ngay</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section section-body pr-section">
            <div class="container">
                <h2>Lý do nên chọn chúng tôi</h2>
                <div class="pr-list">
                            <div class="pr-item">
                                <div class="pr-icon">
                                    <i class="fas fa-cart-plus"></i>
                                </div>
                                <div class="content">
                                    <h3>Nhiều sự lựa chọn</h3>
                                    <p>Hàng trăm loại xe đa dạng phục vụ mọi nhu cầu của khách hàng</p>
                                </div>
                            </div>
                            <div class="pr-item">
                                <div class="pr-icon">
                                    <i class="fab fa-searchengin"></i>
                                </div>
                                <div class="content">
                                    <h3>Thuận tiện</h3>
                                    <p>Dề dàng tìm kiếm, so sánh và đặt chiếc xe như ý chỉ với vài click chuột</p>
                                </div>
                            </div>
                            <div class="pr-item">
                                <div class="pr-icon">
                                    <i class="fas fa-hand-holding-usd"></i>
                                </div>
                                <div class="content">
                                    <h3>Giá cả cạnh tranh</h3>
                                    <p>Giá cả được niêm yết công khai và rẻ hơn 10% so với giá truyền thống</p>
                                </div>
                            </div>
                        
                            <div class="pr-item">
                                <div class="pr-icon">
                                    <i class="fas fa-user-check"></i>
                                </div>
                                <div class="content">
                                    <h3>Tin cậy</h3>
                                    <p>Các xe luôn được đảm bảo tình trạng vận hành tốt nhất với các kỹ sư chuyên ngành</p>
                                </div>
                            </div>
                        
                            <div class="pr-item">
                                <div class="pr-icon">
                                    <i class="fas fa-star"></i>
                                </div>
                                <div class="content">
                                    <h3>Hỗ trợ 24/7</h3>
                                    <p>Có nhân viên hỗ trợ khách hàng trong suốt thời gian thuê xê</p>
                                </div>
                            </div>
                        
                            <div class="pr-item">
                                <div class="pr-icon">
                                    <i class="fas fa-shield-alt"></i>
                                </div>
                                <div class="content">
                                    <h3>Bảo hiểm</h3>
                                    <p>An tâm với các gói bảo hiểm vật chất và tai nạn trong suốt quá trình thuê xe</p>
                                </div>
                            </div>
                </div>
            </div>
        </div>

    <div class="section section-body top_car">
            <div class="container">
                <h2>Xe giảm giá</h2>
    
                <div id="owl-top_car" class="owl-carousel cars-owl-carousel">
                    @foreach ($saleCars as $car)
                        <div class="item car-item">
                           <a href="{{URL::to('/car/'.$car->slug)}}">
                            <div class="car-item-image">
                                <img src="{{asset('uploads/'.$car->thumbnail)}}" alt="Vĩnh Tín AUTO - Thuê xe sân bay Nội bài, xe tự lái giá rẻ">
                                <div class="car-price">
                                    <span class="real">{{$car->costs}}K</span>
                                    {{$car->promotion_costs}}K
                                </div>
                                <span class="label-pos"><span class="car-discount">Giảm {{intval((1-$car->promotion_costs/$car->costs)*100)}}%</span></span>
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

    <div class="section section-body" id="help-section">
        <div class="container">
            <h2>Hướng dẫn thuê xe</h2>
            <div class="helps-step">
                <div class="row">
                    <div class="col-md-3 col-sm-3 col-xs-6 step-item">
                        <div class="step-img">
                            <div class="img-box">
                                <img src="{{asset('images/step-1.svg')}}" alt="Vĩnh Tín AUTO - Thuê xe sân bay Nội bài, xe tự lái giá rẻ">
                            </div>
                        </div>
                        <div class="step-detail">
                            <h3>Đặt xe trên website</h3>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-6 step-item">
                        <div class="step-img">
                            <div class="img-box">
                                <img src="{{asset('images/step-2.svg')}}" alt="Vĩnh Tín AUTO - Thuê xe sân bay Nội bài, xe tự lái giá rẻ">
                            </div>
                        </div>
                        <div class="step-detail">
                            <h3>Nhận xe</h3>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-6 step-item">
                        <div class="step-img">
                            <div class="img-box">
                                <img src="{{asset('images/step-3.svg')}}" alt="Vĩnh Tín AUTO - Thuê xe sân bay Nội bài, xe tự lái giá rẻ">
                            </div>
                        </div>
                        <div class="step-detail">
                            <h3>Trải nghiệm chuyến đi</h3>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-6 step-item">
                        <div class="step-img">
                            <div class="img-box">
                                <img src="{{asset('images/step-4.svg')}}" alt="Vĩnh Tín AUTO - Thuê xe sân bay Nội bài, xe tự lái giá rẻ">
                            </div>
                        </div>
                        <div class="step-detail">
                            <h3>Kết thúc giao dịch</h3>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

    <div class="section section-body top_car">
            <div class="container">
                <h2>Xe nổi bật</h2>
    
                <div id="owl-top_car" class="owl-carousel cars-owl-carousel">
                    @foreach ($topCars as $car)
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

    <div class="section section-quotes">
        <div class="rn-section-overlayer"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-6">

                    <!-- Section Title-->
                    <div class="rn-section-title rn-title-pos-left rn-title-bg-color-white-10 rn-title-color-white">
                        <h2 class="rn-title">Khách hàng hài lòng</h2>
                        <span class="rn-title-bg">Khách hàng hài lòng</span>
                    </div>

                    <!-- Testimonials-->
                    <div class="rn-testimonials rn-testimonials2">
                        <div id="owl-testimonials" class="owl-carousel testimonials-owl-carousel">
                            <div class="item">
                                <blockquote class="rn-testimonial2-item">
                                  <div class="row">
                                    <div class="col-sm-3 text-center">
                                      <img class="img-circle" src="{{asset('images/customer1.jpg')}}" style="width: 100px;height:100px;" alt="Vĩnh Tín AUTO - Thuê xe sân bay Nội bài, xe tự lái giá rẻ">
                                      <!--<img class="img-circle" src="https://s3.amazonaws.com/uifaces/faces/twitter/kolage/128.jpg" style="width: 100px;height:100px;">-->
                                    </div>
                                    <div class="col-sm-9">
                                      <p>Rất tiện lợi, giá cả hợp lý, tài xế cực kỳ thân thiện! Sẽ tiếp tục sử dụng dịch vụ này!!</p>
                                      <small>Dũng Lê</small>
                                    </div>
                                  </div>
                                </blockquote>
                              </div>
                              <!-- Quote 2 -->
                              <div class="item">
                                <blockquote class="rn-testimonial2-item">
                                  <div class="row">
                                    <div class="col-sm-3 text-center">
                                      <img class="img-circle" src="{{asset('images/customer2.jpg')}}" style="width: 100px;height:100px;" alt="Vĩnh Tín AUTO - Thuê xe sân bay Nội bài, xe tự lái giá rẻ">
                                    </div>
                                    <div class="col-sm-9">
                                      <p>Rất tốt, hotline làm việc chuyên nghiệp, nhân viên tổng đài lễ phép, tài xế lịch sự chu đáo.</p>
                                      <small>Tuấn Anh</small>
                                    </div>
                                  </div>
                                </blockquote>
                              </div>
                              <!-- Quote 3 -->
                              <div class="item">
                                <blockquote class="rn-testimonial2-item">
                                  <div class="row">
                                    <div class="col-sm-3 text-center">
                                      <img class="img-circle" src="{{asset('images/customer3.jpg')}}" style="width: 100px;height:100px;" alt="Vĩnh Tín AUTO - Thuê xe sân bay Nội bài, xe tự lái giá rẻ">
                                    </div>
                                    <div class="col-sm-9">
                                      <p>Rất tiện lợi, giá cả hợp lý, tài xế cực kỳ thân thiện! Sẽ tiếp tục sử dụng dịch vụ này!</p>
                                      <small>Minh Thúy</small>
                                    </div>
                                  </div>
                                </blockquote>
                              </div>
                            </div>
                        </div>
                        
                    <!-- End Testimonials-->

                </div>
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-xs-6">

                            <!-- CountUp Item-->
                            <div class="rn-counter-item">
                                <div class="rn-counter-number-container">
                                    <span class="rn-counter-number">350</span>
                                    <span class="rn-counter-postfix">+</span>
                                </div>
                                <div class="rn-counter-text">Xe cho thuê</div>
                            </div>

                        </div>
                        <div class="col-xs-6">

                            <!-- CountUp Item-->
                            <div class="rn-counter-item">
                                <div class="rn-counter-number-container">
                                    <span class="rn-counter-number">1500</span>
                                    <span class="rn-counter-postfix">+</span>
                                </div>
                                <div class="rn-counter-text">Khách hàng hài lòng</div>
                            </div>

                        </div>
                        <div class="col-xs-6">

                            <!-- CountUp Item-->
                            <div class="rn-counter-item">
                                <div class="rn-counter-number-container">
                                    <span class="rn-counter-number">300</span>
                                    <span class="rn-counter-postfix">+</span>
                                </div>
                                <div class="rn-counter-text">Chuyến xe trong tháng</div>
                            </div>

                        </div>
                        <div class="col-xs-6">

                            <!-- CountUp Item-->
                            <div class="rn-counter-item">
                                <div class="rn-counter-number-container">
                                    <span class="rn-counter-number">4500</span>
                                    <span class="rn-counter-postfix">+</span>
                                </div>
                                <div class="rn-counter-text">Đánh giá hài lòng</div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section section-body latest_car">
        <div class="container">
            <h2>Xe mới đăng ký</h2>
            <div id="owl-latest_car" class="owl-carousel cars-owl-carousel">
                @foreach ($newCars as $car)
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
@endsection

@section('script-client')
<script src="{{asset('js/client/home.js')}}" type="text/javascript"></script>
@endsection

