<!-- BOUTIQUE -->
<a id="<?php echo preg_replace('/[^[:alpha:]]/', '', get_sub_field('menu_title')); ?>"  data-menu-offset="-80"></a>
<div id="boutique" class="rubrique">

	<?php
	// RECUPERATION DES CATEGORIES POUR LE FILTRE
	// https://shopplugin.net/workshopp/display-your-product-categories-as-a-grid-on-the-shopp-storefront-page/
	if(shopp('catalog','has-categories')): ?>

		<ul id="filters">
			<li><a href="#" data-filter="*" class="selected">Tout voir</a></li>

		<?php while(shopp('catalog','categories')): ?>

			<li><a href="#" data-filter=".<?php shopp('category','slug'); ?>"><?php shopp('category','name'); ?></a></li>

		<?php endwhile; ?>

		</ul>

	<?php endif; ?>

	<div class='conteneur'>
	<?php

		// https://shopplugin.net/api/category/theme/
		// https://shopplugin.net/api/storefront-catalog-products/
		// http://stackoverflow.com/questions/11119361/how-to-list-all-products-using-shopp

		shopp('storefront','catalog-products','load=true&show=999');

		if ( shopp('collection','has-products') ) :
			$i = 0;
			while ( shopp('collection','products') ) :

	?>

		<?php
			// RECUPERATION DES CATEGORIES POUR UN ARTICLE
			$tag = array();
			if ( shopp('product','hascategories') ) :

			while(shopp('product','categories')) { 
			    $tag[] = shopp('product','category','show=slug&echo=0');
			}

			endif;
		?>

		<!-- ARTICLE -->
		<div class="article <?php echo implode(' ',$tag); ?>">		

			<div class="preview">
				<a href="<?php shopp('product','url'); ?>">
					<?php shopp('product','coverimage','setting=gallery-previews'); ?>
				</a>
			</div>
			<div class="detail">
				<h4 class="name">
					<a href="<?php shopp('product','url'); ?>"><?php shopp('product','name'); ?></a>
				</h4>

				<p class="price"><?php shopp('product','saleprice','starting=à partir de'); ?></p>
			
				<?php if (shopp('product','has-savings')): ?>
				<p class="savings">Économisez <?php shopp('product','savings','show=percent'); ?></p>
				<?php endif; ?>

			</div>
		</div>
		<!-- FIN ARTICLE -->
	<?php
			endwhile;
		endif;

		// https://shopplugin.net/workshopp/using-shopp-ajax-add-to-cart-behaviors/
		// shopp('product','addtocart','ajax=json');
		// shopp('storefront','categories');

	 ?>
	 <div class="clear"></div>
	</div>
</div>
<!-- FIN DE BOUTIQUE -->