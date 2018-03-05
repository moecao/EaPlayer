<?php
/**
 * player core function file
 * @package Louie
 * @since version 1.0.0
 */
require 'Meting.php';
use Metowolf\Meting;

# jsonFormat
function jsonFormat( $data, $indent = null ) {
    array_walk_recursive($data, 'jsonFormatProtect');
    $data = json_encode($data);
    $data = urldecode($data);
    $ret = '';
    $pos = 0;
    $length = strlen($data);
    $indent = isset($indent)? $indent : '    ';
    $newline = "\n";
    $prevchar = '';
    $outofquotes = true;
    for($i=0; $i<=$length; $i++){
        $char = substr($data, $i, 1);
        if($char=='"' && $prevchar!='\\'){
            $outofquotes = !$outofquotes;
        }elseif(($char=='}' || $char==']') && $outofquotes){
            $ret .= $newline;
            $pos --;
            for($j=0; $j<$pos; $j++){
                $ret .= $indent;
            }
        }
        $ret .= $char;
        if(($char==',' || $char=='{' || $char=='[') && $outofquotes){
            $ret .= $newline;
            if($char=='{' || $char=='['){
                $pos ++;
            }
            for($j=0; $j<$pos; $j++){
                $ret .= $indent;
            }
        }
        $prevchar = $char;
    }
    return $ret;
}  
  
# 数组urlencode
function jsonFormatProtect( $val ) {
    if($val!==true && $val!==false && $val!==null) {
        $val = urlencode($val);
    }
}

# 专辑图
function cover( $id, $source ) {
    $API = new Meting($source);
    $result = $API->format(true)->pic($id);
    return $result;
}

# 单曲链接
function song( $id, $source ) {
    $API = new Meting($source);
    $result = json_decode( $API->format(true)->url($id) );
    $url = str_replace('http://', 'https://', $result->url);
    if ($source == 'netease') {
        if (strstr($url, 'm7c')) {
            $url = str_replace('https://m7c', 'https://m8', $url);
        }
        elseif(strstr($url, 'm8c')) {
            $url = str_replace('https://m8c', 'https://m8', $url);
        }
    }
    $arr = ["url"=>$url, "size"=>$result->size, "br"=>$result->br];
    return json_encode($arr);
}

# 下载链接
function download( $id, $source ) {
    $API = new Meting($source);
    $result = json_decode( $API->format(true)->url($id) );
    return str_replace('http://', 'https://', $result->url);
}

# 歌单列表
function playList( $id, $source ) {
    $API = new Meting($source);
    $result = json_decode( $API->format(true)->playlist($id) );
    return $result;
}

# 专辑列表
function album( $id, $source ) {
    $API = new Meting($source);
    $result = json_decode( $API->format(true)->album($id) );
    return $result;
}

# 搜索
function search( $msg, $source ) {
    $API = new Meting($source);
    $result = json_decode( $API->format(true)->search($msg) ); // page = 1, limit = 30
    return $result;
}

# 歌词
function lyric( $id, $source ) {
    $API = new Meting($source);
    $result = $API->format(true)->lyric($id);
    return $result;
}

# 处理数据
function eaResult($id = false, $source = 'tencent', $type = 0, $msg = '') {
    $json = ''; $data = [];
    if ($id) {
        switch ($type) {
            case 0: $data = playList($id, $source); break;
            case 1: $data = album($id, $source); break;
        }
    }
    else $data = search($msg, $source);
    if ( !empty($data) ) {
        foreach ($data as $key => $song) {
            $json .= jsonFormat(array(
                'title' =>$song->name,
                'artist' => array(
                    'name_1' => $song->artist[0],
                    'name_2' => $song->artist[1]
                ),
                'mid' => $song->id,
                'pid' => $song->pic_id,
                'tid' => $song->lyric_id,
                'album' =>$song->album,
                'source' => $song->source
            ));
            $json .= ',';
        }

        return $json;
    }

    return false;
}