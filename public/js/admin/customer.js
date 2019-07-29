$(document).ready(function() {
    $('body').on('click', '.btnViewCustomer', function(ev) {
        ev.preventDefault();
        let id = $(this).data("id");
        target = BASE_URL + "/admin/customer/view/" + id;
        $("#viewCustomer .modal-content").load(target, function() {
            $("#viewCustomer").modal("show");
        });
    });

    $('#viewCustomer').on('hidden.bs.modal', function() {
        $("#viewCustomer .modal-content").html('');
    });

    $('body').on('click', '.btnDeleteCustomer', function(ev) {
        ev.preventDefault();
        let id = $(this).data("id");
        let url = BASE_URL + "/admin/customer/delete/" + id;
        let cf = confirm("Bạn có chắc muốn xóa khách hàng đã chọn!");
        if (cf) {
            $.ajax({
                type: "get",
                url: url,
                success: function(rs) {
                    if (rs.status == 'success') {
                        toastr.success(rs.message);
                        var oTable = $('#CustomerTable').dataTable();
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