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
                        alert(result.message);
                    } else {
                        let role = result.role;
                        if(role > 1){
                            window.location.href = "/admin/dashboard";
                        }else{
                            window.location.href = window.location.search;
                        }
                    }
                }
            });
        }
    });
});