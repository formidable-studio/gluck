<?php get_header(); ?>

<!-- HEADER-BLOG -->
<div id="page" class="blog">

	<header>
		<?php  get_template_part('menu'); ?>

		<div id="bandeau">
		<!--            <h1><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></h1>
		<p class"description"><?php bloginfo('description'); ?></p>
		-->    
			<a href="<?php bloginfo('url'); ?>/category/blog">
			<img src="http://gluckfactory.eu/wp-content/themes/gluck-v2/img/bandeau.jpg" width="1024" height="250" alt="Glück blog">
			</a>
		</div>
	<!--<div id="menu">
	<img src="http://gluckfactory.eu/wp-content/themes/gluck-v2/img/menu.png" width="1024" height="40">
	</div>-->

	<div class="clear"></div>
</header>

<!--
<nav>
	<?php if ( has_nav_menu( 'main_menu_gauche' ) ) {  wp_nav_menu( array('menu'=>'main_menu') );  } ?>
</nav>
-->

<!-- FIN HEADER-BLOG -->