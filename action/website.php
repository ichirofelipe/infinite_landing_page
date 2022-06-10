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

        //CHECK IF MAIN DOMAIN THEN DO NOT DELETE
        $website = findQuery($id, 'websites');
        if($website['websites_is_default'] == 'y'){
            closeConn();
            echo "<script>
                    alert('Atleast 1 domain should be default! cannot delete default website.');
                    window.location.href = '". ($requests['redirect']??'/') ."'
                </script>";
            exit;
        }
        
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






    //CHECK IF POST IS UPDATE
    if(isset($requests['update'])){
        unset($rules['domain']);
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

        //INIT VARIABLES
        $query = false;
        $redirect_domain = '/admin/websites';
        
        //VALIDATION FOR REDIRECTING ADMIN TO THE NEWLY CREATED DOMAIN OR NEW DOMAIN
        if(isset($data['is_default'])){
            
            //CHECK IF IS DEFAULT VALUE IS ON/OFF
            switch($data['is_default']){
                case 'y':
                    $website = null;
                    if(!isset($data['domain']))
                        $website = findQuery($requests['update'], 'websites');
                        
                    $redirect_domain = $data['domain']??$website['websites_domain']??'/admin/websites';

                    if($redirect_domain != '/admin/websites')
                        $redirect_domain = getProtocol().$redirect_domain.'/admin/websites';
                        
                    $remove_default['is_default'] = 'n';
                    $query = updateExceptQuery($remove_default, 'websites', $requests['update']??null);
                    break;
                case 'n':
                    if(isset($requests['update'])){
                        $website = findQuery($requests['update'], 'websites');
                        if($website['websites_is_default'] == 'y'){
                            closeConn();
                            echo "<script>
                                    alert('Atleast 1 domain should be default! toggle on a different domain instead.');
                                    window.location.href = '/admin/websites'
                                </script>";
                            exit;
                        }
                    }
                    break;
            }
        }

        //UPDATE OR CREATE QUERY
        if(isset($requests['update'])){
            $query = updateQuery($data, 'websites', $requests['update']);
        }
        else{
            $query = insertQuery($data, 'websites');
        }

        if($query){

            //MESSAGE CHANGED IF REDIRECTED TO NEWLY CREATED DOMAIN
            $message = null;
            if(isset($data['domain']) && $data['is_default'] == 'y'){
                $message = 'Submitted Successfully! Please refresh after a couple of seconds to visit the new main domain.';
            }

            echo    "<script>
                        alert('".($message??'Submitted Successfully!')."');
                        window.location.href = '". $redirect_domain ."'
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