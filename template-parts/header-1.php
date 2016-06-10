<?php global $bpxl_travelista_options; ?>
<header class="main-header clearfix">
	<div class="top-bar clearfix">
		<div class="top-nav clearfix">
			<div class="center-width">
				<div class="menu-btn off-menu fa fa-align-justify" data-effect="st-effect-4"></div>
				<nav class="nav-menu" >
					<?php if ( has_nav_menu( 'secondary-menu' ) ) {
						wp_nav_menu( array( 'theme_location' => 'secondary-menu', 'menu_class' => 'menu', 'container' => '', 'walker' => new bpxl_nav_walker ) );
					} ?>
				</nav>
				<?php 
				if ($bpxl_travelista_options['bpxl_header_search'] == '1') { ?>
					<div class="header-search"><?php get_search_form(); ?></div>
				<?php }

				if ($bpxl_travelista_options['bpxl_social_links'] == '1') {
					bpxl_social_links( 'header' );
				} ?>
			</div><!-- .main-nav -->
		</div><!-- .top-nav -->
	</div><!-- .top-bar -->
	<div class="header clearfix">
		<div class="container">
			<div class="logo-wrap">
				<?php if (!empty($bpxl_travelista_options['bpxl_logo']['url'])) { ?>
					<div id="logo" class="uppercase">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
							<img width="<?php echo intval( $bpxl_travelista_options['bpxl_logo']['width'] ); ?>" height="<?php echo intval( $bpxl_travelista_options['bpxl_logo']['height'] ); ?>" src="<?php echo esc_url( $bpxl_travelista_options['bpxl_logo']['url'] ); ?>" <?php if (!empty($bpxl_travelista_options['bpxl_retina_logo']['url'])) { echo 'data-at2x="'.$bpxl_travelista_options['bpxl_retina_logo']['url'].'"';} ?> alt="<?php bloginfo( 'name' ); ?>">
						</a>
					</div>
				<?php } else { ?>
					<?php if( is_front_page() || is_home() || is_404() ) { ?>
						<h1 id="logo" class="uppercase">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
						</h1>
					<?php } else { ?>
						<h2 id="logo" class="uppercase">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
						</h2>
					<?php } ?>
				<?php } ?>
				<?php if ($bpxl_travelista_options['bpxl_tagline'] == '1') { ?>
					<span class="tagline">
						<?php bloginfo( 'description' ); ?>
					</span>
				<?php } ?>
			</div><!--.logo-wrap-->
		</div><!-- .container -->
	</div><!-- .header -->
	<div class="main-navigation clearfix">
		<div class="main-nav nav-down clearfix">
			<div class="center-width">
				<nav class="nav-menu" >
					<?php if ( has_nav_menu( 'main-menu' ) ) {
						wp_nav_menu( array( 'theme_location' => 'main-menu', 'menu_class' => 'menu', 'container' => '', 'walker' => new bpxl_nav_walker ) );
					} ?>
				</nav>
			</div><!-- .center-width -->
		</div><!-- .main-nav -->
	</div><!-- .main-navigation -->
</header>