$(document).ready(function() {
	var t;

	// 验证
	$('#submit').click(function() {
		var theme = $('#theme'),
			content = $('#content'),
			tip = null;

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
		if (tip) {

			showTip(tip);
			return false;
		}
	});

	// 节点选择
	$('#node-button').click(function(e) {
		var node = e.target.textContent;

		$("#node option").each(function() {
			$(this).attr("selected", false);
			if ($(this).text() === node) {
				$(this).attr("selected", true);
				return false;
			}
		});
	});



});