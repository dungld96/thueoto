$(document).ready(function() {

    $('body').on('click', '#btnAddUser', function (e) {
        let valid = $('#adUserForm').valid();
        let userForm = $('#adUserForm').serialize();
        let url = BASE_URL + '/admin/users/storemod';
        if (valid) {
            $.ajax({
                type: 'POST',
                url: url,
                data: userForm,
                success: function (data) {
                    if (data.status == 'success') {
                        toastr.success(data.message);
                        $('#modelUser').modal('hide');
                        var oTable = $('#UsersTable').dataTable();
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

    $('#btnUpdateUser').click(() => {
        // $('#btnUpdateCoupon').attr('disabled', 'disabled');
        let valid = $('#adUserForm').valid();
        let coupon = $('#adUserForm').serialize();
        let url = BASE_URL + '/admin/users/updatemod';
        if (valid) {
            $.ajax({
                type: 'PUT',
                url: url,
                data: coupon,
                success: function (data) {
                    if (data.status == 'success') {
                        toastr.success(data.message);
                        $('#modelUser').modal('hide');
                        var oTable = $('#UsersTable').dataTable();
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


    $('#adUserForm').validate({
        errorElement: 'span', //default input error message container
        errorClass: 'help-block help-block-error', // default input error message class
        focusInvalid: true, // do not focus the last invalid input
        rules: {
            name: {
                minlength: 2,
                required: true
            },
            email: {
                minlength: 2,
                required: true
            },
            phone_number: {
                required: true,
                number: true
            }
        },
        messages: {
            name: {
                required: "Tên hiển không được để trống",
                minlength: "Tên hiển thị phải từ 2 ký tự trở lên",
            },
            email: {
                required: "Email không được để trống",
                minlength: "Email phải từ 2 ký tự trở lên",
            },
            phone_number: {
                required: "Số điện thoại không được để trống",
                number: "Số điện thoại phải dạng chữ số",
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




