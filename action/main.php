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
    $protocol = getProtocol();

    $domain = $_SERVER['HTTP_HOST'];
    $domArray = explode('.', $domain);
    if(count($domArray) < 3 && $domArray[0] != 'www'){
        $domain = "www.".$domain;
        header('Location: '.$protocol.$domain.$_SERVER['REQUEST_URI']);
    }
    // dd($domain);
    $site_details = findQuery($domain, 'websites', 'domain');

    if(isset($params['admin_code'])){
        $notfound_flag = false;
        if(!$site_details || (isset($site_details) && $site_details['websites_is_default'] == 'n'))
            $notfound_flag = true;

        if($notfound_flag){
            $params['admin_code'] = 404;
            $params['page_title'] = '404 Not Found!';
        }
    }

    if($site_details){
        //BANNER PAGINATION DETAILS
        if(isset($params['page']) && is_numeric($params['page']) && $params['page'])
            $listPage = $params['page'];
        else
            $listPage = 1;

        $limit = $toShow??9;
        $pages = $pageDisplay??5;
        $skip = $limit * ($listPage - 1);

        $condition['banners_website_id'] = "='".$site_details['websites_id']."'";
        $site_banners = selectQuery('banners', 'banners_title,banners_description_1,banners_description_2,banners_image,banners_url', $condition, $skip, $limit);
        $totalSiteBanners = countQuery('banners', $condition);
        
        $pagination = paginate($totalSiteBanners['count'], $listPage, $limit, $pages);
    }
}

?>