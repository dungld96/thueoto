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

	function initWithFilter() {
		let startDateFilter = $.query.get('startDate');
		let endDateFilter = $.query.get('endDate');

		if(startDateFilter){
			let startTime = moment.unix(startDateFilter).format('HH:mm:ss');
			let startDate = moment.unix(startDateFilter).format('DD/MM/YYYY');
			$('.start_date .date').html(startDate);
			$('.start_date .time').val(startTime);
			$('.start_date .date').data('daterangepicker').setStartDate(moment(startDate, 'DD/MM/YYYY').format('MM/DD/YYYY'));
			$('.start_date .date').data('daterangepicker').setEndDate(moment(startDate, 'DD/MM/YYYY').format('MM/DD/YYYY'));
		}

		if(endDateFilter){
			let endTime = moment.unix(endDateFilter).format('HH:mm:ss');
			let endDate = moment.unix(endDateFilter).format('DD/MM/YYYY');
			$('.end_date .date').html(endDate);
			$('.end_date .time').val(endTime);
			$('.end_date .date').data('daterangepicker').setStartDate(moment(endDate, 'DD/MM/YYYY').format('MM/DD/YYYY'));
			$('.end_date .date').data('daterangepicker').setEndDate(moment(endDate, 'DD/MM/YYYY').format('MM/DD/YYYY'));
		}
		update_datetime();
	}

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
	initWithFilter();

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
					appendCoupon(coupon)
                } else {
                    toastr.error(data.message);
                }
            },
            error: function (e) {
                alert(e);
            }

        });
	});
	
	$('body').on('keyup', '#inpCode',function (ev) {
		let key = $(this).val();
		url =  BASE_URL + "/coupon/search",
		data = {
			key: key,
		}
		$.ajax({
            type: 'GET',
			url: url,
			data: data,
            success: function (data) {
                if (data.status == 'success') {
					let coupons = data.coupon;
					$('#list-coupons').html('');
					if (coupons.length > 0) {
						coupons.forEach(coupon => {
							$('#list-coupons').append(`
							<div class="box-promo">
								<div class="left"><img class="img-promo" src="${BASE_URL}/images/percent.jpg" alt="Mioto - Thuê xe tự lái"></div>
								<div class="center">
									<p class="code">${coupon.code}</p>
									<p class="desc">Giảm <span>${coupon.discount_amount}%. </span>
									${coupon.max_discount ? '(tối đa<span> ' + coupon.max_discount + 'K</span>)' : ''}</p>
									<p class="desc">Bắt đầu từ: <span>${coupon.starts_at} </span> - Tới: <span> ${coupon.expires_at}</span></p>
								</div>
								<div class="right"><a class="applyCoupon btn btn-success" data-id="${coupon.id}">Áp dụng</a></div>
							</div>
						`);
						});
					} else {
						$('#list-coupons').html('<h4>Không tìm thấy mã khuyến mãi</h4>');
					}
					
                } else {
					console.log(data.message)
                }
            },
            error: function (e) {
                alert(e);
            }

        });
	});

	$('#box-car-spec').on('click', function (e) {
		e.preventDefault();
		var carId = $(this).data("id");
        target = BASE_URL + "/car/car-spec/" + carId,
        $("#carSpecModal .modal-content").load(target, function() {
            $("#carSpecModal").modal("show");
        });
	});


});

function appendCoupon(coupon) {
	$('input[name=coupon_code]').val(coupon.code);

	let start_date = $('.start_date .date').text();
	let end_date = $('.end_date .date').text();

	let start = moment(start_date, 'DD/MM/YYYY');
	let end   = moment(end_date, 'DD/MM/YYYY');
	let diff = end.diff(start, 'days') + 1;
	let amount = $('span.amount').text().replace(/[^\d]/g, "");

	let sum_amount = amount * diff;
	let discount = (sum_amount*coupon.discount_amount)/100;

	if(coupon.max_discount && discount >= coupon.max_discount){
		discount = coupon.max_discount
	}
	if(discount && discount>0){
			sum_amount = sum_amount-discount*1000;
	}
	
	$('input[name=coupon_discount]').val(discount);
	$('#booking_form .group-coupon').html(
		`<p>Khuyến mãi mã <span class="in-dam">${coupon.code}</span></p>
		<p>-${discount}.000</p>`
	);
	$('span.sum_amount').text(sum_amount).digits();
}
