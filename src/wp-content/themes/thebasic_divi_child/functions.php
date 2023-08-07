<?php

/*----------The Basic Child Theme Functions.php----------*/

function thebasic_enqueue_scripts() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

}
add_action( 'wp_enqueue_scripts', 'thebasic_enqueue_scripts' );