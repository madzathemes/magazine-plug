wp.customize.controlConstructor['kirki-multicolor'] = wp.customize.Control.extend({

	ready: function() {

		'use strict';

		var control = this,
		    colors  = control.params.choices,
		    keys    = Object.keys( colors ),
		    value   = this.params.value,
		    target  = control.container.find( '.iris-target' ),
		    i       = 0,
		    irisInput,
		    irisPicker;

		// Proxy function that handles changing the individual colors
		function kirkiMulticolorChangeHandler( control, value, subSetting ) {

			var picker = control.container.find( '.multicolor-index-' + subSetting ),
			    args   = {
					target: target[0],
					change: function() {

						// Color controls require a small delay.
						setTimeout( function() {

							// Set the value.
							control.saveValue( subSetting, picker.val() );

							// Trigger the change.
							control.container.find( '.multicolor-index-' + subSetting ).trigger( 'change' );
						}, 100 );

					}
				};

			if ( _.isObject( colors.irisArgs ) ) {
				_.each( colors.irisArgs, function( irisValue, irisKey ) {
					args[ irisKey ] = irisValue;
				});
			}

			// Did we change the value?
			picker.wpColorPicker( args );

		}

		// Colors loop
		while ( i < Object.keys( colors ).length ) {

			kirkiMulticolorChangeHandler( this, value, keys[ i ] );

			// Move colorpicker to the 'iris-target' container div
			irisInput  = control.container.find( '.wp-picker-container .wp-picker-input-wrap' ),
			irisPicker = control.container.find( '.wp-picker-container .wp-picker-holder' );
			jQuery( irisInput[0] ).detach().appendTo( target[0] );
			jQuery( irisPicker[0] ).detach().appendTo( target[0] );

			i++;

		}

	},

	/**
	 * Saves the value.
	 */
	saveValue: function( property, value ) {

		'use strict';

		var control   = this,
		    input     = control.container.find( '.multicolor-hidden-value' ),
		    valueJSON = jQuery( input ).val(),
		    valueObj  = JSON.parse( valueJSON );

		valueObj[ property ] = value;
		jQuery( input ).attr( 'value', JSON.stringify( valueObj ) ).trigger( 'change' );
		control.setting.set( valueObj );

	}

});
