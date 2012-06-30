<?php get_header(); ?>
			
			<?php
				$blog_hero = of_get_option('blog_hero');
				if ($blog_hero){
			?>
			<div class="clearfix row-fluid">
				<div class="hero-unit">
				
					<h1><?php bloginfo('title'); ?></h1>
					
					<p><?php bloginfo('description'); ?></p>
				
				</div>
			</div>
			<?php
				}
			?>
			<?php $i = 1; ?>
			<div id="content" class="clearfix row-fluid">
				<?php get_featured_slider() ?>
			</div>
			<div id="main" class="clearfix" role="main">
				<?php 
				if (have_posts()) : while (have_posts()) : the_post();
					if ($i === 1) {
						echo '</div><div class="row-fluid">';
					}
					else if ($i === 3) {
						$i = 0;
					}
					$i++;
				?>
				
				<?php if (has_post_thumbnail()) { ?>
				<div id="post-<?php the_ID(); ?>" class="span4 postbox clearfix" >
					<div class="thumbnail-info">
						<h1 class="h2"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
						
						<p class="meta">
							<?php
								$my_excerpt = get_the_excerpt();
								if ( $my_excerpt != '' ) {
									// Some string manipulation performed
								}
								echo $my_excerpt; // Outputs the processed value to the page</p>
							?>
						</p>
					
					</div>
					<div class="portfolio-thumb">
						<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'portfolio-thumbnail' ); ?></a>
					</div> 
				</div>
				<?php comments_template(); ?>
				
				<?php } else { ?>
					<div id="post-<?php the_ID(); ?>" class="span4 postbox clearfix" >
						<h1 class="h2"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
						<div class="excerpt">
							<?php echo get_the_excerpt(); ?>
						</div>
					</div>
				<? } ?>
				
				<?php endwhile; ?>	
				
				<?php if (function_exists('page_navi')) { // if expirimental feature is active ?>
					
					<?php page_navi(); // use the page navi function ?>
					
				<?php } else { // if it is disabled, display regular wp prev & next links ?>
					<nav class="wp-prev-next">
						<ul class="clearfix">
							<li class="prev-link"><?php next_posts_link(_e('&laquo; Older Entries', "bonestheme")) ?></li>
							<li class="next-link"><?php previous_posts_link(_e('Newer Entries &raquo;', "bonestheme")) ?></li>
						</ul>
					</nav>
				<?php } ?>		
				
				<?php else : ?>
				
				<article id="post-not-found">
				    <header>
				    	<h1><?php _e("Not Found", "bonestheme"); ?></h1>
				    </header>
				    <section class="post_content">
				    	<p><?php _e("Sorry, but the requested resource was not found on this site.", "bonestheme"); ?></p>
				    </section>
				    <footer>
				    </footer>
				</article>
				</div>
				<?php endif; ?>
		

		<!--<?php get_sidebar(); // sidebar 1 ?>-->

		</div> <!-- end #content -->

<?php get_footer(); ?>