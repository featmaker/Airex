window.onload = function() {

	document.getElementById("toggle").onclick = function turn() {

		var hide = document.getElementById("themeHide"),
			show = document.getElementById("themeShow"),
			toggle=document.getElementById("toggle");

		if (hide.style.display === "none") {
			console.log("hide:none ==> block");
			hide.style.display = "block";
			show.style.display = "none";
			toggle.getElementsByTagName("a")[0].textContent="点击显示主题";

		} else {
			console.log("hide:block ==> none");
			hide.style.display = "none";
			show.style.display = "block";
			toggle.getElementsByTagName("a")[0].textContent="点击隐藏主题";
		}



	}
}