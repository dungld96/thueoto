        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">×</button>
        </div>
        <div class="modal-body">
            <div class="form_container">
                <form id="editPhoneForm">
                    {{csrf_field()}}
                    <h2>Cập nhật số điện thoại</h2>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fas fa-phone-alt"></i></span>
                            <input id="phone_number" type="text" name="phone_number" value="{{$user->phone_number}}" class="form-control input-lg" placeholder="Số điện thoại"  autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" id="btnUpdateInfoAccout" class="btn btn-success btn-lg btn-block">Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>

<script src="{{asset('js/client/_edit_account.js')}}" type="text/javascript"></script>
        
