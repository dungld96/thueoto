$(document).ready(function () {
    var date = moment();

    function start_date_change(date) {
        $('#start_date span').html(date.format('DD/MM/YYYY'));
        $('#end_date span').html(date.format('DD/MM/YYYY'));
    }

    function end_date_change(date) {
        $('#end_date span').html(date.format('DD/MM/YYYY'));
    }

    $('#start_date').daterangepicker({
        singleDatePicker: true,
        minDate: new Date()
    }, start_date_change);

    $('#end_date').daterangepicker({
        singleDatePicker: true,
        minDate: new Date()
    }, end_date_change);

    $('#start_date span').on('apply.daterangepicker', function (ev, picker) {
        $('#end_date span').daterangepicker({
            locale: { "format": "DD/MM/YYYY" },
            singleDatePicker: true,
            minDate: $('#start_date span').text()
        }, end_date_change);
    });

    start_date_change(date);

    end_date_change(date);

    $('input[name=place]').on('focus', function () {
        $(this).val('');
    });

    $('input[name=place]').on('input', function () {
        var text = $(this).val();
        if (text == '') {
            $('.place_result').remove();
            return;
        }
        placesSuggest(text);
    });
    
    let startTime = "00:00:00";
    let endTime = "00:00:00";
    let startDate = $('#start_date span').html();
    let endDate = $('#end_date span').html();

    $('#startTime').on('change', function() {
        startTime = this.value;
    });

    $('#endTime').on('change', function() {
        endTime = this.value;
    });

    $('.search_form .btn_search').on('click', function () {
        let address = $('input[name=place]').val();
        let starDateTime = moment(startDate + " " +  startTime, "MM/DD/YYYY HH:mm:ss").valueOf();
        let endDateTime = moment(endDate + " " +  endTime, "MM/DD/YYYY HH:mm:ss").valueOf();
        window.location.href = `/filter?startDate=${starDateTime}&endDate=${endDateTime}&address=${address}`;
    });
    

    var swiper = new Swiper('.swiper-container', {
        slidesPerView: 4,
        spaceBetween: 25,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        breakpoints: {
            1024: {
                slidesPerView: 4,
                spaceBetween: 40,
            },
            768: {
                slidesPerView: 3,
                spaceBetween: 30,
            },
            640: {
                slidesPerView: 2,
                spaceBetween: 20,
            },
            320: {
                slidesPerView: 1,
                spaceBetween: 10,
            }
        }
    });


});