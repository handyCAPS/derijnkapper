<?php get_header(); ?>
<div class="grid">
<div class="grid__item two-thirds lap-one-whole palm-one-whole">
	<div class="article-wrapper">
	<?php if(have_posts()): while(have_posts()): the_post(); ?>
		<article class="peeled">
			<a href="<?php the_permalink(); ?>"><h2><?php the_title(); ?></h2></a>
			<?php
			the_content();
			edit_post_link('Bewerken');
			?>
		</article>
	<?php endwhile; else: ?>
		<article class="peeled">
			<h2>Geen resultaat</h2>
			Helaas is hier niets te vinden. Ga terug naar <a href="<?php bloginfo('home'); ?>">Home</a>
		</article>
	<?php endif; ?>
	</div><!--  end article-wrapper  -->
	</div><!--  main  -->
	<div class="grid__item one-third lap-one-whole palm-one-whole sidebar">
		<?php get_sidebar('page'); ?>
	</div><!--  sidebar  -->
</div><!-- end main content -->
<footer class="page-footer">
<?php get_footer(); ?>