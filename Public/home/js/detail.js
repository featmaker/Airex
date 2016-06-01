$(document).ready(function() {
	var now = new Date();
	$('.media-heading').children('.time').each(function() {
		var old = new Date($(this).text());
		var dif = now-old;
		var day = Math.round(dif/(24*3600*1000));
		var hour = Math.round(dif/(3600*1000));
		var min = Math.round(dif/(60*1000));
		if (min < 60) {
			$(this).text(min+'分钟以前')
		}else if(hour < 24){
			$(this).text(hour+'小时'+(min-hour*60)+'分钟以前');
		}else{
			$(this).text(day+'天以前');
		}
		$(this).show();


		// 	timeNow = {},
		// 	timeOld = {},
		// 	timeArr = [],
		// 	hour, minute, second, day, ms,
		// 	timeString = $(this).html(),

		// 	// 输出的时间差
		// 	time;

		// timeNow.second = t.getSeconds();
		// timeNow.minute = t.getMinutes();
		// timeNow.hour = t.getHours();
		// timeNow.day = t.getDate();

		// timeArr = timeString.split(" ")[1].split(":");
		// timeArr.push(timeString.split(" ")[0].split("-")[2]);

		// timeOld.hour = timeArr[0];
		// timeOld.minute = timeArr[1];
		// timeOld.second = timeArr[2];
		// timeOld.day = timeArr[3];

		// second = timeNow.second - timeOld.second;
		// minute = timeNow.minute - timeOld.minute;
		// hour = timeNow.hour - timeOld.hour;
		// day = timeNow.day - timeOld.day;

		// ms = day * 24 * 3600 + hour * 3600 + minute * 60 + second;

		// if (ms < 60) {
		// 	time = ms + " 秒前";
		// } else if (ms < 3600) {
		// 	time = Math.floor(ms / 60) + " 分钟前";
		// } else if (ms < 86400) {
		// 	time = Math.floor(ms / 3600) + " 小时 " + Math.floor((ms - Math.floor(ms / 3600) * 3600) / 60) + " 分钟前";
		// } else {
		// 	time = Math.floor(ms / 86400) + " 天前";
		// }

		// $(this).html(time);
		// $(this).show();

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