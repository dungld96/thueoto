$(document).ready(function() {
    $('body').on('click', '.btnApproveBooking', function(ev) {
        ev.preventDefault();
        let id = $(this).data("id");
        target = BASE_URL + "/admin/approve/booking/" + id;
        $("#viewBooing .modal-content").load(target, function() {
            $("#viewBooing").modal("show");
        });
    });

    $('body').on('click', '.btnCancelBooking', function(ev) {
        ev.preventDefault();
        let id = $(this).data("id");
        let url = BASE_URL + "/admin/approve/booking/cancel/" + id;
        let cf = confirm("Bạn có chắc muốn hủy chuyến xe này!");
        if (cf) {
            $.ajax({
                type: "get",
                url: url,
                success: function(rs) {
                    if (rs.status == 'success') {
                        toastr.success("Hủy chuyến xe thành công");
                        var oTable = $('#BookingTable').dataTable();
                        oTable.fnDraw(false);
                    } else {
                        toastr.error(rs.message);
                    }
                },
                error: function(e) {
                    alert(e);
                }
            });
        }
    });

    $('#viewBooing').on('hidden.bs.modal', function() {
        $("#viewBooing .modal-content").html('');
    });

    $('body').on('click', '#approveBooking', function(ev) {
        let id = $(this).data("id");
        let url = BASE_URL + '/admin/approve/booking/store/' + id;
        $.ajax({
            type: 'GET',
            url: url,
            success: function(rs) {
                if (rs.status == 'success') {
                    toastr.success("Chuyến xe được duyệt thành công");
                    toastr.info(rs.smsMessage);
                    $('#viewBooing').modal('hide');
                    var oTable = $('#BookingTable').dataTable();
                    oTable.fnDraw(false);
                } else {
                    toastr.error(rs.message);
                }
            },
            error: function(e) {
                alert(e);
            }

        });
    });

});