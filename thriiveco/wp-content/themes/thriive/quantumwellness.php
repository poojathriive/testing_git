<?php /* Template Name: Quantum Wellness */?>
<?php get_header(); ?>


<style>
    @media only screen and (max-width: 600px) {
        nav.nav-header-top {
            height: 80px !important;
        }

        .spacer-header {
            height: 80px !important;
        }
    }

    @media only screen and (min-width: 680px) {
        nav.nav-header-top {
            height: 100px !important;
        }

        .spacer-header {
            height: 100px !important;
        }

        .q_w_container {
            min-height: 290px;
        }

        .ginput_container_textarea {
            margin-left: 25% !important;
            margin-right: 25%;
        }
    }

    .clear {
        clear: both;
    }

    .w_q_content_6 {
        margin: 2% 0;
    }

    .q_w_container {
        background-color: #fff;
        border: 1px solid #eaeaeabf;
        padding: 2% 5%;
        margin: 2% 0%;
        border-radius: 10px;
    }

    .q_w_container h5 {
        text-align: center;
    }

    .start_new_section {
        margin: 2% 0
    }

    .slick-slide {
        margin: 0px 20px;
    }

    .slick-slide img {
        width: 100%;
    }

    .slick-slider {
        position: relative;
        display: block;
        box-sizing: border-box;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        -webkit-touch-callout: none;
        -khtml-user-select: none;
        -ms-touch-action: pan-y;
        touch-action: pan-y;
        -webkit-tap-highlight-color: transparent;
    }

    .slick-list {
        position: relative;
        display: block;
        overflow: hidden;
        margin: 0;
        padding: 0;
    }

    .slick-list:focus {
        outline: none;
    }

    .slick-list.dragging {
        cursor: pointer;
        cursor: hand;
    }

    .slick-slider .slick-track,
    .slick-slider .slick-list {
        -webkit-transform: translate3d(0, 0, 0);
        -moz-transform: translate3d(0, 0, 0);
        -ms-transform: translate3d(0, 0, 0);
        -o-transform: translate3d(0, 0, 0);
        transform: translate3d(0, 0, 0);
    }

    .slick-track {
        position: relative;
        top: 0;
        left: 0;
        display: block;
    }

    .slick-track:before,
    .slick-track:after {
        display: table;
        content: '';
    }

    .slick-track:after {
        clear: both;
    }

    .slick-loading .slick-track {
        visibility: hidden;
    }

    .slick-slide {
        display: none;
        float: left;
        height: 100%;
        min-height: 1px;
    }

    [dir='rtl'] .slick-slide {
        float: right;
    }

    .slick-slide img {
        display: block;
    }

    .slick-slide.slick-loading img {
        display: none;
    }

    .slick-slide.dragging img {
        pointer-events: none;
    }

    .slick-initialized .slick-slide {
        display: block;
    }

    .slick-loading .slick-slide {
        visibility: hidden;
    }

    .slick-vertical .slick-slide {
        display: block;
        height: auto;
        border: 1px solid transparent;
    }

    .slick-arrow.slick-hidden {
        display: none;
    }


    .slick-next .slick-arrow {
        right: 0;
        border-radius: 3px 0 0 3px;
        cursor: pointer;
        position: absolute;
        top: 50%;
        width: auto;
        margin-top: -22px;
        padding: 16px;
        color: white;
        font-weight: bold;
        font-size: 18px;
        transition: 0.6s ease;
        border-radius: 0 3px 3px 0;
        user-select: none;
    }

    .prev:hover,
    .next:hover {
        background-color: rgba(0, 0, 0, 0.8);
    }

    .slick-prev,
    .slick-next {
        height: 35px;
        width: 35px;
        background-size: 100%, 100%;
        border-radius: 50%;
        border: 0px;
        background-color: #00000059;
        color: #fff;
    }

    .slick-prev {
        top: 50% !important;
        float: left;
        margin: 4% 0%;
    }

    .slick-next {
        top: 50% !important;
        float: right;
        margin: -8% -3%;
    }

    .testmonial_container {
        background-color: #f9f9f9;
        border-radius: 10px;
        padding: .5%;
        border: 1px solid #eaeaeabf;
    }

    .center {
        text-align: center;
        padding: 2%;
    }

    .gform_fields {
        text-align: center;
    }

    .gform_footer {
        text-align: center;
    }

    input[type="submit"] {
        background-color: #4f0475;
        border-radius: 5px;
        color: #fff;
        font-weight: 600;
    }

    .bg_dark {
        background-color: #F9F9F9;
    }

    .text_justify {
        text-align: justify;
    }

    .ind_login {
        font-size: 14px;
        font-family: 'Merienda', cursive;
        color: #4f0475 !important;
        cursor: pointer;
    }

    a p {
        color: #4f0475 !important;
    }

    input[type=text],
    input[type=password],
    input[type=number],
    input[type=date],
    input[type=email] {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        box-sizing: border-box;
    }

    button {
        background-color: #4e0477;
        color: white;
        margin: 8px 0;
        border: none;
        cursor: pointer;
        width: 100%;
    }

    button:hover {
        opacity: 0.8;
    }

    .cancelbtn {
        width: auto;
        background-color: #f44336;
    }

    .form_container {
        padding: 5% 7%;
    }

    span.psw {
        float: right;
        padding-top: 16px;
    }

    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgb(0, 0, 0);
        background-color: rgba(0, 0, 0, 0.4);
        padding-top: 60px;
    }

    .modal-content {
        background-color: #fefefe;
        margin: 5% auto 15% auto;
        border: 1px solid #888;
        width: 30%;
    }

    .close {
        position: absolute;
        right: 25px;
        top: 0;
        color: #000;
        font-size: 35px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: red;
        cursor: pointer;
    }

    .animate {
        -webkit-animation: animatezoom 0.6s;
        animation: animatezoom 0.6s
    }

    @-webkit-keyframes animatezoom {
        from {
            -webkit-transform: scale(0)
        }

        to {
            -webkit-transform: scale(1)
        }
    }

    @keyframes animatezoom {
        from {
            transform: scale(0)
        }

        to {
            transform: scale(1)
        }
    }

    @media screen and (max-width: 300px) {
        span.psw {
            display: block;
            float: none;
        }

        .cancelbtn {
            width: 100%;
        }
    }

    @media screen and (min-width: 600px) {
        .spacer-header {
            /*height: 76px !important;*/
        }
    }

    @media screen and (max-width: 480px) {
        .modal-content {
            width: 90% !important;
        }
    }

