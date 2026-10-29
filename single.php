<?php get_header(); ?>

	<div class="container_wrapper">	
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						<h1>
							<?php the_title(); ?> - SINGLE TEMPLATE
						</h1>

						<div class="meta">
							<?php the_date('d.m.Y'); ?>
						</div>
						
						<div class="entry">
							<?php the_content(); ?>
						</div>	
					<?php endwhile; endif; ?>
					
				</div>
			</div>
		</div>
	</div>
 
<?php get_footer(); ?>
