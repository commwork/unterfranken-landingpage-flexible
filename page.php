<?php get_header(); ?>

	<section class="section pbottom-0">	
		<div class="container">
			<div class="row">
				<div class="col-md-12 entry">
					
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						<h1>
							<?php the_title(); ?>
						</h1>
						<div class="page-content">
							<?php the_content(); ?>
						</div>
					<?php endwhile; endif; ?>
					
				</div>
			</div>
		</div>
	</section>
 
<?php get_footer(); ?>
