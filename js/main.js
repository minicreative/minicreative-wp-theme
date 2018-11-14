
// On Page Load
$(document).ready(function () {
	setColumnWidth();
	fixWordPressImageAttributes();
})

// On Page Resize
$(window).resize(function () {
	setColumnWidth();
});

function fixWordPressImageAttributes () {
	jQuery('img').removeAttr('width').removeAttr('height');
}

function setColumnWidth () {
	$(".columns").each(function () {

		// Get container
		let columns = $(this);

		// Handle each column
		columns.find(".column").each(function () {

			// Get column
			let column = $(this);
	
			// Get and format margin for math
			let margin = parseInt(column.css("marginRight").replace('px',''));
			if (margin < 1) margin = parseInt(column.prev().css("marginRight").replace('px',''));
	
			// Handle columns by class
			if (column.hasClass("half")) {
				column.css("width", ((columns.width()-margin)/2)-3);
				if (column.index() % 2 !== 0) {
					column.css("marginRight", 0);
				}
			}
				
		})
	})
}