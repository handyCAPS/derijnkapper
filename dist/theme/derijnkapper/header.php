<!doctype html><html lang="<?php bloginfo('language'); ?>"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width"><title><?php
		if (is_home()) {
			echo bloginfo('name');
		} else {
			wp_title('|', true, 'right' );
			echo bloginfo('name');
		}
		 ?></title><?php wp_head(); ?><body><header role="banner"><div class="grid" id="headerWrap"><div id="logo" class="grid__item desk-one-eighth lap-one-sixth palm-one-third"><a href="<?php bloginfo('home'); ?>"><img src="<?php echo THEMEPATH; ?>/images/kapper-logo.png" alt="logo" class="one-whole"></a></div><div id="navWrap" class="grid__item desk-seven-eighths lap-five-sixths palm-one-whole"><?php    /**
				* Displays a navigation menu
				* @param array $args Arguments
				*/
				$args = array(
					'theme_location' => 'header_menu',
					'menu' => '',
					'container' => 'nav',
					'container_class' => 'topnav',
					'container_id' => '',
					'menu_class' => 'nav float--right',
					'menu_id' => '',
					'echo' => true,
					'fallback_cb' => 'wp_page_menu',
					'before' => '',
					'after' => '',
					'link_before' => '',
					'link_after' => '',
					'items_wrap' => '<ul id = "%1$s" class = "%2$s">%3$s</ul>',
					'depth' => 0,
					'walker' => ''
				);

				wp_nav_menu( $args ); ?></div></div></header>