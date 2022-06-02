<?php
require_once('include/dbconfig.php');

header("Access-Control-Allow-Origin: *");

$admin = false;
if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    /*=====================*\
            ADMIN AUTH
    \*=====================*/
    if(isset($_COOKIE['_admin']) && is_jwt_valid($_COOKIE['_admin'])){
        $payload = base64_decode(explode('.', $_COOKIE['_admin'])[1]);
        if($id = json_decode($payload)->id){
            $admin = findQuery($id, 'admin');
        }
    }
    else if(isset($_COOKIE['_admin'])){
        unset($_COOKIE['_admin']);
        setcookie('_admin', null, -1, '/');

        echo    "<script>
                    alert('Login expired! Please login again.');
                </script>";
    }

}

?>