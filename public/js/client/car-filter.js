$(document).ready(function() {
    
    $('body').on('change', '#filterCarSortBy', function (e) {
        let sortby = this.value;
        if (sortby && sortby=='min') {
            window.location.href = window.location.href + '&orderBy=costs&sortBy=asc';
        }
        if (sortby && sortby=='max') {
            window.location.href = window.location.href + '&orderBy=costs&sortBy=desc';
        }
    });
});