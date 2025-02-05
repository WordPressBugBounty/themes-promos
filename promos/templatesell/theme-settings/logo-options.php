<?php 
/*Logo Section*/
$wp_customize->add_setting( 'promos_options[promos_logo_width_option]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['promos_logo_width_option'],
    'sanitize_callback' => 'absint'
) );
$wp_customize->add_control( 'promos_options[promos_logo_width_option]', array(
   'label'     => __( 'Logo Width', 'promos' ),
   'description' => __('Adjust the logo width. Minimum is 100px and maximum is 700px.', 'promos'),
   'section'   => 'title_tagline',
   'settings'  => 'promos_options[promos_logo_width_option]',
   'type'      => 'range',
   'priority'  => 15,
   'input_attrs' => array(
          'min' => 100,
          'max' => 700,
        ),
) );