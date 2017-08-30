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

/* Login */

function my_login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-color: transparent;
            background-image: url(<?php
                if( @fopen( get_template_directory_uri()."/images/Logo.png", "r" ) ) {
                    echo get_template_directory_uri()."/images/Logo.png";
                } else {
                    echo plugins_url()."/DesignbueroFreisePlugIn/Designbuero-Freise.png";
                }
            ?>);
            padding-bottom: 30px;
            width: 310px;
            height: 75px;
            background-size: contain;
            background-position: center bottom;
        }
    </style>
<?php }

add_action( 'login_enqueue_scripts', 'my_login_logo' );

function df_dashboard_information() {

	wp_add_dashboard_widget(
                 'df_dashboard_information',
                 'Designbüro Freise Bielefeld',
                 'wp_add_dashboard_widget_cb'
        );
}
add_action( 'wp_dashboard_setup', 'df_dashboard_information' );

function df_dashboard_information_enq() {

	wp_enqueue_style ( "df_dashboard_information", plugins_url()."/designbuerofreise/styles.css");

}

add_action( 'admin_init', 'df_dashboard_information_enq' );

function wp_add_dashboard_widget_cb() {

	?>
	<div id="df_dashboard_information">
		<p><img src="<?php echo plugins_url();?>/DesignbueroFreisePlugIn/Designbuero-Freise.png" alt="Designbüro Freise"></p>
		<p><strong>Vielen Dank, dass Sie sich für das Designbüro Freise entschieden haben. Bei Fragen rund um Ihr Wordpress und Ihre Website freuen wir uns über einen Anruf oder über eine E-Mail.</strong></p>
		<h2>So erreichen Sie uns:</h2>
		<p><strong>Telefon: <a href="tel:+4952199997860">+49 (0) 521 . 9999786-0</a></strong><br>
		<strong>E-Mail: <a href="mailto:info@designbuero-freise.de">info@designbuero-freise.de</a></strong></p>
		<h3><strong>Aktuelle Informationen</strong></h3>
		<p>Verfolgen Sie <a href="http://www.designbuero-freise.de/">unser Weblog</a> oder <a href="https://www.facebook.com/designbuero.freise">unsere Facebook-Seite</a>. Regelmäßig informieren wir dort über aktuelle Trends, unsere Arbeit und Dinge, die glücklich machen.</p>
	</div>
	<?php

}

/* Dashboard */

?>
