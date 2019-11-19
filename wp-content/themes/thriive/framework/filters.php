<?php
add_filter('acf/fields/google_map/api', 'events_google_map_api');
add_filter('wpseo_breadcrumb_links', 'custom_wpseo_breadcrumb_output');
add_filter( 'get_the_archive_title','modify_category_title');
add_filter('wp_nav_menu_items', 'addLogoutLinkInNavigation', 10, 2);
add_filter('image_size_names_choose', 'custom_image_sizes_choose');
add_filter( 'send_password_change_email', '__return_false');
add_filter( 'gform_notification_2', 'add_attachment_pdf', 10, 3 ); //target form id 2, change to your form id
add_filter('wpseo_canonical' , 'change_cannonical_url', 10,1); //Filter to modify Canonical Url
?>