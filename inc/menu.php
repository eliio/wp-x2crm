<?php

add_action('admin_menu', 'wp2x2crm_add_admin');

function wp2x2crm_add_admin() {

add_submenu_page( 'options-general.php' , 'x2CRM Options', 'x2CRM Options' , 'manage_options' , __FILE__ . '_display_contents' , 'wp2x2crm_display_contents');
}
?>
