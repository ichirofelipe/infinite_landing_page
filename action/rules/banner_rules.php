<?php

$rules = [
    'title'               => 'required,max:32',
    'website_id'          => 'required',
    'description_1'       => 'required,max:2048',
    'description_2'       => 'required,max:2048',
    'url'                 => 'required,max:256',
    'image'               => 'required,image',
    'border_color'        => 'max:10,color',
    'border_color_hover'  => 'max:10,color',
];

?>