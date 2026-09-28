import { registerBlockType } from '@wordpress/blocks';
import Edit from './edit';
import metadata from './block.json';
import './style.scss';

// Dynamic block: markup comes from render.php, so save returns null.
registerBlockType( metadata.name, { edit: Edit, save: () => null } );
