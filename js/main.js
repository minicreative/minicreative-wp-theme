
function inializeRoyalSlider () {
    jQuery(document).ready(function($) {
		$('.slider').royalSlider({
		arrowsNav: true,
		loop: true,
		keyboardNavEnabled: true,
		controlsInside: false,
		imageScaleMode: 'fill',
		imageAlignCenter: true,
		arrowsNav: false,
		autoPlay: {
			enabled: true,
			stopAtAction: true,
			pauseOnHover: false,
			delay: '300',
		},
		controlNavigation: 'bullets',
		thumbsFitInViewport: false,
		navigateByClick: true,
		startSlideId: 0,
		transitionType:'fade',
		transitionSpeed: 1400,
		globalCaption: false,
		});
	});
}