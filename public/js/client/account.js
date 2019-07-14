$(document).ready(function() {
    
    $('#editInfoAcc').on('click',function(e) {
        e.preventDefault();
        target = BASE_URL + "/user/account/editinfo",
        $("#modelEdit .modal-content").load(target, function () {
            $("#modelEdit").modal("show");
        });
    });

    $('#editPhoneNumber').on('click',function(e) {
        e.preventDefault();
        target = BASE_URL + "/user/account/editphonenumber",
        $("#modelEdit .modal-content").load(target, function () {
            $("#modelEdit").modal("show");
        });
    });

    $('#editEmail').on('click',function(e) {
        e.preventDefault();
        target = BASE_URL + "/user/account/editemail",
        $("#modelEdit .modal-content").load(target, function () {
            $("#modelEdit").modal("show");
        });
    });

    $('#modelEdit').on('hidden.bs.modal', function () {
        $("#modelEdit .modal-content").html('');
    });
});