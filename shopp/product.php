<!-- PRODUCT -->

<div class="left">
	<div class='product-image'>
	<?php shopp('product','coverimage','setting=gallery-large'); ?>
	</div>
	<?php

	if (shopp('product','found')): 
		//shopp('product','gallery','p_setting=gallery-large&thumbsetting=gallery-thumbnails&height=540');
		//$gallerie = shopp('product','gallery','p_setting=gallery-large&thumbsetting=gallery-thumbnails&return=1&echo=0');

		//var_dump(htmlspecialchars($gallerie));
	endif;

	?>
</div>

<div class="right">
	<ul class="breadcrumb">
		<li><a href="<?php bloginfo('url'); ?>">Retour à la boutique</a></li>
	</ul>
	<?php //shopp('catalog','breadcrumb')?>

	<?php if (shopp('product','found')): ?>

	<?php //shopp('product','gallery','p_setting=gallery-large&thumbsetting=gallery-thumbnails'); ?>

	<h2><?php shopp('product','name'); ?></h2>
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
		<p class="variations">
			<?php shopp('product','variations','mode=multiple&label=false&defaults=Sélectionnez une option'); ?>
		</p>
		<?php endif; ?>
		<?php if(shopp('product','has-addons')): ?>
			<p class="addons">
				<?php shopp('product','addons','mode=menu&label=false&defaults=Sélectionnez un accessoire'); ?>
			</p>
		<?php endif; ?>
		
		<p><?php shopp('product','quantity','class=selectall&input=menu'); ?> <?php shopp('product','addtocart','value=Ajouter au panier&class=valid&class=green right'); ?></p>

	</form>

	<div class="product-description">
	<?php shopp('product','description'); ?>
	</div>

	<?php if(shopp('product','has-specs')): ?>
	<dl class="details">
		<?php while(shopp('product','specs')): ?>
		<dt><?php shopp('product','spec','name'); ?>:</dt><dd><?php shopp('product','spec','content'); ?></dd>
		<?php endwhile; ?>
	</dl>
	<?php endif; ?>


	<?php if(shopp('product','has-images')): ?>
	<ul id="gallery-nav">
	<?php while(shopp('product','images')): ?>
    	<li><a href="<?php shopp('product','image','setting=gallery-large&property=url'); ?>"><?php shopp('product','image','setting=gallery-thumbnails'); ?></a></li>
	<?php endwhile; ?>
	</ul>
	<?php endif; ?>

<?php else: ?>
<h3>Article introuvable</h3>
<p>Désolé ! L'article demandé n'a pas été trouvé dans notre catalogue !</p>
<?php endif; ?>
</div>


<!-- FIN PRODUCT -->