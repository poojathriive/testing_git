<?php
/* Template Name: blog tag */

get_header();
if (have_posts()):
    ?>
    <section class="">
        <div class="container">
            <header class="page-header">
                <div class="row text-center section w-70">
                    <h1 class="page-title w-100"><?php single_tag_title(); ?></h1>
<!--
                    <div class="col-12 p-0">

                        <ul class="row blog-cat-list">
                            <?php
                            $terms = get_terms('post_tag', array('hide_empty' => 'true'));
                            foreach ($terms as $term):
                                ?>
                                <li class="col-4"><a href="<?php echo get_term_link($term); ?>"> <span class="text-highlight"><?php echo $term->name; ?></span></a></li>
                                <?php
                            endforeach;
                            ?>	
                        </ul>
                    </div>
-->
                </div>
            </header>		
            <div class="row blog-listing-content-wrapper">
                <?php
                while (have_posts()) :
                    the_post();
                    get_template_part('template-parts/post/content-post-loop', get_post_type());
                endwhile;
                ?>
            </div>
            <div class="blog-post-navigation mt-5">
                <?php
                the_posts_navigation(array(
                    'prev_text' => __('Next Page', 'theme_textdomain'),
                    'next_text' => __('previous Page', 'theme_textdomain'),
                    'screen_reader_text' => __('Posts navigation', 'theme_textdomain')
                ));
                ?>
            </div>

        </div>
    </section>
    <?php
else :
    get_template_part('template-parts/content', 'none');
endif;
get_footer();
?>