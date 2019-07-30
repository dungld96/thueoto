<!DOCTYPE html>
<html lang="vi">
<head>
<title>Vĩnh Tín Auto - @yield('title')</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
<meta name="viewport" content="width=device-width,height=device-height,initial-scale=1,maximum-scale=1,user-scalable=0"/>
<meta name="robots" content="index, follow">
<meta itemprop="name" content="Vĩnh Tín Auto - Thuê xe sân bay Nội Bài">
<meta name="author" itemprop="author" content="thuexesanbayvinhtin.com">
<meta name="description" content="Thuê xe sân bay Vĩnh Tín với 100+ mẫu xe cho thuê tự lái từ phổ thông đến cao cấp. +300 khách đã thuê xe và hài lòng.
  Xe mới, sạch, đẹp - Đặt xe nhanh chóng từ 5 - 15 phút - Thủ tục đơn giản - Dịch vụ nhiệt tình - Giá cả cạnh tranh từ +450k
  Đa dạng các dòng xe Mini, Sedan, SUV, MPV, Hatchback, Bán tải. Gọi 08 6869 8682 để hỗ trợ đặt xe nhanh nhất."/>
<meta name="keywords" content="Thuê xe tự lái, thuê xe sân bay, thue xe san bay noi bai, xe nội bài, thue xe du lich, cho thue xe tu lai, cho thuê xe tự lái, thue xe oto, Thuê xe tự lái hn, thue xe cuoi, xe tự lái, Cho thuê xe 7 chỗ, thuê xe cưới, xe tu lai, Thuê xe tự lái Hà NỘI, thue xe hoi, Cho thuê xe du lịch 7 chỗ, thuê xe hơi"/>
<meta name="_token" content="{{csrf_token()}}" />
<link rel="alternate" href="https://thuexesanbayvinhtin.com/" hreflang="vi">
<link rel="canonical" href="https://thuexesanbayvinhtin.com/" itemprop="url"/>
<link rel="shortcut icon" href="{{asset('favicon.ico')}}"/>
@yield('custom-style')
@include('sub.client.style')
</head>
    <body cz-shortcut-listen="true">
        <!-- BEGIN HEADER -->
        <div>
            @include('sub.client.navbar')
        </div>
        <!-- END HEADER -->

        <!-- BEGIN BODY -->
        <section class="body">
            @yield('content')
        </section>
        <!-- END BODY -->

        <!-- BEGIN FOOTER -->
        @include('sub.client.footer')
        <!-- END FOOTER -->

        
        @include('sub.client.scripts')

        <div id="loginModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                </div>
            </div>
        </div>

        <div id="notifiModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                </div>
            </div>
        </div>
    </body>
</html>