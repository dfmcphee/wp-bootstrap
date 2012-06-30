<?php get_header(); ?>
			
			<div id="content" class="clearfix row-fluid">
			
				<div id="main" class="span12 clearfix" role="main">
					<?php 
					
					global $post;
					
					
					$rows = get_post_meta($post->ID, 'bootfolio_layout');
					if (!empty($rows)) {
					
					$rows = $rows[0];
	    ?>
	 
	        <div class="row-fluid">
	        	<div class="span4 well column">
	        		<?php 
	        			if (!empty($rows['row_1'])) {
		        			foreach ($rows['row_1'] as $module_id => $module_data) {
			        			?>
			        				<div id="<?php echo $module_id ?>" class="module">
				        				<?php echo html_entity_decode($module_data); ?>
			        				</div>
			        			<?php
		        			}
	        			} 
	        		?>
	        	</div>
	        	
	        	<div class="span8 well column">
	        		<?php
	        			if (!empty($rows['row_2'])) {
		        			foreach ($rows['row_2'] as $module_id => $module_data) {
			        			?>
			        				<div id="<?php echo $module_id ?>" class="module">
											<div clas="content"><?php echo html_entity_decode($module_data) ?></div>
			        				</div>
			        			<?php
		        			}
	        			} 
	        		?>
	        	</div>
	       </div>
	       
	   <?php  }

					else if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
						
						<header>
						
							<?php the_post_thumbnail( 'large' ); ?>
							
							<div class="page-header"><h1 class="single-title" itemprop="headline"><?php the_title(); ?></h1></div>
							
							<p class="meta"><?php _e("Posted", "bonestheme"); ?> <time datetime="<?php echo the_time('Y-m-j'); ?>" pubdate><?php the_date(); ?></time> <?php _e("by", "bonestheme"); ?> <?php the_author_posts_link(); ?> <span class="amp">&</span> <?php _e("filed under", "bonestheme"); ?> <?php the_category(', '); ?>.</p>
						
						</header> <!-- end article header -->
					
						<section class="post_content clearfix" itemprop="articleBody">
							<?php the_content(); ?>
							
							<?php wp_link_pages(); ?>
					
						</section> <!-- end article section -->
						
						<footer>
			
							<?php the_tags('<p class="tags"><span class="tags-title">' . __("Tags","bonestheme") . ':</span> ', ' ', '</p>'); ?>
							
							<?php 
							// only show edit button if user has permission to edit posts
							if( $user_level > 0 ) { 
							?>
							<a href="<?php echo get_edit_post_link(); ?>" class="btn btn-success edit-post"><i class="icon-pencil icon-white"></i> <?php _e("Edit post","bonestheme"); ?></a>
							<?php } ?>
							
						</footer> <!-- end article footer -->
					
					</article> <!-- end article -->
					<div class="row-fluid">
						<div class="span12">
						<?php if (get_adjacent_post(false, '', true)): // if there are older posts ?>
						    <a href="<?php echo get_permalink(get_adjacent_post(false,'',true)); ?>" class="btn btn-primary">Previous</a>
						<?php endif; ?>
						<?php if (get_adjacent_post(false, '', false)): // if there are newer posts ?>
						    <a href="<?php echo get_permalink(get_adjacent_post(false,'',false)); ?>" class="btn btn-primary pull-right">Next</a>
						<?php endif; ?>
						</div>
					</div>
					
					<?php comments_template(); ?>
					
					<?php endwhile; ?>			
					
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
					
					<?php endif; ?>
			
				</div> <!-- end #main -->
    
				<?php //get_sidebar(); // sidebar 1 ?>
    
			</div> <!-- end #content -->

<?php get_footer(); ?>