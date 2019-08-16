@extends('layout.admin.admin')
@section('title', 'Danh sách khách hàng')
@section('style-page')
    <link href="{{asset('assets/global/plugins/dropzone/css/dropzone.css')}}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
    <div class="row content-header">
        <div class="col-md-8">
            <h3 class="page-title">
                Tham số hệ thống
            </h3>
        </div>
        <div class="col-md-4">
           
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="config-content">
                    <form class="form-horizontal" id="configForm">
                            {{csrf_field()}}
    
                            <div class="form-group">
                                <label class="col-md-3 control-label">Phí dịch vụ<span class="required">* </span></label>
                                <div class="col-md-4">
                                        <div class="input-icon right input-group">
                                            <input type="text" class="form-control input-full" name="service_costs" 
                                                placeholder="Phí dịch vụ" value="{{$serviceCostsCf}}"/>
                                            <span class="input-group-addon">.000đ</span>
                                        </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Địa chỉ xe<span class="required">* </span></label>
                                <div class="col-md-9">
                                    <div class="input-icon right">
                                        <input id="address" type="text" class="form-control input-full" name="address" 
                                        placeholder="Địa chỉ" value="{{$infoSystemCf->address}}"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Api Key ESMS<span class="required">* </span></label>
                                <div class="col-md-9">
                                    <div class="input-icon right">
                                        <input id="apiKeyEsms" type="text" class="form-control input-full" name="api_key" 
                                        placeholder="Api Key ESMS" value="{{$esmsKeyCf->api_key}}"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Secret Key ESMS<span class="required">* </span></label>
                                <div class="col-md-9">
                                    <div class="input-icon right">
                                        <input id="secretKeyEsms" type="text" class="form-control input-full" name="secret_key" 
                                        placeholder="Secret Key ESMS" value="{{$esmsKeyCf->secret_key}}"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group text-right" style="margin: 50px 0px;">
                                <a type="button" href="{{route('dashboard')}}" class="btn">Hủy</a>
                                <button type="submit" class="btn btn-primary">Lưu</button>
                            </div>
                    </form>
            </div>
        </div>   
    </div>
   
@endsection
@section('script-admin-custom')
<script src="{{asset('js/admin/config.js')}}" type="text/javascript"></script>
@endsection