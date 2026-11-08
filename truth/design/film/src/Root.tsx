import React from 'react';
import { Composition } from 'remotion';
import { Lift } from './Lift';

// Lift = the frame sequence test.
export const Root: React.FC = () => (
	<>
		<Composition id="Lift" component={Lift} durationInFrames={72} fps={24} width={1600} height={900} />
	</>
);
