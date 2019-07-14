@extends('layout.client.client')
@section('content')
    <div class="section content-account">
        <div class="cover-profile new-profile" style="background-image: url('{{asset('images/car-9.jpg')}}');"></div>
        <div class="content-profile">   
                <div class="container"> 
                    <div class="desc-profile desc-account">
                        <div class="avatar-box">
                            <div class="avatar avatar--xl has-edit">
                                <div class="avatar-img" style="background-image: url({{asset('images/avatars/'.strtolower($user->name[0]).'.jpg')}});"></div>
                            </div>
                        </div>
                        <div class="snippet">
                            <div class="item-title">
                                <p>{{$user->name}}</p><a id="editInfoAcc" class="func-edit" title="Chỉnh sửa"><i class="far fa-edit"></i></a></div>
                            <div class="d-flex"><span class="join">Tham gia: {{$user->created_at}}</span>
                                <div class="bar-line"></div><span class="sum-trips">Chưa có chuyến</span></div>
                            <div class="line-info">
                                <div class="d-flex">
                                    <div class="info">
                                        <span class="label">Ngày sinh </span>
                                        <span class="ctn">{{$user->birthday}}</span>
                                    </div>
                                    <div class="info"><span class="label">Giới tính </span>
                                        <span class="ctn">{{$user->sex == 'm' ? 'Nam' : 'Nữ'}}</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="desc-profile">
                        <div class="information information--acc">
                            <div class="inside">
                                <ul>
                                    <li>
                                        <span class="label">Điện thoại 
                                            <a id="editPhoneNumber" class="func-edit" title="Edit Phone">
                                                <i class="far fa-edit"></i>
                                            </a>
                                        </span>
                                        <span class="ctn">
                                            {{$user->phone_number}}
                                        </span>
                                    </li>
                                    <li>
                                        <span class="label">Email  
                                            <a id="editEmail" class="func-edit" title="Edit Email">
                                                <i class="far fa-edit"></i>
                                            </a>
                                        </span>
                                        <span class="ctn">
                                            {{-- <i class="ic ic-verify"></i>kenjav96@gmail.com --}}
                                            {{$user->email}}
                                              
                                        </span>
                                    </li>
                                    <li>
                                        <span class="label">Facebook</span>
                                        <span class="ctn">
                                            <a class="func-edit"><i class="ic ic-link"></i></a>
                                        </span>
                                    </li>
                                    <li>
                                        <span class="label">Google</span>
                                        <span class="ctn">
                                            <span>Entertainment News 
                                                <span>
                                                    <a class="func-edit"><i class="ic ic-remove"></i></a>
                                                </span> 
                                            </span>
                                        </span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>


    <div id="modelEdit" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
            </div>
        </div>
    </div>
@endsection

@section('script-client')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<script src="{{asset('js/client/account.js')}}" type="text/javascript"></script>

@endsection
