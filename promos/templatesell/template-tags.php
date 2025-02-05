<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Promos
 */
if ( ! function_exists( 'promos_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function promos_posted_on() {		
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = 
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>';

	$byline = sprintf(
            esc_html_x('By %s', 'post author', 'promos'),
            '<span class="author vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span>'
        );
        echo '<span class="posted-on">' . $posted_on . '</span>';
	}
endif;

if ( ! function_exists( 'promos_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function promos_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x('by %s', 'post author', 'promos' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);
        echo '<span class="post_by"> ' . $byline . '</span>'; // WPCS: XSS OK.
	}
endif;

if ( ! function_exists( 'promos_entry_meta' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function promos_entry_meta() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( '&nbsp;', 'promos' ) );

		if ( $categories_list ) {
			echo '<span class="cat-links">' . $categories_list . '</span>';
		}
      	
	}
	}
endif;


if (!function_exists('promos_meta_tags')) :
    /**
     * Prints HTML with meta information for the tags.
     */
    function promos_meta_tags(){
        /* translators: used between list items, there is a space after the comma */
        $tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'promos' ) );
        if ( $tags_list ) {
            /* translators: 1: list of tags. */
            printf( '<div class="entry-meta entry-meta-footer"> <span class="tags-links"><i class="fa fa-tag"></i> ' . esc_html( '%1$s', 'promos' ) . '</span></div>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        }
    }
endif;

/**
 * Post Thumbnail
 *
 *  @since Promos 1.0.0
 */
if (!function_exists('promos_post_thumbnail')) :
    /**
     * Displays an optional post thumbnail.
     *
     * Wraps the post thumbnail in an anchor element on index views, or a div
     * element when on single views.
     */
    function promos_post_thumbnail()
    {
        if (post_password_required() || is_attachment() || !has_post_thumbnail()) {
            return;
        }

        if (is_singular()) :
            ?>

            <div class="post-thumbnail">
                <?php the_post_thumbnail( 'full' ); ?>
            </div><!-- .post-thumbnail -->

        <?php else : ?>
            <?php
            $image_size = 'large';
            global $promos_theme_options;
            $image_location = esc_html( $promos_theme_options['promos-blog-image-layout'] );
            if( $image_location == 'full-image' ){
                $image_size = 'full';
            }if($image_location == 'left-image'){
                $image_size = 'full';
            }if($image_location == 'right-image'){
                $image_size = 'full';
            }
                ?>
                <a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
                    <?php

                    the_post_thumbnail( $image_size, array(
                        'class' => $image_location,
                        'alt' => the_title_attribute(array(
                                'echo' => false,
                            )
                        )
                    ));
                    ?>
                </a>
            <?php
            ?>
        <?php endif; // End is_singular().
    }
endif;