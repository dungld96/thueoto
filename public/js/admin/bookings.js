const BASE_URL = window.location.origin;
$(document).ready(function() {
    $('body').on('click', '.btnViewBooking',function (ev) {
        ev.preventDefault();
        var id = $(this).data("id");
        target = BASE_URL + "/admin/booking/view/"+id,
        $("#viewBooing .modal-content").load(target, function () {
            $("#viewBooing").modal("show");
        });
    });


});