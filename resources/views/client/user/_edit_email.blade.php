        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">×</button>
        </div>
        <div class="modal-body">
            <div class="form_container">
                <form id="editEmailForm">
                    {{csrf_field()}}
                    <h2>Cập nhật email</h2>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fas fa-envelope"></i></span>
                            <input type="text" name="email" value="{{$user->email}}" class="form-control input-lg" placeholder="Email"  autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-lg btn-block">Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>

<script src="{{asset('js/client/_edit_account.js')}}" type="text/javascript"></script>
        
