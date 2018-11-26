
// On Page Load
$(document).ready(function () {
	setupMobileNav();
	fixWordPressImageAttributes();
	setColumnWidth();
})

// On Page Resize
$(window).resize(function () {
	setColumnWidth();
});

function setupMobileNav () {
	let navigation = $(".navigation");
	let navUnderlay = $("#nav-underlay");
	$("#nav-toggle").click(function () {
		if (navigation) navigation.toggleClass("show");
		if (navUnderlay) navUnderlay.toggleClass("show");
	});
	navUnderlay.click(function () {
		navigation.toggleClass("show");
		navUnderlay.toggleClass("show");
	});
}

function fixWordPressImageAttributes () {
	jQuery('img').removeAttr('width').removeAttr('height');
}

function setColumnWidth () {
	$(".columns").each(function () {

		// Get container
		let columns = $(this);

		// Get window width
		let windowWidth = $(window).width();

		// Detect if mobile size
		let isMobile = (windowWidth < 760);

		// Handle each column
		columns.find(".column").each(function () {

			// Get column
			let column = $(this);

			// Reset existing inline margin
			column.css("marginRight", "");

			// Override on mobile
			if (isMobile) {
				column.css("width", "100%");
				column.css("marginRight", 0);
				return;
			}
	
			// Get and format margin for math
			let margin = parseInt(column.css("marginRight").replace('px',''));
	
			// Set columns to half width
			if (column.hasClass("half") || (column.hasClass("third") && windowWidth < 1020)) {
				column.css("width", ((columns.width()-margin)/2)-3);
				if ((((column.index()+1) % 2) == 0)) {
					column.css("marginRight", 0);
				}
			}

			// Set columns to third width
			else if (column.hasClass("third")) {
				column.css("width", ((columns.width()-(margin*2))/3));
				if ((((column.index()+1) % 3) == 0)) {
					column.css("marginRight", 0);
				}
			}

			// Set columns to fourth width
			else if (column.hasClass("fourth")) {
				column.css("width", ((columns.width()-(margin*3))/4));
				if ((((column.index()+1) % 4) == 0)) {
					column.css("marginRight", 0);
				}
			}
				
		})
	})
}