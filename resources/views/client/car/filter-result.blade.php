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
                                                <select class="bs-select form-control">
                                                    <option>Tối ưu</option>
                                                    <option>Ưu tiên khoảng cách</option>
                                                    <option>Ưu tiên giá thấp</option>
                                                    <option>Ưu tiên giá cao</option>
                                                </select>
                                            </div>
                                        </div>
                                    </form>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="list-result">
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
                    </div>
                </div>
            </div>
        </div>
    </div>  
@endsection

@section('script-client')
<script src="{{asset('js/client/booking-detail.js')}}" type="text/javascript"></script>
@endsection
