<?php
function integer($msg="Enter a number : "){
    do{
    $a= readline($msg);
    }while(!is_numeric($a));
    return (int)$a;
}

//nteger("Enter salary");

?>