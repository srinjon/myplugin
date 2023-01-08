<?php

/**
 * Plugin Name:My Plugin
 */
define("PLUGIN_DIR_PATH", plugin_dir_path(__FILE__)); //to include php file
define("PLUGIN_URL", plugins_url()); //to access js,image,css path
define("PLUGIN_VERSION","1.0");
register_activation_hook(__FILE__, "my_plugin");
function my_plugin()
{
}
add_action("admin_menu", "add_my_custom_menu");
function add_my_custom_menu()
{
    add_menu_page("userdetails", "User Details", "manage_options", "my-plugin", "admin_view", "dashicons-dashboard", 4);
    add_submenu_page("my-plugin", "Add New", "Add New", "manage_options", "my-plugin", "add_new_function");
    add_submenu_page("my-plugin", "All Files", "All Files", "manage_options", "add-new", "add_new_function2");
}

function admin_view()
{
    echo "<h1>Customer Details</h1>";
}
function add_new_function()
{
    include_once PLUGIN_DIR_PATH . "/views/submenu1.php";
}
function add_new_function2()
{
    include_once PLUGIN_DIR_PATH . "/views/submenu2.php";
}
function my_plugin_assets(){
    wp_enqueue_style("mpl_style",//unique name for css file
    PLUGIN_URL."/my-plugin/assets/style.css",//css file path
    '', //dependency on other files
    PLUGIN_VERSION, //plugin version number
);
wp_enqueue_script(
    "mpl_script",
    PLUGIN_URL."/my-plugin/assets/script.js",
    '',
    PLUGIN_VERSION,
    
);
}
add_action("init","my_plugin_assets");
function create_page(){
  include_once PLUGIN_DIR_PATH  . "/views/createpage.php";
}
register_activation_hook(__FILE__,"create_page");