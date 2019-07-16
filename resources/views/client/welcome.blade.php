@extends('layout.client.client')
@section('content')
<div class="section banner">
        <div class="cover"></div>
        <div class="overlay">
            <div class="wrap">
                <div class="container">
                    <div class="content">
                        <h1>Thuê xe tự lái</h1>
                        <div class="search_form">
                            <div class="group">
                                <label>Địa điểm</label>
                                <div class="place_wrap">
                                    <input type="text" name="place" placeholder="Nhập địa điểm...">
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
                                <a class="btn_search" href="#"><i class="fas fa-search"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section top_car">
        <div class="container">
            <h2>Xe nổi bật</h2>
            <div class="swiper-container swiper-container-initialized swiper-container-horizontal">
                <div class="swiper-wrapper">

                    @foreach ($cars as $car)
                         <div class="swiper-slide">
                            <a href="{{URL::to('/car/'.$car->slug)}}">
                            <div class="car_image">
                                <img src="{{asset('uploads/'.$car->thumbnail)}}">
                                <div class="car_price">{{$car->costs}}K</div>
                            </div>
                            <div>
                                <h3>{{$car->name}}</h3>
                            </div>
                        </a>
                    </div>
                    @endforeach
                   
                        
                        
                </div>
                <div class="swiper-pagination"></div>
                <div class="swiper-button-next" tabindex="0" role="button" aria-label="Next slide" aria-disabled="false"></div>
                <div class="swiper-button-prev swiper-button-disabled" tabindex="0" role="button" aria-label="Previous slide" aria-disabled="true"></div>
            </div>
        </div>
    </div>
    <div class="section" id="help-section">
    </div>



    <div class="section latest_car">
        <div class="container">
            <h2>Xe mới đăng ký</h2>
            <div class="swiper-container swiper-container-initialized swiper-container-horizontal">
                <div class="swiper-wrapper">

                    @foreach ($newCars as $car)
                         <div class="swiper-slide">
                            <a href="{{URL::to('/car/'.$car->slug)}}">
                            <div class="car_image">
                                <img src="{{asset('uploads/'.$car->thumbnail)}}">
                                <div class="car_price">{{$car->costs}}K</div>
                            </div>
                            <div>
                                <h3>{{$car->name}}</h3>
                            </div>
                        </a>
                    </div>
                    @endforeach
                   
                        
                        
                </div>
                <div class="swiper-pagination"></div>
                <div class="swiper-button-next" tabindex="0" role="button" aria-label="Next slide" aria-disabled="false"></div>
                <div class="swiper-button-prev swiper-button-disabled" tabindex="0" role="button" aria-label="Previous slide" aria-disabled="true"></div>
            </div>
        </div>
    </div>
@endsection

@section('script-client')
<script src="{{asset('js/client/home.js')}}" type="text/javascript"></script>
@endsection

