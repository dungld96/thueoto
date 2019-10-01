const BASE_URL = window.location.origin;

$(document).ready(function() {
  $.ajaxSetup({
    headers: {
      "X-CSRF-TOKEN": $('meta[name="_token"]').attr("content")
    }
  });
  toastr.options = {
    closeButton: false,
    debug: false,
    newestOnTop: false,
    progressBar: false,
    positionClass: "toast-top-right",
    preventDuplicates: false,
    onclick: null,
    showDuration: "300",
    hideDuration: "1000",
    timeOut: "5000",
    extendedTimeOut: "1000",
    showEasing: "swing",
    hideEasing: "linear",
    showMethod: "fadeIn",
    hideMethod: "fadeOut"
  };

  getNotifies();

  $("body").on("click", ".notificationLink", function(ev) {
    ev.preventDefault();
    let target = $(this).attr("data-href");
    let notiId = $(this).data("id");
    readNotification(notiId, target);
  });

  
}); //ready

function getNotifies() {
  let url = BASE_URL + "/admin/notifications";
  $.ajax({
    type: "get",
    url: url,
    success: function(res) {
      if (res.status == "success") {
        const notifications = res.data;
        if (res.data.length > 0) {
          $("#notificationList").html("");
          const unread = notifications.filter(item => {
            return !item.read_at;
          });
          if(unread.length > 0){
            $("#countUnread").html(unread.length);
            $("#header_notification_bar .badge-default").html(unread.length);
          }

          notifications.forEach(notification => {
            const message = notification.data.message;
            const redirectTo = notification.data.redirect_to;
            const notiId = notification.id;
            const createdAt = notification.created_at;
            const time_diff = moment().diff(moment(createdAt));
            const time_s = moment.duration(time_diff).get('seconds');
            const time_m = moment.duration(time_diff).get('minutes');
            const time_h = moment.duration(time_diff).get('hours');
            const time_d = moment(time_diff).format('DD tháng MM');
            const time_string = 
            time_d > 0 ? time_d : 
            time_h > 0 ? time_h + ' giờ' : 
            time_m > 0 ? time_m + ' phút' : 
            'Vài giấy trước' 

            $("#notificationList").append(
              `<li>
                <a class="notificationLink ${!notification.read_at && "notification-unread"}" 
                  data-href="${redirectTo}" data-id="${notiId}">
                  <span>${message}</span>
                  <span class="time">${time_string}</span>
                </a>
							</li>`
            );
          });
        }
      }
      setTimeout(getNotifies, 20000);
    },
    error: function(e) {
      alert(e);
    }
  });
}

function readNotification(notiId, target) {
  let url = BASE_URL + "/admin/notifications/" + notiId;

  $.ajax({
    type: "get",
    url: url,
    success: function(res) {
      window.location.href = target;
    },
    error: function(e) {
      alert(e);
    }
  });
}