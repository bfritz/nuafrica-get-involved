<?php get_header(); ?>

<div id="main-panel">

	<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>
	
	<div class="page">
		<h2 class="post-title"><?php //the_title(); ?></h2>
        
        <?php if( is_page('products-page') || $post->post_parent == '80' ) { ?>
        <h5 class="sub">100% of contributions will be used to supply water &amp; education in Mali</h5>
        
        <div class="post-content">
        
        <div>
<script type="text/javascript" src="http://app.ecwid.com/script.js?794156" charset="utf-8"></script>
<script type="text/javascript"> xProductBrowser("categoriesPerRow=3","views=grid(3,3) list(10) table(20)","categoryView=list","searchView=list","style="); </script>
<noscript>Your browser does not support JavaScript. Please proceed to <a href="http://app.ecwid.com/jsp/794156/catalog">HTML version of NuAfrica</a></noscript>
</div>
        
        </div>       
        
        <?php } elseif(is_page('get-involved')) { ?>
            <div class="post-content">
        	<?php the_content(); include('donation-slider-form.php'); ?>
			</div>        
        <?php } else { ?>
               <div class="post-content">
        		<?php the_content(); ?>
				</div>  
         <?php } ?>
            
			<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
		</div>
	</div>
	
	<?php endwhile; endif; ?>
	
</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
