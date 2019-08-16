$(document).ready(function() {
    $('#adChangePwForm').submit(function(e) {
        e.preventDefault();
        var current_password = $('input[name=current_password]').val().trim();
        var password = $('input[name=password]').val().trim();
        var password_confirm = $('input[name=password_confirm]').val().trim();
        if (password != password_confirm) {
            toastr.error('Xác nhận mật khẩu không chính xác!')
            return false;
        }
        let valid = $('#adChangePwForm').valid();
        if (valid) {
            $.ajax({
                url: BASE_URL + '/admin/users/updatepassword',
                type: 'POST',
                data: $('#adChangePwForm').serialize(),
                dataType: 'json',
                success: function(result) {
                    if (result.status == 'success') {
                        toastr.success("Bạn đã đổi mật khẩu thành công");
                        setTimeout(() => {
                            window.location.href = "/admin/dashboard";
                        }, 1000);
                    } else {
                        toastr.error(result.message);
                    }
                },
                error: function(e) {
                    console.log(e);
                    // let errors = e.responseJSON.errors;
                    // if (errors && errors.password) {
                    //     toastr.error(errors.password[0]);
                    // }
                }
            });
        }
    });

    $('#adChangePwForm').validate({
        errorElement: 'span', //default input error message container
        errorClass: 'help-block help-block-error', // default input error message class
        focusInvalid: true, // do not focus the last invalid input
        rules: {
            current_password: {
                required: true
            },
            password: {
                minlength: 6,
                required: true
            },
            password_confirm: {
                minlength: 6,
                equalTo: "#password"
            }
        },
        messages: {
            current_password: {
                required: "Mật khẩu hiện tại không được để trống",
            },
            password: {
                required: "Mật khẩu mới không được để trống",
                minlength: "Mật khẩu mới phải từ 6 ký tự trở lên",
            },
            password_confirm: {
                minlength: "Xác nhận mật khẩu phải từ 6 ký tự trở lên",
                equalTo: "Mật khẩu xác nhận chưa đúng",
            },

        },
        errorPlacement: function(error, element) { // render error placement for each input type
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
        highlight: function(element) { // hightlight error inputs
            $(element)
                .closest('.form-group').addClass('has-error'); // set error class to the control group
        },

        unhighlight: function(element) { // revert the change done by hightlight
            $(element)
                .closest('.form-group').removeClass('has-error'); // set error class to the control group
        },
    });
});