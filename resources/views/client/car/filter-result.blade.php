@extends('layout.client.client')
@section('title', 'Danh sách xe cho thuê')
@section('content')
    <div class="section filter-result bg-gray">
        <div class="container">
            <div class="result-header">
                <div class="tab-mode">
                    <p class="list-result-title"> <i class="far fa-list-alt"></i>Danh sách</p>
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
                                                    </div>
                                                    <div class="desc-car-item">
                                                        <div class="car-price">{{$car->costs}}K</div>
                                                        <h3>{{$car->name}}</h3>
                                                        <div class="location">
                                                            <p><i class="fas fa-map-marked-alt"></i></i>Hoàn Kiếm, Hà Nội</p>
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
    </div>  
@endsection

@section('script-client')
<script src="{{asset('js/client/car-filter.js')}}" type="text/javascript"></script>
@endsection
