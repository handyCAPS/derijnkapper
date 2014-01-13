<?php get_header(); ?><div class="grid"><div class="grid__item two-thirds lap-one-whole"><div class="article-wrapper"><?php if(have_posts()): while(have_posts()): the_post(); ?><article class="peeled"><a href="<?php the_permalink(); ?>"><h2><?php the_title(); ?></h2></a> <?php
			the_content();
			edit_post_link('Bewerken');
			?></article><?php endwhile; else: ?><article class="peeled"><h2>Geen resultaat</h2>Helaas is hier niets te vinden. Ga terug naar <a href="<?php bloginfo('home'); ?>">Home</a></article><?php endif; ?></div><div class="blue-back wrapper owl-carousel peeled reltv" id="frontSlideWrapper"><?php
			// Custom query to only get the homeslides. Homeslides are the big sliding pics on the frontpage.
			$frontSlide = new WP_Query(array('post_type'=>'homeslide'));
			if ($frontSlide->have_posts()): while($frontSlide->have_posts()): $frontSlide->the_post();
			// Getting the url of the thumbnail. This is needed for the lazy loading of the images. Because the images are 1280 x 960, they get loaded via AJAX once they are in the viewport.
				$thumb = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'homeslide_thumbnail' );
				$thumbnail_url = $thumb['0'];
			?><div class="frontslide-item reltv"><div class="img-wrap"><img class="lazyOwl" data-src="<?php
					// Ckecking if there is a post thumbnail set, in which case it is loaded.
					if(has_post_thumbnail()) {
						echo $thumbnail_url;
					} else {
						// A standard image, in case no featured image is set.
						echo THEMEPATH . '/images/image_1.jpeg';
					}
					?>" src="#" alt=""></div><article class="overlay--half"><a href="<?php the_permalink(); ?>"><h2><?php the_title(); ?></h2></a> <?php the_excerpt();
					edit_post_link('Bewerken');
					 ?></article></div><?php endwhile; endif; ?></div></div><div class="grid__item one-third lap-one-whole sidebar"><?php get_sidebar(); ?></div></div><footer class="page-footer"><?php get_footer(); ?></footer>