wp.customize.controlConstructor['kirki-switch'] = wp.customize.Control.extend({

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

		var control       = this,
		    checkboxValue = control.setting._value;

		// CSS modifications depending on label sizes.
		jQuery( '#customize-control-' + control.id.replace( '[', '-' ).replace( ']', '' ) ).append(
			'<style>#customize-control-' + control.id.replace( '[', '-' ).replace( ']', '' ) + ' .switch label{width:calc(' + control.params.choices.on.length + 'ch + ' + control.params.choices.off.length + 'ch + 40px);}#customize-control-' + control.id.replace( '[', '-' ).replace( ']', '' ) + ' .switch label:after{width:calc(' + control.params.choices.on.length + 'ch + 10px);}#customize-control-' + control.id.replace( '[', '-' ).replace( ']', '' ) + ' .switch input:checked + label:after{left:calc(' + control.params.choices.on.length + 'ch + 25px);width:calc(' + control.params.choices.off.length + 'ch + 10px);}</style>'
		);

		// Save the value
		this.container.on( 'change', 'input', function() {
			checkboxValue = ( jQuery( this ).is( ':checked' ) ) ? true : false;
			control.setting.set( checkboxValue );
		});
	}
});
