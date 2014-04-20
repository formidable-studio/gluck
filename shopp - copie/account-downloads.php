<!-- ACCOUNT DOWNLOADS -->
<h3>Téléchargements</h3>

<p><a href="<?php shopp('customer','url'); ?>">&laquo; Retour à la Gestion du compte</a></p>
<?php if (shopp('customer','has-downloads')): ?>
<table cellspacing="0" cellpadding="0">
	<thead>
		<tr>
			<th scope="col">Article</th>
			<th scope="col">Ordre</th>
			<th scope="col">Montant</th>
		</tr>
	</thead>
	<?php while(shopp('customer','downloads')): ?>
	<tr>
		<td><?php shopp('customer','download','name'); ?> <?php shopp('customer','download','variation'); ?><br />
			<small><a href="<?php shopp('customer','download','url'); ?>">Télécharger le fichier</a> (<?php shopp('customer','download','size'); ?>)</small></td>
		<td><?php shopp('customer','download','purchase'); ?><br />
			<small><?php shopp('customer','download','date'); ?></small></td>
		<td><?php shopp('customer','download','total'); ?><br />
			<small><?php shopp('customer','download','downloads'); ?> Téléchargements</small></td>
	</tr>
	<?php endwhile; ?>
</table>
<?php else: ?>
<p>Vous n'avez pas d'article disponible en téléchargement.</p>
<?php endif; // end 'has-downloads' ?>
<p><a href="<?php shopp('customer','url'); ?>">&laquo; Retour à la Gestion du compte</a></p>

<!-- FIN ACCOUNT DOWNLOADS -->