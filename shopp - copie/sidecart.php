<!-- SIDECART -->
<div id="shopp-cart-ajax">
<?php if (shopp('cart','hasitems')): ?>
	<p class="status">
		<span id="shopp-sidecart-items"><?php shopp('cart','totalitems'); ?></span> <strong>Articles</strong><br />
		<span id="shopp-sidecart-total" class="money"><?php shopp('cart','total'); ?></span> <strong>Montant Total</strong>
	</p>
	<ul>
		<li><a href="<?php shopp('cart','url'); ?>">Modifiez votre panier d'achats</a></li>
		<?php if (shopp('checkout','local-payment')): ?>
		<li><a href="<?php shopp('checkout','url'); ?>">Passez votre commande</a></li>
		<?php endif; ?>
	</ul>
<?php else: ?>
	<p class="status">Votre panier est vide.</p>
<?php endif; ?>
</div>

<!-- FIN SIDECART -->