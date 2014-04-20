Content-type: text/html; charset=utf-8
From: <?php shopp('purchase','email-from'); ?>
To: <?php shopp('purchase','email-to'); ?>
Subject: <?php shopp('purchase','email-subject'); ?>

<html>

<div id="header">
<h1><?php bloginfo('name'); ?></h1>
<h2>Mise à jour de la commande</h2>
</div>
<div id="body">

<?php shopp('purchase','email-note'); ?>

<p class="status">Votre commande est: <strong><?php shopp('purchase','status'); ?></strong></p>

<?php shopp('purchase','receipt'); ?>
</div>

</html>
