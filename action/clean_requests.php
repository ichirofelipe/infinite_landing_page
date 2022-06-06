<?php

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $params = $_GET;

    if($params){
        foreach($params as $key => $value){
            $params[$key] = clean_input($value);
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $requests = $_POST;

    if($requests){
        foreach($requests as $key => $value){
            $requests[$key] = clean_input($value);
        }
    }
}

?>