/**
 * Mobile navigation toggle. Vanilla JS, no dependencies.
 */
( function () {
	const toggle = document.querySelector( '.nav-toggle' );
	const nav = document.getElementById( 'primary-nav' );
	if ( ! toggle || ! nav ) {
		return;
	}

	const setOpen = ( open ) => {
		toggle.setAttribute( 'aria-expanded', String( open ) );
		document.body.classList.toggle( 'nav-open', open );
	};

	toggle.addEventListener( 'click', () => {
		setOpen( toggle.getAttribute( 'aria-expanded' ) !== 'true' );
	} );

	document.addEventListener( 'keydown', ( event ) => {
		if ( event.key === 'Escape' && document.body.classList.contains( 'nav-open' ) ) {
			setOpen( false );
			toggle.focus();
		}
	} );

	window.matchMedia( '(min-width: 60em)' ).addEventListener( 'change', ( mq ) => {
		if ( mq.matches ) {
			setOpen( false );
		}
	} );
} )();
