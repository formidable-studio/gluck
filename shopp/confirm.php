<!-- CONFIRM -->
<?php shopp('checkout','cart-summary'); ?>

<form action="<?php shopp('checkout','url'); ?>" method="post" class="shopp" id="checkout">
	<?php shopp('checkout','function','value=confirmed'); ?>
	<p class="submit"><?php shopp('checkout','confirm-button','value=Confirmez votre commande&class=green'); ?></p>
</form>

<!-- FIN CONFIRM -->