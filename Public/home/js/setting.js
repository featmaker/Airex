$(document).ready(function() {
	var setting = {

		active: function active() {
			var actives = $('#navbar ul li');
			actives.eq(2).addClass('nav-active');
		},

		isEnoughLength: function isEnoughLength() {
			var psw = $('#new-psw'),
				tip = $('#psw-tip-length');
			if (psw.val().length < 6) {
				tip.show();
				psw.click(function() {
					if (tip.is(":visible")) {
						tip.hide();
					}
				});
				return false;
			} else {
				return true;
			}
		},

		isSamePsw: function isSamePsw() {
			var psw = $('#new-psw').val(),
				psw2 = $('#new-psw-repeat').val(),
				notice = $('#psw-tip'),
				length = $('#psw-tip-length');
			console.log("第一次输入为： " + psw);
			console.log("第二次输入： " + psw2);
			if (psw !== psw2) {
				length.hide();
				notice.show();
				return false;
			} else if (psw === psw2) {
				notice.hide();
				return true;
			}
		}

	};
	
	setting.active();

	$('#new-psw-repeat').keyup(function() {
		if (setting.isEnoughLength()) {
			setting.isSamePsw();
		}
	});

	$('#new-psw-repeat').click(function() {
		setting.isEnoughLength();
	});

	$('#psw-btn').click(function() {
		if (!(setting.isSamePsw() && setting.isEnoughLength())) {
			$('#psw-tip').show();
			return false;
		}
	});


});