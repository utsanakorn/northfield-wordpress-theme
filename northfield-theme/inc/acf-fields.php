<?php
/**
 * ACF field group for Programs, registered in code so it lives in Git.
 * Works with free ACF. Fields are skipped if ACF is not active.
 *
 * @package Northfield
 */

defined( 'ABSPATH' ) || exit;

add_action( 'acf/include_fields', function () {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group(
		array(
			'key'      => 'group_northfield_program',
			'title'    => 'Program details',
			'fields'   => array(
				array(
					'key'     => 'field_nf_credential',
					'label'   => 'Credential',
					'name'    => 'credential',
					'type'    => 'select',
					'choices' => array(
						'diploma'     => 'Diploma',
						'certificate' => 'Certificate',
					),
				),
				array(
					'key'          => 'field_nf_duration',
					'label'        => 'Duration',
					'name'         => 'duration',
					'type'         => 'text',
					'instructions' => 'Example: 12 months',
				),
				array(
					'key'     => 'field_nf_delivery',
					'label'   => 'Delivery',
					'name'    => 'delivery',
					'type'    => 'checkbox',
					'choices' => array(
						'campus' => 'On campus',
						'online' => 'Online',
					),
				),
				array(
					'key'   => 'field_nf_next_start',
					'label' => 'Next start date',
					'name'  => 'next_start',
					'type'  => 'date_picker',
					'display_format' => 'F j, Y',
					'return_format'  => 'F j, Y',
				),
				array(
					'key'   => 'field_nf_apply_url',
					'label' => 'Apply link',
					'name'  => 'apply_url',
					'type'  => 'url',
				),
			),
			'location' => array(
				array(
					array(
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => 'program',
					),
				),
			),
			'position'        => 'side',
			'show_in_rest'    => 1,
		)
	);

	acf_add_local_field_group(
		array(
			'key'      => 'group_northfield_testimonial',
			'title'    => 'Graduate story',
			'fields'   => array(
				array(
					'key'       => 'field_nf_quote',
					'label'     => 'Quote',
					'name'      => 'quote',
					'type'      => 'textarea',
					'rows'      => 3,
					'maxlength' => 280,
				),
				array(
					'key'   => 'field_nf_graduate_name',
					'label' => 'Graduate name',
					'name'  => 'graduate_name',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_nf_current_role',
					'label' => 'Current role',
					'name'  => 'current_role',
					'type'  => 'text',
				),
				array(
					'key'           => 'field_nf_story_program',
					'label'         => 'Program completed',
					'name'          => 'program',
					'type'          => 'post_object',
					'post_type'     => array( 'program' ),
					'return_format' => 'object',
				),
				array(
					'key'           => 'field_nf_photo',
					'label'         => 'Photo',
					'name'          => 'photo',
					'type'          => 'image',
					'return_format' => 'id',
				),
			),
			'location' => array(
				array(
					array(
						'param'    => 'block',
						'operator' => '==',
						'value'    => 'acf/testimonial',
					),
				),
			),
		)
	);
} );
