<?php// exit if accessed directlyif (!defined('ABSPATH')) {	exit;}//hook the output to wp_footeradd_action( 'wp_footer', 'rpsi_cta_output_fn' );function rpsi_cta_output_fn(){ 	$options = rpsi_cta_options_globals();	$rpsi_cta_activate = $options['rpsi_cta_field_activate_output'];		if( $rpsi_cta_activate == 1 ) :	$rpsi_cta_default_state = $options['rpsi_cta_field_default_state'];	$rpsi_cta_display_delay = $options['rpsi_cta_field_display_delay'];	$rpsi_cta_txt = $options['rpsi_cta_field_cta_txt'];	$rpsi_posts_num = $options['rpsi_cta_field_posts_num'];	//add our assets	require_once RPSI_CTA_DIR . 'assets/css.php';		if($rpsi_cta_default_state == 'Close' || $rpsi_cta_default_state == 'Open' && $rpsi_cta_display_delay > 0 ) {		$rpsi_toggler_class = 'rpsi_toggle';	}else{		$rpsi_toggler_class = '';	}	?><script type="text/javascript">	jQuery(document).ready(function($){		$('.rpsi_cta_toggler').click(function(){			$('.rpsi_cta_wrap').toggleClass('rpsi_toggle');		});		<?php 				if( $rpsi_cta_default_state == 'Open' && $rpsi_cta_display_delay > 0 ) : ?>					var $rows = $('.rpsi_cta_wrap');		   setTimeout(function() {			   $rows.removeClass("rpsi_toggle");		   }, <?php echo $rpsi_cta_display_delay; ?>);				<?php endif; ?>	});</script>	<div class="rpsi_cta_wrap <?php echo $rpsi_toggler_class; ?>">		<span class="rpsi_cta_toggler rpsi_cta_toggler_on">			<?php echo apply_filters( 'rpsi_cta_toggler_on_txt', 'Top Offers' );?>		</span>		<span class="rpsi_cta_toggler rpsi_cta_toggler_off">			<?php echo apply_filters( 'rpsi_cta_toggler_off_txt', 'Hide Me' ); ?>		</span>			<div class="rpsi_cta_inner">			<div class="rpsicta_wrap">			<?php echo wp_kses_post( $rpsi_cta_txt ); ?>			</div>			<div class="rpsi_heading">				<?php echo apply_filters( 'rpsi_heading_txt', 'Latest Posts' );?> 			</div>			<?php				$rpsi_args = array(				'post_type' => 'post',				'posts_per_page' => $rpsi_posts_num,			);			$rpsi_query = new WP_Query( $rpsi_args ); 			if ( $rpsi_query->have_posts() ) : ?>				<?php while ( $rpsi_query->have_posts() ) : $rpsi_query->the_post(); ?>					<a class="rpsi_block" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">					<?php if ( has_post_thumbnail() ) :  the_post_thumbnail( 'thumbnail', array( 'class' => 'rpsi_thumb' ) ); endif; 										echo'<div class="rpsi_content_wrap"><div class="rpsi_title">'.get_the_title().'</div>';					echo'<div class="rpsi_content">'.wp_trim_words( get_the_content(), 12, ' ...' ).'</div></div>';					echo'  </a>';				endwhile;							wp_reset_postdata();			else :				// If no content, echo "No posts found" .				echo'No Posts Found';			endif;			?>		</div><!--inner-->	</div><!--wrap--><?php endif;}