<?php

class Customer extends BAJAJ_FINANCE implements login_system{

    private $cust_name;
    private $cust_age;
    private $cust_mobile;
    private $cust_address;
    private $cust_salary;
    private $cust_password;
    public  $cust_loans=array();
   // public static $cust_cards=null;

    public function getName()
    {
        return $this->cust_name;
    }


    public function setName($cust_name)
    {
        $this->cust_name = $cust_name;

        return $this;
    }

 
    public function getAge()
    {
        return $this->cust_age;
    }


    public function setAge($cust_age)
    {
        $this->cust_age = $cust_age;

        return $this;
    }


    public function getMobile()
    {
        return $this->cust_mobile;
    }

 
    public function setMobile($cust_mobile)
    {
        $this->cust_mobile = $cust_mobile;

        return $this;
    }

 
    public function getAddress()
    {
        return $this->cust_address;
    }


    public function setAddress($cust_address)
    {
        $this->cust_address = $cust_address;

        return $this;
    }
 
    public function getPassword()
    {
        return $this->cust_password;
    }

    /**
     * Set the value of cust_password
     *
     * @return  self
     */ 
    public function setPassword($cust_password)
    {
        $this->cust_password = $cust_password;

        return $this;
    }
 

    /**
     * Get the value of cusrt_salary
     */ 
    public function getCust_salary()
    {
        return $this->cust_salary;
    }

    /**
     * Set the value of cusrt_salary
     *
     * @return  self
     */ 
    public function setCust_salary($cust_salary)
    {
        $this->cust_salary = $cust_salary;

        return $this;
    }

    public function check_loans(){
        echo "============ Loans available ==================\n";
        foreach(parent::$loans as $loan_name=>$value){
            echo "Loan name:".$loan_name."\n";
            echo "Loan Amount :".$value["amount"]."\n"; 
            echo "INTREST RATE :".$value["intrest"]."%\n";
            echo "DURATION :".$value["duration"]."months\n";
            echo "MIN_SAL".$value["min_sal"]."\n";
            echo "EMI :".$value["emi"]."\n";
            echo "\n=================================\n";
        }
    }

    public function getDetails(){

        echo "Name : ".$this->getName()."\n";
        echo "Age : ".$this->getAge()."\n";
        echo "Mobile :".$this->getMobile()."\n";
        echo "Address :".$this->getAddress()."\n";
        echo "============ LOANS ==============\n";
        foreach($this->cust_loans as $loan_name=>$value){
            echo "Loan name:".$loan_name."\n";
            echo "Loan Amount :".$value["amount"]."\n"; 
            echo "INTREST RATE :".$value["intrest"]."%\n";
            echo "PENDING INSTALLMENTS :".$value["duration"]."months\n";
            // echo "MIN_SAL".$value["min_sal"]."\n";
            echo "EMI :".$value["emi"]."\n";
            echo "DUE :" .$value["due_amount"]."\n";
            echo "\n=================================\n";
        }

    }
    public function pay_loan(){
           
        echo "============ Loans to Pay ==================\n";
        foreach($this->cust_loans as $key=>$value){
            echo "Loan name:".$key."\n";
            echo "Loan Amount :".$value["amount"]."\n"; 
            echo "INTREST RATE :".$value["intrest"]."%\n";
            echo "DURATION :".$value["duration"]."months\n";
            echo "MIN_SAL".$value["min_sal"];
            echo "EMI :".$value["emi"]."\n";
            echo "DUE :" .$value["due_amount"]."\n";
            echo "\n=================================\n";
        }
        $loan_name=readline("Enter the loan name you want to repay :");
        if(array_key_exists($loan_name,$this->cust_loans)){
            $this->cust_loans[$loan_name]["due_amount"]=0;
            $this->cust_loans[$loan_name]["duration"]=0;
            echo "succesfully cleared the loan :". $loan_name."\n";
               
        }else{
            echo "No loan exists with that name $loan_name\n";
        }
    }


