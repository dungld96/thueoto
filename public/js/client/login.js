$(document).ready(function() {
    $('#btnSubmitLogin').on('click',function(e) {
        e.preventDefault();
        if (validate_form()) {
            $.ajax({
                url: site_url + '/login/check',
                type: 'POST',
                data: $('#login_form').serialize(),
                dataType: 'json',
                success: function(result) {
                    if (result.status == 'error') {
                        toastr.error(result.message);
                    } else {
                        toastr.success(result.message);
                        let role = result.role;
                        setTimeout(() => {
                            if(role > 1){
                                window.location.href = "/admin/dashboard";
                            }else{
                                window.location.href = window.location.search;
                            }
                        }, 1000);
                        
                    }
                }
            });
        }
    });
});