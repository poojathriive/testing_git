<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package thriive
 */
?>
<?php
	if(isset($_GET['action']))
	{
		if($_GET['action'] == 'register')
		{
			wp_redirect(site_url());exit;
		}
	}
?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="msvalidate.01" content="4F185E3CCF66C83AB727028487C9CD26" />

    <link rel="profile" href="https://gmpg.org/xfn/11">

    <?php if($_SERVER['SERVER_NAME'] != 'localhost' && $_SERVER['SERVER_NAME'] != 'thriive.noesis.tech' && $_SERVER['SERVER_NAME'] != 'thriive-staging.noesis.tech' && $_SERVER['SERVER_NAME'] != 'thriive.co.in')
		{ ?>
    <script data-obct type="text/javascript">
        /** DO NOT MODIFY THIS CODE**/ ! function(_window, _document) {
            var OB_ADV_ID = '008a24ac4b74afe7d529ada2793d3c054f';
            if (_window.obApi) {
                var toArray = function(object) {
                    return Object.prototype.toString.call(object) === '[object Array]' ? object : [object];
                };
                _window.obApi.marketerId = toArray(_window.obApi.marketerId).concat(toArray(OB_ADV_ID));
                return;
            }
            var api = _window.obApi = function() {
                api.dispatch ? api.dispatch.apply(api, arguments) : api.queue.push(arguments);
            };
            api.version = '1.1';
            api.loaded = true;
            api.marketerId = OB_ADV_ID;
            api.queue = [];
            var tag = _document.createElement('script');
            tag.async = true;
            tag.src = '//amplify.outbrain.com/cp/obtp.js';
            tag.type = 'text/javascript';
            var script = _document.getElementsByTagName('script')[0];
            script.parentNode.insertBefore(tag, script);
        }(window, document);
        obApi('track', 'PAGE_VIEW');

    </script>

    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-58ZT96Z');

    </script>
    <!-- End Google Tag Manager -->

    <script data-obct type="text/javascript">
        /** DO NOT MODIFY THIS CODE**/ ! function(_window, _document) {
            var OB_ADV_ID = '008a24ac4b74afe7d529ada2793d3c054f';
            if (_window.obApi) {
                var toArray = function(object) {
                    return Object.prototype.toString.call(object) === '[object Array]' ? object : [object];
                };
                _window.obApi.marketerId = toArray(_window.obApi.marketerId).concat(toArray(OB_ADV_ID));
                return;
            }
            var api = _window.obApi = function() {
                api.dispatch ? api.dispatch.apply(api, arguments) : api.queue.push(arguments);
            };
            api.version = '1.1';
            api.loaded = true;
            api.marketerId = OB_ADV_ID;
            api.queue = [];
            var tag = _document.createElement('script');
            tag.async = true;
            tag.src = '//amplify.outbrain.com/cp/obtp.js';
            tag.type = 'text/javascript';
            var script = _document.getElementsByTagName('script')[0];
            script.parentNode.insertBefore(tag, script);
        }(window, document);
        obApi('track', 'PAGE_VIEW');

    </script>

    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-58ZT96Z');

    </script>
    <!-- End Google Tag Manager -->

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-58ZT96Z" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <!-- <script async src="https://www.googletagmanager.com/gtag/js?id=UA-133934191-1"></script>
		<script>
		  window.dataLayer = window.dataLayer || [];
		  function gtag(){dataLayer.push(arguments);}
		  gtag('js', new Date());
		
		  gtag('config', 'UA-133934191-1');
		</script>
		
		<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
		<script>
		  (adsbygoogle = window.adsbygoogle || []).push({
		    google_ad_client: "ca-pub-3547338815367924",
		    enable_page_level_ads: true
		  });
		</script> -->


    <!-- Global site tag (gtag.js) - Google Ads: 804170448 -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-804170448"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'AW-804170448');

    </script>
    <!-- End -->

    <!-- Global site tag (gtag.js) - Google Ads: 804170448 -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-804170448"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'AW-804170448');

    </script>
    <!-- End -->

    <!-- Taboola Pixel Code -->
    <script type='text/javascript'>
        window._tfa = window._tfa || [];
        window._tfa.push({
            notify: 'event',
            name: 'page_view',
            id: 1193366
        });
        ! function(t, f, a, x) {
            if (!document.getElementById(x)) {
                t.async = 1;
                t.src = a;
                t.id = x;
                f.parentNode.insertBefore(t, f);
            }
        }(document.createElement('script'),
            document.getElementsByTagName('script')[0],
            '//cdn.taboola.com/libtrc/unip/1193366/tfa.js',
            'tb_tfa_script');

    </script>
    <noscript>
        <img src='//trc.taboola.com/1193366/log/3/unip?en=page_view' width='0' height='0' style='display:none' />
    </noscript>
    <!-- End of Taboola Pixel Code -->


    <!-- Facebook Pixel Code -->
    <!--
			<script>
			  !function(f,b,e,v,n,t,s)
			  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
			  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
			  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
			  n.queue=[];t=b.createElement(e);t.async=!0;
			  t.src=v;s=b.getElementsByTagName(e)[0];
			  s.parentNode.insertBefore(t,s)}(window, document,'script',
			  'https://connect.facebook.net/en_US/fbevents.js');
			  fbq('init', '1207612446081834');
			  fbq('track', 'PageView');
			</script>
			<noscript><img height="1" width="1" style="display:none"
			  src="https://www.facebook.com/tr?id=1207612446081834&ev=PageView&noscript=1"
			/></noscript>
		-->
    <!-- End Facebook Pixel Code -->

    <!-- Facebook Pixel Code -->

    <script>
        ! function(f, b, e, v, n, t, s)

        {
            if (f.fbq) return;
            n = f.fbq = function() {
                n.callMethod ?

                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };

            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';

            n.queue = [];
            t = b.createElement(e);
            t.async = !0;

            t.src = v;
            s = b.getElementsByTagName(e)[0];

            s.parentNode.insertBefore(t, s)
        }(window, document, 'script',

            'https://connect.facebook.net/en_US/fbevents.js');

        fbq('init', '594508334368782');

        fbq('track', 'PageView');

    </script>

    <noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=594508334368782&ev=PageView&noscript=1" /></noscript>

    <!-- End Facebook Pixel Code -->

    <script type="application/ld+json">
        {
            "@context": "http://schema.org",
            "@type": "Organization",
            "name": "Thriive Art and Soul",
            "description": "Find & book appointment with top verified alternative health therapist in India, consult them for any kind of medical assistance and therapy, ask health queries, book appointment, read health articles, attend our events on yoga, meditation and other alternative therapies.",
            "foundingDate": "2016",
            "url": "<?php echo site_url(); ?>",
            "logo": "<?php echo get_template_directory_uri(); ?>/assets/images/thriive_logo.svg",
            "sameAs": [
                "https://www.facebook.com/thriiveindia",
                "https://www.facebook.com/thriiveindia",
                "https://www.youtube.com/thriiveartandsoul",
                "https://www.instagram.com/thriiveindia/"
            ]
        }

    </script>

    <!-- Begin comScore Tag -->
    <script>
        var _comscore = _comscore || [];
        _comscore.push({
            c1: "2",
            c2: "31509269"
        });
        (function() {
            var s = document.createElement("script"),
                el = document.getElementsByTagName("script")[0];
            s.async = true;
            s.src = (document.location.protocol == "https:" ? "https://sb" : "http://b") + ".scorecardresearch.com/beacon.js";
            el.parentNode.insertBefore(s, el);
        })();

    </script>
    <noscript>
        <img src="https://sb.scorecardresearch.com/p?c1=2&c2=31509269&cv=2.0&cj=1" />
    </noscript>
    <!-- End comScore Tag -->
    <?php } ?>
    <?php
		if(is_singular('therapist'))
		{
			?>
    <script type="application/ld+json">
        {
            "@context": "http://schema.org",
            "@type": "BreadcrumbList",
            "itemListElement": [{
                    "@type": "ListItem",
                    "position": 1,
                    "item": {
                        "@id": "<?php echo site_url(); ?>",
                        "name": "Home"
                    }
                },
                {
                    "@type": "ListItem",
                    "position": 2,
                    "item": {
                        "@id": "<?php echo site_url(); ?>/therapist",
                        "name": "Therapist"
                    }
                }
            ]
        }

    </script>
    <?php 
					if ( have_posts() ) { while ( have_posts() ) { the_post(); 

						//Get all therapy
						$get_all_therapy = get_the_terms(get_the_id(),'therapy');		
						$medical_speciality = array();
						foreach ($get_all_therapy as $single_therapy)
						{
							$medical_speciality[] = $single_therapy->name;
						}
						$medical_speciality = '"'.implode('","', $medical_speciality).'"';

						//Therapy with charges
						$therapist_makesOffer = get_field('therapy');
						//echo "<pre>"; print_r($therapist_makesOffer); echo "</pre>";
						$make_offer = "";
						foreach ($therapist_makesOffer as $treatment) 
						{
							$make_offer .= '"makesOffer": {
							        "@type": "Offer",
							        "name": [
						          		"'.$treatment["therapy_name"][0]->name.'"
						        	],
						        	"priceRange": "INR '.$treatment["charges"].'",
						        	"currenciesAccepted": "INR"
						      	},
						      	';
						}

						if(!empty(get_field('first_reference_review')))
						{
							$reviewContent = get_field('first_reference_review');
							$reviewBy = get_field('first_reference_name');
						}
						else if(!empty(get_field('second_reference_review')))
						{
							$reviewContent = get_field('second_reference_review');
							$reviewBy = get_field('second_reference_name');
						}
						else if(!empty(get_field('third_reference_review')))
						{
							$reviewContent = get_field('third_reference_review');
							$reviewBy = get_field('third_reference_name');
						}
				?>
    <script type="application/ld+json">
        {
            "@context": "https://schema.org/",
            "@type": "Physician",
            "name": "<?php echo get_the_title(); ?>",
            "url": "<?php echo get_the_permalink(); ?>",
            "description": "<?php echo esc_html(wp_strip_all_tags(get_the_content())); ?>",
            "medicalSpecialty": [<?php echo $medical_speciality; ?>],
            "address": {
                "@type": "PostalAddress",
                "streetAddress": "<?php echo get_field('address'); ?>",
                "addressLocality": "<?php echo getTherapistCity(get_the_id()); ?>",
                "addressCountry": "<?php echo getTherapistCountry(get_the_id()); ?>"
            },
            <?php if(!empty(get_field('first_reference_review')) || !empty(get_field('second_reference_review')) || !empty(get_field('third_reference_review'))) { ?> "review": [{
                "@type": "Review",
                "datePublished": "<?php echo get_the_date('Y-m-d'); ?>",
                "reviewBody": "<?php echo $reviewContent; ?>",
                "author": {
                    "@type": "Person",
                    "name": "<?php echo $reviewBy; ?>"
                }
            }],
            <?php } ?> "image": "<?php echo get_the_post_thumbnail_url(); ?>"
        }

    </script>
    <?php }} ?>
    <?php
		}
	?>

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-58ZT96Z" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    <nav class="nav-header-top custom">
        <div class="container h-100">
            <div class="row align-items-center">
                <div class="col-md-3 col-sm-2 col-lg-3 col-xs-2">
                    <div class="mobile-button-wrapper">
                        <div class="menu">
                            <span class="menu1"></span>
                            <span class="menu2"></span>
                            <span class=""></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6 text_right_xs text_center">
                    <a href="<?php echo get_site_url()?>"><img title="thriive" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/logo-new.png" alt="thriive logo" class="main-logo"></a>
                    <!-- 	if cicle logo needs to home page  -->
                    <!--
				<?php if(is_front_page()){ ?>
					<img src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/logo.png" alt="" class="main-logo">
				<?php } else { ?>
					<a href="<?php echo get_site_url()?>"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/thriive_logo.svg" alt="" class="main-logo"></a>
				<?php } ?>
                    -->



                    <!--
				<form role="search" method="get" class="search-form icon-search" action="<?php echo home_url( '/' ); ?>">
				        <input type="search" class="search-field"
				            placeholder="<?php echo esc_attr_x( 'Search Ailments', 'placeholder' ) ?>"
				            value="<?php echo get_search_query() ?>" name="s"
				            title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
				</form>
