import { useBlockProps } from '@wordpress/block-editor';
import { Placeholder } from '@wordpress/components';
import { __ } from '@wordpress/i18n';

export default function Edit() {
	const blockProps = useBlockProps( {
		style: { minHeight: '200px' },
	} );

	return (
		<div { ...blockProps }>
			<Placeholder
				icon="grid-view"
				label={ __( 'Ingredient Catalog', 'farbest' ) }
				instructions={ __(
					'The Farbest ingredient filter app renders here on the frontend.',
					'farbest'
				) }
			/>
		</div>
	);
}
