<?php

$rules = [
    'domain'            => 'required,max:32,unique:websites',
    'title'             => 'required,max:32',
    'description'       => 'required,max:2048',
    'content'           => 'required',
];

?>