    public function apply_loan(){
        $loan=readline("\nEnter loan name : ");
        $loan_applied=$loan;
        if(array_key_exists($loan,parent::$loans)){
    
            if(parent::$loans[$loan]["min_sal"]<=$this->getCust_salary()){
                
                $this->cust_loans[$loan]["name"]=$loan_applied;
                $this->cust_loans[$loan]["amount"]=parent::$loans[$loan]["amount"];
                $this->cust_loans[$loan]["intrest"]=parent::$loans[$loan]["intrest"];
                $this->cust_loans[$loan]["due_amount"]=parent::$loans[$loan]["amount"];
                $this->cust_loans[$loan]["min_sal"]=parent::$loans[$loan]["min_sal"];
                $this->cust_loans[$loan]["emi"]=parent::$loans[$loan]["emi"];
                $this->cust_loans[$loan]["duration"]=parent::$loans[$loan]["duration"];
                echo "Sucessfully Sanctioned the loan\n";  
            }else{
                echo "\n You are not elgible for this loan.";
            }
        }else{
            echo "loan does not exists";
        }
    }


    public function login(){
        $mobile=readline("Enter mobile number : ");
        //echo $mobile;
        //var_dump(parent::$customers);
        echo $this->getMobile();
        if(array_key_exists($mobile,parent::$customers))
        {
            $password=readline("Enter password : ");
            if(parent::$customers[$mobile]->getPassword()==$password){
                return parent::$customers[$mobile];
            }
            else{
                echo "Incorrect password";
                return false;
            }
        }
        else{
            echo "Customer Doesn't Exists ";
            return false;
        }
    }
    // public function login(){
    //     $mobile=readline("Enter mobile number : ");
            
    //     foreach(parent::$customers as $customer){
    //         if($customer->getMobile()==$mobile){
    //             $password=readline("Enter password :");
    //             if($customer->getPassword()==$password){
    //                 echo "login succesful...,". $customer->getName()."\n";
    //                 return $customer;
                    
    //             }
    //             else{
    //                 echo "Incorrect password";
    //                 return false;
    //             }
    //         }
               
    //     }
    //     echo "Customer doesnot exists\n";
    //     return false;
    // }
    function emi_calculator($amount, $intrest, $months) 
    { 
        $emi; 
        $intrest = $intrest /  (12*100); 
        $emi = ($amount * $intrest * pow(1 + $intrest, $months)) /  
                            (pow(1 + $intrest, $months) - 1); 
            
        return ceil($emi); 
    }
            
            
    function pay_installment(){
        echo "============ Loans to Pay ==================\n";
        foreach($this->cust_loans as $key=>$value){
            echo "Loan name:".$key."\n";
            echo "Loan Amount :".$value["amount"]."\n"; 
            echo "INTREST RATE :".$value["intrest"]."%\n";
            echo "pending Installments :".$value["duration"]."months\n";
            echo "MIN_SAL".$value["min_sal"];
            echo "EMI :".$value["emi"]."\n";
            echo "DUE :" .$value["due_amount"]."\n";
            echo "\n=================================\n";
        }
        $loan_name=readline("Enter the loan name you want to repay :");

        if(array_key_exists($loan_name,$this->cust_loans)){
            $amount_paying=$this->cust_loans[$loan_name]["emi"];
            echo "paying installement amount $amount_paying\n";
            $due=$this->cust_loans[$loan_name]["due_amount"];
            if($due>0){
                if($due>=$amount_paying){
                    
                    $this->cust_loans[$loan_name]["due_amount"]-=$amount_paying;
                    $this->cust_loans[$loan_name]["duration"]-=1;
                    echo "The due is :". $this->cust_loans[$loan_name]["due_amount"];
                }else{
                    echo "you are paying more.. transaction cancelled\n";
                }
                    
            }else{
                echo "There is no due for the loan $loan_name\n";
            }
                
        }else{
            echo "No loan exists with that name $loan_name\n";
        }



    }

     
}





?>