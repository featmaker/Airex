$(document).ready(function() {
	var now = new Date();
	$('.media-heading').children('.time').each(function() {
		var old = new Date($(this).text()),
			dif = now - old,
			day = Math.floor(dif / (24 * 3600 * 1000)),
			hour = Math.floor(dif / (3600 * 1000)),
			min = Math.floor(dif / (60 * 1000)),
			second = Math.floor(dif / (1000));
		if (second < 60) {
			$(this).text(second + " 秒以前");
		} else if (min < 60) {
			$(this).text(min + ' 分钟以前')
		} else if (hour < 24) {
			$(this).text(hour + ' 小时 ' + (min - hour * 60) + ' 分钟以前');
		} else {
			$(this).text(day + ' 天以前');
		}
		$(this).show();



	});

	$('.reply-info').each(function() {
		$(this).mouseover(function() {
			$(this).find('.thank-area').show();
		});
		$(this).mouseout(function() {
			$(this).find('.thank-area').hide();
		});
	});

	$('.reply').each(function() {
		$(this).click(function() {
			var par = $(this).parents('.reply-info');
			if (par.children(".media-body").next().hasClass('reply-box')) {
				par.children(".media-body").next().remove();
			} else {
				par.children(".media-body").after('<form action="#" method="post" accept-charset="utf-8" class="reply-box"><br/><textarea name="reply" class="form-control" rows="2" placeholder="@ admin:"></textarea><input type="submit" id="reply-button" class="btn btn-info btn-sm"></input></form>');
			}
		});
	});



	(function() {



	})();


});