$(document).ready(function () {
    var date = moment();
    let startTime = "00:00:00";
    let endTime = "00:00:00";
    let startDate = $('#start_date span').html();
    let endDate = $('#end_date span').html();

    function start_date_change(date) {
        $('#start_date span').html(date.format('DD/MM/YYYY'));
        $('#end_date span').html(date.format('DD/MM/YYYY'));
        startDate = date.format('DD/MM/YYYY');
        endDate = date.format('DD/MM/YYYY');
    }

    function end_date_change(date) {
        $('#end_date span').html(date.format('DD/MM/YYYY'));
        endDate = date.format('DD/MM/YYYY');
    }

    $('#start_date').daterangepicker({
        singleDatePicker: true,
        minDate: new Date()
    }, start_date_change);

    $('#end_date').daterangepicker({
        singleDatePicker: true,
        minDate: new Date()
    }, end_date_change);

    $('#start_date').on('apply.daterangepicker', function (ev, picker) {
        $('#end_date').daterangepicker({
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

    $('#startTime').on('change', function() {
        startTime = this.value;
    });

    $('#endTime').on('change', function() {
        endTime = this.value;
    });

    $('.search_form .btn_search').on('click', function () {
        let address = $('input[name=place]').val().trim();
        console.log(moment(startDate + " " +  startTime, "DD/MM/YYYY HH:mm:ss"))
        console.log(moment(endDate + " " +  endTime, "DD/MM/YYYY HH:mm:ss"))
        let starDateTime = moment(startDate + " " +  startTime, "DD/MM/YYYY HH:mm:ss").unix();
        let endDateTime = moment(endDate + " " +  endTime, "DD/MM/YYYY HH:mm:ss").unix();
        // if(!address){
        //     toastr.error('Bạn phải nhập điạ điểm để tìm kiếm');
        //     return;
        // }
        window.location.href = `/car/filter?startDate=${starDateTime}&endDate=${endDateTime}&address=${address}`;
    });
   
    $(window).on('scroll', function() {
        animateCounters();
    });

    var animateCounters = function animateCounters() {
        $('.rn-counter-item').each(function() {
            var countUpItem = $(this);
            console.log(countUpItem.isInViewport());
            console.log(countUpItem.prop('animated'));
            if (countUpItem.isInViewport() && !countUpItem.prop('animated')) {
                countUpItem.prop('animated', true).find('.rn-counter-number').prop('Counter', 0).animate({
                    Counter: parseInt(countUpItem.text())
                }, {
                    duration: 4000,
                    easing: 'swing',
                    step: function step(now) {
                        $(this).text(Math.ceil(now));
                    }
                });
            }
        });
    };

    $.fn.isInViewport = function() {
        var $this = $(this),
            elementTop = $this.offset().top,
            elementBottom = elementTop + $this.outerHeight(),
            $window = $(window);
        var viewportTop = $window.scrollTop();
        var viewportBottom = viewportTop + $window.height();
        return elementBottom > viewportTop && elementTop < viewportBottom;
    };
    
});