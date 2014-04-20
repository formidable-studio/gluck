<!-- CATEGORY -->
<?php if(shopp('category','hasproducts','load=coverimages')): ?>
	<div class="conteneur category">
	<?php shopp('catalog','breadcrumb'); ?>

	<h3><?php shopp('category','name'); ?></h3>
	<?php shopp('catalog','views','label=Affichage :'); ?>

	<!--<div><?php //shopp('category','subcategory-list','hierarchy=true&showall=true&class=subcategories&dropdown=1'); ?></div>-->

	<?php //shopp('catalog','orderby-list','dropdown=on'); ?>
	<div class="alignright"><?php shopp('category','pagination','show=10'); ?></div>

	<ul class="products">
		<li class="row"><ul>
		<?php while(shopp('category','products')): ?>
		<?php if(shopp('category','row')): ?></ul></li><li class="row"><ul><?php endif; ?>
			<li class="product">
				<div class="frame">
				<a href="<?php shopp('product','url'); ?>"><?php shopp('product','coverimage','setting=thumbnails'); ?></a>
					<div class="details">
					<h4 class="name"><a href="<?php shopp('product','url'); ?>"><?php shopp('product','name'); ?></a></h4>
					<p class="price"><?php shopp('product','saleprice','starting=à partir de'); ?> </p>
					<?php if (shopp('product','has-savings')): ?>
						<p class="savings">Économisez <?php shopp('product','savings','show=percent'); ?></p>
					<?php endif; ?>

						<div class="listview">
						<p><?php shopp('product','summary'); ?></p>
						<form action="<?php shopp('cart','url'); ?>" method="post" class="shopp product">
						<?php shopp('product','addtocart'); ?>
						</form>
						</div>
					</div>

				</div>
			</li>
		<?php endwhile; ?>
		</ul></li>
	</ul>

	<div class="alignright"><?php shopp('category','pagination','show=10'); ?></div>

	</div>
<?php else: ?>
	<?php if (!shopp('catalog','is-landing')): ?>
	<?php shopp('catalog','breadcrumb'); ?>
	<h3><?php shopp('category','name'); ?></h3>
	<p>Aucun acticle n'a été trouvé.</p>
	<?php endif; ?>
<?php endif; ?>

<!-- FIN CATEGORY -->