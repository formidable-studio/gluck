<!-- GABARIT SKROLLR.PHP -->

<?php
if ( !is_super_admin() || !is_admin_bar_showing() ) {
	$decalSkrollr = '0';
}else{
	$decalSkrollr = '28px';
}
?>

<?php  get_template_part('menu'); ?>

<div id="skrollr-body">
	<div id="page" class="home">
		<div id="content">



			<a title="accueil" name="accueil" data-menu-offset="0"></a>
			<div id="accueil" class="rubrique">

				<!-- IMAGES ACCUEIL -->
				<img src="<?php bloginfo( 'template_url' ); ?>/img/accueil/fleur.png" style="position:absolute;left:-300px;" data-anchor-target="#accueil" data-0="top:50px;" data-1000="top:300px;" nopin="true" />
				<img src="<?php bloginfo( 'template_url' ); ?>/img/accueil/saut-transparent.png" style="position:absolute;left:30px;z-index:200" data-anchor-target="#accueil" data-0="top:38px;" data-300="top:-90px;" id="girl" nopin="true" />
				<img src="<?php bloginfo( 'template_url' ); ?>/img/accueil/forme1.png" style="position:absolute;left:20px;" data-anchor-target="#accueil" data-0="top:300px;" data-300="top:-50px;" nopin="true" />    
				<img src="<?php bloginfo( 'template_url' ); ?>/img/accueil/forme2.png" style="position:absolute;left:668px;" data-anchor-target="#accueil" data-0="top:255px;" data-2300="top:600px;" nopin="true" />  
				<img src="<?php bloginfo( 'template_url' ); ?>/img/accueil/forme3.png" style="position:absolute;left:850px;" data-anchor-target="#accueil" data-0="top:195px;" data-1000="top:-100px;" nopin="true" />
				<img src="<?php bloginfo( 'template_url' ); ?>/img/accueil/forme4.png" style="position:absolute;left:668px;" data-anchor-target="#accueil" data-0="top:610px;" data-1000="top:-100px;" nopin="true" />   
				<img src="<?php bloginfo( 'template_url' ); ?>/img/logo-gluck.png" style="position:absolute;left:520px;top:252px;" data-anchor-target="#accueil" data-0="top:252px;" data-1000="top:-200px;" alt="Glück (!)" id="logo-gluck" nopin="true" />
				<p id="soustitre" style="position:absolute;left:650px;top:400px;" data-anchor-target="#accueil" data-0="top:400px;" data-1000="top:100px;"><?php bloginfo('description') ?></p>
			</div>

			<?php
			if(get_field('home_pages', 'option')):
				while(has_sub_field('home_pages', 'option')):
					if(get_sub_field('bloc') == 'page'):
						$post_object = get_sub_field('page_ref');
					if( $post_object ): 
						$post = $post_object;
					setup_postdata( $post ); 
					?>

					<!-- PAGE -->
					<a id="<?php echo preg_replace('/[^[:alpha:]]/', '', get_sub_field('menu_title')); ?>"  data-menu-offset="-100"></a>
					<div id="<?php the_slug();?>" class="rubrique">

						<?php if(the_slug(false) == 'was-ist-gluck' ) { ?>
						<!-- IMAGES WAS IST GLUCK -->
						<img src="<?php bloginfo( 'template_url' ); ?>/img/was-ist-gluck/forme3.png" style="position:absolute;left:-65px;" data-anchor-target="#was-ist-gluck"  data-bottom-top="top:-150px;" data-top-bottom="top:588px;" nopin="true" />
						<img src="<?php bloginfo( 'template_url' ); ?>/img/was-ist-gluck/forme1.png" style="position:absolute;left:25px;" data-anchor-target="#was-ist-gluck" data-top-bottom="top:470px;" data-bottom-top="top:600px;" nopin="true" />
						<img src="<?php bloginfo( 'template_url' ); ?>/img/was-ist-gluck/forme2.png" style="position:absolute;left:778px;" data-anchor-target="#was-ist-gluck" data-bottom-top="top:700px;" data-top-bottom="top:-500px;" nopin="true" />
						<img src="<?php bloginfo( 'template_url' ); ?>/img/was-ist-gluck/fleur.png" style="position:absolute;left:-150px;" data-anchor-target="#was-ist-gluck" data-bottom-top="top:50px;" data-top-bottom="top:-150px;" nopin="true" />
						<img src="<?php bloginfo( 'template_url' ); ?>/img/was-ist-gluck/jambes.png" style="position:absolute;left:660px;" data-anchor-target="#was-ist-gluck" data-bottom-top="top:-40px;" data-top-bottom="top:-200px;" nopin="true" />

						<?php } else if(the_slug(false) == 'contact' ) { ?>
						<!-- IMAGES CONTACT -->
						<img src="<?php bloginfo( 'template_url' ); ?>/img/contact/forme1.png" style="position:absolute;left:135px;z-index:1;" data-anchor-target="#contact" data-bottom-top="top:675px;" data-top-bottom="top:-200px;" nopin="true" />
						<img src="<?php bloginfo( 'template_url' ); ?>/img/contact/forme2.png" style="position:absolute;left:95px;z-index:2;" data-anchor-target="#contact" data-bottom-top="top:500px;" data-top-bottom="top:-450px;" nopin="true" />
						<img src="<?php bloginfo( 'template_url' ); ?>/img/contact/jambes-telephone.png" style="position:absolute;left:45px;z-index:3;" data-anchor-target="#contact" data-bottom-top="top:-500px;" data-top-bottom="top:120px;" nopin="true" />

						<?php } ?>

						<div class="skrollr_bloc"  data-menu-offset="-80">
							<h3><?php the_title(); ?></h3>
							<div><?php

					
			// pour corriger un probleme avec shopplugin ?
			$content = get_the_content();
			$content = wptexturize($content);
			$content = do_shortcode( $content );
			$content = wpautop($content,false);
			//$content = apply_filters('the_content', $content);
			//the_content();
			/*wptexturize
			convert_smilies
			convert_chars
			wpautop
			shortcode_unautop
			prepend_attachment
			do_shortcode*/
			$content = str_replace(']]>', ']]&gt;', $content);

			echo $content;
			//the_content();
			?></div>
		</div>
	</div>
	<!-- FIN PAGE --> 

	<?php
	wp_reset_postdata(); 
	endif;
	else:
		?>		

	<!-- COLLECTION OU BOUTIQUE -->

	<?php
	get_template_part(get_sub_field('bloc'));

	?>

	
	<?php		
	endif;
	endwhile;
	endif; 
	?>
	<a title="credit" name="credit"></a>
	<div id="credit" class="rubrique">
		<div class="skrollr_bloc">
			<p>© Glück 2014 — N° Siret : 47976416900021 — <a href="http://www.gluckfactory.eu/mentions-legales/" >Mentions légales</a> — 
				Conception graphique : <a href="http://www.formidable-studio.net" target="_blank">Formidable</a></p>
			</div>  	
		</div>
	</div>


	<div id="scroll-button" data-0="position:fixed;bottom:0;opacity:1;" data-200="opacity:0;" data-top-top="position:fixed;bottom:0;">
		<img src="<?php bloginfo( 'template_url' ); ?>/img/scroll.png" nopin="true" />
	</div>
</div>
</div>



<!-- FIN SKROLLR.PHP -->