<?PHP
function recent_posts( $atts ) {

	$atts = shortcode_atts(
		array(
			'posts_number' => 3,
		), $atts, 'recent_posts' );

  	global $post;

	$html = "";

	$my_query = new WP_Query( array(
		'post_type' => 'post',
		'posts_per_page' => $atts['posts_number']
	));

	if( $my_query->have_posts() ) : while( $my_query->have_posts() ) : $my_query->the_post();

		$html .= "<a href='" . get_the_permalink() . "'>";
		$html .= "<div class='news-section__content__single'><div class='news-section__content__image'>" . get_the_post_thumbnail( $the_post->ID, 'small' ). "</div>";
		$html .= "<div class='news-section__content__excerpt'><h2 class='news-section__content__title'>" . get_the_title() . " [" . get_the_date() . "] </h2>";
		$html .= "<p>" . get_the_excerpt() . "</p></div></div></a>";

		endwhile; 
		wp_reset_postdata();
	endif;

	return $html;
}
 add_shortcode( 'recent_posts', 'recent_posts' );
