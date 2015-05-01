<?php

namespace Kamran\CoreBundle\Commons;



class UrlParser
{

    protected $url = '';

    public function __construct($url){
        $this->url = $url;
    }


/*    public function urlParams( $urlString = '' ){
        if(!empty($urlString)){
            $currentUrl = parse_url($urlString);
        }else{
            $currentUrl = parse_url($_SERVER['REQUEST_URI']);
        }
        if(array_key_exists('query',$currentUrl)){
            return $currentUrl['query'];
        }
        return '';
    }*/

    public function get(){
       // echo $this->url;
        echo __CLASS__." called";
    }
}