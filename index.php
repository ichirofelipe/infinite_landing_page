<?php
    require_once('action/main.php');
    
    if(isset($params['admin_code']) && $params['admin_code']){
        $page = $params['admin_code'];

        $dir = "include/pages/admin/";

        include_once($dir."layout/header.php");

        if(!$admin){
            switch($page){
                case "404":
                    require_once($dir."404.php");
                    break;
                case "signup":
                    require_once($dir."signup.php");
                    break;
                default:
                    require_once($dir."login.php");
                    break;
            }
        }
        else{
            switch($page){
                case "websites":
                    //ACTION LINK
                    if(isset($params['action']) && $params['action']){
                        $action = $params['action'];
                        require_once($dir."/action/".$page."/".$action.".php");
                        closeConn();
                        exit;
                        break;
                    }
                    require_once("action/websites_list.php");
                    require_once($dir."websites.php");
                    break;
                default:
                    require_once($dir."404.php");
                    break;
            }
        }
        closeConn();
        
        include $dir.'layout/footer.php';

        exit;
    }

    if(isset($site_details) && $site_details){
        $dir = "include/pages/user/";
        require_once($dir."home.php");
        closeConn();
        exit;
    }
?>