import { useBlockProps, RichText } from '@wordpress/block-editor';

export default function save( { attributes } ) {
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
	const blockProps = useBlockProps.save( { className: 'nf-hero' } );

	return (
		<section { ...blockProps }>
			<div className="nf-hero__copy">
				{ intake && (
					<RichText.Content
						tagName="p"
						className="nf-hero__intake"
						value={ intake }
					/>
				) }
				<RichText.Content
					tagName="h1"
					className="nf-hero__heading"
					value={ heading }
				/>
				<RichText.Content
					tagName="p"
					className="nf-hero__text"
					value={ text }
				/>
				{ buttonText && buttonUrl && (
					<a className="button button--accent" href={ buttonUrl }>
						{ buttonText }
					</a>
				) }
			</div>
			{ mediaUrl && (
				<figure className="nf-hero__media">
					<img
						src={ mediaUrl }
						alt={ mediaAlt }
						className={
							mediaId ? `wp-image-${ mediaId }` : undefined
						}
					/>
				</figure>
			) }
		</section>
	);
}
