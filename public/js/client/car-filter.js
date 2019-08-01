$(document).ready(function() {
    
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