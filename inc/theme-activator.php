<?php

// Update Media Sizes on Theme Activation
function yellowbox_set_wordpress_settings() {

    // Media settings
    update_option( 'thumbnail_size_w', 500 );
    update_option( 'thumbnail_size_h', 500 );
    update_option( 'thumbnail_crop', 1 );

    update_option( 'medium_size_w', 1000 );
    update_option( 'medium_size_h', 1000 );

    update_option( 'large_size_w', 1500 );
    update_option( 'large_size_h', 1500 );

    // Site Language
    update_option( 'WPLANG', 'en_GB' );

    // Time zone: London, UK
    update_option( 'timezone_string', 'Europe/London' );
    update_option( 'gmt_offset', 0 );

    // Date & time formats
    update_option( 'date_format', 'd/m/Y' ); // dd/mm/yyyy

}
add_action( 'after_switch_theme', 'yellowbox_set_wordpress_settings' );