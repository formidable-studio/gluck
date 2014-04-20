<!-- LOGIN -->
<form action="<?php shopp('customer','url'); ?>" method="post" class="shopp" id="login">

<ul>
	<?php if (shopp('customer','notloggedin')): ?>
	<li>
		<label for="login">Connexion au compte</label>
		<span><?php shopp('customer','account-login','size=20&title=Se connecter'); ?>
			<label for="login"><?php shopp('customer','login-label'); ?></label></span>
		<span><?php shopp('customer','password-login','size=20&title=Mot de passe'); ?>
			<label for="password">Mot de passe</label></span>
		<span><?php shopp('customer','login-button'); ?></span>
	</li>
	<li><a href="<?php shopp('customer','recover-url'); ?>">Mot de passe oublié ?</a></li>
	<?php endif; ?>
</ul>

</form>

<!-- FIN LOGIN -->