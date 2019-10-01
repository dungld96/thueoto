        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">×</button>
        </div>
        <div class="modal-body">
            <div class="form_container">
                <form id="editInfoForm">
                    {{csrf_field()}}
                    <h2>Cập nhật thông tin</h2>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="far fa-user"></i></span>
                            <input type="text" name="name" value="{{$user->name}}" class="form-control input-lg" placeholder="Tên hiển thị"  autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fas fa-calendar-alt"></i></span>
                            <input type="text" name="birthday" value="{{$user->birthday}}" class="form-control input-lg" autocomplete="off" id="birthday">
                        </div>
                    </div>
                     <div class="form-group">
                        <div class="input-group">
                            
                            <select class="bs-select form-control input-lg" name="sex">
                                <option @if($user->sex == 'm') selected @endif value="m">Nam</option>
                                <option @if($user->sex == 'f') selected @endif value="f">Nữ</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" id="btnUpdateInfoAccout" class="btn btn-success btn-lg btn-block">Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>

<script src="{{asset('js/client/_edit_account.js')}}" type="text/javascript"></script>
        
