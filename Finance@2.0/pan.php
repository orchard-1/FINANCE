  <?php
    #validate pan
    function validate_pan(){
        $count=0;
        $pan=0;
        do{
            if($count==0){
                $pan=readline("\nEnter PAN number : ");
                $count++;
            }else{
                $pan=readline("\nEnter A valid PAN number : ");
            }
        }while(!preg_match('/[A-Z]{5}[0-9]{4}[A-Z]$/', $pan));
        return $pan;
    }
?>