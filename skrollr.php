<!-- GABARIT SKROLLR.PHP -->

<?php
if ( !is_super_admin() || !is_admin_bar_showing() ) {
	$decalSkrollr = '0';
}else{
	$decalSkrollr = '28px';
}
?>

<div id="menu_wrapper" data-smooth-scrolling="off" style="top:<?php echo $decalSkrollr;?>;">
	<ul id="nav">
            <li>
            	<a href="#accueil" id="btn_accueil">
            		<img src="<?php bloginfo( 'template_url' ); ?>/img/exclamation.png" alt="Accueil" width="18" height="20"/></a>
            </li>
            <?php

            	if(get_field('home_pages', 'option')):
					while(has_sub_field('home_pages', 'option')):
					
			?>
			<li>
				<a href="#<?php echo preg_replace('/[^[:alpha:]]/', '', get_sub_field('menu_title')); ?>" id="btn_<?php echo preg_replace('/[^[:alpha:]]/', '', get_sub_field('menu_title')); ?>"><?php the_sub_field('menu_title'); ?></a>
			</li>
			<?php if(get_sub_field('menu_title')=='Boutique'){ ?>
    			<li>
    				<a href="<?php bloginfo('url'); ?>/shop/cart/" id="btn_panier">Panier <img src="<?php bloginfo( 'template_url' ); ?>/img/panier.png" class="logo-panier" alt="Panier" width="21" height="17"/>
    				</a>
    			</li>
			<?php } ?>
    		<?php
	    			endwhile;
	    		endif;
    		?>
            <li>
            	<a href="<?php bloginfo('url'); ?>/category/blog/" id="btn_blog">Blog</a>
            </li>
        </ul>
</div>

<div id="skrollr-body">
<div id="page" class="home">
	<div id="content">
		
		

		<a title="accueil" name="accueil" data-menu-offset="-40"></a>
        <div id="accueil" class="rubrique">
           
			<!-- IMAGES ACCUEIL -->
			<img src="<?php bloginfo( 'template_url' ); ?>/img/accueil/fleur.png" style="position:absolute;left:-300px;" data-anchor-target="#accueil" data-0="top:50px;" data-1000="top:300px;" />
			<img src="<?php bloginfo( 'template_url' ); ?>/img/accueil/saut-transparent.png" style="position:absolute;left:30px;z-index:200" data-anchor-target="#accueil" data-0="top:38px;" data-300="top:-90px;" id="girl" />
			<img src="<?php bloginfo( 'template_url' ); ?>/img/accueil/forme1.png" style="position:absolute;left:20px;" data-anchor-target="#accueil" data-0="top:300px;" data-300="top:-50px;" />    
			<img src="<?php bloginfo( 'template_url' ); ?>/img/accueil/forme2.png" style="position:absolute;left:668px;" data-anchor-target="#accueil" data-0="top:255px;" data-2300="top:600px;" />  
			<img src="<?php bloginfo( 'template_url' ); ?>/img/accueil/forme3.png" style="position:absolute;left:850px;" data-anchor-target="#accueil" data-0="top:195px;" data-1000="top:-100px;" />
			<img src="<?php bloginfo( 'template_url' ); ?>/img/accueil/forme4.png" style="position:absolute;left:668px;" data-anchor-target="#accueil" data-0="top:610px;" data-1000="top:-100px;" />   
			<img src="<?php bloginfo( 'template_url' ); ?>/img/logo-gluck.png" style="position:absolute;left:520px;top:252px;" data-anchor-target="#accueil" data-0="top:252px;" data-1000="top:-200px;" alt="Glück (!)" id="logo-gluck" />
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
	<a id="<?php echo preg_replace('/[^[:alpha:]]/', '', get_sub_field('menu_title')); ?>"  data-menu-offset="-200"></a>
	<div id="<?php the_slug();?>" class="rubrique">

		<?php if(the_slug(false) == 'was-ist-gluck' ) { ?>
		<!-- IMAGES WAS IST GLUCK -->
		<img src="<?php bloginfo( 'template_url' ); ?>/img/was-ist-gluck/forme3.png" style="position:absolute;left:-65px;" data-anchor-target="#was-ist-gluck"  data-bottom-top="top:-150px;" data-top-bottom="top:588px;" />
        <img src="<?php bloginfo( 'template_url' ); ?>/img/was-ist-gluck/forme1.png" style="position:absolute;left:25px;" data-anchor-target="#was-ist-gluck" data-top-bottom="top:470px;" data-bottom-top="top:600px;" />
        <img src="<?php bloginfo( 'template_url' ); ?>/img/was-ist-gluck/forme2.png" style="position:absolute;left:778px;" data-anchor-target="#was-ist-gluck" data-bottom-top="top:700px;" data-top-bottom="top:-500px;" />
        <img src="<?php bloginfo( 'template_url' ); ?>/img/was-ist-gluck/fleur.png" style="position:absolute;left:-150px;" data-anchor-target="#was-ist-gluck" data-bottom-top="top:50px;" data-top-bottom="top:-150px;" />
        <img src="<?php bloginfo( 'template_url' ); ?>/img/was-ist-gluck/jambes.png" style="position:absolute;left:660px;" data-anchor-target="#was-ist-gluck" data-bottom-top="top:-40px;" data-top-bottom="top:-200px;" />

		<?php } else if(the_slug(false) == 'contact' ) { ?>
		<!-- IMAGES CONTACT -->
		<img src="<?php bloginfo( 'template_url' ); ?>/img/contact/forme1.png" style="position:absolute;left:135px;z-index:1;" data-anchor-target="#contact" data-bottom-top="top:675px;" data-top-bottom="top:-200px;" />
        <img src="<?php bloginfo( 'template_url' ); ?>/img/contact/forme2.png" style="position:absolute;left:95px;z-index:2;" data-anchor-target="#contact" data-bottom-top="top:500px;" data-top-bottom="top:-450px;" />
        <img src="<?php bloginfo( 'template_url' ); ?>/img/contact/jambes-telephone.png" style="position:absolute;left:45px;z-index:3;" data-anchor-target="#contact" data-bottom-top="top:-500px;" data-top-bottom="top:120px;" />
		
		<?php } ?>

		<div class="skrollr_bloc"  data-menu-offset="-80">
			<h3><?php the_title(); ?></h3>
			<div><?php

			/*			
			// pour corriger un probleme avec shopplugin ?
			$content = get_the_content();
			$content = do_shortcode( $content );
			$content = wpautop($content);
			//$content = apply_filters('the_content', $content);
			//the_content();
			$content = str_replace(']]>', ']]&gt;', $content);

			echo $content;*/
			the_content();
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
        <img src="<?php bloginfo( 'template_url' ); ?>/img/scroll.png" />
    </div>
</div>
</div>



<!-- FIN SKROLLR.PHP -->