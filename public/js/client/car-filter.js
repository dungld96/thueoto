$(document).ready(function() {
    
    var date = moment();
    let startTime = "00:00:00";
    let endTime = "00:00:00";
    let startDate = $.query.get('startDate');
    let endDate = $.query.get('endDate');
    let address = $.query.get('address');


    if(address){
        $('input[name=place]').val(address);
    }

    if(startDate){
        $('.start_date span').html(moment.unix(startDate).format('DD/MM/YYYY'));
        $('.start_date .time').val(moment.unix(startDate).format('HH:mm:ss'));
    }

    if(endDate){
        $('.end_date span').html(moment.unix(endDate).format('DD/MM/YYYY'));
        $('.end_date .time').val(moment.unix(endDate).format('HH:mm:ss'));
    }

    function start_date_change(date) {
        $('.start_date span').html(date.format('DD/MM/YYYY'));
        $('.end_date span').html(date.format('DD/MM/YYYY'));
        startDate = date.format('DD/MM/YYYY');
        endDate = date.format('DD/MM/YYYY');
    }

    function end_date_change(date) {
        $('.end_date span').html(date.format('DD/MM/YYYY'));
        endDate = date.format('DD/MM/YYYY');
    }

    $('.start_date .date').daterangepicker({
        singleDatePicker: true,
        minDate: new Date()
    }, start_date_change);

    $('.end_date .date').daterangepicker({
        singleDatePicker: true,
        minDate: new Date()
    }, end_date_change);

    $('.start_date span').on('apply.daterangepicker', function (ev, picker) {
        $('.end_date span').daterangepicker({
            locale: { "format": "DD/MM/YYYY" },
            singleDatePicker: true,
            minDate: $('.start_date span').text()
        }, end_date_change);
    });

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

    $('.start_date .time').on('change', function() {
        startTime = this.value;
    });

    $('.end_date .time').on('change', function() {
        endTime = this.value;
    });


    $('body').on('change', '#filterCarSortBy', function (e) {
        let sortby = this.value;
        if(sortby){
            window.location.search = $.query.set('orderBy', 'costs').set('sortBy', sortby);
        }else{
            if($.query.get('orderBy') && $.query.get('sortBy')){
                window.location.search =  $.query.REMOVE('orderBy').REMOVE('sortBy');
            }
        }
    });

    $('body').on('change', '#filterCarByMake', function (e) {
        let makeBy = this.value;
        if(makeBy){
            window.location.search = $.query.set('makeBy', makeBy);
        }else{
            if($.query.get('makeBy')){
                window.location.search =  $.query.REMOVE('makeBy');
            }
        }
    });

    $( "#rangeCarCosts" ).slider({
        range: "min",
        min: 100,
        max: 3001,
        create: function() {
            let valueUrl = $.query.get('costsRange');
            if(valueUrl){
                $("#rangeCarCosts").slider('value', valueUrl);
                $( "#amountCarCosts" ).html( "< " + valueUrl + "K/Ngày");
            }else{
                $("#rangeCarCosts").slider('value', 3001);
                $( "#amountCarCosts" ).html( "Tất cả giá");
            }
        },
        slide: function( event, ui ) {
            $( "#amountCarCosts" ).html( "< " + ui.value + "K/Ngày");
            if(ui.value == 3001){
                $( "#amountCarCosts" ).html( "Tất cả giá");
            }
        },
        stop: function(event, ui) {
            if(ui.value == 3001){
                if($.query.get('costsRange')){
                    window.location.search =  $.query.REMOVE('costsRange');
                }
            }else{
                window.location.search =  $.query.set('costsRange', ui.value);
            }
        }
    });

});