<!doctype html><html lang="<?php bloginfo('language'); ?>"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width"><title><?php
		if (is_home()) {
			echo bloginfo('name');
		} else {
			wp_title('|', true, 'right' );
		}
		 ?></title><?php wp_head(); ?></head><body><div id="outerWrap"><header role="banner"><div class="grid" id="headerWrap"><div id="logo" class="grid__item one-sixth lap-one-third"><img src="../images/kapper-logo.png" alt="logo" class="one-whole"></div><!--  end logo  --><div id="navWrap" class="grid__item five-sixths lap-one-whole"><nav class="topnav" role="navigation"><ul class="nav float--right"><li class="current-menu-item"><a href="#">Home</a></li><li><a href="#">Portfolio</a></li><li><a href="#">Nieuws</a></li><li><a href="#">Prijzen</a></li><li><a href="#">Contact</a></li></ul></nav></div><!--  end navWrap  --></div><!--  end headerWrap  --></header><div class="grid"></div></div></body></html>