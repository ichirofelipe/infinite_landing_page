<?php

if(isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'])
    $listPage = clean_input($_GET['page']);
else
    $listPage = 1;

header("Access-Control-Allow-Origin: *");

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $limit = $toShow??9;
    $pages = $pageDisplay??5;
    $skip = $limit * ($listPage - 1);
    $websites = selectQuery('websites', $skip, $limit, 'websites_id,websites_domain,websites_title,websites_description,websites_created_at');
    if(isset($_GET['website_id']))
        $websites = findQuery($_GET['website_id'], 'websites');
    $columns = getColumns($websites[0]??$websites);
    $totalWebsites = countQuery('websites');
    $pagination = paginate($totalWebsites['count'], $listPage, $limit, $pages);
}
 
?>