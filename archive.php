<?php
/*
Template Name: Page Front Skrollr
*/
?>
<?php get_header(); ?>
<!-- GABARIT ARCHIVE.PHP -->


<!-- INCLUSION DU GABARIT SKROLLR -->
<?php get_template_part('skrollr'); ?>


<div id="test">
<script type="text/html" id="boutique_content">
<div style="width:770px">
	<?php the_content(); ?>
</div>
</script>
</div>

<!-- FIN ARCHIVE.PHP -->

<?php get_footer(); ?>