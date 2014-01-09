(function($) {
	$(document).ready(function() {

		var $formButton = $('#pricelistSave');

		function addPrices(e) {

			// Stopping the form from submitting
			e.preventDefault();

			// Store the values in variables
			var $dienst = $('#dienst')[0];
			var $price = $('#price')[0];
			var $ordering = $('#order')[0];
			var dienstValue = $dienst.value;
			var priceValue = $price.value;
			var orderingValue = $ordering.value;

			// Send the values along with the ajaxcall
			var data = {
				action: 'derijn_pricelist',
				name: dienstValue,
				price: priceValue,
				ordering: orderingValue
			};

			// Make the ajaxcall and display the results
			$.post(ajaxurl, data, function(response) {
				$('#priceTableUpdate').html(response);
			});

			// Empty the values
			$dienst.value = '';
			$price.value = '';
			$ordering.value = '';
		}

		// Bind the function to the click event, which gets triggered on click and Enter
		$formButton.click(addPrices);

		var updateButton = $('.update-button');

		function updatePrices() {
			// Get the id so we know what fields to target
			var updateId = $(this).parent()[0].id;
			var nameId = '#' + updateId + '-name';
			var priceId = '#' + updateId + '-price';
			var orderingId = '#' + updateId + '-ordering';

			// Getting the values
			var nameValue = $(nameId)[0].value;
			var priceValue = $(priceId)[0].value;
			var orderingValue = $(orderingId)[0].value;

			var data = {
					action: 'derijn_update_pricelist',
					name: nameValue,
					price: priceValue,
					ordering: orderingValue,
					id: updateId
				};
			console.log(priceValue);

			// making the ajaxcall
			$.post(ajaxurl, data, function(response) {
				$('#priceTableUpdate').html(response);
			
				console.log(updateButton);
			});

		}

		updateButton.click(updatePrices);

	});
})(jQuery);