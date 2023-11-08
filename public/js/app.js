const app = {

	selectors: {
		masks: '[class*="mask-"]',
		zipcode: '.mask-zipcode',
		formControl: '.form-control',
	},

	html: {
		spinner: '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'
	},

	text: {
		submitButton: 'Gravar'
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
		app.initEvents();
		app.initMasks();
	},

	initMasks() {

		$(app.selectors.masks).each(function(){

			let mask = app.getMaskFromInputClass(this);

			$(this).inputmask(app.masks[mask]);

		});

	},

	initEvents() {
		app.setZipcodeInputEvent();
		app.setSubmitFormEvent();
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

	transformString(str) {
		const parts = str.split('.');
		return parts.reduce((acc, part, index) => {
			return index === 0 ? part : `${acc}[${part}]`;
		}, '');
	},

	fillAddressFormFieldsWithAddressObject(addressObject) {
		
		$.each(addressObject, function(key, value) {
			$(`[name*="${key}"]`).val(value);
		});

	},

	addLoadingStateToForm(form) {

		let submitButton = $(form).find('[type="submit"]');

		app.text.submitButton = submitButton.text();

		submitButton.prop('disabled', true).html(app.html.spinner);
		$(form).find(app.selectors.formControl).addClass('bg-light').removeClass('is-invalid').parent().find('.invalid-feedback').remove();
	},

	removeLoadingStateFromForm(form) {
		$(form).find('[type="submit"]').prop('disabled', false).html(app.text.submitButton);
		$(form).find(app.selectors.formControl).removeClass('bg-light');
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

	},

	setSubmitFormEvent() {

		$('form[method="post"]').on('submit', function(e) {

			e.preventDefault();

			app.submitPostFormByAjax(this);

		});

	},

	submitPostFormByAjax(form) {
		
		let url = $(form).attr('action');
		let method = $(form).attr('method');
		let data = new FormData(form);

		app.addLoadingStateToForm(form);

		$.ajax({
			url: url,
			method: method,
			dataType: 'json',
			data: data,
			processData: false,
			contentType: false,
			success: function(response) {
				console.log(response);

				if(response.redirect) {
					location = response.redirect;
				} else {
					app.removeLoadingStateFromForm(form);
				}

				

			},
			error: function(error) {
				console.log(error);

				if(error.responseJSON.errors) {
					
					Object.keys(error.responseJSON.errors).forEach(function(key) {
					
						let inputName = app.transformString(key);

						$(form).find(`[name="${inputName}"]`).addClass('is-invalid').parent().append(`<div class="invalid-feedback">${error.responseJSON.errors[key][0]}</div>`);
					});

				}

				app.removeLoadingStateFromForm(form);

			}
		});
	}

}

app.init();