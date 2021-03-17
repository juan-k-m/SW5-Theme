$(document).ready(function () {

	var previousScroll = 0;
	$(window).scroll(function () {
		var actualScroll = $(this).scrollTop();
    var containerNayHeight = $("#jk-navigation").height();
		if (actualScroll < containerNayHeight) {
			visibleNav();
		} else if (actualScroll > 0 && actualScroll < $(document).height() - $(window).height()) {
			if (actualScroll > previousScroll) {
				invisibleNav();
			} else {
				visibleNav();
			}
			previousScroll = actualScroll;
		}
	});
});


	function invisibleNav() {
		$("#jk-navigation").removeClass("jk-is-visible").addClass("jk-is-hidden");
	}

	function visibleNav() {
		$("#jk-navigation").removeClass("jk-is-hidden").addClass("jk-is-visible");
	}
