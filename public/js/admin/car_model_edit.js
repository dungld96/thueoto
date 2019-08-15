$(document).ready(function() {
    let make_code = $('#inpSelectMake').val();
    console.log(make_code);
    $('#makeCode').val(make_code);

    $('#btnAddCModel').click(() => {
        // $('#btnAddCoupon').attr('disabled', 'disabled');
        let valid = $('#carModelForm').valid();
        let coupon = $('#carModelForm').serialize();
        let url = BASE_URL + '/admin/cars/models/store';
        if (valid) {
            $.ajax({
                type: 'POST',
                url: url,
                data: coupon,
                success: function (data) {
                    if (data.status == 'success') {
                        toastr.success(data.message);
                        $('#viewCarModel').modal('hide');
                        var oTable = $('#carModelTable').dataTable();
                        oTable.fnDraw(false);
                    } else {
                        toastr.error(data.message);
                    }
                },
                error: function (e) {
                    alert(e);
                }

            });
        }
    });

    $('#btnUpdateCModel').click(() => {
        // $('#btnUpdateCoupon').attr('disabled', 'disabled');
        let valid = $('#carModelForm').valid();
        let coupon = $('#carModelForm').serialize();
        let url = BASE_URL + '/admin/cars/models/update';
        if (valid) {
            $.ajax({
                type: 'POST',
                url: url,
                data: coupon,
                success: function (data) {
                    if (data.status == 'success') {
                        toastr.success(data.message);
                        $('#viewCarModel').modal('hide');
                        var oTable = $('#carModelTable').dataTable();
                        oTable.fnDraw(false);
                    } else {
                        toastr.error(data.message);
                    }
                },
                error: function (e) {
                    alert(e);
                }

            });
        }
    });

    $('#carModelForm').validate({
        errorElement: 'span', //default input error message container
        errorClass: 'help-block help-block-error', // default input error message class
        focusInvalid: true, // do not focus the last invalid input
        rules: {
            name: {
                minlength: 2,
                required: true
            },
            type: {
                required: true,
            }
        },
        messages: {
            name: {
                required: "Tên không được để trống",
                minlength: "Tên phải từ 2 ký tự trở lên",
            },
            type: {
                required: "Kiểu xe không được để trống",
            }
        },
        highlight: function (element) { // hightlight error inputs
            $(element)
                .closest('.form-group').addClass('has-error'); // set error class to the control group
        },

        unhighlight: function (element) { // revert the change done by hightlight
            $(element)
                .closest('.form-group').removeClass('has-error'); // set error class to the control group
        },
    });
});