</style>

<section class="slider__">
    <?php 
        echo do_shortcode("[rev_slider alias='wellness']"); 
    ?>
</section>
<div class="clear"></div>

<div class="container start_new_section">
    <h2 class="text-center">Health and Wellness on your Terms</h2>
    <div class="row">
        <div class="col-md-6 col-xs-12">
            <div class="">
                <img class="img-responsive" src="">
            </div>
        </div>
        <div class="col-md-6 col-xs-12">
            <hr>
            <div>
                <h5>What is Quantum Wellness?</h5>
                <p>Science is what has gotten us this far in the world of wellness. And quantum physics takes us a step ahead. Welcome to an age where Quantum Wellness is much more than just a theory- it’s an actual practice. Quantum wellness is an experiential new age technique that heals us by balancing our energies through scalar waves.</p>
            </div>
            <div>
                <h5>The concept</h5>
                <p>Hundred years ago, the famous scientist Nikola Tesla discovered that there are waves that have no frequencies and called them Scalar waves. Scalar waves form the crux of the theory of quantum wellness.</p>
                <p>They are capable of penetrating any solid object & travel faster than the speed of light and are involved in the process of the formation of nature.Based on scientific studies, scalar waves have a beneficial effect on the immune system of mammals and can also coherently reorder the molecular structure of water.</p>
                <p>Hence, scalar waves can be used to actually ‘reprogram’ or ‘rectify’ our bodies and help us heal effectively, from miles away, without a single medicine, touch or pain.</p>
            </div>
        </div>
    </div>
</div>
<div class="clear"></div>

