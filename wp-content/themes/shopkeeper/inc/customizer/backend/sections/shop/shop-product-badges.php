<?php
/**
* The Shop Product Badges section options.
*
* @package shopkeeper
*/

add_action( 'customize_register', 'shopkeeper_customizer_shop_product_badges_controls' );
/**
 * Adds controls for shop product badges settings section.
 *
 * @param  [object] $wp_customize [customizer object].
 */
function shopkeeper_customizer_shop_product_badges_controls( $wp_customize ) {

    // Out of Stock Label.
    $wp_customize->add_setting(
		'out_of_stock_label',
		array(
			'type'       => 'theme_mod',
			'capability' => 'edit_theme_options',
            'sanitize_callback' => 'wp_filter_nohtml_kses',
			'default'    => esc_html__( 'Out of stock', 'shopkeeper' ),
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'out_of_stock_label',
			array(
				'type'        => 'text',
				'label'       => esc_attr__( 'Out of Stock Label', 'shopkeeper' ),
				'section'     => 'product_badges',
				'priority'    => 10,
                'description' => wp_kses_post( __('<span class="dashicons dashicons-editor-help"></span>If you\'re using a multi language plugin we recommend leaving the default value.', 'shopkeeper') ),
			)
		)
	);

    // Sale Label.
    $wp_customize->add_setting(
		'sale_label',
		array(
			'type'       => 'theme_mod',
			'capability' => 'edit_theme_options',
            'sanitize_callback' => 'wp_filter_nohtml_kses',
			'default'    => esc_html__( 'Sale!', 'shopkeeper' ),
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'sale_label',
			array(
				'type'        => 'text',
				'label'       => esc_attr__( 'Sale Label', 'shopkeeper' ),
				'section'     => 'product_badges',
				'priority'    => 10,
                'description' => wp_kses_post( __('<span class="dashicons dashicons-editor-help"></span>If you\'re using a multi language plugin we recommend leaving the default value.', 'shopkeeper') ),
			)
		)
	);
}

?>
