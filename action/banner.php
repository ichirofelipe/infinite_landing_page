<?php

require_once('../include/dbconfig.php');
require_once('rules/banner_rules.php');
require_once('auth.php');
require_once('clean_requests.php');

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if(!$admin){
        closeConn();
        echo    "<script>
                    alert('Unauthorized Request!');
                    window.location.href = '/admin/login';
                </script>";
        exit;
    }



    if(isset($requests['delete']) && $requests['delete']){
        $id = $requests['delete'];
        $column = findQuery($id, 'banners');
        $dir = dirname(__DIR__)."/upload/images/";
        $file = $dir.$column['banners_image'];
        removeImage($file);

        if(deleteQuery($id, 'banners')){
            closeConn();

            echo    "<script>
                        alert('Deleted Successfully!');
                        window.location.href = '". ($requests['redirect']??'/') ."'
                    </script>";
            exit;
        }

        closeConn();

        echo    "<script>
                    alert('Something went wrong!');
                    window.location.href = '". ($requests['redirect']??'/') ."'
                </script>";
        exit;
    }







    if(isset($requests['update'])){
        unset($rules['domain']);
    }
    //VALIDATE REQUESTS
    $data = validateRequests($requests, $rules);

    if(count($data['errors'])){
        closeConn();
        
        echo    "<script>
                    alert('". ($data['errors'][0]??'Submission Failed!') ."');
                    window.location.href = '/admin/banners'
                </script>";
        exit;
    }
    unset($data['errors']);
    
    try{
        if($files){
            //FILE UPLOAD TO FOLDER
            $id = $requests['update']??null;
            $micro = floor(microtime(true) * 1000);
            $ext = pathinfo($requests['image']["name"], PATHINFO_EXTENSION);
            $name = $micro.'.'.$ext;
            if($result = uploadImage($requests['image'], $name, $id)){
                closeConn();
            
                echo    "<script>
                            alert('". ($result??'Submission Failed!') ."');
                            window.location.href = '/admin/banners'
                        </script>";
                exit;
            }
            $data['image'] = $name;
        }

        $query = false;
        if(isset($requests['update'])){
            $query = updateQuery($data, 'banners', $requests['update']);
        }
        else{
            $query = insertQuery($data, 'banners');
        }

        if($query){

            closeConn();
            
            echo    "<script>
                        alert('Submitted Successfully!');
                        window.location.href = '/admin/banners'
                    </script>";
            exit;
        }
    
        closeConn();

        echo    "<script>
                    alert('Error Submitting Request!');
                    window.location.href = '/admin/banners'
                </script>";
        exit;
    }
    catch(Exception $e){
        logInfo($e);
        closeConn();
        
        echo    "<script>
                    alert('Error Submitting Request!');
                    window.location.href = '/admin/banners'
                </script>";
        exit;
    }
}

closeConn();
header('Location: /admin/banners');

?>