-->
                </div>
                <div class="col-md-3 col-sm-4 col-lg-3 col-xs-4 icons-set">
                	<div class="col-xs-4 hidden-lg hidden-md">
	                    <span href="" class="location-wrapper-top " id="openlocationbox">
	                        <span class="fa fa-map-marker fa-sm mg-5"></span>
	                        <span id="menu_geolocation" class="tl-txt hidden-xs">
	                            <?php if($_SESSION['user_area']){echo $_SESSION['user_area'];} else {echo 'Mumbai';} ?>
	                        </span>
	                    </span>
                    </div>
                    <!-- <div class="col-xs-4 col-md-6"></div> -->
                    <a href="<?php echo get_permalink( get_page_by_path( 'search-page' ) ); ?>" class="right-icons icon-search top_nuv_icon"></a>
                    <?php if (!is_user_logged_in()) { ?>
                    <a href="<?php echo get_permalink(419); ?>" class="right-icons icon-singin"></a>
                    <?php }else{ 
					$current_user = wp_get_current_user();
					if(in_array("therapist", $current_user->roles))
					{
						$page_link = site_url() . "/" . "therapist-account-dashboard";
					}
					else if(in_array("subscriber", $current_user->roles))
					{
						$page_link = site_url() . "/" . "my-account-page";
					}
					else
					{
						$page_link = site_url() . "/";
					}
					
				?>
                    <span class="user-loggedin"><a href="" class="link_profile" top_nuv_icon><i class="fa fa-user-circle-o" aria-hidden="true"></i></a>
                        <div class="user-sub-action-wrapper">
                            <ul class="user-sub-action">
                                <li class="user-sub-action-user-info">
                                    <!-- <a class="ua-item" tabindex="-1" href="<?php echo $therapist_profile_url; ?>"> -->
                                    <?php 
									if($userPost->profile_picture)
									{
										$profile_img_src = wp_get_attachment_image_src($userPost->profile_picture)[0];
									}
									else
									{
										$profile_img_src = get_stylesheet_directory_uri( ) . "/assets/images/dummy-profile-img.png";
									}
								?>
                                    <img alt="" src="<?php echo $profile_img_src ?>" srcset="<?php echo $profile_img_src ?>" class="avatar_img" height="40" width="40">
                                    <span class="display-name"><?php echo wp_get_current_user()->first_name . ' ' . wp_get_current_user()->last_name; ?></span>
                                    <span class="user-email ellipsis"><?php echo wp_get_current_user()->user_email; ?></span>
                                    <!-- </a> -->
                                </li>
                                <?php if(in_array("therapist", wp_get_current_user()->roles)) {  ?>
                                <li id="user-sub-action-profile">
                                    <a class="ab-item" href="<?php echo $therapist_profile_url; ?>">View Profile</a>
                                </li>
                                <?php } ?>
                                <li id="user-sub-action-dashboard">
                                    <?php
								if(in_array("therapist", wp_get_current_user()->roles))
								{
									$dashboard = "/therapist-account-dashboard/";
								}
								else
								{
									$dashboard = "/my-account-page/";
								}
							?>
                                    <a class="ab-item" href="<?php echo $dashboard; ?>">View Dashboard</a>
                                </li>
                                <li id="user-sub-action-logout">
                                    <a class="ab-item" href="<?php echo wp_logout_url('/login/')  ?>">Log Out</a>
                                </li>
                            </ul>
                        </div>
                    </span>
                    <?php }?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-2 col-sm-12 col-xs-12 banner-above-menu-wrapper">
                 
                </div>
                <div class="col-md-8 col-sm-12 col-xs-12 banner-above-menu-wrapper">
                    <?php
					wp_nav_menu(array(
						'theme_location' => 'main_above_banner',
						'menu_id' => 'main_above_banner',
						'menu_class' => 'menu-inline',            
					));
				?>
                </div>
                <div class="col-md-2 hidden-xs hidden-sm">
                    <span href="" class="location-wrapper-top" id="openlocationbox">
                        <span class="fa fa-map-marker fa-md mg-5"></span>
                        <span id="menu_geolocation" class="tl-txt hidden-xs">
                            <?php if($_SESSION['user_area']){echo $_SESSION['user_area'];} else {echo 'Mumbai';} ?>
                        </span>
                    </span>
                </div>
            </div>

            <div id="locationsearch" style="display: none; float: right;" class="row">
                <!-- <button class="col-md-2 btnlocation" type="button" id="savesearch"><i class="fa fa-map-marker fa-lg" aria-hidden="true"></i></button> -->
                <input type="text" name="area" id="searchArea" autocomplete="off" class="form-control col-md-10" value="" placeholder="Search Location" />
                <div id="resultsearch"></div>
            </div>
        </div>
    </nav>

    <div class="mobile-menu-wrapper ping-bg">
        <!--
		<div class="menu-open open">
           	<span class="menu1"></span>
            <span class="menu2"></span>
            <span class=""></span>
        </div>
-->
        <?php
        wp_nav_menu(array(
            'theme_location' => 'menu-1',
            'menu_id' => 'primary-menu',
            'menu_class' => 'menu-list',            
        ));
        ?>
    </div>

    <div class="spacer-header"></div>
    <?php //print_r($_SESSION); ?>

    <?php if (is_post_type_archive('event')) { ?>
    <script>
        var event = true;

    </script>
    <?php } elseif(is_singular('event')){ ?>
    <script>
        var event_post_id = '';

    </script>
    <?php } ?>
