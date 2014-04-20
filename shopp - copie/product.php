<!-- PRODUCT -->
<?php shopp('catalog','breadcrumb')?>
<?php if (shopp('product','found')): ?>

	<?php shopp('product','gallery','p_setting=gallery-previews&thumbsetting=gallery-thumbnails'); ?>

	<h3><?php shopp('product','name'); ?></h3>
	<p class="headline"><big><?php shopp('product','summary'); ?></big></p>

	<?php if (shopp('product','onsale')): ?>
		<h3 class="original price"><?php shopp('product','price'); ?></h3>
		<h3 class="sale price"><?php shopp('product','saleprice'); ?></h3>
		<?php if (shopp('product','has-savings')): ?>
			<p class="savings">Vous économisez <?php shopp('product','savings'); ?> (<?php shopp('product','savings','show=%'); ?>)!</p>
		<?php endif; ?>
	<?php else: ?>
		<h3 class="price"><?php shopp('product','price'); ?></h3>
	<?php endif; ?>

	<?php if (shopp('product','freeshipping')): ?>
	<p class="freeshipping">Livraison gratuite !</p>
	<?php endif; ?>

	<form action="<?php shopp('cart','url'); ?>" method="post" class="shopp product validate validation-alerts">
		<?php if(shopp('product','has-variations')): ?>
		<ul class="variations">
			<?php shopp('product','variations','mode=multiple&label=true&defaults=Sélectionnez une option&before_menu=<li>&after_menu=</li>'); ?>
		</ul>
		<?php endif; ?>
		<?php if(shopp('product','has-addons')): ?>
			<ul class="addons">
				<?php shopp('product','addons','mode=menu&label=true&defaults=Sélectionnez un accessoire&before_menu=<li>&after_menu=</li>'); ?>
			</ul>
		<?php endif; ?>

		<p><?php shopp('product','quantity','class=selectall&input=menu'); ?>
		<?php shopp('product','addtocart'); ?></p>

	</form>

	<?php shopp('product','description'); ?>

	<?php if(shopp('product','has-specs')): ?>
	<dl class="details">
		<?php while(shopp('product','specs')): ?>
		<dt><?php shopp('product','spec','name'); ?>:</dt><dd><?php shopp('product','spec','content'); ?></dd>
		<?php endwhile; ?>
	</dl>
	<?php endif; ?>

<?php else: ?>
<h3>Article introuvable</h3>
<p>Désolé ! L'article demandé n'a pas été trouvé dans notre catalogue !</p>
<?php endif; ?>

<!-- FIN PRODUCT -->