<?php
require_once('include/dbconfig.php');
require_once('clean_requests.php');

header("Access-Control-Allow-Origin: *");

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    require_once('auth.php');


    /*=====================*\
        GET DOMAIN DETAILS
    \*=====================*/
    //GET HTTPS or HTTP
    $protocol = 'http://';
    if (isset($_SERVER['HTTPS']) &&
        ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||
        isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
        $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {

        $protocol = 'https://';
    }

    $domain = $_SERVER['HTTP_HOST'];
    $domArray = explode('.', $domain);
    if(count($domArray) < 3 && $domArray[0] != 'www'){
        $domain = "www.".$domain;
        header('Location: '.$protocol.$domain.$_SERVER['REQUEST_URI']);
    }
    
    $site_details = findQuery($domain, 'websites', 'domain');
    if((!$site_details || isset($params['admin_code'])) && $site_details['websites_is_default'] == 'n'){
        $params['admin_code'] = 404;
        $params['page_title'] = '404 Not Found!';
    }
}

?>