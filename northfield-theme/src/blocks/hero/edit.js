import { __ } from '@wordpress/i18n';
import {
	useBlockProps,
	RichText,
	InspectorControls,
	MediaUpload,
	MediaUploadCheck,
} from '@wordpress/block-editor';
import { PanelBody, TextControl, Button } from '@wordpress/components';

export default function Edit( { attributes, setAttributes } ) {
	const {
		intake,
		heading,
		text,
		buttonText,
		buttonUrl,
		mediaId,
		mediaUrl,
		mediaAlt,
	} = attributes;
	const blockProps = useBlockProps( { className: 'nf-hero' } );

	const onSelectMedia = ( media ) =>
		setAttributes( {
			mediaId: media.id,
			mediaUrl: media.sizes?.large?.url || media.url,
			mediaAlt: media.alt || '',
		} );

	return (
		<>
			<InspectorControls>
				<PanelBody title={ __( 'Call to action', 'northfield' ) }>
					<TextControl
						label={ __( 'Button label', 'northfield' ) }
						value={ buttonText }
						onChange={ ( value ) =>
							setAttributes( { buttonText: value } )
						}
						__nextHasNoMarginBottom
					/>
					<TextControl
						label={ __( 'Button link', 'northfield' ) }
						value={ buttonUrl }
						type="url"
						onChange={ ( value ) =>
							setAttributes( { buttonUrl: value } )
						}
						__nextHasNoMarginBottom
					/>
				</PanelBody>
				<PanelBody title={ __( 'Image', 'northfield' ) }>
					<MediaUploadCheck>
						<MediaUpload
							onSelect={ onSelectMedia }
							allowedTypes={ [ 'image' ] }
							value={ mediaId }
							render={ ( { open } ) => (
								<Button variant="secondary" onClick={ open }>
									{ mediaUrl
										? __( 'Replace image', 'northfield' )
										: __( 'Choose image', 'northfield' ) }
								</Button>
							) }
						/>
					</MediaUploadCheck>
					{ mediaUrl && (
						<>
							<TextControl
								label={ __( 'Alt text', 'northfield' ) }
								value={ mediaAlt }
								onChange={ ( value ) =>
									setAttributes( { mediaAlt: value } )
								}
								__nextHasNoMarginBottom
							/>
							<Button
								variant="link"
								isDestructive
								onClick={ () =>
									setAttributes( {
										mediaId: undefined,
										mediaUrl: undefined,
										mediaAlt: '',
									} )
								}
							>
								{ __( 'Remove image', 'northfield' ) }
							</Button>
						</>
					) }
				</PanelBody>
			</InspectorControls>

			<section { ...blockProps }>
				<div className="nf-hero__copy">
					<RichText
						tagName="p"
						className="nf-hero__intake"
						value={ intake }
						onChange={ ( value ) =>
							setAttributes( { intake: value } )
						}
						placeholder={ __(
							'Next intake: January 5, 2027',
							'northfield'
						) }
						allowedFormats={ [] }
					/>
					<RichText
						tagName="h1"
						className="nf-hero__heading"
						value={ heading }
						onChange={ ( value ) =>
							setAttributes( { heading: value } )
						}
						placeholder={ __( 'Write a headline', 'northfield' ) }
					/>
					<RichText
						tagName="p"
						className="nf-hero__text"
						value={ text }
						onChange={ ( value ) =>
							setAttributes( { text: value } )
						}
						placeholder={ __(
							'One or two sentences that support the headline',
							'northfield'
						) }
					/>
					<span className="button button--accent">
						{ buttonText }
					</span>
				</div>
				{ mediaUrl && (
					<figure className="nf-hero__media">
						<img src={ mediaUrl } alt={ mediaAlt } />
					</figure>
				) }
			</section>
		</>
	);
}
