$(document).ready(function () {
    $('#configForm').submit(function (e) {
        e.preventDefault();
        let data = $('#configForm').serialize();
        let valid = $('#configForm').valid();
        if (valid) {
            $.ajax({
                url: BASE_URL + '/admin/configs/update',
                type: 'POST',
                data: data,
                dataType: 'json',
                success: function (result) {
                    if (result.status == 'success') {
                        toastr.success("Cập nhật thâm số hệ thống thành công");
                        setTimeout(() => {
                            window.location.href = window.location.href;
                        }, 1000);
                    } else {
                        toastr.error(result.message);
                    }
                },
                error: function (e) {
                    console.log(e);
                    // let errors = e.responseJSON.errors;
                    // if (errors && errors.password) {
                    //     toastr.error(errors.password[0]);
                    // }
                }
            });
        }
    });

    $('#configForm').validate({
        errorElement: 'span', //default input error message container
        errorClass: 'help-block help-block-error', // default input error message class
        focusInvalid: true, // do not focus the last invalid input
        rules: {
            service_costs: {
                required: true
            },
            address: {
                required: true
            },
            api_key: {
                required: true

            },
            secret_key: {
                required: true

            }
        },
        messages: {
            service_costs: {
                required: "Phí dịch vụ không được để trống",
            },
            address: {
                required: "Địa chỉ không được để trống",
            },

            api_key: {
                required: "Api key esms không được để trống",
            },

            secret_key: {
                required: "Secret key esms không được để trống",
            },
            errorPlacement: function (error, element) { // render error placement for each input type
                if (element.parent(".input-group").size() > 0) {
                    error.insertAfter(element.parent(".input-group"));
                } else if (element.attr("data-error-container")) {
                    error.appendTo(element.attr("data-error-container"));
                } else if (element.parents('.radio-list').size() > 0) {
                    error.appendTo(element.parents('.radio-list').attr("data-error-container"));
                } else if (element.parents('.radio-inline').size() > 0) {
                    error.appendTo(element.parents('.radio-inline').attr("data-error-container"));
                } else if (element.parents('.checkbox-list').size() > 0) {
                    error.appendTo(element.parents('.checkbox-list').attr("data-error-container"));
                } else if (element.parents('.checkbox-inline').size() > 0) {
                    error.appendTo(element.parents('.checkbox-inline').attr("data-error-container"));
                } else {
                    error.insertAfter(element); // for other inputs, just perform default behavior
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
        }
    });
});