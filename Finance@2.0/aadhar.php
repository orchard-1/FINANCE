<?php

    #validate aadhar
    function validate_aadhar(){
        $aadhar=0;
        $count=0;
        do{
            if($count==0){
                $aadhar=readline("\nEnter Aadhar number : ");
                $count++;
            }else{
                $aadhar=readline("\nEnter A valid Aadhar number : ");
            }
        
        }while(!preg_match('/[1-9][0-9]{11}/', $aadhar));
        return $aadhar;
    }
?>