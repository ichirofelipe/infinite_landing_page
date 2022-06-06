<?php
require_once('include/dbconfig.php');
require_once('clean_requests.php');

header("Access-Control-Allow-Origin: *");

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    require_once('auth.php');


    /*=====================*\
        GET SUB DOMAIN
    \*=====================*/
    if(count(explode('.', $_SERVER['HTTP_HOST'])) > 2){
        $subdomain = explode('.', $_SERVER['HTTP_HOST'])[0];
        if($subdomain == 'www'){
            $subdomain = explode('.', $_SERVER['HTTP_HOST'])[1];
        }
        
        $site_details = findQuery($subdomain, 'websites', 'domain');
        if(!$site_details || isset($params['admin_code'])){
            $params['admin_code'] = 404;
            $params['page_title'] = '404 Not Found!';
        }
    }
    else{
        $site_details = findQuery('default', 'websites', 'domain');
    }
}

?>