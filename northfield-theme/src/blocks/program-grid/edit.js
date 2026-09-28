import { __ } from '@wordpress/i18n';
import {
	useBlockProps,
	InspectorControls,
	RichText,
} from '@wordpress/block-editor';
import {
	PanelBody,
	RangeControl,
	SelectControl,
	Spinner,
	Notice,
} from '@wordpress/components';
import { useSelect } from '@wordpress/data';
import { store as coreStore } from '@wordpress/core-data';
import { decodeEntities } from '@wordpress/html-entities';

export default function Edit( { attributes, setAttributes } ) {
	const { heading, count, school } = attributes;
	const blockProps = useBlockProps( { className: 'nf-programs' } );

	// Live data from the REST API (/wp/v2/programs and /wp/v2/school).
	const { programs, schools, isLoading } = useSelect(
		( select ) => {
			const core = select( coreStore );
			const query = {
				per_page: count,
				orderby: 'title',
				order: 'asc',
				_embed: false,
			};
			if ( school ) {
				query.school = [ school ];
			}
			return {
				programs: core.getEntityRecords( 'postType', 'program', query ),
				schools: core.getEntityRecords( 'taxonomy', 'school', {
					per_page: -1,
				} ),
				isLoading: ! core.hasFinishedResolution( 'getEntityRecords', [
					'postType',
					'program',
					query,
				] ),
			};
		},
		[ count, school ]
	);

	const schoolOptions = [
		{ label: __( 'All schools', 'northfield' ), value: 0 },
		...( schools || [] ).map( ( term ) => ( {
			label: decodeEntities( term.name ),
			value: term.id,
		} ) ),
	];

	return (
		<>
			<InspectorControls>
				<PanelBody title={ __( 'Which programs', 'northfield' ) }>
					<SelectControl
						label={ __( 'School', 'northfield' ) }
						value={ school }
						options={ schoolOptions }
						onChange={ ( value ) =>
							setAttributes( { school: Number( value ) } )
						}
						__nextHasNoMarginBottom
					/>
					<RangeControl
						label={ __( 'Number of programs', 'northfield' ) }
						value={ count }
						min={ 1 }
						max={ 12 }
						onChange={ ( value ) =>
							setAttributes( { count: value } )
						}
						__nextHasNoMarginBottom
					/>
				</PanelBody>
			</InspectorControls>

			<section { ...blockProps }>
				<RichText
					tagName="h2"
					className="nf-programs__heading"
					value={ heading }
					onChange={ ( value ) =>
						setAttributes( { heading: value } )
					}
					placeholder={ __( 'Section heading', 'northfield' ) }
				/>

				{ isLoading && <Spinner /> }

				{ ! isLoading && ( ! programs || programs.length === 0 ) && (
					<Notice status="info" isDismissible={ false }>
						{ __(
							'No programs match. Add one under Programs, or pick another school.',
							'northfield'
						) }
					</Notice>
				) }

				{ ! isLoading && programs?.length > 0 && (
					<ul className="program-list">
						{ programs.map( ( program ) => (
							<li className="program-row" key={ program.id }>
								<span className="program-row__link">
									<span className="program-row__title">
										{ decodeEntities(
											program.title.rendered
										) }
									</span>
									<span className="program-row__meta">
										{ program.acf?.duration && (
											<span>
												{ program.acf.duration }
											</span>
										) }
									</span>
								</span>
							</li>
						) ) }
					</ul>
				) }
			</section>
		</>
	);
}
