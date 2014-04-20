<!-- ACCOUNT PROFILE -->
<form action="<?php shopp('customer','action'); ?>" method="post" class="shopp validate" autocomplete="off">

	<?php if(shopp('customer','password-changed')): ?>
	<div class="notice">Votre mot de passe a été changé avec succès.</div>
	<?php endif; ?>
	<?php if(shopp('customer','profile-saved')): ?>
	<div class="notice">Votre compte a été mis à jour.</div>
	<?php endif; ?>

	<p><a href="<?php shopp('customer','url'); ?>">&laquo; Retour à la Gestion du compte</a></p>

	<ul>
		<li>
			<label for="firstname">Votre compte</label>
			<span><?php shopp('customer','firstname','required=true&minlength=2&size=8&title=Prénom'); ?><label for="firstname">Prénom</label></span>
			<span><?php shopp('customer','lastname','required=true&minlength=3&size=14&title=Nom'); ?><label for="lastname">Nom</label></span>
		</li>
		<li>
			<span><?php shopp('customer','company','size=20&title=Société'); ?><label for="company">Société</label></span>
		</li>
		<li>
			<span><?php shopp('customer','phone','format=phone&size=15&title=Téléphone'); ?><label for="phone">Téléphone</label></span>
		</li>
		<li>
			<span><?php shopp('customer','email','required=true&format=email&size=30&title=Email'); ?>
			<label for="email">Email</label></span>
		</li>
		<li>
			<div class="inline"><label for="marketing"><?php shopp('customer','marketing','title=Je souhaite continuer à recevoir les e-mails concernant les nouveautés et offres spéciales !'); ?> Je souhaite continuer à recevoir les e-mails concernant les nouveautés et offres spéciales !</label></div>
		</li>
		<?php while (shopp('customer','hasinfo')): ?>
		<li>
			<span><?php shopp('customer','info'); ?>
			<label><?php shopp('customer','info','mode=name'); ?></label></span>
		</li>
		<?php endwhile; ?>
		<li>
			<label for="password">Changez votre mot de passe</label>
			<span><?php shopp('customer','password','size=14&title=Nouveau mot de passe'); ?><label for="password">Nouveau mot de passe</label></span>
			<span><?php shopp('customer','confirm-password','&size=14&title=Confirmez le mot de passe'); ?><label for="confirm-password">Confirmez le mot de passe</label></span>
		</li>
		<li id="billing-address-fields">
		<label for="billing-address">Adresse de facturation</label>
		<div>
			<?php shopp('customer','billing-address','title=Adresse de facturation'); ?>
			<label for="billing-address">Adresse</label>
		</div>
		<div>
			<?php shopp('customer','billing-xaddress','title=Adresse de facturation, ligne 2'); ?>
			<label for="billing-xaddress">Adresse, ligne 2</label>
		</div>
		<div class="left">
			<?php shopp('customer','billing-city','title=Ville de facturation'); ?>
			<label for="billing-city">Ville</label>
		</div>
		<div class="right">
			<?php shopp('customer','billing-state','title=État/Province/Région/Dépt de facturation'); ?>
			<label for="billing-state">État / Province / Département</label>
		</div>
		<div class="left">
			<?php shopp('customer','billing-postcode','title=Code postal de facturation'); ?>
			<label for="billing-postcode">Code postal</label>
		</div>
		<div class="right">
			<?php shopp('customer','billing-country','title=Pays de facturation'); ?>
			<label for="billing-country">Pays</label>
		</div>
		</li>
		<li id="shipping-address-fields">
			<label for="shipping-address">Adresse de livraison</label>
			<div>
				<?php shopp('customer','shipping-address','title=Adresse de livraison'); ?>
				<label for="shipping-address">Adresse</label>
			</div>
			<div>
				<?php shopp('customer','shipping-xaddress','title=Adresse de livraison, ligne 2'); ?>
				<label for="shipping-xaddress">Adresse, ligne 2</label>
			</div>
			<div class="left">
				<?php shopp('customer','shipping-city','title=Ville de livraison'); ?>
				<label for="shipping-city">Ville</label>
			</div>
			<div class="right">
				<?php shopp('customer','shipping-state','title=État/Province/Région/Dépt de livraison'); ?>
				<label for="shipping-state">État / Province / Département</label>
			</div>
			<div class="left">
				<?php shopp('customer','shipping-postcode','title=Code postal de livraison'); ?>
				<label for="shipping-postcode">Code postal</label>
			</div>
			<div class="right">
				<?php shopp('customer','shipping-country','title=Pays de livraison'); ?>
				<label for="shipping-country">Pays</label>
			</div>
		</li>
	</ul>
	<p><?php shopp('customer','save-button','label=Sauvegarder'); ?></p>

	<p><a href="<?php shopp('customer','url'); ?>">&laquo; Retour à la Gestion du compte</a></p>

</form>

<!-- FIN ACCOUNT PROFILE -->