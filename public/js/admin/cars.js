$(document).ready(function() {
    $("a[data-target='#addCar']").on('click',function (ev) {
        ev.preventDefault();

        var target = $(this).attr("data-href");
        // load the url and show modal on success
        $("#addCar .modal-content").load(target, function () {
            $("#addCar").modal("show");
        });


    });

    $('body').on('click', '.btnDeleteCar',function (ev) {
        ev.preventDefault();
        var carId = $(this).data("id");
        var cf = confirm("Bạn có chắc muốn xóa xe này!");
        if(cf){
            $.ajax({
                type: "get",
                url: BASE_URL + "/admin/cars/delete/"+carId,
                success: function (data) {
                var oTable = $('#carsdata').dataTable(); 
                oTable.fnDraw(false);
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        }
        
    });
    
    $('body').on('click', '.btnEditCar',function (ev) {
        ev.preventDefault();
        var carId = $(this).data("id");
        target = BASE_URL + "/admin/cars/edit/"+carId,
        $("#addCar .modal-content").load(target, function () {
            $("#addCar").modal("show");
        });
    });


    $('#addCar').on('hidden.bs.modal', function () {
        $("#addCar .modal-content").html('');
        if(typeof $images !== 'undefined'){
            $images = undefined;
        }
    });


    
});

