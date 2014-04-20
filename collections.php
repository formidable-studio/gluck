<!-- COLLECTIONS -->
<?php

// http://localhost:8888/Site_GLUCK/api/get_post/?post_id=427&post_type=collection
// http://wordpress.org/plugins/json-api/other_notes/
// https://vimeo.com/48773789
// 
// http://localhost:8888/Site_GLUCK/collection/hiver-2013/?json=get_post&exclude=custom_fields,attachments
// http://support.advancedcustomfields.com/forums/topic/native-acf-json-api/
// 
// 
?>
<a id="<?php echo preg_replace('/[^[:alpha:]]/', '', get_sub_field('menu_title')); ?>"  data-menu-offset="-80"></a>
<div id="collections" class="rubrique">
	<div id="collection_defil">
		<?php
	if(get_field('collections', 'option')):
		$index = 0;

		$count = count(get_field('collections','option')); 


		while(has_sub_field('collections', 'option')):
			$post_object = get_sub_field('collection');
			if( $post_object ): 
				$post = $post_object;
				setup_postdata( $post ); 
				
	?>

			<?php if($count == 2 && $index ==1 ){ ?>
				
					<div class="collection_header">
						<p>Collection</p>
						<h1><a href="<?php the_permalink();?>"><?php the_title(); ?> <span class="fleche">></span></a></h1> 
					</div>
				</div>
				<!-- FIN DE COLLECTION-SEPARATOR-->
			<?php }?>

			<!-- COLLECTION -->
			<div class="article">
				<a href="<?php the_permalink();?>"><?php the_post_thumbnail(); ?></a>
				<?php if($count > 2){ ?>
				<div class="description">
					<div class="collection_header">
						<p>Collection</p>
						<h1><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h1>
					</div>
				</div>
				<?php } ?>                 	   	                    	   	
			</div>	
			<!-- FIN COLLECTION -->

			<?php if($count == 2 && $index == 0){ ?>
				
				<!-- COLLECTION-SEPARATOR-->
				<div class="article collection-separator">
					<div class="collection_header">
						<p>Collection</p>
						<h1><a href="<?php the_permalink();?>"><span class="fleche"><</span> <?php the_title(); ?></a></h1> 
					</div>

			<?php }?>


	<?php
			endif;
			$index++;
		endwhile;
	endif;
	wp_reset_postdata(); ?>       	   	                          
	</div>
</div>
<!-- FIN DE COLLECTIONS -->