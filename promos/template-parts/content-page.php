<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Promos
 */
global $promos_theme_options;
$image_option = absint($promos_theme_options['promos-single-page-featured-image']);
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="post-wrap">
        <div class="post-media">
            <?php
            if ($image_option == 1) {
                promos_post_thumbnail();
            }
            ?>
        </div>
        <div class="post-content">
            <?php the_title('<h1 class="post-title entry-title">', '</h1>'); ?>
            <div class="post-excerpt entry-content">
                <?php
                
                the_content();
                
                wp_link_pages(array(
                    'before' => '<div class="page-links">' . esc_html__('Pages:', 'promos'),
                    'after' => '</div>',
                ));
                ?>
                <!-- read more -->
                <?php if (!empty($read_more)): ?>
                    <a class="more-link" href="<?php the_permalink(); ?>"><?php echo esc_html($read_more); ?> <i
                                class="fa fa-long-arrow-right"></i>
                    </a>
                <?php endif; ?>
            </div>
            <!-- .entry-content end -->
            <footer class="post-footer entry-footer">
                <?php promos_entry_meta(); ?>
                <?php do_action( 'promos_social_sharing' ,get_the_ID() );?>
            </footer><!-- .entry-footer end -->
        </div>
    </div>
</article><!-- #post-->

