<!-- CHECKOUT -->
<form action="<?php shopp('checkout','url'); ?>" method="post" class="shopp validate" id="checkout">
<?php shopp('checkout','cart-summary'); ?>

<?php if (shopp('cart','hasitems')): ?>
	<?php shopp('checkout','function'); ?>
	<ul>
		<?php if (shopp('customer','notloggedin')): ?>
		<li>
			<label for="login">Connexion à votre compte</label>
			<span><?php shopp('customer','account-login','size=20&title=Se connecter'); ?><label for="account-login">Email</label></span>
			<span><?php shopp('customer','password-login','size=20&title=Mot de passe'); ?><label for="password-login">Mot de passe</label></span>
			<span><?php shopp('customer','login-button','context=checkout&value=Login'); ?></span>
		</li>
		<li></li>
		<?php endif; ?>
		<li>
			<label for="firstname">Informations de contact</label>
			<span><?php shopp('checkout','firstname','required=true&minlength=2&size=8&title=Prénom'); ?><label for="firstname">Prénom</label></span>
			<span><?php shopp('checkout','lastname','required=true&minlength=3&size=14&title=Nom'); ?><label for="lastname">Nom</label></span>
			<span><?php shopp('checkout','company','size=22&title=Société/Organisation'); ?><label for="company">Société/Organisation</label></span>
		</li>
		<li>
		</li>
		<li>
			<span><?php shopp('checkout','phone','format=phone&size=15&title=Téléphone'); ?><label for="phone">Téléphone</label></span>
			<span><?php shopp('checkout','email','required=true&format=email&size=30&title=Email'); ?>
			<label for="email">Email</label></span>
		</li>
		<?php if (shopp('customer','notloggedin')): ?>
		<li>
			<span><?php shopp('checkout','password','required=true&format=passwords&size=16&title=Mot de passe'); ?>
			<label for="password">Mot de passe</label></span>
			<span><?php shopp('checkout','confirm-password','required=true&format=passwords&size=16&title=Confirmation du mot de passe'); ?>
			<label for="confirm-password">Confirmez le mot de passe</label></span>
		</li>
		<?php endif; ?>
		<li></li>
		<?php if (shopp('cart','needs-shipped')): ?>
			<li class="half" id="billing-address-fields">
		<?php else: ?>
			<li>
		<?php endif; ?>
			<label for="billing-address">Adresse de facturation</label>
			<div>
				<?php shopp('checkout','billing-name','required=false&title=Facturer à'); ?>
				<label for="billing-name">Nom</label>
			</div>
			<div>
				<?php shopp('checkout','billing-address','required=true&title=Adresse de facturation'); ?>
				<label for="billing-address">Adresse</label>
			</div>
			<div>
				<?php shopp('checkout','billing-xaddress','title=Adresse de facturation, ligne 2'); ?>
				<label for="billing-xaddress">Adresse, ligne 2</label>
			</div>
			<div class="left">
				<?php shopp('checkout','billing-city','required=true&title=Ville de facturation'); ?>
				<label for="billing-city">Ville</label>
			</div>
			<div class="right">
				<?php shopp('checkout','billing-state','required=true&title=État/Province/Région/Dépt de facturation'); ?>
				<label for="billing-state">État / Province / Département</label>
			</div>
			<div class="left">
				<?php shopp('checkout','billing-postcode','required=true&title=Code postal de facturation'); ?>
				<label for="billing-postcode">Code postal</label>
			</div>
			<div class="right">
				<?php shopp('checkout','billing-country','required=true&title=Pays de facturation'); ?>
				<label for="billing-country">Pays</label>
			</div>
		<?php if (shopp('cart','needs-shipped')): ?>
			<div class="inline"><?php shopp('checkout','same-shipping-address'); ?></div>
			</li>
			<li class="half right" id="shipping-address-fields">
				<label for="shipping-address">Adresse de livraison</label>
				<div>
					<?php shopp('checkout','shipping-name','required=false&title=Livré à'); ?>
					<label for="shipping-address">Nom</label>
				</div>
				<div>
					<?php shopp('checkout','shipping-address','required=true&title=Adresse de livraison'); ?>
					<label for="shipping-address">Adresse</label>
				</div>
				<div>
					<?php shopp('checkout','shipping-xaddress','title=Adresse de livraison, ligne 2'); ?>
					<label for="shipping-xaddress">Adresse, ligne 2</label>
				</div>
				<div class="left">
					<?php shopp('checkout','shipping-city','required=true&title=Ville de livraison'); ?>
					<label for="shipping-city">Ville</label>
				</div>
				<div class="right">
					<?php shopp('checkout','shipping-state','required=true&title=État/Province/Région/Dépt de livraison'); ?>
					<label for="shipping-state">État / Province / Département</label>
				</div>
				<div class="left">
					<?php shopp('checkout','shipping-postcode','required=true&title=Code postal de livraison'); ?>
					<label for="shipping-postcode">Code postal</label>
				</div>
				<div class="right">
					<?php shopp('checkout','shipping-country','required=true&title=Pays de livraison'); ?>
					<label for="shipping-country">Pays</label>
				</div>
			</li>
		<?php else: ?>
			</li>
		<?php endif; ?>
		<?php if (shopp('checkout','billing-localities')): ?>
			<li class="half locale hidden">
				<div>
				<?php shopp('checkout','billing-locale'); ?>
				<label for="billing-locale">Juridiction locale</label>
				</div>
			</li>
		<?php endif; ?>
		<li></li>
		<li>
			<?php shopp('checkout','payment-options'); ?>
			<?php shopp('checkout','gateway-inputs'); ?>
		</li>
		<?php if (shopp('checkout','card-required')): ?>
		<li class="payment">
			<label for="billing-card">Informations de paiement</label>
			<span><?php shopp('checkout','billing-card','required=true&size=30&title=Numéro de la carte de crédit/débit'); ?><label for="billing-card">Numéro de la carte de crédit/débit</label></span>
			<span><?php shopp('checkout','billing-cardexpires-mm','size=4&required=true&minlength=2&maxlength=2&title=Card\'s 2-digit expiration month'); ?> /<label for="billing-cardexpires-mm">MM</label></span>
			<span><?php shopp('checkout','billing-cardexpires-yy','size=4&required=true&minlength=2&maxlength=2&title=Card\'s 2-digit expiration year'); ?><label for="billing-cardexpires-yy">AA</label></span>
			<span><?php shopp('checkout','billing-cardtype','required=true&title=Type de carte'); ?><label for="billing-cardtype">Type de carte</label></span>
		</li>
		<li class="payment">
			<span><?php shopp('checkout','billing-cardholder','required=true&size=30&title=Card Holder\'s Name'); ?><label for="billing-cardholder">Nom sur la carte</label></span>
			<span><?php shopp('checkout','billing-cvv','size=7&minlength=3&maxlength=4&title=Card\'s security code (3-4 digits on the back of the card)'); ?><label for="billing-cvv">Sécurité ID</label></span>
		</li>
		<?php if (shopp('checkout','billing-xcsc-required')): // Extra billing security fields ?>
		<li class="payment">
		<span><?php shopp('checkout','billing-xcsc','input=start&size=7&minlength=5&maxlength=5&title=Card\'s start date (MM/YY)'); ?><label for="billing-xcsc-start">Date d'activation</label></span>
			<span><?php shopp('checkout','billing-xcsc','input=issue&size=7&minlength=3&maxlength=4&title=Card\'s issue number'); ?><label for="billing-xcsc-issue">Émission #</label></span>
		</li>
		<?php endif; ?>

		<?php endif; ?>
		<li></li>
		<li>
		<div class="inline"><label for="marketing"><?php shopp('checkout','marketing'); ?> Oui, j'aimerais être informé(e) par e-mail des nouveautés et des offres spéciales !</label></div>
		</li>
	</ul>
	<p class="submit"><?php shopp('checkout','submit','value=Envoyer la commande'); ?></p>

<?php endif; ?>
</form>

<!-- FIN CHECKOUT -->