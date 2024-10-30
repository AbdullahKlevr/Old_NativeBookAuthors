<?php
/**
 * The template for displaying all blog posts
 * This template can be overridden by copying it to yourtheme/bdp_templates/blog/ticker.php.
 *
 * @link       https://www.solwininfotech.com/
 * @since      2.3
 *
 * @package    Blog_Designer_PRO
 * @subpackage Blog_Designer_PRO/admin
 * @author     Solwin Infotech <info@solwininfotech.com>
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post;
?>
<li>
<?php
	$bdp_post_title_link = isset( $bdp_settings['bdp_post_title_link'] ) ? $bdp_settings['bdp_post_title_link'] : 1;
if ( 1 == $bdp_post_title_link ) {
	echo '<a class="blog-ticker-anchor" href="' . esc_url( get_the_permalink() ) . '" title="' . esc_html( get_the_title() ) . '">';
}
	echo esc_html( get_the_title() );
if ( 1 == $bdp_post_title_link ) {
	echo '</a>';
}
?>
</li>