<section class="w_q_content_6 start_new_section bg_dark">
    <div class="container">
        <h2 class="center">Quantum Wellness..</h2>
        <div class="center1" style="text-align: center;">
            <iframe width="100%" height="315" src="https://www.youtube.com/embed/wjV4mJa-vlg" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
        <div class="row">
            <div class="col-md-4 col-xs-12">
                <div class="q_w_container">
                    <h5 class="center">Cosmetic correction & Anti- ageing</h5>
                    <div class="row" style="text-align:center">
                        <div class="col-md-12 col-xs-12">
                            <img class="img-responsive" src="">
                        </div>
                        <div class="col-md-12 col-xs-12">
                            <p class="text_justify"> Do you not want to look your age? That’s fine! Throw away your collection of anti-ageing creams loaded with chemicals. Get rid of wrinkles and skin dullness by using the Quantum Wellness program for anti-ageing.</p>
                        </div>
                    </div>
                    <?php if (!is_user_logged_in()){ ?>
                        <a class="ind_login" onclick="document.getElementById('sing_up').style.display='block'">
                            <p class="center"> Sign Up</p>
                        </a>
                    <?php } ?>
                </div>
            </div>

            <div class="col-md-4 col-xs-12">
                <div class="q_w_container">
                    <h5 class="center">Business Development Program</h5>
                    <div class="row" style="text-align:center">
                        <div class="col-md-12 col-xs-12">
                            <img class="img-responsive" src="">
                        </div>
                        <div class="col-md-12 col-xs-12">
                            <p class="text_justify"> Speed past your contemporaries by improving your business acumen. Maybe your several years of hard work is just asking for a frequency correction to produce good financial results. All you need to do is</p>
                        </div>
                    </div>
                    <?php if (!is_user_logged_in()){ ?>
                        <a class="ind_login" onclick="document.getElementById('sing_up').style.display='block'">
                            <p class="center"> Sign Up</p>
                        </a>
                    <?php } ?>
                </div>
            </div>

            <div class="col-md-4 col-xs-12">
                <div class="q_w_container">
                    <h5 class="center">Fatigue</h5>
                    <div class="row" style="text-align:center">
                        <div class="col-md-12 col-xs-12">
                            <img class="img-responsive" src="">
                        </div>
                        <div class="col-md-12 col-xs-12">
                            <p class="text_justify">Huffing and puffing after a few minutes of workout? Is ‘I used to’ becoming a common phrase while you describe your gym routine which has gone for a toss? It’s time to energise. Fight fatigue with this Quantum Wellness program-</p>
                        </div>
                    </div>
                    <?php if (!is_user_logged_in()){ ?>
                        <a class="ind_login" onclick="document.getElementById('sing_up').style.display='block'">
                            <p class="center"> Sign Up</p>
                        </a>
                    <?php } ?>
                </div>
            </div>

            <div class="col-md-4 col-xs-12">
                <div class="q_w_container">
                    <h5 class="center">Energy & Vitality</h5>
                    <div class="row" style="text-align:center">
                        <div class="col-md-12 col-xs-12">
                            <img class="img-responsive" src="">
                        </div>
                        <div class="col-md-12 col-xs-12">
                            <p class="text_justify">Taking the lift for the first floor, feeling drowsy at workplace and lacking enthusiasm about outdoor plans could be clear signs of perpetually low energy levels. Click here to pump it up!-</p>
                        </div>
                    </div>
                    <?php if (!is_user_logged_in()){ ?>
                        <a class="ind_login" onclick="document.getElementById('sing_up').style.display='block'">
                            <p class="center"> Sign Up</p>
                        </a>
                    <?php } ?>
                </div>
            </div>

            <div class="col-md-4 col-xs-12">
                <div class="q_w_container">
                    <h5 class="center">Manifestation session</h5>
                    <div class="row" style="text-align:center">
                        <div class="col-md-12 col-xs-12">
                            <img class="img-responsive" src="">
                        </div>
                        <div class="col-md-12 col-xs-12">
                            <p class="text_justify">Dreams and goals can be tantalising but useless if they don’t fuel your spirit to manifest them. If your dozens of to-do lists aren’t working, this will. Take up this program to experience a manifestation session</p>
                        </div>
                    </div>
                    <?php if (!is_user_logged_in()){ ?>
                        <a class="ind_login" onclick="document.getElementById('sing_up').style.display='block'">
                            <p class="center"> Sign Up</p>
                        </a>
                    <?php } ?>
                </div>
            </div>

            <div class="col-md-4 col-xs-12 ">
                <div class="q_w_container">
                    <h5 class="center">Memory improvement</h5>
                    <div class=" row" style="text-align:center">
                        <div class="col-md-12 col-xs-12">
                            <img class="img-responsive" src="">
                        </div>
                        <div class="col-md-12 col-xs-12">
                            <p class="text_justify">Are you tired of failing to meet deadlines, missing out on important events and sending in ‘belated’ birthday wishes? If poor memory has forever been your enemy, this program can help you fight it and improve!</p>
                        </div>
                    </div>
                    <?php if (!is_user_logged_in()){ ?>
                        <a class="ind_login" onclick="document.getElementById('sing_up').style.display='block'">
                            <p class="center"> Sign Up</p>
                        </a>
                    <?php } ?>
                </div>
            </div>

            <div class="col-md-4 col-xs-12 ">
                <div class="q_w_container">
                    <h5 class="center">Sports Program</h5>
                    <div class=" row" style="text-align:center">
                        <div class="col-md-12 col-xs-12">
                            <img class="img-responsive" src="">
                        </div>
                        <div class="col-md-12 col-xs-12">
                            <p class="text_justify">Be the golf swing, the aim for the basket or the kick for the goal post- perfect every sports move by running this robust sports program on yourself.</p>
                        </div>
                    </div>
                    <?php if (!is_user_logged_in()){ ?>
                        <a class="ind_login" onclick="document.getElementById('sing_up').style.display='block'">
                            <p class="center"> Sign Up</p>
                        </a>
                    <?php } ?>
                </div>
            </div>

            <div class="col-md-4 col-xs-12 ">
                <div class="q_w_container">
                    <h5 class="center">Stress & Tension</h5>
                    <div class=" row" style="text-align:center">
                        <div class="col-md-12 col-xs-12">
                            <img class="img-responsive" src="">
                        </div>
                        <div class="col-md-12 col-xs-12">
                            <p class="text_justify">If you start sweating around your seniors, stammering in front of new people and fidgeting when your partner is upset with you, you must be knowing what stress and tension feels like when it hits you. De-stress with technology.</p>
                        </div>
                    </div>
                    <?php if (!is_user_logged_in()){ ?>
                        <a class="ind_login" onclick="document.getElementById('sing_up').style.display='block'">
                            <p class="center"> Sign Up</p>
                        </a>
                    <?php } ?>
                </div>
            </div>
            <?php if (!is_user_logged_in()){ ?>
                <div class="col-md-4 col-xs-12">
                    <div class="q_w_container">
                        <div class=" row">
                            <a class="q_w_link" onclick="showRegister()" href="#" style="padding: 24% 15%;">
                                <h2>Sign up for More PROGRAMS</h2>
                            </a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>
<div class="clear"></div>

<section class="start_new_section">
    <div class="container">
        <h2 class="center">Testimonials</h2>
        <section class="testmonual_fetch slider">
            <div class="slide testmonial_container">
                <p>Qsserver has helped me to manage a H1B visa for my client. My client was on the last few days of his H1B visa and he had to submit many papers to continue his H1B. He was sceptical that he may not get H1B. His company sent lawyers to work out his case. I made him send a handwritten wish card and his photograph in softcopy by email. This was then uploaded in QSServer. Firstly, I balanced his Aura and Negative Energies from QSS for 3 iterations. Then I asked him to call me on a particular day. The day when he called me I told him that after the call is over, he must "focus his intent on his wish and pray for 5 mins imagining his wish being fulfilled". As soon as the call was hung up, I started the Manifestation program in the QSS. This was done only once. His last date for H1B visa approval was on 3rd May. He called me on 4th May to convey that his H1B was approved. I am sure that while he was focusing his intent with wish, and I was running the Manifestation program for Legal matters, QSServer did all the changes in the quantum level.
                </p>
                <h5 class="center">~~Gunjan~~</h5>
            </div>
            <div class="slide testmonial_container">
                <p>I am sensitive anyway but this really did heighten my awareness. This is so fast!! I just ran these programs! I know who is calling me before I look, I am calm and grounded. It is hard to explain the difference I feel but I do absolutely see a difference! I really thought it would take more time.
                    I slept better than I have in years. I have no idea what caused that. I ran about 50 programs. lol I have never really slept well but something helped that.

                    I am more focused. I tend to have an attention deficit. I get distracted easily. I am far more focused and aware. I LOVE that! Again, I don't know what program might have done that and I wasn't looking for that but grateful anyway! </p>
                <h5 class="center">~~Donna Weigel~~</h5>
            </div>
            <div class="slide testmonial_container">
                <p>I know I'm going crazy on the balancing! This is a blast! (fun). I have a SE-5 but need to learn how to use it yet and we are in the moving process so I am taking advantage of this online.

                    I can actually feel it working. I get a tingle all over and sometimes light-headed. I don't have better words for it.

                    The biggest thing I noticed was the sugar balance. About three weeks ago I was diagnosed with diabetes and give a prescription. I refused to go that way and changed my diet completely and faithfully stuck to it. It was running around 315! With diet over the last couple of weeks, I got it down to 215. I couldn't budge it from there. I figured it will take time. I ran the sugar balance program. also pancreas. Wow, wow, wow! This morning my sugar count was 144! That is amazing! Since for weeks, nothing changed until I ran the program. Then there was an instant BIG change.
                </p>
                <h5 class="center">~~Donna Weigel~~</h5>
            </div>
        </section>
    </div>
</section>
<div class="clear"></div>

<section class="start_new_section bg_dark">
    <div class="container">
        <h2 class="center">Your Health Starts Here</h2>
        <?php echo do_shortcode('[gravityform id=22 title=false description=false]'); ?>
    </div>
</section>
<div class="clear"></div>

<div id="sing_up" class="modal">
    <form class="modal-content animate" action="" method="POST" id="qw_form">
        <div class="imgcontainer">
            <span onclick="document.getElementById('sing_up').style.display='none'" class="close" title="Close Modal">&times;</span>
            <!-- <img src="img_avatar2.png" alt="Thriive" class="header_logo"> -->
        </div>
        <div class="error-msg form-error text-left" id="qsmsg"></div>
        <div class="form_container">
            <select name="user_role" class="form-control">
                <option>Select Account for</option>
                <option>Excuter</option>
                <option>Healer</option>
            </select>
            <input type="email" placeholder="Email id" name="email" required class="form-control">
            <input type="text" placeholder="Name" name="name" required class="form-control">
            <input type="date" placeholder="Date of birth" name="dob" class="form-control">
            <input type="text" placeholder="Address" name="address" required class="form-control">
            <?php global $wpdb; 
            $countries = $wpdb->get_results("SELECT * FROM countries ORDER BY name ASC"); ?>
            <select name="country" class="form-control">
                <option>Select Country</option>
                <?php foreach ($countries as $key => $value) { ?>
                    <option value="<?php echo $value->sortname; ?>"><?php echo $value->name; ?></option>
                <?php } ?>
            </select>
            <input type="number" placeholder="Mobile Number" name="mobile" required class="form-control">
            <input type="password" placeholder="Password" id="password" name="password" required class="form-control">
            <input type="password" placeholder="Confirm Password" id="c_password" name="c_password" required class="form-control">
            <button type="submit" name="qw_submit">Sign Up</button>
        </div>
<!--         <div class="container" style="background-color:#f1f1f1">
            <button type="button" onclick="document.getElementById('sing_up').style.display='none'" class="cancelbtn">Cancel</button>
            <span class="psw">Forgot <a href="#">password?</a></span>
        </div> -->
    </form>
</div>

<script>
    $(document).ready(function() {
        $('.testmonual_fetch').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 4500,
            arrows: false,
            dots: false,
            pauseOnHover: false,
            responsive: [{
                breakpoint: 768,
                settings: {
                    slidesToShow: 4
                }
            }, {
                breakpoint: 520,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            }]
        });
    });

</script>

<?php get_footer();?>
