$(document).ready(function() {
    initSearchAdressDaterange();

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

    $('body').on('change', '#filterCarType', function (e) {
        let type = this.value;
        if(type){
            window.location.search = $.query.set('type', type);
        }else{
            if($.query.get('type')){
                window.location.search =  $.query.REMOVE('type');
            }
        }
    });

    $('body').on('click', '#btnMbApplyFilter', function (e) {
        let sortBy = $('#mbFilterCarSortBy').val();
        let makeBy = $('#mbFilterCarByMake').val();
        let type = $('#mbFilterCarType').val();
        let costsRange = $("#mbRangeCarCosts").slider('value');
        let query = $.query;

        if(sortBy){
            query = query.set('orderBy', 'costs').set('sortBy', sortBy);
        }else{
            if(query.get('orderBy') && query.get('sortBy')){
                query.REMOVE('orderBy').REMOVE('sortBy');
            }
        }

        if(makeBy){
            query = query.set('makeBy', makeBy);
        }else{
            if(query.get('makeBy')){
                query.REMOVE('makeBy');
            }
        }

        if(type){
            query = query.set('type', type);
        }else{
            if(query.get('type')){
                query.REMOVE('type');
            }
        }

        if(costsRange){
            if(costsRange == 3001){
                if(query.get('costsRange')){
                    query.REMOVE('costsRange');
                }
            }else{
                query = query.set('costsRange', costsRange);
            }
        }
        console.log(query.toString());
        window.location.search = query;
    });

    $('#dropdownMbFilterHeader').on('click', function (e) {
        let submenuitem = $('#dropdown-menu-address-daterange');
        let display = $('#dropdown-menu-address-daterange').css('display');
        if( display == 'none' ){
            submenuitem.show(500);
        }else{
            submenuitem.hide(500);
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

    $( "#mbRangeCarCosts" ).slider({
        range: "min",
        min: 100,
        max: 3001,
        create: function() {
            let valueUrl = $.query.get('costsRange');
            if(valueUrl){
                $("#mbRangeCarCosts").slider('value', valueUrl);
                $( "#mbAmountCarCosts" ).html( "< " + valueUrl + "K/Ngày");
            }else{
                $("#mbRangeCarCosts").slider('value', 3001);
                $( "#mbAmountCarCosts" ).html( "Tất cả giá");
            }
        },
        slide: function( event, ui ) {
            $( "#mbAmountCarCosts" ).html( "< " + ui.value + "K/Ngày");
            if(ui.value == 3001){
                $( "#mbAmountCarCosts" ).html( "Tất cả giá");
            }
        }
    });

});

function initSearchAdressDaterange() {
    var date = moment();
    let startTime = "00:00:00";
    let endTime = "00:00:00";
    let startDate = $.query.get('startDate');
    let endDate = $.query.get('endDate');
    let address = $.query.get('address');


    if(address){
        $('input[name=place]').val(address);
        $('input[name=place]').attr('title', address);
        $('#mb-plade').html(address);
    }

    if(startDate){
        startTime = moment.unix(startDate).format('HH:mm:ss');
        startDate = moment.unix(startDate).format('DD/MM/YYYY');
        $('.start_date span').html(startDate);
        $('.start_date .time').val(startTime);
        $('#mb-start-date').html(startDate);
        $('#mb-start-time').html(startTime);
    }

    if(endDate){
        endTime = moment.unix(endDate).format('HH:mm:ss');
        endDate = moment.unix(endDate).format('DD/MM/YYYY');
        $('.end_date span').html(endDate);
        $('.end_date .time').val(endTime);
        $('#mb-end-date').html(endDate);
        $('#mb-end-time').html(endTime);
    }

    function start_date_change(date) {
        $('.start_date span').html(date.format('DD/MM/YYYY'));
        $('.end_date span').html(date.format('DD/MM/YYYY'));
        startDate = date.format('DD/MM/YYYY');
        endDate = date.format('DD/MM/YYYY');
        search();
    }

    function end_date_change(date) {
        $('.end_date span').html(date.format('DD/MM/YYYY'));
        endDate = date.format('DD/MM/YYYY');
        search();
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
        search();
    });

    $('.end_date .time').on('change', function() {
        endTime = this.value;
        search();
    });

    function search() {
        let starDateTime = moment(startDate + " " +  startTime, "DD/MM/YYYY HH:mm:ss").unix();
        let endDateTime = moment(endDate + " " +  endTime, "DD/MM/YYYY HH:mm:ss").unix();
        window.location.search =  $.query.set('startDate', starDateTime).set('endDate', endDateTime);
    }
}