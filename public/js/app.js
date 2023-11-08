const app = {

	selectors: {
		masks: '[class*="mask-"]',
		zipcode: '.mask-zipcode'
	},

	masks : {

		zipcode: {
			mask: '99999-999'
		}

	},

	init() {
		
		app.initMasks();
		app.setZipcodeInputEvent();

	},

	initMasks() {

		$(app.selectors.masks).each(function(){

			let mask = app.getMaskFromInputClass(this);

			$(this).inputmask(app.masks[mask]);

		});

	},

	getMaskFromInputClass(input) {
		return $(input).prop('class').split(' ').filter(item => item.includes('mask'))[0].split('-')[1]
	},

	getAddressByZipcode(zipcode) {

	},

	setZipcodeInputEvent() {

		$(app.selectors.zipcode).on('keyup', function() {

			let zipcode = $(this).inputmask('unmaskedvalue');

			if(zipcode.length === 8) {

				let url = $(this).data('ajax');

				url = url.substring(1, url.length - 1);
				
				$.ajax({
					url: url,
					method: 'GET',
					dataType: 'json',
					data: { zipcode: zipcode },
					success: function(response) {
						console.log(response);
					}
				});

				
			}

		});

	}

}

app.init();