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
    $websites = selectQuery('websites', 'websites_id,websites_domain,websites_name,websites_title,websites_description,websites_is_default,websites_created_at,websites_updated_at', null, $skip, $limit);
    $columns = getColumns($websites[0]??$websites);
    $totalWebsites = countQuery('websites');
    $pagination = paginate($totalWebsites['count'], $listPage, $limit, $pages);
}
 
?>