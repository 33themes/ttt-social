<?php
/**
* Template Name: TTTSocial One column, no sidebar
*
* A custom page template without sidebar.
*
* The "Template Name:" bit above allows this to be selectable
* from a dropdown menu on the edit page screen.
*
* @package WordPress
* @subpackage Twenty_Ten
* @since Twenty Ten 1.0
*/
get_header(); ?>
<div id="container" class="one-column">
<div id="content" role="main">
<?php if ( is_active_sidebar( 'tttsocial-sidebar' ) ) : ?>
	<!--<ul id="sidebar">-->
	<section>
		<?php dynamic_sidebar( 'tttsocial-sidebar' ); ?>
	</section>
	<!--</ul>-->
<?php endif; ?>
</div><!-- #content -->
</div><!-- #container -->
<?php get_footer(); ?>