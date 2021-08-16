/*jslint esnext:true */
jQuery( ( $ ) => {
	const selectedLocale = $( 'select[name="LC"]' ).val();
	const { __ } = wp.i18n;

	// Auto-submit the form when a locale is selected.
	$( 'select[name="LC"]' ).on( 'change', function () {
		if ( selectedLocale === this.value ) {
			return;
		}

		$( this ).closest( 'form' )
			.find( 'button[name="switch"]' ).prop( 'disabled', true )
			.end().submit();
	} );

	// Setup the button for testing AJAX mode.
	$( '.wpse-393178-tmp' ).fadeIn().on( 'click', 'button', function ( e ) {
		e.preventDefault();

		const btn = this;
		btn.disabled = true;

		$.get( ajaxurl + '?action=wpse-393178-en&t=' + Date.now() )
			.done( res => $( this ).closest( 'p' ).html( res ) )
			.fail( () => alert( __(
				'Request failed! Try again later.',
				'wpse-393178-en'
			) ) )
			.always( () => btn.disabled = false );
	} );

	console.log( __( 'script translations OK', 'wpse-393178-en' ) );
} );
