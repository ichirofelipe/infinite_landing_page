<?php

$rules = [
    'domain'              => 'domain,required,max:32,unique:websites',
    'name'                => 'required,max:32',
    'title'               => 'required,max:32',
    'description'         => 'required,max:2048',
    'is_default'          => 'toggle',
    'content'             => '',
    'header_info'         => '',
    'footer_info'         => '',
    'border_color'        => 'max:10,color',
    'border_color_hover'  => 'max:10,color',
];

?>