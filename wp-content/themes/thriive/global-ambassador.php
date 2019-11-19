<?php /* Template Name: global ambassador  */ ?>
<?php get_header(); ?>
<section class="about-us">
<div class="banner-home healer-detail-wrapper">
		<div class="container ">
			<div class="justify-content-center flex-column text-center">
				<div class="red-healer-circle mt-3">
					<div class="inner-healer-circle">
						<?php the_post_thumbnail('thumbnail'); ?>
					</div>
				</div>
				<h1><?php echo get_the_title(); ?></h1>
				<?php if(get_field("short_description")){ ?>
					<p><?php echo get_field("short_description"); ?></p>
				<?php }?>
				
				<?php if(get_field("location")){ ?>
					<p><?php echo get_field("location"); ?></p>
				<?php }?>
				<a href="" class="btn share-cta mb-3"><i class="icon-new-share p-1"></i>SHARE</a>
				<div class="thriive-social-block hide-block mb-3"> 
					
					<?php if ( function_exists( 'ADDTOANY_SHARE_SAVE_KIT' ) ) { ADDTOANY_SHARE_SAVE_KIT(); } ?>
				</div>
			</div>
		

		</div>
	</div>
</section>
<section>
	<div class="container">
		<div class="row abt-section section w-70  mt-3">
		<?php the_content();  ?>	
		<?php if(get_field("website_url")){ 
			$link = get_field("website_url");	
			if($link){
				$link_url = $link['url'];
				$link_title = $link['title'];
				$link_target = $link['target'] ? $link['target'] : '_self';	
			}
		?>
		<div class="text-center w-100">
			<p class="text-highlight text-center">To know more, visit  <a href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>" class="text-highlight"><?php echo esc_html($link_title); ?></a></p>
		</div>
		<?php }?>
		</div>
	</div>
</section>

<?php get_footer(); ?>