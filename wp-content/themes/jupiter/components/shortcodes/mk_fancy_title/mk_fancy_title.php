<?php
$phpinfo =  pathinfo( __FILE__ );
$path = $phpinfo['dirname'];
include( $path . '/config.php' );

$id = Mk_Static_Files::shortcode_id();

$style = ( $style == 'true' ) ? 'pattern' : 'simple';

$span_padding = $app_styles = '';

if ( $style == 'pattern' ) {
	if ( $align == 'left' ) {$span_padding = 'padding-right:8px;';}
	else if ( $align == 'center' ) {$span_padding = 'padding:0 8px;';}
	else if ( $align == 'right' ) {$span_padding = 'padding-left:8px;';}
}


$styles[] = ($letter_spacing != '') ? ('letter-spacing:'.$letter_spacing.'px;') : '';
$styles[] = ($txt_transform != '') ? ('text-transform:'.$txt_transform.';') : '';
$styles[] = 'font-size: '.$size.'px;';
// TODO: Delete this comment first update after released Jupiter v5
// Line height calculate for old customers
if( $line_height > 100 || $line_height < 100 || !isset($line_height) ) {
	$styles[] = 'line-height: '.$line_height.'%;';
}
$styles[] = ($color_style != 'gradient_color') ? 'color: '.$color.';' : '';
$styles[] = 'text-align:'.$align.';';
$styles[] = 'font-style:'.$font_style.';';
$styles[] = 'font-weight:'.$font_weight.';';
$styles[] = 'padding-top:'.$margin_top.'px;';
$styles[] = 'padding-bottom:'.$margin_bottom.'px;';


$class[] = 'align-'.$align;
$class[] = get_viewport_animation_class($animation);
$class[] = $style.'-style';
$class[] = $el_class;
$class[] = ( $color_style == 'gradient_color' ) ? 'color-gradient' : 'color-single';


?>

<<?php echo $tag_name; ?> id="fancy-title-<?php echo $id; ?>" class="mk-fancy-title <?php echo implode(' ', $class); ?>">
	<span>
		<?php 
			if($color_style == 'gradient_color') {
				echo "<i>";
			} 
		?>
		<?php
		if($strip_tags == 'true') {
			echo do_shortcode(strip_tags($content));
		} else {
			echo do_shortcode($content);
		}
		?>
		<?php 
			if($color_style == 'gradient_color') {
				echo "</i>";
			} 
		?>
	</span>
</<?php echo $tag_name; ?>>
<div class="clearboth"></div>

<?php


echo mk_get_fontfamily( "#fancy-title-", $id, $font_family, $font_type );


// Color Styles
if (!empty($grandient_color_fallback)) {
	$grandient_color_fallback = 'color: '.$grandient_color_fallback.' !important;';
}

$app_styles .= '#fancy-title-'.$id.'{' .implode('', $styles).'}';
$app_styles .= '#fancy-title-'.$id.' span{' .$span_padding.'}';

if($color_style == 'gradient_color'){
	$style = '';
	$gradients = mk_gradient_option_parser($grandient_color_style, $grandient_color_angle);
	Mk_Static_Files::addCSS('
		#fancy-title-'.$id.' span i {
	    	background: '.$grandient_color_fallback.';
			background: -webkit-'.$gradients['type'].'-gradient('.$gradients['angle_1'].''.$grandient_color_from.' 0%, '.$grandient_color_to.' 100%);
			background: '.$gradients['type'].'-gradient('.$gradients['angle_2'].''.$grandient_color_from.' 0%, '.$grandient_color_to.' 100%);
	    }
	', $id);
	$app_styles .= '
	#fancy-title-'.$id.' span i{
		-webkit-background-clip: text;
		-webkit-text-fill-color: transparent;
		display: inline-block;
	}
	@-moz-document url-prefix() {
		#fancy-title-'.$id.' span i{
			background: transparent;
	  	}
	}
	';
}

if ($force_font_size == 'true') {
	if($size_smallscreen != '0'){
		$app_styles .= '
			@media handheld, only screen and (max-width: 1280px) {
				#fancy-title-'.$id.' {
					font-size: '.$size_smallscreen.'px;
				}
			}
		';
	} 
	if($size_tablet != '0') {
		$app_styles .= '
			@media handheld, only screen and (min-width: 768px) and (max-width: 1024px) {
				#fancy-title-'.$id.' {
					font-size: '.$size_tablet.'px;
				}
			}
		';
	}
	if($size_phone != '0') {
		$app_styles .= '
			@media handheld, only screen and (max-width: 767px) {
				#fancy-title-'.$id.' {
					font-size: '.$size_phone.'px;
				}
			}
		';
	}
}

Mk_Static_Files::addCSS($app_styles, $id);