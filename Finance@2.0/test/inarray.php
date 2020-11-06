<?php
$admins=array("ganjichinmaya5@gmail.com"=>array("name"=>"chinmaya","password"=>"1234"));
if(array_key_exists("ganjichinmaya5@gmail.com",$admins)){
    echo "yes";
}else{
    echo "no";
}