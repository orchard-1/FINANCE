<?php

    include "login_system.php";
    include "email.php";
    include "mobile.php";
    
    
    # class for Admin
    class Admin extends BAJAJ_FINANCE implements login_system
    {
        # function for Admin login
        public function login()
        {
            $mail = email_validator();
            if(array_key_exists($mail,parent::$admins)){
                $pass = readline("Enter admin password :");
                if(parent::$admins[$mail]["password"]==$pass)
                {
                    echo "login successful,".parent::$admins[$mail]["name"]."\n";
                    return true;
                }
                else
                {
                    echo "Incorrect Password";
                }

            }else
            {
                echo "Admin does not exists";
            }
            return false;
        }
        // # function for Admin login
        // public function login()
        // {
        //     # function to read & validate email address
        //     $mail = email_validator();
        //     $pass = readline("Enter admin password :");

        //     # variable to check for existence of Admin
        //     $admin_found = 0;
        //     foreach (parent::$admins as $email => $value)
        //     {
        //         # comparing mail entered with mails present in admins array
        //         if ($email == $mail)
        //         {
        //             $admin_found = 1;

        //             # comparing password
        //             if ($value["password"] == $pass)
        //             {
        //                 echo "login successful, " . $value["name"] . "..\n";
        //                 return true;
        //             }
        //             else
        //             {
        //                 echo "Incorrect password\n";
        //                 return false;
        //             }
        //         }
        //     }
        //     # if Admin exists in the admins array
        //     if ($admin_found == 0)
        //     {
        //         echo "Admin doesnot exists";
        //     }

        // }

        # function to add a new loan 
        public function add_loan()
        {
            $loan_name = readline("Enter loan name :");
            $amount = (int)readline("Enter amount :");
            $duration = (int)readline("Enter duration of the loan in months : ");
            $intrest = (float)readline("Enter Intrest : ");
            $min_sal = (int)readline("Monthly income to eligible for loan : ");
            parent::$loans[$loan_name]["amount"] = $amount;
            parent::$loans[$loan_name]["duration"] = $duration;
            parent::$loans[$loan_name]["intrest"] = $intrest;
            parent::$loans[$loan_name]["min_sal"] = $min_sal;
            $emi = $this->emi_calculator($amount, $intrest, $duration);
            parent::$loans[$loan_name]["emi"] = $emi;

        }

        # function to display details of the customer
        public function get_customer_details()
        {
            # reading mobile number from console and validating
            $customer_mobile=validate_mobile();

            if(array_key_exists($customer_mobile,parent::$customers))
            {
               // foreach(parent::$customers as $mobile => $customer){
                    # printing customer personal details
                   $customer=parent::$customers[$customer_mobile];
                    echo "============ CUSTOMER DETAILS ============\n";
                    echo "Name : ".$customer->getName()."\n";
                    echo "Age : ".$customer->getAge()."\n";
                    echo "Mobile :".$customer->getMobile()."\n";
                    echo "Address :".$customer->getAddress()."\n"; 
                    //var_dump($customer->cust_loans);
                    # printing loans of customer
                    echo "=========== LOANS ================\n";
                    foreach($customer->cust_loans as $key=>$value){
                        foreach($value as $subkey=>$subvalue){
                            echo $subkey." : ".$subvalue."\n";
                        }
                        echo "\n=================================\n";
                    }
               // }

              
            }else{
                echo "customer does not exists\n";
            }

        }

        // # function to display details of the customer
        // public function get_customer_details()
        // {

        //     # reading mobile number from console and validating
        //     $customer_mobile=validate_mobile();

        //     # finding customer based on the mobile number
        //     foreach (parent::$customers as $customer) 
        //     {
            
        //         if($customer_mobile==$customer->getMobile())
        //         {

        //             # printing customer personal details
        //             echo "Name : ".$customer->getName()."\n";
        //             echo "Age : ".$customer->getAge()."\n";
        //             echo "Mobile :".$customer->getMobile()."\n";
        //             echo "Address :".$customer->getAddress()."\n";
                    

        //             # printing loans of customer
        //             echo "=========== LOANS ================\n";
        //             foreach($customer::$cust_loans as $key=>$value){
        //                 foreach($value as $subkey=>$subvalue){
        //                     echo $subkey." : ".$subvalue."\n";
        //                 }
        //                 echo "\n=================================\n";
        //             }
        //         }

        
        //     }

            
        // }

        # function to dispaly all the available loans
        public function check_loans()
        {
            echo "============ Loans available ==================\n";
            foreach (parent::$loans as $loan_name => $value)
            {
                echo "Loan name:" . $loan_name . "\n";
                echo "Loan Amount :" . $value["amount"] . "\n";
                echo "INTREST RATE :" . $value["intrest"] . "%\n";
                echo "DURATION :" . $value["duration"] . "months\n";
                echo "MIN_SAL" . $value["min_sal"] . "\n";
                echo "EMI :" . $value["emi"] . "\n";
                echo "\n=================================\n";
            }
        }

        # function to add customer to customer array
        public function add_customer()
        {
            $mobile = validate_mobile();
            $name = readline("Enter customer name : ");
            //$age = (int)readline("Enter Age : ");
            $age=
            $password = readline("password : ");
            $address = readline("Address : ");
            $salary = (int)readline("salary : ");
            $customer_obj = new Customer();
            $customer_obj->setCust_salary($salary);
            $customer_obj->setAddress($address);
            $customer_obj->setAge($age);
            $customer_obj->setMobile($mobile);
            $customer_obj->setName($name);
            $customer_obj->setPassword($password);
            parent::$customers[$mobile] = $customer_obj;
        }

        function emi_calculator($amount, $intrest, $months)
        {
            # intrest per month
            $intrest = $intrest / (12 * 100);
 
            /* Mathematical formula to calculate EMI
            EMI = [P x R x (1+R)^N]/[(1+R)^ (N-1)],
            
            In this formula the variables stand for:

            EMI – the equated monthly installment
            P – the principal or the amount that is borrowed as a loan
            R – the rate of interest that is levied on the loan amount (the interest rate should be a monthly rate)
            N – the tenure of repayment of the loan or the number of monthly installments that you will pay (tenure should be in months)
            */

            # logic for calculating emi
            $emi = ($amount * $intrest * pow(1 + $intrest, $months)) / (pow(1 + $intrest, $months) - 1);
            
            # rounding the EMI value
            return ceil($emi);
        }

    }

?>
