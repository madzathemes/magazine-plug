wp.customize.controlConstructor['kirki-toggle'] = wp.customize.Control.extend({

	// When we're finished loading continue processing
	ready: function() {

		'use strict';

		var control = this,
		    section = control.section.get();

		// Add to the queue.
		kirkiControlLoader( control );
	},

	initKirkiControl: function() {

		'use strict';

		var control = this,
		    checkboxValue = control.setting._value;

		// Save the value
		this.container.on( 'change', 'input', function() {
			checkboxValue = ( jQuery( this ).is( ':checked' ) ) ? true : false;
			control.setting.set( checkboxValue );
		});

	}

});
