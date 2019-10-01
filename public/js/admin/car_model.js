$(document).ready(function() {
    $('body').on('change', '#inpSelectMake', function(ev) {
        var oTable = $('#carModelTable').dataTable();
        oTable.fnDraw(false);
    });

    $("a[data-target='#addCModels']").on('click',function (ev) {
        ev.preventDefault();
        let target = $(this).attr("data-href");
        // load the url and show modal on success
        $("#viewCarModel .modal-content").load(target, function () {
            $("#viewCarModel").modal("show");
        });


    });

    $('body').on('click', '.btnEditCModel',function (ev) {
        ev.preventDefault();
        var cModelId = $(this).data("id");
        target = BASE_URL + "/admin/cars/models/edit/"+cModelId,
        $("#viewCarModel .modal-content").load(target, function () {
            $("#viewCarModel").modal("show");
        });
    });

    $('body').on('click', '.btnDeleteCModel',function (ev) {
        ev.preventDefault();
        var cModelId = $(this).data("id");
        var cf = confirm("Bạn có chắc muốn xóa mẫu xe này!");
        if(cf){
            $.ajax({
                type: "get",
                url: BASE_URL + "/admin/cars/models/delete/"+cModelId,
                success: function (rs) {
                    if(rs.status == 'success'){
                        toastr.success(rs.message);
                        var oTable = $('#carModelTable').dataTable(); 
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

    $('#viewCarModel').on('hidden.bs.modal', function () {
        $("#viewCarModel .modal-content").html('');
    });
});