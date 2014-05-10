<!-- CATEGORY -->
<div class="conteneur category">
<?php if(shopp('category','hasproducts','load=coverimages')): ?>
	
	<div class="article">
		<?php shopp('catalog','breadcrumb'); ?>

		<!--<h3><?php shopp('category','name'); ?></h3>-->
		<?php //shopp('catalog','views','label=Affichage :'); ?>

		<div><?php shopp('category','subcategory-list','hierarchy=true&showall=true&class=subcategories&dropdown=1'); ?></div>

		<?php shopp('catalog','orderby-list','dropdown=on'); ?>
	</div>
	<!--<div class="alignright"><?php shopp('category','pagination','show=10'); ?></div>-->

		
		<?php
		$i = 1;
		while(shopp('category','products')): ?>
		<?php if(shopp('category','row')): ?></ul></li><li class="row"><ul><?php endif; ?>
			<div class="article">
				<a href="<?php shopp('product','url'); ?>"><?php shopp('product','coverimage','setting=gallery-previews'); ?></a>
				
				<div class="detail">
				<h4 class="name">
					<a href="<?php shopp('product','url'); ?>"><?php shopp('product','name'); ?></a>
					<span class="price"><?php shopp('product','saleprice','starting=à partir de'); ?></h4>
				<?php if (shopp('product','has-savings')): ?>
					<p class="savings">Économisez <?php shopp('product','savings','show=percent'); ?></p>
				<?php endif; ?>

					<div class="listview">
					<p><?php shopp('product','summary'); ?></p>
					<form action="<?php shopp('cart','url'); ?>" method="post" class="shopp product shoppform">
					<?php shopp('product','addtocart'); ?>
					</form>
					</div>
				</div>

			</div>

		<?php if(($i++)%5==4) echo '<div class="clear"></div>' ?>
		<?php endwhile; ?>
		


	<!--<div class="alignright"><?php shopp('category','pagination','show=10'); ?></div>-->

	
<?php else: ?>
	<?php if (!shopp('catalog','is-landing')): ?>
	<div class="article">
		<?php shopp('catalog','breadcrumb'); ?>
		<h3><?php shopp('category','name'); ?></h3>
		<p>Aucun acticle n'a été trouvé.</p>
	</div>
	<?php endif; ?>
<?php endif; ?>

</div>

<!-- FIN CATEGORY -->