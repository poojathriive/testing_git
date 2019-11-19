<?php /* Template Name: blog single */ ?>

<?php get_header(); ?>


<section class="">
	<div class="container">
		<div class="row text-center section w-70">
			<h1 class="w-100">Blog</h1>			
		</div>
		
		<div class="row w-70 section">
			<div class="col-12 p-0 blog-wrapper text-center pb-2">
				<div class="blog-banner">
					<img src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/blog-list-img1.jpg" alt="">
				</div>
				<div class="category-name "><span class="icon-new-heart blog-icon-set"> </span> <span class="text-highlight">Love</span></div>
				<div class="blog-title mt-3"><h3>Unveiling the Secrets Of Sacred Sexuality</h3></div>
				<div class="blog-author"><p class="text-highlight">By Cyntha Gonsales</p></div>
				<div class="col-12 col-sm-10 mx-auto p-0 d-flex blog-list-details">
					<div class="col-6"><span class="icon-new-calender_1 icon-event"></span> <span>12 Oct, 2018</span> </div>
					<div class="col"><span class="icon-new-comment icon-event"></span>21</div>
					<div class="col"><span class="icon-new-view-eye icon-event"></span>89</div>
				</div>
				<div class="mt-3 text-left">
					<p>What is Sacred Sexuality? How can we experience it? What role does it play in our spiritual practice? Cyntha Gonzalez, a transpersonal psychology counsellor based in Dubai, reveals to us all that we need to know about Sacred Sexuality.</p>
					<p>Gracy (name changed) was sexually abused by a family friend when she was a nine year old and it traumatized her deeply. On top of that, she had a very unstable mother and was raised by her grandmother, uncle and aunt. She was dealing with emotional abandonment and sexual violation all her childhood. When she grew up, she met this amazing man who loved her deeply. She knew they were destined to be together and they got married. But she began to be very cagey about sex. She was sexual but it always had to be on her terms. He could never initiate. She also hadn’t told him that she had been sexually abused.</p>
					<p class="more">The couple came to me because an emotional barrier had come up between them. When they came for the first session, I maintained her confidentiality but I did mention that the components of sacred sexuality are transparency and radical honesty. Non-transparency diminishes the life force energy. Immediately after this session, she disclosed to her husband that she had been sexually abusconnection to each other and to our divine Creator with the help of mastery of the breath, intention and mindful touch</p>
				</div>
				
			</div>
			
			
			<div class="col-12 p-0">
				<form data-parsley-validate class="form-element-section">
					<div class="form-group">
						 <label for="exampleFormControlTextarea1">Leave A Comment</label>
						<textarea class="form-control" rows="3"></textarea>
					</div>
					
					<div class="mt-3 my-event-btn text-right">
						<button type="submit"class="btn secondary-btn d-inline">SUBMIT</button>
					</div>	
				</form>
			</div>
			
			<div class="col-12">
				<h6>Comments</h6>
				
				<div class="section-comment mb-3">
					<p>“Lorem ipsum dolor sit Lorem ipsum dolor sit Lorem ipsum dolor sit Lorem ipsum dolor sit Lorem ipsum dolor sit Lorem ipsum dolor sit Lorem ipsum dolor sit Lorem ipsum dolor sit Lorem ipsum dolor sit Lorem ipsum dolor sit Lorem ipsum dolor sit Lorem ipsum dolor sit Lorem ipsum dolor sit Lorem ipsum dolor sit”</p>
					<div class="text-right text-highlight">Sonia Rao | 12/10/2018</div>
				</div>
				
				<div class="section-comment mb-3">
					<p>“Lorem ipsum dolor sit Lorem ipsum dolor sit Lorem ipsum dolor sit Lorem ipsum dolor sit Lorem ipsum dolor sit Lorem ipsum dolor sit Lorem ipsum dolor sit Lorem ipsum dolor sit Lorem ipsum dolor sit Lorem ipsum dolor sit Lorem ipsum dolor sit Lorem ipsum dolor sit Lorem ipsum dolor sit Lorem ipsum dolor sit”</p>
					<div class="text-right text-highlight">Michelle Fernandes | 12/10/2018</div>
				</div>
				
			</div>
			
			
		</div>
		
		
	</div>
</section>

<div class="m-1 divider"></div>

<section class="related-blogs">
	<div class="container">		
		<div class="row w-70 section">
			<h3 class="w-100 text-center">Related Articles/Blogs</h3>
			<?php get_template_part( 'template-parts/related-blog'); ?>
		</div>
	</div>
</section>

<div class="m-1 divider"></div>

<section class="related-therapies ">
	<div class="container">
		<div class="row w-70 section">
			<h3 class="w-100 text-center">Related Therapies</h3>
			<?php get_template_part( 'template-parts/related-therapies'); ?>
		</div>
	</div>
</section>

<div class="m-1 divider"></div>

<section class="related-therapist pb-5">
	<div class="container">
		<div class="row w-70 section text-center">
			<h3 class="w-100 text-center">Related Therapist</h3>
			<?php get_template_part( 'template-parts/related-therapist'); ?>
		</div>
	</div>
</section>



<?php get_footer(); ?>