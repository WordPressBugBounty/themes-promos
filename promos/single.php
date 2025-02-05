<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Promos
 */
get_header();
?>
<section id="content" class="site-content posts-container">
    <div class="container">
        <div class="row">
			<div class="breadcrumbs-wrap">
				<?php 
				// Breadcrumb hook
				do_action('promos_breadcrumb_options_hook'); ?> 
			</div>
			<div id="primary" class="col-lg-9 content-area">
				<main id="main" class="site-main">
					<?php
						while ( have_posts() ) :
							the_post();

							get_template_part( 'template-parts/content', 'single' );
						
						// If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() ) :
								comments_template();
							endif;						   
			            endwhile; // End of the loop.
			        ?>
				</main><!-- #main -->
			</div><!-- #primary -->
			<?php get_sidebar(); ?>
		</div>
	</div>
</section>
<section class="">
    <div class="container">
        <div class="row">
        	<div class="col-sm-12">
				<?php 
				/**
				 * promos_related_posts hook
				 * @since Promos 1.0.0
				 *
				 * @hooked promos_related_posts -  10
				 */
				do_action( 'promos_related_posts' ,get_the_ID() );
				?>
			</div>
		</div>
	</div>
</section>
<?php  get_footer();

