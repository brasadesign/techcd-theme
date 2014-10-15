<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till #main div
 *
 * @package Odin
 * @since 2.2.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="no-js ie ie7 lt-ie9 lt-ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="no-js ie ie8 lt-ie9" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8) ]><!-->
<html class="no-js" <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<link href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon.ico" rel="shortcut icon" />
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/assets/js/html5.js"></script>
	<![endif]-->
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div class="container">
		<div id="page" class="site-main curved-top row">
			<div class="col-md-12 login_top">
				<a href="#" id="login-box">Login</a>
			</div><!-- .col-md-12 login_top -->
			<header id="header" role="banner" class="col-md-12">
				<div class="col-md-3 pull-left logo">
					<img src="<?php bloginfo('template_url');?>/assets/images/logo-techcd.png">
				</div><!-- .col-md-4 pull-left logo -->
				<nav id="top-menu" class="col-md-7" role="navigation">
					<div class="main">
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'main-menu',
								'depth'          => 2,
								'container'      => false,
								'menu_class'     => 'nav navbar-nav',
								'fallback_cb'    => 'Odin_Bootstrap_Nav_Walker::fallback',
								'walker'         => new Odin_Bootstrap_Nav_Walker()
								)
							);
						?>
					</div><!-- .main -->
				</nav><!-- #main-menu -->
				<div class="col-md-12 clear" style="clear:both"></div>
					<div id="search" class="pull-right busca_top">
						<form action="#" id="form-search">
							<fieldset>
								<input type="text" placeholder="Busca" class="input-text autoclear" /><input type="submit" value="" class="input-submit" />
							</fieldset>
						</form>
					</div><!-- .col-md-2 busca_top -->
				</header><!-- #header -->
