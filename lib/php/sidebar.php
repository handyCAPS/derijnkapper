<div class="one-whole wrapper reltv sidebar-item owl-carousel blue-back peeled" id="slidePostWrapper">
	<?php
	$slidepost = new WP_Query(array('post_type'=>'slidepost'));
	if ($slidepost->have_posts()): while($slidepost->have_posts()): $slidepost->the_post();
	$thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'slidepost_thumbnail' );
	$thumbnail_permalink = $thumbnail['0'];
	 ?>
		<div class="slidepost-item">
			<div class="img-wrap">
				<img class="lazyOwl" data-src="" src="<?php
				if (has_post_thumbnail()) {
					echo $thumbnail_permalink;
				} else {
					echo THEMEPATH . '/images/image_1.jpeg';
				 }?>" alt="placeholder">
			</div><!--  end img-wrap  -->
			<article class="overlay">
				<a href="<?php the_permalink(); ?>"><h2><?php the_title(); ?></h2></a>
				<?php
				the_excerpt();
				edit_post_link('Bewerken');
				?>
			</article>
		</div><!--  end slidepost-item -->
	<?php endwhile; endif; ?>
	</div><!--  end sliderPostWrapper  -->
		<div class="one-whole wrapper sidebar-item">
			<?php
			dynamic_sidebar('sidebar1');
			?>
		</div><!--  end openingstijden  -->
		<div class="one-whole wrapper sidebar-item">
			<article class="peeled">
				<h2>Prijzen</h2>
				<ul>
					<li>
						<div class="dienst dotlist__item">Knippen en wassen... en</div>
						<div class="price dotlist__item">&#128; 20,00</div>
					</li>
					<li>
						<div class="dienst dotlist__item">Knippen</div>
						<div class="price dotlist__item">&#128; 20,00</div>
					</li>
					<li>
						<div class="dienst dotlist__item">Knippen</div>
						<div class="price dotlist__item">&#128; 20,00</div>
					</li>
					<li>
						<div class="dienst dotlist__item">Knippen</div>
						<div class="price dotlist__item">&#128; 20,00</div>
					</li>
					<li>
						<div class="dienst dotlist__item">Knippen</div>
						<div class="price dotlist__item">&#128; 20,00</div>
					</li>
					<li>
						<div class="dienst dotlist__item">Knippen</div>
						<div class="price dotlist__item">&#128; 20,00</div>
					</li>
					<li>
						<div class="dienst dotlist__item">Knippen</div>
						<div class="price dotlist__item">&#128; 20,00</div>
					</li>
					<li>
						<div class="dienst dotlist__item">Knippen</div>
						<div class="price dotlist__item">&#128; 20,00</div>
					</li>
					<li>
						<div class="dienst dotlist__item">Knippen</div>
						<div class="price dotlist__item">&#128; 20,00</div>
					</li>
					<li>
						<div class="dienst dotlist__item">Knippen</div>
						<div class="price dotlist__item">&#128; 20,00</div>
					</li>
				</ul>
			</article>
		</div><!--  end prijzen  -->