<?php
get_header('shop'); ?>
<div class="col-md-12 clear-mob"></div>
<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
	<header class="col-md-12 wooheader">
		<div class="col-md-5 pull-left">
			<h1 class="page-title"><?php _e('Downloads','techcd-theme'); ?></h1>
		</div><!-- .col-md-5 pull-left -->
		<div class="col-md-12 clear-mob"></div>
		<div class="col-md-7 woo-term-maislidos pull-right">
			<?php do_action('woo_term_hide_mini_query'); ?>
		</div><!-- .pull-right -->
	</header><!-- .wooheader -->
<?php endif; ?>
<div class="col-md-12 clear-mob"></div>
<?php get_template_part('content','pagination'); ?>
<div class="col-md-3" id="sidebar-woo">
	<?php get_sidebar('woo'); ?>
</div><!-- #sidebar-woo.col-md-2 -->
<div class="col-md-12 clear-mob"></div>
<div id="primary" class="col-md-8 pull-right">
	<div class="col-md-12 clear-mob"></div>
	<div id="content" class="site-content" role="main">
		<?php $args = array(
			'taxonomy' => 'downloads_tipos'
			);
		$cats = get_categories($args);
		foreach($cats as $cat):
	    ?>
	    <h5><?php echo $cat->name; ?></h5>
	    <?php
	    // WP_Query arguments
	    $args = array (
	    	'post_type'              => 'downloads',
	    	'posts_per_page'         => -1,
	        'tax_query' => array(
	        	array(
	        	'taxonomy' => 'downloads_tipos',
	        	'field'    => 'slug',
	        	'terms'    => $cat->slug,
	        	),
	        ),

	    	);
	    // The Query
	    $query = new WP_Query( $args );
	    // The Loop
	    if ( $query->have_posts() ) {
	    	while ( $query->have_posts() ) {
	    		$query->the_post();
	    		// do something
	    		get_template_part( 'content', 'downloads' );
	    	}
	    }
	    wp_reset_postdata();
		?>
	   <?php endforeach; ?>
	</div><!-- #content -->
	<div class="col-md-12 clear-mob"></div>
</div><!-- #primary -->
<?php get_template_part('content','pagination'); ?>
<?php get_template_part('content','bottom'); ?>
<?php
get_footer();
?>
