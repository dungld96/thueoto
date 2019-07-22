@extends('layout.client.client')
@section('content')
    <div class="section list-mytrips bg-gray">
            <div class="mytrips-header">
                <div class="container">
                    <div class="tab-mode">
                        <p class="mytrips-title"> <i class="fas fa-history"></i>Lịch sử chuyến</p>
                    </div>
                </div>
            </div>
            <div class="mytrips-content">
                <div class="container">
                    @if ($myTrips->count() > 0)
                    <div class="has-trips">
                            @foreach ( $myTrips as $trip )
                                <div class="trip-box">
                                    <div class="trip-header">
                                        <h4 class="car-name">
                                            {{$trip->carName}}
                                        </h4>
                                    </div>
                                    <div class="trip-body">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="car-image">
                                                    <a href="{{URL::to('/trip/detail/'.$trip->tripCode)}}">
                                                        <div class="thumbnail">
                                                            <img src="{{asset('uploads/'.$trip->carThumbnail)}}" alt="Cho thuê xe tự lái {{$trip->carName}}">
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <p>Bắt đầu: {{$trip->startDate}}</p>
                                                <p>Kết thúc: {{$trip->endDate}}</p>
                                                <p>Tổng tiền {{$trip->sumAmount}}K</p>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="{{URL::to('/trip/detail/'.$trip->tripCode)}}">
                                        <div class="trip-footer">
                                            <div class="trip-status">
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
                                            <div class="time">
                                                @if ($trip->tripTime === 0)
                                                    <p>Hôm nay</p>
                                                @else
                                                    <p>$trip->tripTime ngày trước</p>
                                                @endif
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="no-has-trip">
                            <div style="text-align: center; padding: 5vh 10vh 10vh;">
                                <img src="/images/no-trips.png" class="img-fluid">
                                <p class="margin-top-m">Bạn chưa có chuyến nào, hãy thuê ngay một chiếc xe để trải nghiệm dịch vụ của Vĩnh Tín</p>
                                <a class="btn btn-primary margin-top-m" href="/">Tìm xe ngay</a>
                            </div>
                        </div>
                    @endif
                    
                </div>
            </div>
    </div>  
@endsection

@section('script-client')
@endsection
