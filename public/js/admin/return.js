$(document).ready(function() {
    $('body').on('click', '.btnConfirmReturn', function(ev) {
        ev.preventDefault();
        let id = $(this).data("id");
        let url = BASE_URL + "/admin/trips/end/" + id;
        let cf = confirm("Bạn có chắc muốn xác nhận khách hàng đã trả xe!");
        if (cf) {
            $.ajax({
                type: "get",
                url: url,
                success: function(rs) {
                    if (rs.status == 'success') {
                        toastr.success(rs.message);
                        var oTable = $('#ReturnTable').dataTable();
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

});