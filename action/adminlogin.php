<?php

require_once('../include/dbconfig.php');
require_once('rules/admin_login_rules.php');

$requests = $_POST;
$redirect = '/admin/websites';
    
    
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //VALIDATE REQUESTS
    $data = validateRequests($requests, $rules);

    if(count($data['errors'])){
        closeConn();

        echo    "<script>
                    alert('".($data['errors'][0]??'Login Failed!')."');
                    window.location.href = '".$redirect."'
                </script>";
        exit;
    }
    unset($data['errors']);
    
    try{
        if($query = userVerificationQuery($data, true, 'admin')){
            closeConn();

            generateToken($query, '_admin');

            echo    "<script>
                        alert('Logged in Successfully!');
                        window.location.href = '".$redirect."'
                    </script>";
            exit;
        }

        closeConn();

        echo    "<script>
                    alert('User and Password does not exist!');
                    window.location.href = '".$redirect."'
                </script>";
        exit;
    }
    catch(Exception $e){
        logInfo($e);
        closeConn();

        echo    "<script>
                    alert('Error Submitting Request!');
                    window.location.href = '".$redirect."'
                </script>";
    }
}

closeConn();

header('Location: '.$redirect);
 
?>