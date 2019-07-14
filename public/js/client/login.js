$(document).ready(function() {
    $('#login_form').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: BASE_URL + '/login/check',
            type: 'POST',
            data: $('#login_form').serialize(),
            dataType: 'json',
            success: function(result) {
                if (result.status == 'error') {
                    toastr.error(result.message);
                } else {
                    let role = result.role;
                    if (role > 1) {
                        window.location.href = "/admin/dashboard";
                    } else {
                        window.location.href = window.location.search;
                    }
                }
            },
            error: function(e) {
                let errors = e.responseJSON.errors;
                if(errors && errors.email){
                    toastr.error(errors.email[0]);
                }
                if(errors && errors.password){
                    toastr.error(errors.password[0]);
                }
            }

        });
    });
});