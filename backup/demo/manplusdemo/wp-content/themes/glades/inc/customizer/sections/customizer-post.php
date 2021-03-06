<?php
/**
 * Register Post Settings section, settings and controls for Theme Customizer
 *
 */

// Add Theme Colors section to Customizer
add_action( 'customize_register', 'glades_customize_register_post_settings' );

function glades_customize_register_post_settings( $wp_customize ) {

	// Add Sections for Post Settings
	$wp_customize->add_section( 'glades_section_post', array(
        'title'    => esc_html__( 'Post Settings', 'glades' ),
        'priority' => 30,
		'panel' => 'glades_options_panel' 
		)
	);

	// Add Settings and Controls for Posts
	$wp_customize->add_setting( 'glades_theme_options[posts_length]', array(
        'default'           => 'excerpt',
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'glades_sanitize_post_length'
		)
	);
    $wp_customize->add_control( 'glades_control_posts_length', array(
        'label'    => esc_html__( 'Post length on archives', 'glades' ),
        'section'  => 'glades_section_post',
        'settings' => 'glades_theme_options[posts_length]',
        'type'     => 'radio',
		'priority' => 1,
        'choices'  => array(
            'index' => esc_html__( 'Show full posts', 'glades' ),
            'excerpt' => esc_html__( 'Show post excerpts', 'glades' )
			)
		)
	);
	
	// Add Post Images Headline
	$wp_customize->add_setting( 'glades_theme_options[post_images]', array(
        'default'           => '',
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'esc_attr'
        )
    );
    $wp_customize->add_control( new Glades_Customize_Header_Control(
        $wp_customize, 'glades_control_post_images', array(
            'label' => esc_html__( 'Post Images', 'glades' ),
            'section' => 'glades_section_post',
            'settings' => 'glades_theme_options[post_images]',
            'priority' => 	2
            )
        )
    );
	$wp_customize->add_setting( 'glades_theme_options[post_thumbnails_index]', array(
        'default'           => true,
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'glades_sanitize_checkbox'
		)
	);
    $wp_customize->add_control( 'glades_control_posts_thumbnails_index', array(
        'label'    => esc_html__( 'Display featured images on archive pages', 'glades' ),
        'section'  => 'glades_section_post',
        'settings' => 'glades_theme_options[post_thumbnails_index]',
        'type'     => 'checkbox',
		'priority' => 3
		)
	);

	$wp_customize->add_setting( 'glades_theme_options[post_thumbnails_single]', array(
        'default'           => true,
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'glades_sanitize_checkbox'
		)
	);
    $wp_customize->add_control( 'glades_control_posts_thumbnails_single', array(
        'label'    => esc_html__( 'Display featured images on single posts', 'glades' ),
        'section'  => 'glades_section_post',
        'settings' => 'glades_theme_options[post_thumbnails_single]',
        'type'     => 'checkbox',
		'priority' => 4
		)
	);
	
	// Add Post Meta Settings
	$wp_customize->add_setting( 'glades_theme_options[postmeta_headline]', array(
        'default'           => '',
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'esc_attr'
        )
    );
    $wp_customize->add_control( new Glades_Customize_Header_Control(
        $wp_customize, 'glades_control_postmeta_headline', array(
            'label' => esc_html__( 'Post Meta', 'glades' ),
            'section' => 'glades_section_post',
            'settings' => 'glades_theme_options[postmeta_headline]',
            'priority' => 5
            )
        )
    );
	$wp_customize->add_setting( 'glades_theme_options[meta_date]', array(
        'default'           => true,
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'glades_sanitize_checkbox'
		)
	);
    $wp_customize->add_control( 'glades_control_meta_date', array(
        'label'    => esc_html__( 'Display post date', 'glades' ),
        'section'  => 'glades_section_post',
        'settings' => 'glades_theme_options[meta_date]',
        'type'     => 'checkbox',
		'priority' => 6
		)
	);
	$wp_customize->add_setting( 'glades_theme_options[meta_author]', array(
        'default'           => true,
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'glades_sanitize_checkbox'
		)
	);
    $wp_customize->add_control( 'glades_control_meta_author', array(
        'label'    => esc_html__( 'Display post author', 'glades' ),
        'section'  => 'glades_section_post',
        'settings' => 'glades_theme_options[meta_author]',
        'type'     => 'checkbox',
		'priority' => 7
		)
	);
	$wp_customize->add_setting( 'glades_theme_options[meta_category]', array(
        'default'           => true,
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'glades_sanitize_checkbox'
		)
	);
    $wp_customize->add_control( 'glades_control_meta_category', array(
        'label'    => esc_html__( 'Display post categories', 'glades' ),
        'section'  => 'glades_section_post',
        'settings' => 'glades_theme_options[meta_category]',
        'type'     => 'checkbox',
		'priority' => 8
		)
	);
	$wp_customize->add_setting( 'glades_theme_options[meta_tags]', array(
        'default'           => true,
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'glades_sanitize_checkbox'
		)
	);
    $wp_customize->add_control( 'glades_control_meta_tags', array(
        'label'    => esc_html__( 'Display post tags', 'glades' ),
        'section'  => 'glades_section_post',
        'settings' => 'glades_theme_options[meta_tags]',
        'type'     => 'checkbox',
		'priority' => 9
		)
	);
	
	// Add Post Footer Settings
	$wp_customize->add_setting( 'glades_theme_options[post_footer_headline]', array(
        'default'           => '',
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'esc_attr'
        )
    );
    $wp_customize->add_control( new Glades_Customize_Header_Control(
        $wp_customize, 'glades_control_post_footer_headline', array(
            'label' => esc_html__( 'Post Footer', 'glades' ),
            'section' => 'glades_section_post',
            'settings' => 'glades_theme_options[post_footer_headline]',
            'priority' => 12
            )
        )
    );
	$wp_customize->add_setting( 'glades_theme_options[post_navigation]', array(
        'default'           => false,
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'glades_sanitize_checkbox'
		)
	);
    $wp_customize->add_control( 'glades_control_post_navigation', array(
        'label'    => esc_html__( 'Display post navigation on single posts', 'glades' ),
        'section'  => 'glades_section_post',
        'settings' => 'glades_theme_options[post_navigation]',
        'type'     => 'checkbox',
		'priority' => 13
		)
	);

}