$(document).ready(function() {
	var t;
	$('#submit').click(function() {
		var theme = $('#theme'),
			content = $('#content'),
			tip;

		function showTip(tip) {
			$('.tip').hide();
			clearTimeout(t);
			if (tip.is(':hidden')) {
				tip.show();
				t = setTimeout(function() {
					tip.hide();
				}, 2000);
			}
		}

		//标题空白
		if ((theme.val() === "") || (theme.val().match(/^\s*$/))) {
			theme.focus();
			tip = $('#tips-theme');
			//内容空白
		} else if ((content.val() === "") || content.val().match(/^\s*$/)) {
			content.focus();
			tip = $('#tips-content');
		}
		showTip(tip);

		return false;
	});
});
