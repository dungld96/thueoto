const site_url = window.location.origin;

$('body').tooltip({
	selector: '[data-toggle="tooltip"]'
});

function validate_form(form) {
	var check = true;
	var input = $(form).find('.form-control');
	for (var i = 0; i < input.length; i++) {
		if ($(input[i]).val().trim() == '') {
			$(input[i]).focus();
			check = false;
			break;
		}
	}
	return check;
}

function placesSuggest(text) {
	$.ajax({
		url: 'https://places.demo.api.here.com/places/v1/suggest',
		type: 'GET',
		data: {
			at: '14.9031,105.8067',
			q: text,
			app_id: 'DemoAppId01082013GAL',
			app_code: 'AJKnXv84fjrb0KIHawS0Tg'
		},
		success: function(result) {
			var i = 0;
			var html = '';
			$.each(result.suggestions, function(k, v) {
				if (i < 5) html += '<a href="javascript:void(0)"><i class="fas fa-map-marker-alt"></i>' + v + '</a>';
				i++;
			});
			if ($('.place_result').length == 0)
				$('.place_wrap').append('<div class="place_result">' + html + '</div>');
			else
				$('.place_result').html(html);
		}
	});

}

$(document).ready(function() {
	toastr.options = {
		"closeButton": false,
		"debug": false,
		"newestOnTop": false,
		"progressBar": false,
		"positionClass": "toast-top-center",
		"preventDuplicates": false,
		"onclick": null,
		"showDuration": "100",
		"hideDuration": "500",
		"timeOut": "5000",
		"extendedTimeOut": "1000",
		"showEasing": "swing",
		"hideEasing": "linear",
		"showMethod": "fadeIn",
		"hideMethod": "fadeOut"
	}

	$('#signup_form').submit(function(e) {
		e.preventDefault();
		var password = $('input[name=password]').val().trim();
		var password_confirm = $('input[name=password_confirm]').val().trim();
		if (password != password_confirm) {
			alert('Xác nhận mật khẩu không chính xác!');
			return false;
		}
		if (validate_form($(this))) {
			$.ajax({
				url: site_url + '/signup/create',
				type: 'POST',
				data: $('#signup_form').serialize(),
				dataType: 'json',
				success: function(result) {
					alert(result.message);
					window.location.href = '/';
				},
				error: function(e) {
					alert(e.responseText);
				  }
			});
		}
	});

	$('body').on('submit', '#confirm_form', function(e) {
		e.preventDefault();
		$.ajax({
			url: site_url + '/ajax/booking_car',
			type: 'POST',
			data: $('#confirm_form').serialize(),
			dataType: 'json',
			success: function(result) {
				if (result.error) {
					alert(result.msg);
				} else {
					$('#bookingModal .form_container').html('<h2>Đã đặt xe thành công!</h2>');
				}
			}
		});
	});

	$('#btnLogin').on('click', function(e) {
		var target = $(this).attr("data-href");
        // load the url and show modal on success
        $("#loginModal .modal-content").load(target, function () {
            $("#loginModal").modal("show");
		});

	});

	$('#btnLogout').on('click', function(e) {
		$.post(site_url + '/ajax/logout', function() {
			window.location.href = window.location.search;
		})
	});

	$('.place_wrap').on('click', '.place_result a', function() {
		$(this).closest('.place_wrap').find('input').val($(this).text());
		$('.place_result').remove();
	});

});

$(document).mouseup(function(e) {
	var container = $('.place_wrap');
	if (!container.is(e.target) && container.has(e.target).length === 0) {
		$('.place_result').remove();
	}
});

function toTimestamp(date, time) {
	var dateParts = date.split('/');
	var timeParts = time.split(':');
	var datetime = new Date(dateParts[2], parseInt(dateParts[1], 10) - 1, dateParts[0], timeParts[0], timeParts[1]);
	return datetime.getTime() / 1000;

}

