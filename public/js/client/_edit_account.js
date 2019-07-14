$(document).ready(function() {
    $('#birthday').mask("00/00/0000", { placeholder: "__/__/____" });
    $('#editInfoForm').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: BASE_URL + '/user/account/saveinfo',
            type: 'POST',
            data: $('#editInfoForm').serialize(),
            dataType: 'json',
            success: function(result) {
                if(result.status == 'success'){
                    toastr.success('Cập nhật thông tin thành công');
                    location.reload();
                }
            },
            error: function(e) {
            	alert(e.responseText);
            }
        });
    });


    $('#editPhoneForm').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: BASE_URL + '/user/account/savephonenumber',
            type: 'POST',
            data: $('#editPhoneForm').serialize(),
            dataType: 'json',
            success: function(result) {
                if(result.status == 'success'){
                    toastr.success('Cập nhật số điện thoại thành công');
                    location.reload();
                }else{
                    toastr.error(result.message);
                }
            },
            error: function(e) {
                let errors = e.responseJSON.errors;
                if(errors && errors.phone_number){
                    toastr.error(errors.phone_number[0]);
                }
            }
        });
    });

    $('#editEmailForm').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: BASE_URL + '/user/account/saveemail',
            type: 'POST',
            data: $('#editEmailForm').serialize(),
            dataType: 'json',
            success: function(result) {
                if(result.status == 'success'){
                    toastr.success('Cập nhật email thành công');
                    location.reload();
                }else{
                    toastr.error(result.message);
                }
            },
            error: function(e) {
                let errors = e.responseJSON.errors;
                if(errors && errors.phone_number){
                    toastr.error(errors.email[0]);
                }
            }
        });
    });
});