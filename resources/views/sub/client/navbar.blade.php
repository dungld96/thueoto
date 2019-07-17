    <nav id="navbar"class="navbar navbar-inverse">
        <div class="container">
            <div class="navbar-header">
                <div class="logo-container">
                    <a class="navbar-brand" href="/">Vĩnh Tín Auto</a>
                </div>
                <div class="header-icon navbar-toggle" aria-expanded="false">
                    <span class="trigger-menu " style="" onclick="openNav()">&#9776;</span>
                </div>
            </div>

            <div class="collapse navbar-collapse" id="vtNavbar">
                <ul class="nav navbar-nav nav-contact">
                    <li><span><i class="fas fa-phone-alt"></i> 08 6869 8682 | 0246 327 8686</span></li>
                    <li><span><i class="fas fa-envelope"></i> vinhtin2069@gmail.com</span></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                        @if (Auth::guest())
                        <li><a id="btnLogin" href="javascript:;" data-href="{{route('user.login.view')}}">Đăng nhập</a></li>
                        <li><a  id="btnRegister" href="{{route('user.signup')}}">Đăng ký</a></li>
                        @endif
                        @if (Auth::check())
                        <li class="dropdown">
                            <span style="cursor: pointer;">
                                <div id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <div class="avatar avatar--s">
                                            <div class="avatar-img" style="background-image: url({{asset('images/avatars/'.strtolower(Auth::user()->name[0]).'.jpg')}});">
                                            </div>
                                        </div>
                                        <div class="snippet">
                                            <div class="item-title">
                                                <span >{{Auth::user()->name}}</span>
                                                {{-- <i class="fas fa-angle-down"></i> --}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <ul>
                                            <li><a href="{{route('user.account')}}">Tài khoản</a></li>
                                            <li><a href="{{route('user.logout')}}">Đăng Xuất</a></li>
                                        </ul>
                                    </div>
                                </span>
                        </li>
                        {{-- <li><a id="btnLogin" href="{{route('user.logout')}}"><i class="fas fa-sign-in-alt"></i> Đăng Xuất</a></li> --}}
                        @endif
                </ul>
            </div>
            <div id="mySidenav" class="menu-wrap">
                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                <ul>
                    @if (Auth::guest())
                    <li><a id="btnLoginMb" href="javascript:;" data-href="{{route('user.login.view')}}">Đăng nhập</a></li>
                    <li><a id="btnRegisterMb" href="{{route('user.signup')}}">Đăng ký</a></li>
                    @endif
                    @if (Auth::check())
                    <li>
                        <div class="mb-snippet">
                            <div class="avatar avatar--m">
                                <div class="avatar-img" style="background-image: url({{asset('images/avatars/'.strtolower(Auth::user()->name[0]).'.jpg')}});">
                                </div>
                            </div>
                            <div class="item-title">
                                <span >{{Auth::user()->name}}</span>
                            </div>
                        </div>
                        <div class="space m"></div>
                        <div class="sideBody">
                            <ul>
                                <li><a href="{{route('user.account')}}">Tài khoản</a></li>
                                <li><a href="{{route('user.logout')}}">Đăng Xuất</a></li>
                            </ul>
                        </div>
                    </li>
                    @endif
                </ul>
                
            </div>
        </div>
    </nav>


    