const app = {

	init() {
		
		this.initMasks();

	},

	initMasks() {

		$('[class*="mask-"]').each(function(){

			let mask = app.getMaskFromClass(this);

			$(this).inputmask(app.masks[mask]);

		});

	},

	getMaskFromClass(input) {
		return $(input).prop('class').split(' ').filter(item => item.includes('mask'))[0].split('-')[1]
	},

	masks : {

		zipcode: {
			mask: '99999-999'
		}

	}

}

app.init();