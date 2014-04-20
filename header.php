<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

  <title data-titre="<?php bloginfo('name') ?> &raquo; " data-slogan="<?php bloginfo('description') ?>"><?php bloginfo('name') ?><?php if ( is_404() ) : ?> &raquo; <?php _e('Not Found') ?><?php elseif ( is_home() ) : ?> &raquo; <?php bloginfo('description') ?><?php else : ?><?php wp_title() ?><?php endif ?></title>
 
  <meta name="generator" content="WordPress <?php bloginfo('version'); ?>" />
  <meta name="identifier-url" content="<?php bloginfo('url'); ?>" />
  
  
  <link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
  <link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />
  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
  
  <?php wp_get_archives('type=monthly&format=link'); ?>
  <?php wp_head(); ?>

  <!-- MONSERRAT -->
  <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
  <link rel="stylesheet" href="<?php bloginfo( 'template_url' ); ?>/scrollpane/jquery.jscrollpane.css" type="text/css" media="screen" />
  <link rel="stylesheet" href="<?php bloginfo( 'template_url' ); ?>/fancybox/jquery.fancybox.css" type="text/css" media="screen" />
  <!--<link rel="stylesheet" href="<?php bloginfo( 'template_url' ); ?>/dropkick/dropkick.css" type="text/css" media="screen" />-->

  <?php wp_enqueue_script('jquery'); ?>

  <script type="text/javascript" src="//use.typekit.net/oix6kfw.js"></script>
  <script type="text/javascript">try{Typekit.load();}catch(e){}</script>
  
</head>
<body>


<!-- FIN HEADER -->