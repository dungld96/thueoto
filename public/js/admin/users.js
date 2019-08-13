$(document).ready(function() {
    $("a[data-target='#addUser']").on('click',function (ev) {
        ev.preventDefault();

        var target = $(this).attr("data-href");
        // load the url and show modal on success
        $("#modelUser .modal-content").load(target, function () {
            $("#modelUser").modal("show");
        });

    });

    $('body').on('click', '.btnDeleteUser',function (ev) {
        ev.preventDefault();
        var userId = $(this).data("id");
        var cf = confirm("Bạn có chắc muốn xóa tài khoản này!");
        if(cf){
            $.ajax({
                type: "get",
                url: BASE_URL + "/admin/users/deletemod/"+userId,
                success: function (rs) {
                    if(rs.status == 'success'){
                        toastr.success(rs.message);
                        var oTable = $('#UsersTable').dataTable(); 
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
    
    $('body').on('click', '.btnEditUser',function (ev) {
        ev.preventDefault();
        var userId = $(this).data("id");
        target = BASE_URL + "/admin/users/editmod/"+userId,
        $("#modelUser .modal-content").load(target, function () {
            $("#modelUser").modal("show");
        });
    });


    $('#modelUser').on('hidden.bs.modal', function () {
        $("#modelUser .modal-content").html('');
    });

});




