    <?php
        #validating Customer name
        function validate_name(){
        $name=0;
        $count=0;
            do{
                if($count==0){
                    $name=readline("Enter Customer name :");
                    $count++;
                }else{
                    $name=readline("Enter A Valid Customer name :"); 
                }
            }while(!preg_match('/^[a-zA-Z]+\s[a-zA-z]*/i', $name));
         
    }
?>
