@extends('layout.client.client')
@section('title', 'Danh sách xe cho thuê')
@section('content')
    <div class="section filter-result bg-gray">
        <div class="container">
            <div class="result-header">
                <div class="tab-mode">
                    <p class="list-result-title"> <i class="far fa-list-alt"></i><span> Danh sách</span></p>
                </div>
                <div class="daterange" id="adress-daterange">
                    <div class="form-inline select-datetime select-address">
                        <label>Địa điểm</label>
                        <div class="place_wrap input-group">
                             <input type="text" name="place" placeholder="Nhập địa điểm...">
                        </div>
                    </div>
                    <div class="form-inline select-datetime">
                        <label>Bắt đầu</label>
                        <div class="input-group select-date start_date">
                            <span class="date">00/00/0000</span>
                            <i class="fas fa-angle-down"></i>
                        </div>
                        <div class="input-group start_date">
                            <select class="time">
                                <option value="00:00:00">00:00</option><option value="00:30:00">00:30</option><option value="01:00:00">01:00</option><option value="01:30:00">01:30</option><option value="02:00:00">02:00</option><option value="02:30:00">02:30</option><option value="03:00:00">03:00</option><option value="03:30:00">03:30</option><option value="04:00:00">04:00</option><option value="04:30:00">04:30</option><option value="05:00:00">05:00</option><option value="05:30:00">05:30</option><option value="06:00:00">06:00</option><option value="06:30:00">06:30</option><option value="07:00:00">07:00</option><option value="07:30:00">07:30</option><option value="08:00:00">08:00</option><option value="08:30:00">08:30</option><option value="09:00:00">09:00</option><option value="09:30:00">09:30</option><option value="10:00:00">10:00</option><option value="10:30:00">10:30</option><option value="11:00:00">11:00</option><option value="11:30:00">11:30</option><option value="12:00:00">12:00</option><option value="12:30:00">12:30</option><option value="13:00:00">13:00</option><option value="13:30:00">13:30</option><option value="14:00:00">14:00</option><option value="14:30:00">14:30</option><option value="15:00:00">15:00</option><option value="15:30:00">15:30</option><option value="16:00:00">16:00</option><option value="16:30:00">16:30</option><option value="17:00:00">17:00</option><option value="17:30:00">17:30</option><option value="18:00:00">18:00</option><option value="18:30:00">18:30</option><option value="19:00:00">19:00</option><option value="19:30:00">19:30</option><option value="20:00:00">20:00</option><option value="20:30:00">20:30</option><option value="21:00:00">21:00</option><option value="21:30:00">21:30</option><option value="22:00:00">22:00</option><option value="22:30:00">22:30</option><option value="23:00:00">23:00</option><option value="23:30:00">23:30</option>                        </select>
                            <i class="fas fa-angle-down"></i>
                        </div>
                    </div>
                    <div id="mb-g">-</div>
                    <div class="form-inline select-datetime">
                        <label>Kết thúc</label>
                        <div class="input-group select-date end_date">
                            <span class="date">00/00/0000</span>
                            <i class="fas fa-angle-down"></i>
                        </div>
                        <div class="input-group end_date">
                                <select class="time">
                                    <option value="00:00:00">00:00</option><option value="00:30:00">00:30</option><option value="01:00:00">01:00</option><option value="01:30:00">01:30</option><option value="02:00:00">02:00</option><option value="02:30:00">02:30</option><option value="03:00:00">03:00</option><option value="03:30:00">03:30</option><option value="04:00:00">04:00</option><option value="04:30:00">04:30</option><option value="05:00:00">05:00</option><option value="05:30:00">05:30</option><option value="06:00:00">06:00</option><option value="06:30:00">06:30</option><option value="07:00:00">07:00</option><option value="07:30:00">07:30</option><option value="08:00:00">08:00</option><option value="08:30:00">08:30</option><option value="09:00:00">09:00</option><option value="09:30:00">09:30</option><option value="10:00:00">10:00</option><option value="10:30:00">10:30</option><option value="11:00:00">11:00</option><option value="11:30:00">11:30</option><option value="12:00:00">12:00</option><option value="12:30:00">12:30</option><option value="13:00:00">13:00</option><option value="13:30:00">13:30</option><option value="14:00:00">14:00</option><option value="14:30:00">14:30</option><option value="15:00:00">15:00</option><option value="15:30:00">15:30</option><option value="16:00:00">16:00</option><option value="16:30:00">16:30</option><option value="17:00:00">17:00</option><option value="17:30:00">17:30</option><option value="18:00:00">18:00</option><option value="18:30:00">18:30</option><option value="19:00:00">19:00</option><option value="19:30:00">19:30</option><option value="20:00:00">20:00</option><option value="20:30:00">20:30</option><option value="21:00:00">21:00</option><option value="21:30:00">21:30</option><option value="22:00:00">22:00</option><option value="22:30:00">22:30</option><option value="23:00:00">23:00</option><option value="23:30:00">23:30</option>                        </select>
                                <i class="fas fa-angle-down"></i>
                        </div>
                        <div class="error error_end_date text-danger hidden"><i class="fas fa-exclamation-circle"></i> Vui lòng chọn thời gian kết thúc!</div>
                    </div>
                </div>
                <div id="mb-address-daterange">
                    <div id="dropdownMbFilterHeader" >
                        <div class="mb-content-address-daterange">
                            <p id="mb-plade">Nhập địa điểm...</p>
                            <p id="mb-date-range">
                                <span id="mb-start-date">00/00/0000 </span> <span id="mb-start-time">00:00</span> -
                                <span id="mb-end-date">00/00/0000 </span> <span id="mb-end-time">00:00</span>
                            </p>
                        </div>
                        <div class="mb-icon-dropdow">
                            <i class="fas fa-angle-down"></i>
                        </div>
                    </div>
                    <div id="dropdown-menu-address-daterange">
                        <div class="form-inline select-datetime select-address">
                            <label>Địa điểm</label>
                            <div class="place_wrap input-group">
                                <input type="text" name="place" placeholder="Nhập địa điểm...">
                            </div>
                        </div>
                        <div class="form-inline select-datetime">
                            <label>Bắt đầu</label>
                            <div class="input-group select-date start_date">
                                <span class="date">00/00/0000</span>
                                <i class="fas fa-angle-down"></i>
                            </div>
                            <div class="input-group start_date">
                                <select class="time">
                                    <option value="00:00:00">00:00</option><option value="00:30:00">00:30</option><option value="01:00:00">01:00</option><option value="01:30:00">01:30</option><option value="02:00:00">02:00</option><option value="02:30:00">02:30</option><option value="03:00:00">03:00</option><option value="03:30:00">03:30</option><option value="04:00:00">04:00</option><option value="04:30:00">04:30</option><option value="05:00:00">05:00</option><option value="05:30:00">05:30</option><option value="06:00:00">06:00</option><option value="06:30:00">06:30</option><option value="07:00:00">07:00</option><option value="07:30:00">07:30</option><option value="08:00:00">08:00</option><option value="08:30:00">08:30</option><option value="09:00:00">09:00</option><option value="09:30:00">09:30</option><option value="10:00:00">10:00</option><option value="10:30:00">10:30</option><option value="11:00:00">11:00</option><option value="11:30:00">11:30</option><option value="12:00:00">12:00</option><option value="12:30:00">12:30</option><option value="13:00:00">13:00</option><option value="13:30:00">13:30</option><option value="14:00:00">14:00</option><option value="14:30:00">14:30</option><option value="15:00:00">15:00</option><option value="15:30:00">15:30</option><option value="16:00:00">16:00</option><option value="16:30:00">16:30</option><option value="17:00:00">17:00</option><option value="17:30:00">17:30</option><option value="18:00:00">18:00</option><option value="18:30:00">18:30</option><option value="19:00:00">19:00</option><option value="19:30:00">19:30</option><option value="20:00:00">20:00</option><option value="20:30:00">20:30</option><option value="21:00:00">21:00</option><option value="21:30:00">21:30</option><option value="22:00:00">22:00</option><option value="22:30:00">22:30</option><option value="23:00:00">23:00</option><option value="23:30:00">23:30</option>                        </select>
                                    <i class="fas fa-angle-down"></i>
                            </div>
                        </div>
                        <div id="mb-g">-</div>
                        <div class="form-inline select-datetime">
                            <label>Kết thúc</label>
                            <div class="input-group select-date end_date">
                                <span class="date">00/00/0000</span>
                                <i class="fas fa-angle-down"></i>
                            </div>
                            <div class="input-group end_date">
                                <select class="time">
                                    <option value="00:00:00">00:00</option><option value="00:30:00">00:30</option><option value="01:00:00">01:00</option><option value="01:30:00">01:30</option><option value="02:00:00">02:00</option><option value="02:30:00">02:30</option><option value="03:00:00">03:00</option><option value="03:30:00">03:30</option><option value="04:00:00">04:00</option><option value="04:30:00">04:30</option><option value="05:00:00">05:00</option><option value="05:30:00">05:30</option><option value="06:00:00">06:00</option><option value="06:30:00">06:30</option><option value="07:00:00">07:00</option><option value="07:30:00">07:30</option><option value="08:00:00">08:00</option><option value="08:30:00">08:30</option><option value="09:00:00">09:00</option><option value="09:30:00">09:30</option><option value="10:00:00">10:00</option><option value="10:30:00">10:30</option><option value="11:00:00">11:00</option><option value="11:30:00">11:30</option><option value="12:00:00">12:00</option><option value="12:30:00">12:30</option><option value="13:00:00">13:00</option><option value="13:30:00">13:30</option><option value="14:00:00">14:00</option><option value="14:30:00">14:30</option><option value="15:00:00">15:00</option><option value="15:30:00">15:30</option><option value="16:00:00">16:00</option><option value="16:30:00">16:30</option><option value="17:00:00">17:00</option><option value="17:30:00">17:30</option><option value="18:00:00">18:00</option><option value="18:30:00">18:30</option><option value="19:00:00">19:00</option><option value="19:30:00">19:30</option><option value="20:00:00">20:00</option><option value="20:30:00">20:30</option><option value="21:00:00">21:00</option><option value="21:30:00">21:30</option><option value="22:00:00">22:00</option><option value="22:30:00">22:30</option><option value="23:00:00">23:00</option><option value="23:30:00">23:30</option>                        </select>
                                <i class="fas fa-angle-down"></i>
                            </div>
                            <div class="error error_end_date text-danger hidden"><i class="fas fa-exclamation-circle"></i> Vui lòng chọn thời gian kết thúc!</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-result">
                <div class="row">
                    <div class="col-md-4 hidden-sm hidden-xs">
                        <div class="sidebar-result">
                          <div class="scroll-inner">
                                <form action="#" class="form-horizontal" role="form">
                                        <div class="form-group">
                                            <label class="control-label" class="slstitle">Sắp xếp</label>
                                            <div class="line-form">
                                                <select class="bs-select form-control"  id="filterCarSortBy">
                                                    <option value="">Tối ưu</option>
                                                    <option {{ Request::get('sortBy') && Request::get('sortBy') == 'asc' ? 'selected' : ''}} value="asc">Ưu tiên giá thấp</option>
                                                    <option {{ Request::get('sortBy') && Request::get('sortBy') == 'desc' ? 'selected' : ''}} value="desc">Ưu tiên giá cao</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" class="slstitle">Mức giá</label>
                                            <div class="line-form">
                                                <div id="rangeCarCosts"></div>
                                                <p id="amountCarCosts" style="border:0; color:#00a550; font-weight:bold;"></p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" class="slstitle">Loại xe (số chỗ)</label>
                                            <div class="line-form">
                                                <select class="bs-select form-control"  id="filterCarType">
                                                    <option value="">Tất cả</option>
                                                        @foreach ($c_seats as $c_seat)
                                                            <option 
                                                            @if(Request::get('type') && Request::get('type') == $c_seat->number) selected
                                                            @endif
                                                            value="{{$c_seat->number}}">{{$c_seat->number}} chỗ</option>
                                                        @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" class="slstitle">Hãng xe</label>
                                            <div class="line-form">
                                                <select class="bs-select form-control"  id="filterCarByMake">
                                                    <option value="">Tất cả</option>
                                                        @foreach ($makes as $make)
                                                            <option 
                                                            @if(Request::get('makeBy') && Request::get('makeBy') == $make->code) selected
                                                            @endif
                                                            value="{{$make->code}}">{{$make->name}}</option>
                                                        @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </form>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="list-result">
                            @if (count($carResults) > 0)
                            <ul>
                                @foreach ($carResults as $car)
                                    <li class="col-md-6 col-sm-6 col-xs-6">
                                        <a href="{{URL::to('/car/'.$car->slug)}}">
                                            <div class="car-item">
                                                    <div class="car-item-image">
                                                        <img src="{{asset('uploads/'.$car->thumbnail)}}" alt="Vĩnh Tín AUTO - Thuê xe sân bay Nội bài, xe tự lái giá rẻ">
                                                        @if (isset($car->promotion_costs))
                                                        <span class="label-pos"><span class="car-discount">Giảm {{intval((1-$car->promotion_costs/$car->costs)*100)}}%</span></span>
                                                        @endif
                                                    </div>
                                                    <div class="desc-car-item">
                                                        <div class="group-inline">
                                                            <h3>{{$car->name}}</h3>
                                                            <div class="car-price">
                                                                    @if (isset($car->promotion_costs))
                                                                    <span class="real">{{$car->costs}}K</span>                                    
                                                                    <span class="special">{{$car->promotion_costs}}K</span>                                    
                                                                    @else
                                                                    <span class="special">{{$car->costs}}K</span>                                    
                                                                    @endif
                                                            </div>
                                                        </div>
                                                        <div class="group-label"><span>{{getNameTransmission($car->transmission)}}</span><span>Giao xe tận nơi</span></div>
                                                        <div class="group-label location">
                                                                <p><i class="fas fa-map-marked-alt"></i></i>{{$infoSystemCf->address}}</p>
                                                        </div>
                                                        
                                                    </div>
                                                    
                                            </div>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                            @else
                            <div class="no-cars-result">
                                <h4>Không tìm thấy xe phù hợp !</h4>
                            </div>
                            @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="fixed-mb-filter-box">
            <div class="tab-box">
                <a id="f-filter" data-toggle="modal" data-target="#modalMbFilter">
                    <i class="fas fa-stream"></i> Bộ lọc
                </a>
            </div>
        </div>
    </div> 

    {{-- MOBILE MODAL --}}
    <div id="modalMbFilter" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">×</button>
                        </div>
                        <div class="modal-body">
                            <div class="form_container">
                                <h3 class="modal-title">Bộ lọc</h3>
                                <form action="#" class="form-horizontal" role="form">
                                        <div class="form-group">
                                            <label class="control-label" class="slstitle">Sắp xếp</label>
                                            <div class="line-form">
                                                <select class="bs-select form-control"  id="mbFilterCarSortBy">
                                                    <option value="">Tối ưu</option>
                                                    <option {{ Request::get('sortBy') && Request::get('sortBy') == 'asc' ? 'selected' : ''}} value="asc">Ưu tiên giá thấp</option>
                                                    <option {{ Request::get('sortBy') && Request::get('sortBy') == 'desc' ? 'selected' : ''}} value="desc">Ưu tiên giá cao</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" class="slstitle">Mức giá</label>
                                            <div class="line-form">
                                                <div id="mbRangeCarCosts"></div>
                                                <p id="mbAmountCarCosts" style="border:0; color:#00a550; font-weight:bold;"></p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" class="slstitle">Loại xe (số chỗ)</label>
                                            <div class="line-form">
                                                <select class="bs-select form-control"  id="mbFilterCarType">
                                                    <option value="">Tất cả</option>
                                                        @foreach ($c_seats as $c_seat)
                                                            <option 
                                                            @if(Request::get('type') && Request::get('type') == $c_seat->number) selected
                                                            @endif
                                                            value="{{$c_seat->number}}">{{$c_seat->number}} chỗ</option>
                                                        @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" class="slstitle">Hãng xe</label>
                                            <div class="line-form">
                                                <select class="bs-select form-control"  id="mbFilterCarByMake">
                                                    <option value="">Tất cả</option>
                                                        @foreach ($makes as $make)
                                                            <option 
                                                            @if(Request::get('makeBy') && Request::get('makeBy') == $make->code) selected
                                                            @endif
                                                            value="{{$make->code}}">{{$make->name}}</option>
                                                        @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group modal-footer">
                                            <button id="btnMbApplyFilter" type="button" class="btn btn-success"><i class="fas fa-sync-alt"></i> Áp dụng </button>
                                        </div>
                                </form>
                            </div>
                        </div>
                </div>
            </div>
        </div>
@endsection

@section('script-client')
<script src="{{asset('js/client/car-filter.js')}}" type="text/javascript"></script>
@endsection
