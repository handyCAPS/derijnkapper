$(document).ready(function() {
	$('#frontSlideWrapper').owlCarousel({
		singleItem: true,
		paginationSpeed: 5000,
		autoPlay: 12000,
		stopOnHover: true,
		lazyLoad: true
	});
	$('#slidePostWrapper').owlCarousel({
		singleItem: true,
		autoPlay: 8000,
		stopOnHover: true
	});
});
