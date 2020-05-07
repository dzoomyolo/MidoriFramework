<?php

namespace lib\classes;
/** 
 *  @Class Used to process page links 
 */
class URLClass{
    /**
     *  return parsed link
     */
    public function getUrl(){
        $s_request_uri = $_SERVER['REQUEST_URI'];
        $s_host = $_SERVER['HTTP_HOST'];
        $s_protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === 0 ? 'https://' : 'http://';
        $s_request_uri_arr = explode("/",parse_url($_SERVER['REQUEST_URI'])['path']);
        $mapped = array_filter($s_request_uri_arr, function($value) { return $value !== ''; });
        $url_arr = array(
            "protocol"=>$s_protocol,
            "host"=>$s_host,
            "path"=>$s_request_uri,
            "path_arr"=>$mapped
        );

        /**
         * @return array processed link
         */

        return $url_arr;
    }
    /**
     * get post fields
     */
    public function postFields(){

        $p_arr = array();

        foreach($_POST as $i=>$p){
            array_push($p_arr,array($i=>$p));
        }
        /**
         * @return array post fields
         */
        return $p_arr;
    }
    /**
     * get 'get' fields
     */
    public function getFields(){

        $g_arr = array();

        foreach($_GET as $i=>$p){
            array_push($g_arr,array($i=>$p));
        }
        /**
         * @return array get fields
         */
        return $g_arr;
    }
}

?>