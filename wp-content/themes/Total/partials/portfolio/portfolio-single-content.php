<?php
/**
 * Portfolio single content
 *
 * @package Total WordPress theme
 * @subpackage Partials
 * @version 3.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>

<article class="entry clr"<?php wpex_schema_markup( 'entry_content' ); ?>>
	<?php the_content(); ?>
</article><!-- .entry clr -->