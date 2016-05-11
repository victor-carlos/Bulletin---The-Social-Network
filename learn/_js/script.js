$(function() {
	$(".title").css("height", ($(window).height() - 100) + "px");
	$(".wrap").css("min-height", $(window).height() + "px");
	
	$(".btn-0").click(function () {
		if($(".global-nav ul").css("display") == "none"){
			$(".global-nav ul").slideDown(300);
			$(".btn-0").css("background", "#fff");
		}else {
			$(".global-nav ul").slideUp(300);
			$(".btn-0").css("background", "#66f");
		}
	});
});