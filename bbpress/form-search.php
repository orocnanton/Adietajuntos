<?php
/**
 * Created by PhpStorm.
 * User: oscar
 * Date: 16/6/16
 * Time: 19:59
 */
?>

<form role="search" method="get" class="searchform bbp-search-form search-form" action="<?php bbp_search_url(); ?>">
	<label>
		<span class="screen-reader-text hidden" for="bbp_search"><?php _e( 'Search for:', 'bbpress' ); ?></span>
		<input type="hidden" name="action" value="bbp-search-request"/>

		<input class="search-field" tabindex="<?php bbp_tab_index(); ?>" type="text"
		       value="<?php echo esc_attr( bbp_get_search_terms() ); ?>"
		       placeholder="<?php _e( 'Buscar un foro...', 'Verano' ); ?>" name="bbp_search" id="bbp_search"/>
	</label>
	<button type="submit" tabindex="<?php bbp_tab_index(); ?>" class="search-submit w3-btn"><span
			class="screen-reader-text">Buscar foro</span></button>
	<div class="clearfix"></div>
</form>

