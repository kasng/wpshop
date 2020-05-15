<?php
/**
* The Header Logo section options.
*
* @package shopkeeper
*/

add_action( 'customize_register', 'shopkeeper_customizer_header_logo_controls' );
/**
 * Adds controls for header logo section.
 *
 * @param  [object] $wp_customize [customizer object].
 */
function shopkeeper_customizer_header_logo_controls( $wp_customize ) {

    // Logo.
    $wp_customize->add_setting(
        'site_logo',
        array(
            'type'       => 'theme_mod',
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'shopkeeper_sanitize_image',
            'default'	 => get_template_directory_uri() . '/images/shopkeeper-logo.png',
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'site_logo',
            array(
                'type'        => 'image',
                'label'       => esc_html__( 'Logo', 'shopkeeper' ),
                'section'     => 'header_logo',
                'description' => wp_kses( __( '<span class="dashicons dashicons-editor-help"></span>Applied on Non-Transparent Headers. To upload a logo for a Transparent Background go to <strong>Header Transparency</strong> section.', 'shopkeeper' ), array( 'span' => array( 'class' => array() ), 'strong' => array() )),
                'priority'    => 10,
            )
        )
    );

    // Alternative Logo.
    $wp_customize->add_setting(
        'sticky_header_logo',
        array(
            'type'       => 'theme_mod',
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'shopkeeper_sanitize_image',
            'default'	 => get_template_directory_uri() . '/images/shopkeeper-logo.png',
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'sticky_header_logo',
            array(
                'type'        => 'image',
                'label'       => esc_html__( 'Alternative Logo', 'shopkeeper' ),
                'section'     => 'header_logo',
                'description' => wp_kses( __('<span class="dashicons dashicons-editor-help"></span>Used on the <strong>Sticky Header</strong> and <strong>Mobile Devices</strong>.', 'shopkeeper' ), array( 'span' => array( 'class' => array() ), 'strong' => array() )),
                'priority'    => 10,
            )
        )
    );

    // Logo Container Min Width.
    $wp_customize->add_setting(
        'logo_min_height',
        array(
            'type'       => 'theme_mod',
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'absint',
            'default'    => 50,
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'logo_min_height',
            array(
                'type'        => 'number',
                'label'       => esc_html__( 'Logo Container Min Width', 'shopkeeper' ),
                'description' => esc_html__( "(0px - 600px)", 'shopkeeper' ),
                'section'     => 'header_logo',
                'priority'    => 10,
                'input_attrs' => array(
                    'min'  => 0,
                    'max'  => 600,
                    'step' => 1,
                ),
            )
        )
    );

    // Logo Container Height.
    $wp_customize->add_setting(
        'logo_height',
        array(
            'type'       => 'theme_mod',
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'absint',
            'default'    => 50,
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'logo_height',
            array(
                'type'        => 'number',
                'label'       => esc_html__( 'Logo Container Height', 'shopkeeper' ),
                'description' => esc_html__( "(0px - 300px)", 'shopkeeper' ),
                'section'     => 'header_logo',
                'priority'    => 10,
                'input_attrs' => array(
                    'min'  => 0,
                    'max'  => 300,
                    'step' => 1,
                ),
            )
        )
    );
}

?>
