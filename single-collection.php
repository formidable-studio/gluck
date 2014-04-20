<?php get_header(); ?>

<!-- GABARIT SINGLE-COLLECTION.PHP -->

<div id="content">
<?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); ?>
		<div class="post" id="post-<?php the_ID(); ?>">
			<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
								
				<div class="post_content">
					<?php the_content(); ?>
				</div>

				<div class="gallerie-collection">
				<?php if(get_field('gallerie')): ?>
				<?php while(the_repeater_field('gallerie')): ?>

				<div class="article vignette">
					<?php 

						$attachment_id = get_sub_field('photo');
						$size = "collection-image";
						$image = wp_get_attachment_image_src( $attachment_id, $size );

					?>
					<img src="<?php echo $image[0]; ?>" width="<?php echo $image[1]; ?>" height="<?php echo $image[2]; ?>" />

					<?php
					$titre = get_sub_field('titre');
					$sous_titre = get_sub_field('sous_titre');
					if( !empty($titre) || !empty($sous_titre) ) { ?>
					<div class="description">
						<div class="collection_header">
							<h1><?php echo $titre; ?></h1>
							<p><?php echo $sous_titre; ?></p>
						</div>
					</div>
					<?php } ?>
				</div>

				<?php endwhile; ?>
				<?php endif; ?>
				</div>
		</div>
	
	<?php endwhile; ?>
	<?php else : ?>
			<p>Désolé, aucun article ne correspond à vos critères.</p>
<?php endif; ?>
</div>

<!-- FIN SINGLE-COLLECTION.PHP -->

<?php get_footer(); ?>