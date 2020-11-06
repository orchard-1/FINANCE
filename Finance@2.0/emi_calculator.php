
<?php 
 // EMI Calculator program in PHP 
  
 // Function to calculate EMI 
  function emi_calculator($amount, $intrest, $months) { 
    $emi; 
    $intrest = $intrest /  (12*100); 
    $emi = ($amount * $intrest * pow(1 + $intrest, $months)) /  (pow(1 + $intrest, $months) - 1); 
    return ceil($emi); 
  } 
  
?>