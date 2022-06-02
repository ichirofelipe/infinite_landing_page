<?php

$rules = [
    'username'      => 'required,max:32,unique:admin',
    'password'      => 'required,max:64,min:5',
];

?>