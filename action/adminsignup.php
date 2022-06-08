<?php

require_once('../include/dbconfig.php');
require_once('rules/admin_signup_rules.php');
require_once('clean_requests.php');

$redirect = '/admin';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //VALIDATE REQUESTS
    $data = validateRequests($requests, $rules, true);
    if(count($data['errors'])){
        closeConn();

        echo    "<script>
                    alert('". ($data['errors'][0]??'Registration Failed!') ."');
                    window.location.href = '". $redirect ."'
                </script>";
        exit;
    }
    unset($data['errors']);

    try{
        if($query = insertQuery($data, 'admin', true)){
            closeConn();
            
            generateToken($query, '_admin');

            echo    "<script>
                        alert('Registered Successfully!');
                        window.location.href = '". $redirect ."'
                    </script>";
            
            exit;
        }
    
        closeConn();

        echo    "<script>
                    alert('Error Submitting Request!');
                    window.location.href = '". $redirect ."'
                </script>";
    }
    catch(Exception $e){
        logInfo($e);
        closeConn();
        
        echo    "<script>
                    alert('Error Submitting Request!');
                    window.location.href = '". $redirect ."'
                </script>";
    }
}

closeConn();

header('Location: '.$redirect);
 
?>