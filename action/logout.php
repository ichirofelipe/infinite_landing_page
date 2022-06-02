<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    echo    "<script>
                alert('Logged out successfully!');
            </script>";
    
    if(isset($_POST['user'])){
        if (isset($_COOKIE['_token'])) {
            unset($_COOKIE['_token']); 
            setcookie('_token', null, -1, '/');
        }
        echo "<script>window.location.href = '/'</script>";
    }
    else{
        if (isset($_COOKIE['_admin'])) {
            unset($_COOKIE['_admin']); 
            setcookie('_admin', null, -1, '/');
        }
        echo "<script>window.location.href = '/admin'</script>";
    }
}

?>