<?php
/**
 * thriive functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package thriive
 */

/**
 * Include Framework Modules
 *
 * The $file_includes array determines the code libraries included in your theme.
 *
 * @since 0.0.1
 */
 
 //SMS gateway url
define("SMS_URL","http://ems-api.startenterprise.com:8080/bulksms/bulksms?"."username=THRIIVEOTP&password=SkaeXmPn&type=0&dlr=1&source=THRIIV&");

//pay u details
if($_SERVER['SERVER_NAME'] == 'localhost' || $_SERVER['SERVER_NAME'] == 'thriive.co.in')
	
{
	
    //For Dev & Staging
    define('MERCHANT_KEY','gtKFFx');
    define('SALT','eCwWELxi');
    define('PAYU_BASE_URL','https://test.payu.in/_payment');
    //define('RECAPTCHA_SITE_KEY','6LfbdrQUAAAAAJ59S3WxMJ5k-KXs7IS1EUjM4mUA');
    //define('RECAPTCHA_SITE_SECRET','6LfbdrQUAAAAAEvsoVLj6GP5DQO6BvieKio4WrLh');
	
	
	define('RECAPTCHA_SITE_KEY','6Lf6Br8UAAAAAAnZh-GzplYh41YSk3JWWuUn633F');
    define('RECAPTCHA_SITE_SECRET','6Lf6Br8UAAAAAE8L1gMGWOKJkG8ftB-ybLybLkZf');
}
else
{
    //For live 
    define('MERCHANT_KEY','fsZR5l');
    define('SALT','C0SiMqcB');
    define('PAYU_BASE_URL','https://secure.payu.in/_payment');
    //define('RECAPTCHA_SITE_KEY','6LeSIbQUAAAAABKLl6Kma4t-lRG6gAZDD9fZwUaq');
    //define('RECAPTCHA_SITE_SECRET','6LeSIbQUAAAAAGWX3VAYuPCJG0MLl0Bd_TroVuU2');

}

define('HASH_SEQUENCE','key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10');
define('PAYU_RETURN_URL', site_url() . '/thank-you/');
    
 
$file_includes = array(
    'framework/actions.php',
    'framework/assets.php',
    'framework/core-functions.php',
    'framework/init.php',
    'framework/filters.php',
    'framework/custom-endpoints.php',
    'framework/custom-endpoint-callbacks.php',
    'framework/ajax_actions.php'
);

// Include files from $file_includes array.
foreach ($file_includes as $file) {
    include_once get_stylesheet_directory() . '/' . $file;
}

/**
 * Required Files
 *
 * The $file_requires array determines the required files in your theme.
 *
 * @since 0.0.1
 */
$file_requires = array(
    'custom-header.php', // Implement the Custom Header feature.
    'template-tags.php', // Custom template tags for this theme.
    'template-functions.php', // Functions which enhance the theme by hooking into WordPress.
    'customizer.php' // Customizer additions.
);

// Include files from $file_requires array.
foreach ($file_requires as $file) {
    require get_template_directory() . '/inc/' . $file;
}

/**
 * Load Jetpack compatibility file.
 *
 * The loads Jetpack compatibility file.
 *
 * @since 0.0.1
 */
if (defined('JETPACK__VERSION')) {
    require get_template_directory() . '/inc/jetpack.php';
}


?>