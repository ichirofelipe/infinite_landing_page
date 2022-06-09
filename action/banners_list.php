<?php

// $listPage = is_numeric($params['page'])?$params['page']??1:1;

if(isset($params['page']) && is_numeric($params['page']) && $params['page'])
    $listPage = $params['page'];
else
    $listPage = 1;

header("Access-Control-Allow-Origin: *");

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $limit = $toShow??9;
    $pages = $pageDisplay??5;
    $skip = $limit * ($listPage - 1);
    $banners = selectQuery('banners', 'banners_id,banners_image,banners_title,banners_url,banners_created_at,banners_updated_at', null, $skip, $limit);
    $columns = getColumns($banners[0]??$banners);
    $totalBanners = countQuery('banners');
    $pagination = paginate($totalBanners['count'], $listPage, $limit, $pages);
}
 
?>