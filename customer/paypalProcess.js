
	paypal.Buttons({
		// Sets up the transaction when a payment button is clicked
		createOrder: function(data, actions) {
			return actions.order.create({
				"purchase_units": [{
					"amount": {
						"currency_code": "USD",
						"value": "50",
						"breakdown": {
							"item_total": {
								/* Required when including the `items` array */
								"currency_code": "USD",
								"value": "100"
							}
						}
					},
					"items": [{
						"name": "First Product Name",
						/* Shows within upper-right dropdown during payment approval */
						"description": "Optional descriptive text..",
						/* Item details will also be in the completed paypal.com transaction view */
						"unit_amount": {
							"currency_code": "USD",
							"value": "50"
						},
						"quantity": "2"
					}, ]
				}]
			});
		},

		// Finalize the transaction after payer approval
		onApprove: function(data, actions) {
			return actions.order.capture().then(function(orderData) {
				// Successful capture! For dev/demo purposes:
				console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
				var transaction = orderData.purchase_units[0].payments.captures[0];
				alert('Transaction ' + transaction.status + ': ' + transaction.id + '\n\nSee console for all available details');

				// When ready to go live, remove the alert and show a success message within this page. For example:
				// var element = document.getElementById('paypal-button-container');
				// element.innerHTML = '';
				// element.innerHTML = '<h3>Thank you for your payment!</h3>';
				// Or go to another URL:  actions.redirect('thank_you.html');
			});
		}
	}).render('#paypal-button-container');
