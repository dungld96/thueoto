<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>Vĩnh Tín Auto | @yield('title')</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1" name="viewport"/>
<meta content="" name="description"/>
<meta content="" name="author"/>
<meta name="_token" content="{{csrf_token()}}" />
<link rel="shortcut icon" href="{{asset('favicon.ico')}}"/>
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