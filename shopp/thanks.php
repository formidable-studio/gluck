<!-- THANKS -->
<div id="shopp" class="thanks">
<h3>Merci pour votre commande !</h3>
<p>L'équipe Glück(!) vous remercie pour votre commande et s'active d'hors et déjà pour vous la livrer dans les plus bref délais!</p>
<p>The Glück(!) team thanks you for your order and makes already everything possible to send it as soon as possible!</p>

<?php if (shopp('checkout','completed')): ?>

<?php if (shopp('purchase','notpaid')): ?>
	<p>Votre commande a bien été réceptionnée mais le traitement du paiement n'est pas encore achevé.</p>
	
	<?php if (shopp('checkout','offline-instructions','return=1')): ?>
	<p><?php shopp('checkout','offline-instructions'); ?></p>
	<?php endif; ?>
	
	<?php if (shopp('purchase','hasdownloads')): ?>
	<p>Les liens de téléchargement figurant sur le reçu de votre commande ne seront activés qu'à la réception du paiement.</p>
	<?php endif; ?>

	<?php if (shopp('purchase','hasfreight')): ?>
	<p>Vos articles ne seront expédiés qu'à la réception de votre paiement.</p>
	<?php endif; ?>

<?php endif; ?>

<?php shopp('checkout','receipt'); ?>

<?php if (shopp('customer','wpuser-created')): ?>
	<p>Un e-mail contenant les informations de connexion à votre compte a été envoyé à l'adresse indiquée lors de votre commande.  <a href="<?php shopp('customer','url'); ?>">Connectez-vous à votre compte</a> afin d'accéder à vos commandes, changez votre mot de passe et gérez vos informations de paiement.</p>
<?php endif; ?>

<?php else: ?>

<p>Votre commande demeure en traitement car elle n'a pas encore été reçue par le système de traitement des paiements. Lorque le paiement aura été vérifié, vous recevrez un e-mail vous notifiant que la commande a été traitée.</p>

<?php endif; ?>

</div>
<!-- FIN THANKS -->


