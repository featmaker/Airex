/*************  javascript  ***********
  
		window.onload = function() {

			document.getElementById("toggle").onclick = function() {

				var hide = document.getElementById("themeHide"),
					show = document.getElementById("themeShow"),
					toggle = document.getElementById("toggle");

				if (hide.style.display === "none") {
					console.log("hide:none ==> block");
					hide.style.display = "block";
					show.style.display = "none";
					toggle.getElementsByTagName("a")[0].textContent = "点击显示主题";
				} else {
					console.log("hide:block ==> none");
					hide.style.display = "none";
					show.style.display = "block";
					toggle.getElementsByTagName("a")[0].textContent = "点击隐藏主题";
				}
			}
		}

*/



/************* jQuery *************/


$(document).ready(function() {

	// 显示隐藏切换
	$("#toggle").click(function() {
		var hide = $("#themeHide"),
			show = $("#themeShow");
		if (hide.is(":hidden")) {
			hide.show();
			show.hide();
			$("#toggle>a").html("点击显示主题");
		} else {
			hide.hide();
			show.show();
			$("#toggle>a").html("点击隐藏主题");
		}
	});



});