$(document).ready(function () {
	$("#owl-album_car_detail").owlCarousel({
		slideSpeed : 300,
		paginationSpeed : 400,
		singleItem:true,
		navigation : true, 
		navigationText: [
			"<i class='carousel-control-prev-icon'></i>",
			"<i class='carousel-control-next-icon'></i>"
		],
	});

	var date = moment();
	$.fn.digits = function(){
		return this.each(function(){
			$(this).text( $(this).text().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.") );
		})
	}
	function start_date_change(date) {
		var element = $('.start_date .date');
		element.html(date.format('DD/MM/YYYY'));
		end_date_change(date);
	}
	function end_date_change(date) {
		var element = $('.end_date .date');
		element.html(date.format('DD/MM/YYYY'));
	}
	$('select.time').on('change', function() {
		$('.error_end_date').addClass('hidden');
		update_datetime();
	});
	function update_datetime() {
		var start_date = $('.start_date .date').text();
		var start_time = $('.start_date .time').val();

		var end_date = $('.end_date .date').text();
		var end_time = $('.end_date .time').val();

		var start_timestamp = toTimestamp(start_date, start_time);
		var end_timestamp = toTimestamp(end_date, end_time);

		$('input[name=start_date]').val(start_timestamp);
		$('input[name=end_date]').val(end_timestamp);

		var start = moment(start_date, 'DD/MM/YYYY');
		var end   = moment(end_date, 'DD/MM/YYYY');
		var diff = end.diff(start, 'days') + 1;
		$('input[name=days]').val(diff);
		$('.days').text(diff + ' ngày');

		var discount = $('input[name=coupon_discount]').val();
		var amount = $('span.amount').text().replace(/[^\d]/g, "");
		var sum_amount = amount * diff;
		if(discount && discount>0){
			sum_amount = sum_amount-discount*1000;
		}
		$('span.sum_amount').text(sum_amount).digits();
	}
	$('.start_date .date').daterangepicker({
		singleDatePicker: true,
		minDate: new Date()
	}, start_date_change);
	$('.end_date .date').daterangepicker({
		singleDatePicker: true,
		minDate: new Date()
	}, end_date_change);
	$('.start_date .date').on('apply.daterangepicker', function(ev, picker) {
		$('.end_date .date').daterangepicker({
			locale: { "format": "DD/MM/YYYY" },
			singleDatePicker: true,
			minDate: $('.start_date .date').text()
		}, end_date_change);
		$('.end_date .date').on('apply.daterangepicker', function(ev, picker) {
			update_datetime();
		});
		update_datetime();
	});
	$('.end_date .date').on('apply.daterangepicker', function(ev, picker) {
		update_datetime();
	});
	start_date_change(date);
	end_date_change(date);
	update_datetime();
	$('input[name=address]').on('input', function() {
		var text = $(this).val();
		if (text == '') {
			$('.place_result').remove();
			return;
		}
		placesSuggest(text);
	});
	$('input[name=address]').on('focus', function() {
		$('.error_address').addClass('hidden');
	});


	$('#booking_form').submit(function(e) {
		e.preventDefault();
		var start_date = $('input[name=start_date]').val();
		var end_date = $('input[name=end_date]').val();
		if (end_date <= start_date) {
			$('.error_end_date').removeClass('hidden');
			return;
		}
		if ($('input[name=address]').val().trim() == '') {
			$('.error_address').removeClass('hidden');
			return;
		}
		$.ajax({
			url: BASE_URL + '/car/booking',
			type: 'POST',
			data: $('#booking_form').serialize(),
			dataType: 'json',
			success: function(result) {
				if (result.status == 'error') {
					switch (result.error) {
						case 'no-auth':
							let target = BASE_URL + '/login/view';
							$("#loginModal .modal-content").load(target, function () {
								$("#loginModal").modal("show");
							});
							$('#loginModal').modal('show');
							break;

						case 'no-phone-number':
							$("#notifiModal .modal-content").html(result.html);
							$('#notifiModal').modal('show');
							$('[data-toggle="tooltip"]').tooltip();
							break;
					
						case 'booked':
							toastr.error(result.message);
							break;

						case 'has_promo':
							toastr.error(result.message);
							break;

						default:
							console.log(result.message)
							break;
					}
				} else {
					$('#confirmBookingModal .modal-content').html(result.html);
					$('#confirmBookingModal').modal('show');
					$('[data-toggle="tooltip"]').tooltip();
				}
			}
		});
	});

	$('#useCoupon').on('click', function (e) {
		e.preventDefault();
        target = BASE_URL + "/coupon/my-coupons",
        $("#useCouponModel .modal-content").load(target, function() {
            $("#useCouponModel").modal("show");
        });
	});

	$('body').on('click', '.applyCoupon',function (ev) {
        console.log('checkCoupon');
        let couponId = $(this).data("id");
        let url = BASE_URL + '/coupon/check-coupon/' + couponId;
        $.ajax({
            type: 'GET',
            url: url,
            success: function (data) {
                if (data.status == 'success') {
					let coupon = data.coupon;
					$("#useCouponModel").modal("hide");
					$('input[name=coupon_code]').val(coupon.code);
					let amount = $('span.sum_amount').text().replace(/[^\d]/g, "");
					let discount = (amount*coupon.discount_amount)/100;
					if(coupon.max_discount && discount >= coupon.max_discount){
						discount = coupon.max_discount
					}
					$('input[name=coupon_discount]').val(discount);
					$('#booking_form .group-get-amount').append(
						`<div class="group">
							<p>Khuyến mãi mã <span class="in-dam">${coupon.code}</span></p>
							<p>-${discount}.000</p>
						</div>`
					);
					$('span.sum_amount').text(amount-discount*1000).digits();
                } else {
                    toastr.error(data.message);
                }
            },
            error: function (e) {
                alert(e);
            }

        });
    });

});
