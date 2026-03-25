<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package yellowbox
 */

	$navigation_layout = ( get_field('navigation_layout', 'options') ?? 'one' );

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php if( $custom_font = get_field('font_embed_code', 'options') ) { echo $custom_font; } ?>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<?php do_action('yellowbox_before_page'); ?>
<div id="page" class="site">


	<?php get_template_part('partials/navigation/layout-' . $navigation_layout ); ?>

  <?php do_action('yellowbox_after_navbar'); ?>

	<?php
		$header_style = get_field('header_style');
    if( is_home() || is_archive() || is_tax() ) {
      get_template_part('partials/header/archive');
		} elseif( $header_style != 'hidden' ) {
			get_template_part('partials/header/' . $header_style );
		}
	?>

  <?php do_action('yellowbox_after_header'); ?>