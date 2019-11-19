<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="container blog-wrapper">
				<div class="row section w-70">
					<?php if ( function_exists('yoast_breadcrumb') ) 
						{yoast_breadcrumb('<p id="breadcrumbs">','</p>');} 
					?>

					<header class="entry-header text-center w-100">
						<?php
							$post_categories = get_post_primary_category($post->ID, 'category');
						?>
					<div class="category-name "><span class="cat-<?php echo $post_categories['primary_category']->slug;?> cat-icon-set blog-icon-set"> </span> <span class="text-highlight"><?php echo $post_categories['primary_category']->name;?></span></div>
					<?php
					if ( is_singular() ) :
						the_title( '<h1 class="entry-title w-100 blog-title mt-3">', '</h1>' );
					else :
						the_title( '<h2 class="entry-title w-100 blog-title mt-3"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
					endif;
					?>
					<div class="entry-meta">
							<?php
							thriive_posted_by();
							?>
					</div><!-- .entry-meta -->
					<div class="col-12 col-sm-10 mx-auto p-0 d-flex blog-list-details mb-3">
						<div class="col"><span class="icon-new-calender_1 icon-event"></span> <span><?php the_date('j M, Y');?></span> </div>
						<div class="col"><span class="icon-new-comment icon-event"></span><?php comments_number('0');?></div>
						<div class="col"><span class="icon-new-view-eye icon-event"></span><?php echo getPostViews(get_the_ID());?></div>
					</div>
					<?php
					if (has_post_thumbnail()):
						?>
						<div class="blog-banner">
							<?php the_post_thumbnail('blog-header', array('alt' => str_replace(array('“','”'), array('',''), get_the_title()), 'title' => str_replace(array('“','”'), array('',''), get_the_title()) ));?>
						</div>
					<?php
					endif;
					?>
					</header><!-- .entry-header -->
				</div>
		
				<div class="row w-70 section">
			<div class="col-12 p-0 blog-wrapper text-justify blog-single-txt pb-2">
				<?php the_content(); ?>
			</div>
			
			
			<?php
				
				$commenter = wp_get_current_commenter();
				$req = get_option( 'require_name_email' );
				$aria_req = ( $req ? " aria-required='true'" : '' );
				
				$consent = empty( $commenter['comment_author_email'] ) ? '' : ' checked="checked"';
				
				//Customize form field
				$fields =  array(
					'author' =>
					    '<div class="form-group">
					    	<label for="author">' . __( 'Name', 'domainreference' ) . ( $req ? '<span class="required">*</span>' : '' ) . '</label>' .
							'<input id="author" name="author" class="form-control" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
							'" ' . $aria_req . ' />
						</div>',
				
					'email' =>
						'<div class="form-group">
							<label for="email">' . __( 'Email', 'domainreference' ) . ( $req ? '<span class="required">*</span>' : '' ) . '</label>' .
							'<input id="email" name="email" type="text" class="form-control" value="' . esc_attr(  $commenter['comment_author_email'] ) .
							'" ' . $aria_req . ' />
						</div>',
				
					'url' =>
				    	'<div class="form-group">
				    		<label for="url">' . __( 'Website', 'domainreference' ) . '</label>' .
							'<input id="url" name="url" type="text" class="form-control" value="' . esc_attr( $commenter['comment_author_url'] ) .
							'" />
						</div>',
				);

				//Customize comment form setting
				$comments_args = array
				( 
					'class_form'=>'form-element-section',
			        //'title_reply'=>'Leave your comment',
			        'comment_notes_after' => '',
			        'comment_field' => '
			        		<div class="form-group">
								<label for="comment">' . _x( 'Comment', 'noun' ) .  ( $req ? '<span class="required">*</span>' : '' ) . '</label>
								<textarea class="form-control" id="comment" name="comment" ' . $aria_req . '></textarea>
							</div>',
			        'label_submit'=>'Send',
			        'class_submit'=>'btn btn-primary d-inline',
			        'fields' => apply_filters( 'comment_form_default_fields', $fields ),
			        'format'            => 'xhtml'
				);
				
				comment_form($comments_args);
			?>
			<?php if(get_comments_number()){ ?>
			<div class="rfa_comment comments-area">
				<h6>Comments</h6>
				<ol class="comment-list">
				    <?php    
				        //Gather comments for a specific page/post 
				        $comments = get_comments(array(
				            'post_id' => get_the_id(),
				            'status' => 'approve' //Change this to the type of comments to be displayed
				        ));
				
				        //Display the list of comments
				        wp_list_comments(array(
				            'per_page' => 10, //Allow comment pagination
				            'reverse_top_level' => false //Show the latest comments at the top of the list
				        ), $comments);
				    ?>
				</ol>
			</div>
			<?php } ?>
			
			<?php
			// If comments are open or we have at least one comment, load up the comment template.
/*
			if ( comments_open() || get_comments_number() ) :
			?>
			<div class="col-12 p-0">
				<?php
				comments_template();
				?>
			</div>
			<?php
			endif;
*/
			?>
		</div>
		</div>
</article>

<!--
<style>
	.rfa_comment.comments-area, .blog-wrapper #respond 
	{
	    width: 100%;
	}
	.rfa_comment .comment-list
	{
	    list-style-type: none;
	}
</style>
-->

<div class="text-center">
	<a href="" class="btn share-cta mb-3"><i class="icon-new-share p-1"></i>SHARE</a>
	<div class="thriive-social-block hide-block mb-3"> 
		<?php if ( function_exists( 'ADDTOANY_SHARE_SAVE_KIT' ) ) { ADDTOANY_SHARE_SAVE_KIT(); } ?>
	</div>
</div>