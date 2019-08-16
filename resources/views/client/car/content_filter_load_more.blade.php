@foreach ($carResults as $car)
<li class="col-md-6 col-sm-6 col-xs-6">
        <a href="{{URL::to('/car/'.$car->slug.'?startDate='.Request::get('startDate').'&endDate='.Request::get('endDate'))}}">
            <div class="car-item">
                <div class="car-item-image">
                    <img src="{{asset('uploads/'.$car->thumbnail)}}" alt="Vĩnh Tín AUTO - Thuê xe sân bay Nội bài, xe tự lái giá rẻ"> @if (isset($car->promotion_costs))
                    <span class="label-pos"><span class="car-discount">Giảm {{intval((1-$car->promotion_costs/$car->costs)*100)}}%</span></span>
                    @endif
                </div>
                <div class="desc-car-item">
                    <div class="group-inline">
                        <h3>{{$car->name}}</h3>
                        <div class="car-price">
                            @if (isset($car->promotion_costs))
                            <span class="real">{{$car->costs}}K</span>
                            <span class="special">{{$car->promotion_costs}}K</span> @else
                            <span class="special">{{$car->costs}}K</span> @endif
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