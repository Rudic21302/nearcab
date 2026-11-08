import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl, ToggleControl } from '@wordpress/components';
import ServerSideRender from '@wordpress/server-side-render';
import { registerBlockType } from '@wordpress/blocks';
import { __ } from '@wordpress/i18n';

/**
 * Registers a block whose only editable settings are its attributes: strings, on/off switches and arrays.
 * Content is rendered by PHP, so the editor shows a server preview.
 */
export default function registerLabelsBlock( metadata ) {
	const keys = Object.keys( metadata.attributes ).filter( ( k ) => metadata.attributes[ k ].type === 'string' );
	const toggles = Object.keys( metadata.attributes ).filter( ( k ) => metadata.attributes[ k ].type === 'boolean' );
	// Array attributes: strings get one textarea (one item per line); objects get a panel per item, its fields taken
	// from the first default item (string → text field, boolean → switch).
	const arrays = Object.keys( metadata.attributes ).filter( ( k ) => metadata.attributes[ k ].type === 'array' );

	registerBlockType( metadata.name, {
		edit( { attributes, setAttributes, context } ) {
			return (
				<>
					<InspectorControls>
						<PanelBody title={ __( 'Labels', 'nearcab' ) }>
							{ keys.map( ( key ) => (
								<TextControl
									key={ key }
									label={ key }
									value={ attributes[ key ] ?? '' }
									onChange={ ( value ) => setAttributes( { [ key ]: value } ) }
								/>
							) ) }
							{ toggles.map( ( key ) => (
								<ToggleControl
									key={ key }
									label={ key }
									checked={ !! attributes[ key ] }
									onChange={ ( value ) => setAttributes( { [ key ]: value } ) }
									__nextHasNoMarginBottom
								/>
							) ) }
						</PanelBody>
						{ arrays.map( ( key ) => {
							const list = attributes[ key ] ?? [];
							const sample = metadata.attributes[ key ].default?.[ 0 ];
							if ( typeof sample !== 'object' ) {
								return (
									<PanelBody key={ key } title={ key } initialOpen={ false }>
										<TextareaControl
											label={ __( 'One item per line', 'nearcab' ) }
											value={ list.join( '\n' ) }
											onChange={ ( value ) => setAttributes( { [ key ]: value.split( '\n' ) } ) }
											__nextHasNoMarginBottom
										/>
									</PanelBody>
								);
							}
							const update = ( index, changes ) =>
								setAttributes( { [ key ]: list.map( ( item, i ) => ( i === index ? { ...item, ...changes } : item ) ) } );
							return list.map( ( item, index ) => (
								<PanelBody key={ `${ key }-${ index }` } title={ `${ key } ${ index + 1 }` } initialOpen={ false }>
									{ Object.keys( sample ).map( ( field ) => ( typeof sample[ field ] === 'boolean' ? (
										<ToggleControl
											key={ field }
											label={ field }
											checked={ !! item[ field ] }
											onChange={ ( value ) => update( index, { [ field ]: value } ) }
											__nextHasNoMarginBottom
										/>
									) : (
										<TextControl
											key={ field }
											label={ field }
											value={ item[ field ] ?? '' }
											onChange={ ( value ) => update( index, { [ field ]: value } ) }
										/>
									) ) ) }
								</PanelBody>
							) );
						} ) }
					</InspectorControls>
					<div { ...useBlockProps() }>
						<ServerSideRender block={ metadata.name } attributes={ attributes } urlQueryArgs={ { post_id: context.postId } } />
					</div>
				</>
			);
		},
	} );
}
