(function($) {
	$(document).ready(function() {

		var $formButton = $('#pricelistSave');

		function updatePrices(e) {

			// Stopping the form from submitting
			e.preventDefault();

			// Store the values in variables
			var $dienst = $('#dienst')[0];
			var $price = $('#price')[0];

			// Replacing the . with a , in the price
			var $priceValue = $price.value.replace('.', ',');

			// var $pluginsUrl = $('#pluginUrl')[0].value;

			var data = {
				action: 'derijn_pricelist',
				name: $dienst.value,
				price: $priceValue
			};
			$.post(ajaxurl, data, function(response) {
				$('#load').html(response);
			});

			// Empty the values
			$dienst.value = '';
			$price.value = '';
		}

		// Bind the function to the click event, which gets triggered on click and Enter
		$formButton.click(updatePrices);

	});
})(jQuery);