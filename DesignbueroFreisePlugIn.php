<?php
/*
Plugin Name: Designbüro Freise Diverse Hilfsfunktionen
Plugin URI: http://www.desingbuero-freise.de/
Description:
Version: 1.0.
Author: Markus Freise
Author URI: http://markus-freise.de/
*/

add_filter( 'use_default_gallery_style', '__return_false' );

add_shortcode( 'gallery', 'custom_gallery_shortcode' );

function custom_gallery_shortcode( $attr = array(), $content = '' )
{
        $attr['itemtag']        = "div";
        $attr['icontag']        = "";
        $attr['captiontag']     = "p";

        // Run the native gallery shortcode callback:
        $html = gallery_shortcode( $attr );

        // Remove all tags except a, img,li, p
        $html = strip_tags( $html, '<div><a><img><li><p>' );

        // Some trivial replacements:
        $from = array(
            'a href='
        );
        $to = array(
            'a href='
        );
        $html = str_replace( $from, $to, $html );

        // Remove width/height attributes:
        $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );

        // Wrap the output in ul tags:
        $html = sprintf( '%s', $html );

        return $html;
}

function my_login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-color: transparent;
            background-image: url(<?php echo plugins_url(); ?>/DesignbueroFreisePlugIn/Designbuero-Freise.png);
            padding-bottom: 30px;
            width: 310px;
            height: 75px;
            background-size: contain;
        }
    </style>
<?php }

add_action( 'login_enqueue_scripts', 'my_login_logo' );


?>
