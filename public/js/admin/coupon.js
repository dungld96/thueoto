$(document).ready(function() {
    $("a[data-target='#addCoupon']").on('click',function (ev) {
        ev.preventDefault();

        var target = $(this).attr("data-href");
        // load the url and show modal on success
        $("#viewCoupon .modal-content").load(target, function () {
            $("#viewCoupon").modal("show");
        });


    });

    $('body').on('click', '.btnDeleteCoupon',function (ev) {
        ev.preventDefault();
        var couponId = $(this).data("id");
        var cf = confirm("Bạn có chắc muốn xóa mã khuyến mãi này!");
        if(cf){
            $.ajax({
                type: "get",
                url: BASE_URL + "/admin/coupons/delete/"+couponId,
                success: function (rs) {
                    if(rs.status == 'success'){
                        toastr.success(rs.message);
                        var oTable = $('#couponsTable').dataTable(); 
                        oTable.fnDraw(false);
                    }else{
                        toastr.error(rs.message);
                    }
                },
                error: function (rs) {
                    console.log('Error:', rs);
                }
            });
        }
        
    });
    
    $('body').on('click', '.btnEditCoupon',function (ev) {
        ev.preventDefault();
        var couponId = $(this).data("id");
        target = BASE_URL + "/admin/coupons/edit/"+couponId,
        $("#viewCoupon .modal-content").load(target, function () {
            $("#viewCoupon").modal("show");
        });
    });


    $('#viewCoupon').on('hidden.bs.modal', function () {
        $("#viewCoupon .modal-content").html('');
    });


    
});

