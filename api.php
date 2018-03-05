<?php
/**
 * player api function file
 * @package Louie
 * @since version 1.0.0
 */
header("Content-Type: application/json;charset=UTF-8");
error_reporting(0);
require 'modules/core.php';

$action = $_GET['action'];
$id = $_GET['id'];
$source = $_GET['source'];
$type = $_GET['type'];
$name = $_GET['name'];

if ( $action == 'song' && !empty($id) ) {
    echo song($id, $source);
}
elseif ( $action == 'cover' && !empty($id) ) {
	echo cover($id, $source);
}
elseif ( $action == 'lyric' && !empty($id) ) {
	header("Content-Type: text/html;charset=UTF-8");
	// json_encode($data, JSON_UNESCAPED_UNICODE);
	//$lrc = preg_replace("#\\\u([0-9a-f]{4})#ie", "iconv('UCS-2BE', 'UTF-8', pack('H4', '\\1'))", lyric($id, $source));
	preg_match('|"lyric":"(.+)"|U', lyric($id, $source), $matches);
	$lrc = $matches[1];
	$lrc = str_replace('\n', "\n", $lrc);
	$lrc = str_replace('\r', "\r", $lrc);
	$lrc = stripslashes($lrc);
	if (strpos($lrc,']') === false) {
		echo '[ti:暂无歌词]';
	} else {
		echo $lrc;
	}
}
elseif ( $action == 'list' && !empty($id) ) {
	header("Content-Type: text/html;charset=UTF-8");
	echo 'var playlist = ['.eaResult($id, $source, $type).'];';
	die();
}
elseif ( $action == 'search' && !empty($name) ) {
	header("Content-Type: text/html;charset=UTF-8");
	echo 'var playlist = ['.eaResult(false, $source, 0, $name).'];';
	die();
}
else {
	echo '404';
}