<?php /* Template Name: Review form */ 
get_header(); ?>
<?php $therapist = get_page_by_path( $_GET['t'], OBJECT, 'therapist' ); ?>
<div class="container review_section">
	<div class="review_head text-center">Submit a Review for <?php echo $therapist->post_title; ?></div>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4 col-xs-12">
            <div class="">
                <form data-parsley-validate="" class="" action="<?php echo get_permalink($therapist->ID); ?>" method="post" novalidate="">
                    <div class="rate">
                        <input type="radio" id="rate5_hidden" name="rate" value="5" required/>
                        <label for="rate5_hidden" title="rate">5 stars</label>
                        <input type="radio" id="rate4_hidden" name="rate" value="4" />
                        <label for="rate4_hidden" title="rate">4 stars</label>
                        <input type="radio" id="rate3_hidden" name="rate" value="3" />
                        <label for="rate3_hidden" title="rate">3 stars</label>
                        <input type="radio" id="rate2_hidden" name="rate" value="2" />
                        <label for="rate2_hidden" title="rate">2 stars</label>
                        <input type="radio" id="rate1_hidden" name="rate" value="1" />
                        <label for="rate1_hidden" title="rate">1 star</label>
                    </div>
                    <div style="clear:both"></div>
                    <div class="review_issue">
                        <label for="ailment">For which issues did you consult ?</label>
                        <input type="text" name="ailment" id="txtAilment" autocomplete="off" class="form-control" value="" placeholder="Search Issues" />
                        <div id="resultailment"></div>
                    </div>
                    <div class="review_issue">
                        <label for="review">Review</label><br />
                        <textarea type="text" name="review" value="" id="review_text" class="review_text"></textarea>
                    </div>
                    <div class="review_recommende">
                        <label>Would you like to recommend Thriive?</label><br />
                        <input type="radio" name="recommend" value="yes"/>Yes &nbsp;
                        <input type="radio" name="recommend" value="no" />No
                    </div>
                    <input type="hidden" name="post_id" value="<?php echo $_GET['t']; ?>">
                    <input type="hidden" name="user_id" value="<?php echo get_current_user_id(); ?>">
                    <button type="submit" class="btn btn-primary text-center" name="review_submit" id="review_submit">Submit</button>
                </form>
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>
</div>
<?php get_footer(); ?>