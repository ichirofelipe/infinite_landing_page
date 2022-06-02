<?php
    require_once('action/authentication.php');
    
    if(isset($_GET['admin_code']) && $_GET['admin_code']){
        $page = clean_input($_GET['admin_code']);

        $dir = "include/pages/admin/";

        include_once($dir."layout/header.php");

        if(!$admin){
            switch($page){
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
                    if(isset($_GET['action']) && $_GET['action']){
                        $action = clean_input($_GET['action']);
                        require_once($dir."/action/".$page."/".$action.".php");
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
?>