<?php
/**
* The Header Sticky section options.
*
* @package shopkeeper
*/

/**
 * Checks if sticky header is enabled.
 */
function sk_header_is_sticky(){

    return Shopkeeper_Opt::getOption( 'sticky_header', true );
}

add_action( 'customize_register', 'shopkeeper_customizer_header_sticky_controls' );
/**
 * Adds controls for header sticky section.
 *
 * @param  [object] $wp_customize [customizer object].
 */
function shopkeeper_customizer_header_sticky_controls( $wp_customize ) {

    // Sticky Header.
    $wp_customize->add_setting(
		'sticky_header',
		array(
			'type'                 => 'theme_mod',
			'capability'           => 'edit_theme_options',
			'sanitize_callback'    => 'shopkeeper_sanitize_checkbox',
			'default'              => true,
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'sticky_header',
			array(
				'type'     => 'checkbox',
				'label'    => esc_html__( 'Sticky Header', 'shopkeeper' ),
				'section'  => 'sticky_header',
				'priority' => 10,
			)
		)
	);

    // Sticky Header Background Color.
    $wp_customize->add_setting(
        'sticky_header_background_color',
        array(
            'type'       => 'theme_mod',
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_hex_color',
            'default'    => '#fff',
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'sticky_header_background_color',
            array(
                'label'    => esc_html__( 'Sticky Header Background Color', 'shopkeeper' ),
                'section'  => 'sticky_header',
                'priority' => 10,
                'active_callback' => 'sk_header_is_sticky',
            )
        )
    );

    // Sticky Header Text Color.
    $wp_customize->add_setting(
        'sticky_header_color',
        array(
            'type'       => 'theme_mod',
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_hex_color',
            'default'    => '#000',
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'sticky_header_color',
            array(
                'label'    => esc_html__( 'Sticky Header Text Color', 'shopkeeper' ),
                'section'  => 'sticky_header',
                'priority' => 10,
                'active_callback' => 'sk_header_is_sticky',
            )
        )
    );
}

?>
