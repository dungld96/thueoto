@extends('layout.client.client')
@section('content')
<div class="error-502__container" style="min-height: 100vh;">
        <div class="error-502" style="margin-top: 15%;">
            <div class="error-502__text">
                <h1 style="text-align: center;color: #5d862e;font-size: calc(1.875rem + 1.125 * ((100vw - 30rem)/ 87.5));">Không tìm thấy thông tin <b>:(</b></h1>
                <h2 style="text-align: center;font-size: calc(1.5rem + .75 * ((100vw - 30rem)/ 87.5));"><p>Bạn có thể quay lại <a href="/" style="color: #29abe2;">Trang chủ</a>.</p></h2>
            </div>
        </div>
    </div>
@endsection