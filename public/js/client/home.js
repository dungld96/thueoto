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
   

    
});