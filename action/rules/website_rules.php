<?php

$rules = [
    'domain'            => 'required,max:32,unique:websites',
    'name'              => 'required,max:32',
    'title'             => 'required,max:32',
    'description'       => 'required,max:2048',
    'content'           => '',
    'header_info'       => '',
    'footer_info'       => '',
];

?>