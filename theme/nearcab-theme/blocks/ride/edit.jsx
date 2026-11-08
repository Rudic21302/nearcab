import { useBlockProps, useInnerBlocksProps, InnerBlocks, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl } from '@wordpress/components';
import { registerBlockType } from '@wordpress/blocks';
import { __ } from '@wordpress/i18n';
import metadata from './block.json';

// The six stops, fixed in order: the ride's scroll timeline is keyed to them. In the editor they stack like a page.
const TEMPLATE = metadata.allowedBlocks.map( ( name ) => [ name ] );

function Edit( { attributes, setAttributes } ) {
	const innerBlocksProps = useInnerBlocksProps( useBlockProps( { className: 'nearcab-editor' } ), {
		allowedBlocks: metadata.allowedBlocks,
		template: TEMPLATE,
		templateLock: 'all',
	} );

	return (
		<>
			<InspectorControls>
				<PanelBody title={ __( 'Header', 'nearcab' ) }>
					{ Object.keys( metadata.attributes ).map( ( key ) => (
						<TextControl
							key={ key }
							label={ key }
							value={ attributes[ key ] ?? '' }
							onChange={ ( value ) => setAttributes( { [ key ]: value } ) }
						/>
					) ) }
				</PanelBody>
			</InspectorControls>
			<div { ...innerBlocksProps } />
		</>
	);
}

registerBlockType( metadata.name, { edit: Edit, save: () => <InnerBlocks.Content /> } );
