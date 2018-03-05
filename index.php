<?php
/*
Plugin Name: EA Player
Plugin URI: https://www.cssplus.org
Description: A new wordpress player
Author: 蜜汁路易(louie)
Version: 1.0.0
Author URI: https://www.cssplus.org
*/

define('PLAYER_VERSION', '1.0.0');
define('PLAYER_URL', plugins_url('', __FILE__));
define('PLAYER_PATH', plugin_dir_path( __FILE__ ));

require PLAYER_PATH . '/modules/function.php';