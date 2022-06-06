<?php

require_once('../include/dbconfig.php');
require_once('rules/website_rules.php');
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
        
        if(deleteQuery($id, 'websites')){
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
        $rules['domain'] = 'required,max:32';
    }
    //VALIDATE REQUESTS
    $data = validateRequests($requests, $rules);
    if(count($data['errors'])){
        closeConn();
        
        echo    "<script>
                    alert('". ($data['errors'][0]??'Submission Failed!') ."');
                    window.location.href = '/admin/websites'
                </script>";
        exit;
    }
    unset($data['errors']);
    
    try{

        $query = false;
        if(isset($requests['update'])){
            $query = updateQuery($data, 'websites', $requests['update']);
        }
        else{
            $query = insertQuery($data, 'websites');
        }

        if($query){
            closeConn();
            
            echo    "<script>
                        alert('Submitted Successfully!');
                        window.location.href = '/admin/websites'
                    </script>";
            exit;
        }
    
        closeConn();

        echo    "<script>
                    alert('Error Submitting Request!');
                    window.location.href = '/admin/websites'
                </script>";
        exit;
    }
    catch(Exception $e){
        logInfo($e);
        closeConn();
        
        echo    "<script>
                    alert('Error Submitting Request!');
                    window.location.href = '/admin/websites'
                </script>";
        exit;
    }
}

closeConn();
header('Location: /admin/websites');

?>