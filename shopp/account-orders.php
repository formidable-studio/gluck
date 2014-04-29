<!-- ACCOUNT ORDERS -->
<p><a href="<?php shopp('customer','url'); ?>">&laquo; Retour à la Gestion du compte</a></p>

<?php if (shopp('purchase','get-id')): ?>
	<?php shopp('purchase','receipt'); ?>
<?php return; endif; ?>

<form action="<?php shopp('customer','action'); ?>" method="post" class="shopp validate shoppform" autocomplete="off">

<?php if (shopp('customer','has-purchases')): ?>
	<table cellspacing="0" cellpadding="0">
		<thead>
			<tr>
				<th scope="col">Date</th>
				<th scope="col">Ordre</th>
				<th scope="col">Statut</th>
				<th scope="col">Montant Total</th>
			</tr>
		</thead>
		<?php while(shopp('customer','purchases')): ?>
		<tr>
			<td><?php shopp('purchase','date'); ?></td>
			<td><?php shopp('purchase','id'); ?></td>
			<td><?php shopp('purchase','status'); ?></td>
			<td><?php shopp('purchase','total'); ?></td>
			<td><a href="<?php shopp('customer','order'); ?>">Afficher la commande</a></td>
		</tr>
		<?php endwhile; ?>
	</table>
<?php else: ?>
<p>Vous n'avez pas encore de commandes.</p>
<?php endif; // end 'has-purchases' ?>

</form>

<p><a href="<?php shopp('customer','url'); ?>">&laquo; Retour à la Gestion du compte</a></p>

<!-- FIN ACCOUNT ORDERS -->