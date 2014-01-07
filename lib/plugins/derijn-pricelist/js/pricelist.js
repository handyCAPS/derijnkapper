(function($) {
	$(document).ready(function() {

		var $formButton = $('#pricelistSave');

		function updatePrices(e) {

			// Stopping the form from submitting
			e.preventDefault();

			// Store the values in variables
			var $dienst = $('#dienst')[0];
			var $price = $('#price')[0];
			var $dienstValue = $dienst.value;
			var $priceValue = $price.value;

			// Send the values along with the ajaxcall
			var data = {
				action: 'derijn_pricelist',
				name: $dienstValue,
				price: $priceValue
			};

			// Make the ajaxcall and display the results
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