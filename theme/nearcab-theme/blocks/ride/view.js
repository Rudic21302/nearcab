import { store, getElement, withSyncEvent } from '@wordpress/interactivity';

// Sky state: on between 24% and 56.5% of the ride, off again only past 21.5% / 59%. The safety margins keep small
// scrolls from flickering; once switched, the lift (or drop) plays out in time (style.scss), in either direction.
const IN = [ 0.24, 0.565 ];
const OUT = [ 0.215, 0.59 ];
let still;

const timeline = () => CSS.supports( 'animation-timeline', 'view()' ) && ! matchMedia( '(prefers-reduced-motion: reduce)' ).matches;

// A frame whose copy is taller than its reading area scrolls it up during the frame's hold (style.scss reads --over);
// the pickup (data-fit) never scrolls inside: it scales down to fit instead (--fit).
function measure( stage ) {
	stage.querySelectorAll( '.frame' ).forEach( ( frame ) => {
		const grid = frame.firstElementChild;
		if ( ! grid ) {
			return;
		}
		const room = frame.clientHeight - parseFloat( getComputedStyle( frame ).paddingTop ) - 24;
		if ( 'fit' in frame.dataset ) {
			frame.style.setProperty( '--fit', Math.min( 1, room / grid.scrollHeight ) );
		} else {
			frame.style.setProperty( '--over', `${ Math.max( 0, grid.scrollHeight - room ) }px` );
		}
	} );
}

const { state } = store( 'nearcab', {
	state: {
		sky: false,
		moving: false,
	},
	actions: {
		// In-page links (header CTA, pickup CTA, brand) ride to their stop: the frame's data-hold is its % of the ride.
		jump: withSyncEvent( ( event ) => {
			const target = document.querySelector( event.currentTarget.hash || '#top' );
			const ride = document.querySelector( '.nearcab .ride' );
			if ( ! target || ! ride || ! timeline() ) {
				return;
			}
			event.preventDefault();
			const top = ride.getBoundingClientRect().top + window.scrollY;
			window.scrollTo( { top: top + ( ride.offsetHeight - window.innerHeight ) * ( Number( target.dataset.hold ) || 0 ) / 100, behavior: 'smooth' } );
		} ),
	},
	callbacks: {
		init() {
			const { ref } = getElement();
			const remeasure = () => measure( ref );
			remeasure();
			window.addEventListener( 'load', remeasure );
			document.fonts?.ready.then( remeasure );
			sync( ref );
		},
		measure() {
			measure( getElement().ref );
		},
		scroll() {
			sync( getElement().ref );
			// The wheels blur only while the reader is scrolling a drive (style.scss: --drive * --moving).
			state.moving = true;
			clearTimeout( still );
			still = setTimeout( () => ( state.moving = false ), 120 );
		},
	},
} );

function sync( stage ) {
	if ( ! CSS.supports( 'animation-timeline', 'view()' ) ) {
		return;
	}
	const ride = stage.parentElement.getBoundingClientRect();
	const p = Math.min( 1, Math.max( 0, -ride.top / ( ride.height - window.innerHeight ) ) );
	state.sky = state.sky ? ! ( p < OUT[ 0 ] || p > OUT[ 1 ] ) : p >= IN[ 0 ] && p <= IN[ 1 ];
}
