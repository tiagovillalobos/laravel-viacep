const app = {

	selectors: {
		masks: '[class*="mask-"]',
		zipcode: '.mask-zipcode',
		formControl: '.form-control',
	},

	elements: {
		loaderModal: new bootstrap.Modal(document.getElementById('loader-modal'), { keyboard: false, backdrop: 'static' }),
		modals: {
			error: new bootstrap.Modal(document.getElementById('error-modal'), { keyboard: false, backdrop: 'static' }),
		}
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

	clearChildrenInputsAndHideElement(element) {
		$(element).find(app.selectors.formControl).val('');
		$(element).addClass('d-none');
	},

	createAddressObjectFromResponse(response) {
		
		return {
			'street': response.logradouro,
			'district': response.bairro,
			'city': response.localidade,
			'state': response.uf
		};

	},

	fillAddressFormFieldsWithAddressObject(addressObject) {
		
		$.each(addressObject, function(key, value) {
			$(`[name*="${key}"]`).val(value);
		});

	},

	setErrorModalText(text) {
		$('#error-modal').find('#error-modal-text').text(text);
	},

	setZipcodeInputEvent() {

		$(app.selectors.zipcode).on('keyup', function() {

			let zipcode = $(this).inputmask('unmaskedvalue');
			let url = $(this).data('ajax');
			let target = $($(this).data('target'));

			if(zipcode.length === 8) {

				app.clearChildrenInputsAndHideElement(target);

				app.elements.loaderModal.show();

				$.ajax({
					url: url,
					method: 'GET',
					dataType: 'json',
					data: { zipcode: zipcode },
					success: function(response) {
						console.log(response);

						let addressObject = app.createAddressObjectFromResponse(response);

						app.fillAddressFormFieldsWithAddressObject(addressObject);

						target.removeClass('d-none');

						app.elements.loaderModal.hide();

					},
					error: function(error) {
						console.log(error);
						app.elements.loaderModal.hide();

						app.setErrorModalText(error.responseJSON.message);
						app.elements.modals.error.show();
					}
				});

				
			} else {

				app.clearChildrenInputsAndHideElement(target);

			}

		});

	}

}

app.init();