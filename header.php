<?php
/**
 * The Header for our theme - this is dependent on the page we're currently on.
 * Displays all of the <head> section and everything up till <div id="wrap">
 */
?><!DOCTYPE html>

<html class="no-js" <?php language_attributes(); ?>>

<head>

	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php echo bloginfo( 'pingback_url' ); ?>">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<!-- BEGIN #wrapper -->
<div id="wrapper">

<!-- BEGIN .container -->
<div class="container">

<!-- BEGIN #navigation -->
<nav id="navigation" class="navigation-main fixed-nav clearfix" role="navigation">

	<button class="menu-toggle"><i class="fa fa-bars"></i></button>

	<?php		
		wp_nav_menu( array(
			'theme_location' 		=> 'fixed-menu',
			'title_li' 					=> '',
			'depth' 						=> 4,
			'container_class' 	=> '',
			'menu_class'      	=> 'menu',
			)
		);
		
	?>

<!-- END #navigation -->
</nav>

<!-- BEGIN #header -->
<div id="header">
		<div id="custom-header" class="fixed-menu" style="background-image: url(<?php echo(sh_header_image_uri()); ?>);" data-type="background">
			<img class="hide-img" src="<?php echo(sh_header_image_uri()) ?>" height="170" width="1180" alt="<?php echo esc_attr( get_bloginfo() ); ?>" />
		</div>
</div>

<?php if ( has_nav_menu( 'main-menu' ) ) { ?>

<!-- BEGIN #navigation -->
<nav id="navigation" class="navigation-main clearfix" role="navigation">

	<?php if ( ! has_nav_menu( 'fixed-menu' ) ) { ?>
		<button class="menu-toggle"><i class="fa fa-bars"></i></button>
	<?php } ?>

	<?php
		wp_nav_menu( array(
			'theme_location' 		=> 'main-menu',
			'title_li' 					=> '',
			'depth' 						=> 4,
			'container_class' 	=> '',
			'menu_class'      	=> 'menu',
			)
		);
	?>
	<a href=''>Logout</a>

<!-- END #navigation -->
</nav>

<?php } ?>
