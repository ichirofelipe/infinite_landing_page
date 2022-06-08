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

    $files = [];
    foreach($_FILES as $key => $value){
        if(! file_exists($_FILES[$key]["tmp_name"]))
            continue;
        $requests[$key] = $value;
        $files[$key] = $value;
    }
}

?>