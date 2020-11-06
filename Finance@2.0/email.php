<?php
function email_validator(){
    $count=0;
    do{
        if($count==0){
            $email=readline("Enter email ");
            $count++;
        }else{
              $email=readline("Enter a valid email ");
        }
        
    }while (!filter_var($email, FILTER_VALIDATE_EMAIL));
       
    
        return $email;
    
}

?>