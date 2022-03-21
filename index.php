<?php
/*
Plugin Name: Beeply
Plugin URI: https://mustafaoguzbaran.com
Description: WordPress Notification Plugin
Version: 1.0
Author: Mustafa Oğuz Baran
Author URI: https://mustafaoguzbaran.com
*/
include("functions.php");
add_action( "admin_menu", "beeply_front");
add_action("wp_head", "beeply_frontend");
function beeply_front(){
    add_menu_page("Beeply", "Beeply", "manage_options","beeply", "beeply_content");
}
add_table_beeply();
?>