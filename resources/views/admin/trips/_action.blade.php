<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h4 class="modal-title">Điểu chỉnh chuyến xe #{{$trip->trip_code}}</h4>
    </div>
    <div class="modal-body">
            <form role="form">
                <div class="form-body">
                    <div class="form-group">
                        <label>Hành động</label>
                        <select class="form-control" id="selectTripAction">
                            <option value=''>-- Chọn --</option>
                            <option value='start'>Xác nhận đã giao xe</option>
                            <option value='end'>Xác nhận đã trả xe</option>
                            <option value='cancel'>Hủy chuyến</option>
                        </select>
                    </div>
                </div>
            </form>
    </div>
    <div class="modal-footer">
        <button type="button" data-id="{{$trip->id}}" id="btnSaveAction" class="btn btn-success">Lưu</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
    </div>