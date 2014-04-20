<?php get_header(); ?>

<!-- HEADER-BLOG -->
<div id="page" class="blog">

  <header>
    <div id="menu_wrapper" data-smooth-scrolling="off" style="top:<?php echo $decalSkrollr;?>;">
      <ul id="nav">
        <li>
          <a href="<?php bloginfo( 'url' ); ?>/#accueil" id="btn_accueil">
            <img src="<?php bloginfo( 'template_url' ); ?>/img/exclamation.png" alt="Accueil" width="18" height="20"/></a>
        </li>
      <?php

      if(get_field('home_pages', 'option')):
      while(has_sub_field('home_pages', 'option')):

      ?>
        <li>
          <a href="<?php bloginfo( 'url' ); ?>/#<?php echo preg_replace('/[^[:alpha:]]/', '', get_sub_field('menu_title')); ?>" id="btn_<?php echo preg_replace('/[^[:alpha:]]/', '', get_sub_field('menu_title')); ?>"><?php the_sub_field('menu_title'); ?></a>
        </li>
        <?php if(get_sub_field('menu_title')=='Boutique'){ ?>
        <li>
          <a href="<?php bloginfo('url'); ?>/shop/cart/" id="btn_panier">Panier <img src="<?php bloginfo( 'template_url' ); ?>/img/panier.png" class="logo-panier" alt="Panier" width="21" height="17"/>
          </a>
        </li>
      <?php } ?>
      <?php
      endwhile;
      endif;
      ?>
        <li>
          <a href="<?php bloginfo('url'); ?>/category/blog/" id="btn_blog">Blog</a>
        </li>
      </ul>
    </div>
    <div id="bandeau">
    <!--        		<h1><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></h1>
                    <p class"description"><?php bloginfo('description'); ?></p>
    -->    
    <a href="<?php bloginfo('url'); ?>/category/blog">
      <img src="http://gluckfactory.eu/wp-content/themes/gluck-v2/img/bandeau.png" width="1024" height="250" alt="Glück blog">
    </a>
    </div>
    <!--<div id="menu">
    <img src="http://gluckfactory.eu/wp-content/themes/gluck-v2/img/menu.png" width="1024" height="40">
    </div>-->

    <div id="social">
      <a href="http://pinterest.com/gluckfactory/" id="pinterest">Pinterest</a>
      <a href="http://www.etsy.com/people/gluck1" id="etsy">Etsy</a>
      <a href="https://www.facebook.com/pages/Glück/102108928011?fref=ts" id="facebook">Facebook</a>
    </div>

    <div class="clear"></div>
  </header>

	
	<nav>
	<?php if ( has_nav_menu( 'main_menu_gauche' ) ) {  wp_nav_menu( array('menu'=>'main_menu') );  } ?>
	</nav>
<!-- FIN HEADER-BLOG -->