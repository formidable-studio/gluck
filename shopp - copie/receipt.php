<!-- RECEIPT -->
<div id="receipt" class="shopp">
<table class="transaction">
	<tr><th>Numéro de commande :</th><td><?php shopp('purchase','id'); ?></td></tr>
	<tr><th>Date de commande :</th><td><?php shopp('purchase','date'); ?></td></tr>
	<tr><th>Facturé à :</th><td><?php shopp('purchase','card'); ?> (<?php shopp('purchase','cardtype'); ?>)</td></tr>
	<tr><th>Transaction :</th><td><?php shopp('purchase','transactionid'); ?> (<strong><?php shopp('purchase','payment'); ?></strong>)</td></tr>
</table>

<table class="labels"><tr>
<td><fieldset class="billing">
	<legend>Facturé à </legend>
	<address><big><?php shopp('purchase','firstname'); ?> <?php shopp('purchase','lastname'); ?></big><br />
	<?php shopp('purchase','company'); ?><br />
	<?php shopp('purchase','address'); ?><br />
	<?php shopp('purchase','xaddress'); ?>
	<?php shopp('purchase','city'); ?>, <?php shopp('purchase','state'); ?> <?php shopp('purchase','postcode'); ?><br />
	<?php shopp('purchase','country'); ?></address>
</fieldset></td>
<?php if (shopp('purchase','hasfreight')): ?>
<td><fieldset class="shipping">
		<legend>Livré à</legend>
		<address><big><?php shopp('purchase','shipname'); ?></big><br /><br />
		<?php shopp('purchase','shipaddress'); ?><br />
		<?php shopp('purchase','shipxaddress'); ?>
		<?php shopp('purchase','shipcity'); ?>, <?php shopp('purchase','shipstate'); ?> <?php shopp('purchase','shippostcode'); ?><br />
		<?php shopp('purchase','shipcountry'); ?></address>

		<p>Frais de port : <?php shopp('purchase','shipmethod'); ?></p>
</fieldset></td>
<?php endif; ?>
</tr></table>

<?php if (shopp('purchase','hasitems')): ?>
<table class="order widefat">
	<thead>
	<tr>
		<th scope="col" class="item">Articles commandés</th>
		<th scope="col">Quantité</th>
		<th scope="col" class="money">Prix unitaire</th>
		<th scope="col" class="money">Prix</th>
	</tr>
	</thead>

	<?php while(shopp('purchase','items')): ?>
		<tr>
			<td><?php shopp('purchase','item-name'); ?><?php shopp('purchase','item-options','before= – '); ?><br />
				<?php shopp('purchase','item-sku')."<br />"; ?>
				<?php shopp('purchase','item-download'); ?>
				<?php shopp('purchase','item-addons-list'); ?>
				</td>
			<td><?php shopp('purchase','item-quantity'); ?></td>
			<td class="money"><?php shopp('purchase','item-unitprice'); ?></td>
			<td class="money"><?php shopp('purchase','item-total'); ?></td>
		</tr>
	<?php endwhile; ?>

	<tr class="totals">
		<th scope="row" colspan="3" class="total">Sous-total</th>
		<td class="money"><?php shopp('purchase','subtotal'); ?></td>
	</tr>
	<?php if (shopp('purchase','hasdiscount')): ?>
	<tr class="totals">
		<th scope="row" colspan="3" class="total">Remise</th>
		<td class="money">-<?php shopp('purchase','discount'); ?></td>
	</tr>
	<?php endif; ?>
	<?php if (shopp('purchase','hasfreight')): ?>
	<tr class="totals">
		<th scope="row" colspan="3" class="total">Livraison</th>
		<td class="money"><?php shopp('purchase','freight'); ?></td>
	</tr>
	<?php endif; ?>
	<?php if (shopp('purchase','hastax')): ?>
	<tr class="totals">
		<th scope="row" colspan="3" class="total">Taxes</th>
		<td class="money"><?php shopp('purchase','tax'); ?></td>
	</tr>
	<?php endif; ?>
	<tr class="totals">
		<th scope="row" colspan="3" class="total">Montant Total</th>
		<td class="money"><?php shopp('purchase','total'); ?></td>
	</tr>
</table>

<?php if(shopp('purchase','has-data')): ?>
	<ul>
	<?php while(shopp('purchase','orderdata')): ?>
		<?php if (shopp('purchase','get-data') == '') continue; ?>
		<li><strong><?php shopp('purchase','data','name'); ?>:</strong> <?php shopp('purchase','data'); ?></li>
	<?php endwhile; ?>
	</ul>
<?php endif; ?>


<?php else: ?>
	<p class="warning">Aucun élément trouvé pour cet achat.</p>
<?php endif; ?>
</div>

<!-- FIN RECEIPT -->