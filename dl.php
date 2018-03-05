<?php
/**
 * player download function file
 * @package Louie
 * @since version 1.0.0
 */
error_reporting(0);
require 'modules/core.php';
$id = $_GET['id'];
$source = $_GET['source'];
$name = $_GET['name'];
if (!empty($id) && !empty($source) && !empty($name)) {
	$path = download($id, $source);
	$file_name = $name.'.mp3';
	header("Content-type: application/octet-stream");
	header('Content-Disposition: attachment; filename='.$file_name); 
	ob_end_clean();
	readfile($path);
} else {
	echo '文件不存在';
}