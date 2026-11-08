import React from 'react';
import { AbsoluteFill, Img, interpolate, Easing, staticFile, useCurrentFrame } from 'remotion';

// The lift: the camera rises off the street. The street falls away and shrinks,
// the city map tilts from a street-level view to straight above, and the cab
// becomes the yellow dot it is on the map. Ends on the plain map the page continues from.
const ease = Easing.bezier(0.76, 0, 0.24, 1);
const PAPER = '#FDFAF7';

export const Lift: React.FC = () => {
	const f = useCurrentFrame();
	const t = (a: number, b: number) => interpolate(f, [a, b], [0, 1], { extrapolateLeft: 'clamp', extrapolateRight: 'clamp', easing: ease });

	// street: sinks and shrinks while the camera climbs
	const s = t(0, 34);
	const streetScale = 1 - 0.55 * s;
	const streetY = 260 * s;
	const streetOpacity = 1 - t(20, 40);

	// map: from a low, tilted angle to straight above
	const m = t(10, 60);
	const tilt = 62 * (1 - m);
	const mapScale = 1.9 - 0.9 * m;
	const mapOpacity = t(10, 28);

	// cab: shrinks toward its map position and hands over to the dot
	const c = t(28, 58);
	const cabOpacity = 1 - t(44, 58);
	const dot = t(48, 62);

	const mapSize = 820;
	return (
		<AbsoluteFill style={{ backgroundColor: PAPER, overflow: 'hidden' }}>
			<AbsoluteFill style={{ perspective: 1400, perspectiveOrigin: '50% 30%' }}>
				<div style={{ position: 'absolute', left: '50%', top: 40, width: mapSize, height: mapSize * 1400 / 1347, marginLeft: -mapSize / 2, opacity: mapOpacity, transformOrigin: '50% 47%', transform: `rotateX(${tilt}deg) scale(${mapScale})` }}>
					<Img src={staticFile('map-streets.webp')} style={{ width: '100%', height: '100%' }} />
					<div style={{ position: 'absolute', left: '63.3%', top: '39%', width: 22, height: 22, marginLeft: -11, marginTop: -11, borderRadius: '50%', background: '#FCCF5D', border: '3px solid #1C1A19', opacity: dot, transform: `scale(${0.4 + 0.6 * dot})` }} />
				</div>
			</AbsoluteFill>
			<div style={{ position: 'absolute', left: 0, right: 0, bottom: 0, height: 380, opacity: streetOpacity, transformOrigin: '50% 100%', transform: `translateY(${streetY}px) scale(${streetScale})` }}>
				<Img src={staticFile('dusk-back.webp')} style={{ position: 'absolute', bottom: 54, right: 0, height: 290 }} />
				<Img src={staticFile('dusk-front.webp')} style={{ position: 'absolute', bottom: 54, right: -200, height: 300 }} />
				<div style={{ position: 'absolute', left: 0, right: 0, bottom: 0, height: 60, background: '#EFE9E2' }} />
			</div>
			<Img src={staticFile('taxi-side.webp')} style={{ position: 'absolute', left: interpolate(c, [0, 1], [96, 1600 / 2 + 0.133 * mapSize - 60]), bottom: interpolate(c, [0, 1], [12, 900 - 40 - 0.39 * mapSize * 1400 / 1347 - 30]), height: 160 * (1 - 0.85 * c), opacity: cabOpacity }} />
		</AbsoluteFill>
	);
};
