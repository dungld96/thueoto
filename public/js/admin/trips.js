const BASE_URL = window.location.origin;
$(document).ready(function() {
    $('body').on('click', '.btnViewTrip', function(ev) {
        ev.preventDefault();
        let id = $(this).data("id");
        target = BASE_URL + "/admin/trips/view/" + id;
        $("#modelTrip .modal-content").load(target, function() {
            $("#modelTrip").modal("show");
        });
    });

    $('body').on('click', '.btnActionTrip', function(ev) {
        ev.preventDefault();
        let id = $(this).data("id");
        target = BASE_URL + "/admin/trips/action/" + id;
        $("#modelAction .modal-content").load(target, function() {
            $("#modelAction").modal("show");
        });
    });

    $('body').on('click', '#btnSaveAction', function(ev) {
        ev.preventDefault();
        let id = $(this).data("id");
        let action = $('#selectTripAction').val();
        if (action) {
            let url = BASE_URL + "/admin/trips/" + action + '/' + id;
            $.ajax({
                type: "get",
                url: url,
                success: function(rs) {
                    if (rs.status == 'success') {
                        toastr.success(rs.message);
                        $('#modelAction').modal('hide');
                        var oTable = $('#TripsTable').dataTable();
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

    $('body').on('click', '.btnDeleteTrip', function(ev) {
        ev.preventDefault();
        let id = $(this).data("id");
        let url = BASE_URL + "/admin/trips/delete/" + id;
        let cf = confirm("Bạn có chắc muốn xóa chuyến xe này!");
        if (cf) {
            $.ajax({
                type: "get",
                url: url,
                success: function(rs) {
                    if (rs.status == 'success') {
                        toastr.success("Xóa chuyến xe thành công");
                        var oTable = $('#TripsTable').dataTable();
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


    $('#modelTrip').on('hidden.bs.modal', function() {
        $("#modelTrip .modal-content").html('');
    });
    $('#modelAction').on('hidden.bs.modal', function() {
        $("#modelAction .modal-content").html('');
    });


});