<!-- CART -->
<?php if (shopp('cart','hasitems')): ?>
<form id="cart" action="<?php shopp('cart','url'); ?>" method="post" class="shoppform">
<big>
	<a href="<?php bloginfo('url'); ?>/">< Continuez votre shopping</a>
	<!--<a href="<?php shopp('cart','referrer'); ?>">< Continuez votre shopping</a>-->
	<a href="<?php shopp('checkout','url'); ?>" class="right green">Passez votre commande&nbsp;&nbsp;></a>
</big>

<?php shopp('cart','function'); ?>
<table class="cart">
	<tr>
		<th scope="col" class="item">Articles du panier</th>
		<th scope="col">Quantité</th>
		<th scope="col" class="money">Prix unitaire</th>
		<th scope="col" class="money">Prix</th>
	</tr>

	<?php while(shopp('cart','items')): ?>
		<tr>
			<td>
				<a href="<?php shopp('cartitem','url'); ?>"><?php shopp('cartitem','name'); ?></a>
				<?php shopp('cartitem','options'); ?>
				<?php shopp('cartitem','addons-list'); ?>
				<?php shopp('cartitem','inputs-list'); ?>
			</td>
			<td class="quantite"><?php shopp('cartitem','quantity','input=text'); ?>
				<?php shopp('cartitem','remove','input=button&label=Supprimer'); ?></td>
			<td class="money"><?php shopp('cartitem','unitprice'); ?></td>
			<td class="money"><?php shopp('cartitem','total'); ?></td>
		</tr>
	<?php endwhile; ?>

	<?php while(shopp('cart','promos')): ?>
		<tr><td colspan="4" class="money"><?php shopp('cart','promo-name'); ?><strong><?php shopp('cart','promo-discount',array('before' => '&nbsp;&mdash;&nbsp;')); ?></strong></td></tr>
	<?php endwhile; ?>

	<tr class="totals first">
		<td colspan="2" rowspan="5">
			<?php if (shopp('cart','needs-shipping-estimates')): ?>
			<small>Estimation des frais de port &amp; taxes :</small>
			<?php shopp('cart','shipping-estimates'); ?>
			<?php endif; ?>
			<?php shopp('cart','promo-code'); ?>
		</td>
		<th scope="row">Sous-total</th>
		<td class="money"><?php shopp('cart','subtotal'); ?></td>
	</tr>
	<?php if (shopp('cart','hasdiscount')): ?>
	<tr class="totals">
		<th scope="row">Remise</th>
		<td class="money">-<?php shopp('cart','discount'); ?></td>
	</tr>
	<?php endif; ?>
	<?php if (shopp('cart','needs-shipped')): ?>
	<tr class="totals">
		<th scope="row"><?php shopp('cart','shipping','label=Estimation des frais de port'); ?></th>
		<td class="money"><?php shopp('cart','shipping'); ?></td>
	</tr>
	<?php endif; ?>
	<tr class="totals">
		<th scope="row"><?php shopp('cart','tax','label=Taxes'); ?></th>
		<td class="money"><?php shopp('cart','tax'); ?></td>
	</tr>
	<tr class="totals total">
		<th scope="row">Montant Total</th>
		<td class="money"><?php shopp('cart','total'); ?></td>
	</tr>
	<tr class="buttons">
		<td colspan="4"><?php shopp('cart','update-button', 'class&value=Mettre à jour le sous-total'); ?></td>
	</tr>
</table>

<big>
	<a href="<?php bloginfo('url'); ?>/">< Continuez votre shopping</a>
	<!--<a href="<?php shopp('cart','referrer'); ?>">< Continuez votre shopping</a>-->
	<a href="<?php shopp('checkout','url'); ?>" class="right green">Passez votre commande ></a>
</big>

</form>

<?php else: ?>
	<p class="warning">Il n'y a actuellement aucun article dans votre panier.</p>
	<p><a href="<?php bloginfo('url'); ?>/">< Continuez votre shopping</a>
	<!--<a href="<?php shopp('cart','referrer'); ?>">< Continuez votre shopping</a>--></p>
<?php endif; ?>

<!-- FIN CART -->