$(document).ready(function() {
    $('#btnSubmitLogin').on('click',function(e) {
        console.log('cc');
        e.preventDefault();
        if (validate_form()) {
            $.ajax({
                url: site_url + '/login/check',
                type: 'POST',
                data: $('#login_form').serialize(),
                dataType: 'json',
                success: function(result) {
                    if (result.error) {
                        alert(result.msg);
                    } else {
                        window.location.href = window.location.search;
                    }
                }
            });
        }
    });
});