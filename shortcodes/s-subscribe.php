<?php
function subscribe( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'position' => 'center',
		'type' => 'custom-ad-1',
		), $atts));

		if ( false == get_theme_mod( 't_s_get_the_best', false ) ) { $t_s_get_the_best = esc_html__("Get the best viral stories straight into your inbox!", "magazine-plug");  } else { $t_s_get_the_best = get_theme_mod( 't_s_get_the_best' ); }
		if ( false == get_theme_mod( 't_s_your_email_address', false ) ) { $t_s_your_email_address = esc_html__("Your email address", "magazine-plug");  } else { $t_s_your_email_address = get_theme_mod( 't_s_your_email_address' ); }
		if ( false == get_theme_mod( 't_s_sign_up', false ) ) { $t_s_sign_up = esc_html__("Sign Up", "magazine-plug");  } else { $t_s_sign_up = get_theme_mod( 't_s_sign_up' ); }
		if ( false == get_theme_mod( 't_s_spam', false ) ) { $t_s_spam = esc_html__("Don't worry, we don't spam", "magazine-plug");  } else { $t_s_spam = get_theme_mod( 't_s_spam' ); }

			$shortcode = '';
			$shortcode .= '<div class="letter-wrap">
        <div class="gt_newpost mt-radius">
          <div class="form-overlay"></div>
          <form method="post" target="popupwindow" action="https://www.specificfeeds.com/follow?pub=7TqNP3vbLCHPZ32iTs3xu6gzzHWHxDTV">
          	<h3>'. esc_html($t_s_get_the_best).'</h3>
          	<input type="text" name="email" placeholder="'. esc_html($t_s_your_email_address) .'" required>
          	<input type="submit" value="'. esc_html($t_s_sign_up) .'" name="subscribe">
          	<small class="color-silver-light">'. esc_html($t_s_spam) .'</small>
          </form>
        </div>
      </div>';
			return $shortcode;
}
add_shortcode('subscribe', 'subscribe'); ?>
