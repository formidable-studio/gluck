<?php
/*
Template Name: Page pour le blog
*/
?>
<?php get_header('blog'); ?>

<!-- GABARIT BLOG-PAGE.PHP -->


<div id="content">
<?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); ?>
		<div class="post" id="post-<?php the_ID(); ?>">
			<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>				
				<div class="post_content">
					<?php the_content(); ?>
				</div>
		</div>

<?php endwhile; ?>
<?php else : ?>
<h2>Aucun résultat</h2>
<p>Désolé, mais vous cherchez quelque chose qui ne se trouve pas ici .</p>
<?php include (TEMPLATEPATH . "/searchform.php"); ?>
<?php edit_post_link('Modifier cette page', '<p>', '</p>'); ?>
<?php endif; ?>
</div>

<!-- FIN BLOG-PAGE.PHP -->

<?php get_footer('blog'); ?>
