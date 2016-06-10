<!DOCTYPE html>
<?php global $bpxl_travelista_options; ?>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<meta name="viewport" content="width=device-width" />
	<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<?php wp_head(); ?>
</head>

<?php if($bpxl_travelista_options['bpxl_layout_type'] != '1') { $layout_class = ' boxed-layout'; } ?>
<body id="blog" <?php body_class('main'); ?> itemscope itemtype="http://schema.org/WebPage">
	<div id="st-container" class="st-container">
		<nav class="st-menu st-effect-4" id="menu-4">
			<div id="close-button"><i class="fa fa-times"></i></div>
			<div class="off-canvas-search">
				<div class="header-search off-search"><?php get_search_form(); ?></div>
			</div>
			<?php if ( has_nav_menu( 'main-menu' ) ) {
				wp_nav_menu( array( 'theme_location' => 'main-menu', 'menu_class' => 'menu', 'container' => '', 'walker' => new bpxl_nav_walker_mobile ) ); ?>
			<?php } ?>
			<?php if ( has_nav_menu( 'secondary-menu' ) ) {
				wp_nav_menu( array( 'theme_location' => 'secondary-menu', 'menu_class' => 'menu', 'container' => '', 'walker' => new bpxl_nav_walker_mobile ) );
			} ?>
		</nav>
		<div class="main-container<?php if($bpxl_travelista_options['bpxl_layout_type'] != '1') { echo $layout_class; } ?>">
			<div class="menu-pusher">
				<!-- START HEADER -->
				<?php 
					if ( !empty($bpxl_travelista_options['bpxl_header_style']) )  {
						$bpxl_header_style = $bpxl_travelista_options['bpxl_header_style'];
					} else {
						$bpxl_header_style = '1';
					}
					get_template_part('template-parts/header-'.$bpxl_header_style );
				?>
				<!-- END HEADER -->