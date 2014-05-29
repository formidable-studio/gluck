<!-- PRODUCT -->

<div class="left">
	<div class='product-image'>
		<?php //shopp('product','coverimage','setting=gallery-large'); ?>
		<?php shopp('product','coverimage','width=360&height=540&fit=crop'); ?>
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
		<!--<li><a href="#" class="closeFancy" javascript="$.fancybox.close();false;">Retour à la boutique</a></li>-->
		<li><a href="<?php bloginfo('url'); ?>/" class="fancy closeFancy">Retour à la boutique</a></li>
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

<form action="<?php shopp('cart','url'); ?>" method="post" class="shopp product validate validation-alerts shoppform">
	<?php if(shopp('product','has-variations')): ?>
	<div class="variations">
		<?php shopp('product','variations','mode=multiple&label=true&defaults=Sélectionnez une option&before_menu=<p>&after_menu=</p>'); ?>
	</div>
<?php endif; ?>
<?php if(shopp('product','has-addons')): ?>
	<p class="addons">
		<?php shopp('product','addons','mode=menu&label=false&defaults=Sélectionnez un accessoire'); ?>
	</p>
<?php endif; ?>

<p><?php shopp('product','quantity','class=selectall&input=menu&label=Quantité'); ?> <?php shopp('product','addtocart','value=Ajouter au panier&class=valid&class=green right'); ?></p>

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
</div>
<?php endif; ?>


<?php
// pour compter le nombre d'images
$compteur = 0;
if(shopp('product','has-images')):
	while(shopp('product','images')):
		$compteur ++;
	endwhile;
endif;
?>

<?php if(shopp('product','has-images') && $compteur > 1): ?>
	<ul id="gallery-nav">
		<?php while(shopp('product','images')): ?>
		<li><a href="<?php shopp('product','image','setting=gallery-large&property=url'); ?>">
			<?php //shopp('product','image','setting=gallery-thumbnails'); ?>
			<?php shopp('product','image','width=82&height=82&fit=crop'); ?>
		</a></li>
		<?php endwhile; ?>
	</ul>
<?php endif; ?>

<!-- cf http://fr.business.pinterest.com/widget-builder/#do_pin_it_button -->
<div class="pinit">
	<a href="http://fr.pinterest.com/pin/create/button/" data-pin-do="buttonBookmark"  data-pin-color="red" data-pin-height="28">
		<img src="http://assets.pinterest.com/images/pidgets/pinit_fg_en_rect_red_28.png" />
	</a>
</div>

<?php else: ?>
	<h3>Article introuvable</h3>
	<p>Désolé ! L'article demandé n'a pas été trouvé dans notre catalogue !</p>
<?php endif; ?>



<!-- FIN PRODUCT -->