$(document).ready(function () {
    initDatePicker();

    $('#btnAddCoupon').click(() => {
        // $('#btnAddCoupon').attr('disabled', 'disabled');
        let valid = $('#couponForm').valid();
        let coupon = $('#couponForm').serialize();
        let url = BASE_URL + '/admin/coupons/store';
        if (valid) {
            $.ajax({
                type: 'POST',
                url: url,
                data: coupon,
                success: function (data) {
                    if (data.status == 'success') {
                        toastr.success(data.message);
                        $('#viewCoupon').modal('hide');
                        var oTable = $('#couponsTable').dataTable();
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

    $('#btnUpdateCoupon').click(() => {
        // $('#btnUpdateCoupon').attr('disabled', 'disabled');
        let valid = $('#couponForm').valid();
        let coupon = $('#couponForm').serialize();
        let url = BASE_URL + '/admin/coupons/update';
        if (valid) {
            $.ajax({
                type: 'PUT',
                url: url,
                data: coupon,
                success: function (data) {
                    if (data.status == 'success') {
                        toastr.success(data.message);
                        $('#viewCoupon').modal('hide');
                        var oTable = $('#couponsTable').dataTable();
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

    $('#couponForm').validate({
        errorElement: 'span', //default input error message container
        errorClass: 'help-block help-block-error', // default input error message class
        focusInvalid: true, // do not focus the last invalid input
        rules: {
            code: {
                minlength: 2,
                required: true
            },
            name: {
                minlength: 2,
                required: true
            },
            discount_amount: {
                required: true,
                number: true
            },
            starts_at: {
                required: true
            },
            expires_at: {
                required: true,
            },
            status: {
                required: true,
            },
        },
        messages: {
            code: {
                required: "Mã giảm giá không được để trống",
                minlength: "Mã giảm giá phải từ 2 ký tự trở lên",
            },
            name: {
                required: "Tên không được để trống",
                minlength: "Tên phải từ 2 ký tự trở lên",
            },
            discount_amount: {
                required: "Số phần trăm không được để trống",
                number: "Số phần trăm giảm phải dạng chữ số",
            },
            starts_at: {
                required: "Bắt đầu không được để trống",
            },
            expires_at: {
                required: "Kết thúc không được để trống",
            },
            status: {
                required: "Trạng thái không được để trống",
            },
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

function initDatePicker() {
    let start = $('#startDatePicker input').val();
    let end = $('#startDatePicker input').val();

    $('#startDatePicker').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        minDate: start ? moment(start, "DD-MM-YYYY") : new Date()
    }, onStartDateChange);

    $('#endDatePicker').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        minDate: start ? moment(start, "DD-MM-YYYY") : new Date()
    }, onEndDateChange);

    function onStartDateChange(date) {
        $('#startDatePicker input').val(date.format('DD/MM/YYYY'))
        $('#endDatePicker input').val(date.format('DD/MM/YYYY'))

    }

    function onEndDateChange(date) {
        $('#endDatePicker input').val(date.format('DD/MM/YYYY'))
    }

    $('#startDatePicker').on('apply.daterangepicker', function (ev, picker) {

        $('#endDatePicker').daterangepicker({
            locale: { "format": "DD/MM/YYYY" },
            singleDatePicker: true,
            minDate: $('#startDatePicker input').val()
        }, onEndDateChange);
    });
}