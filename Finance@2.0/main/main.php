<?php
    $start= microtime(true);
    include "BAJAJ_FINANCE.php";
    include "Admin.php";
    include "Customer.php";
    include "name.php";

    # function to display admin menu 
    function admin_menu()
    {
        echo "=============== ADMIN MENU ================\n";
        echo "1.ADD LOAN\n2.ADD CUSTOMER\n3.check loans\n4.get customer details\n";
    }

    #function to display customer menu
    function customer_menu()
    {
        echo "\n================ CUSTOMER MENU ==================\n";
        echo "1.check loans\n2.apply loan\n3.pay loan\n4.get details\n5.EMI calculator\n6.pay installment";
    }

    # function to display main menu
    function main_menu()
    {
        echo "\n========= MAIN MENU ============\n";
        echo "1.root\n2.Admin\n3.customer\n";
    }

    #function to display root menu
    function root_menu()
    {
        echo "\n========= ROOT MENU ============\n";
        echo "1.ADD ADMIN\n2.UPDATE COMPANY ADDRESS\n3.UPADTE ABOUT\n";
    }

    # function for admin operations
    function admin_operations()
    {
        do
        {
            #displaying admin menu
            admin_menu();
            $option = readline("Enter admin option : ");

            # executing operation based on option entered
            switch ($option)
            {
                case "exit":
                    echo "Exited from Admin";
                    break;
                case 1:
                    $GLOBALS['admin_obj']->add_loan();
                    break;
                case 2:
                    $GLOBALS['admin_obj']->add_customer();
                    break;
                case 3:
                    $GLOBALS['admin_obj']->check_loans();
                    break;
                case 4: $GLOBALS['admin_obj']->get_customer_details();
                break;  
                case "exit":
                    echo "you are exited from the Admin Menu";
                    break;
                default:
                    echo "Enter a valid option from admin\n";
                break;

            }
        }
        while ($option != "exit");

    }

    # function to perfrom customer operations
    function customer_operations($obj)
    {
        do
        {
            # displaying customer menu 
            customer_menu();
            $option = readline("\nEnter customer option : ");

            # performing operations based on option entered
            switch ($option)
            {
                # for checking available loans 
                case 1:
                    $obj->check_loans();
                break;

                # for applying loan
                case 2:
                    $obj->apply_loan();
                break;

                # for clearing the loan
                case 3:
                    $obj->pay_loan();
                break;

                # get the details of customer
                case 4:
                    $obj->getDetails();
                break;

                # EMI calculator
                case 5: 
                    $amount = readline("Enter principal amount : ");
                    $intrest = readline("Intrest per annum : ");
                    $months = readline("Number of months : ");
                    echo "The EMI is :" . $obj->emi_calculator($amount, $intrest, $months);
                break;

                # to pay monthly installment
                case 6:$obj->pay_installment();
                break;    
                case "exit":
                    echo "you are exited from Customer";
                break;
            }

        }
        while ($option != "exit");
    }
    
    # function for performing root operations
    function root_operations()
    {
        
        do
        {
            # displaying root menu
            root_menu();
            $choice = readline("\nEnter your root option :");

            # performing operations based on the choice entered
            switch ($choice)
            {
                case 1:
                    # creating a admin 
                    $GLOBALS['obj']->add_admin();
                    break;
                case 2:
                    # updating address of the company
                    $GLOBALS['obj']->update_address();
                    break;
                case 3:
                    # updating about section of the company
                    $GLOBALS['obj']->update_about();
                    break;
                case "exit":
                    echo "Successfully logged out from root";
                    break;
                default:
                    echo "Enter a valid option from ROOT MENU\n";
                    break;

            }
        }while ($choice != "exit");

    }

    # driver block

    #creating object of BAJAJFINANCE
    $obj = BAJAJ_FINANCE::create_object();
    //$option;
    do
    {
        # displaying main menu
        main_menu();
        $option = readline("Enter the option:");

        # performing login based on option entered
        switch ($option)
        {
            # root login
            case 1:
                if ($obj->root_login())
                {
                    root_operations();
                }
            break;

            # admin login
            case 2:
                $admin_obj = new Admin();
                if ($admin_obj->login())
                {
                    admin_operations();

                }

            break;

            # customer login
            case 3: 
                $cust_obj = new Customer();
                $cust_obj = $cust_obj->login();
                if ($cust_obj)
                {
                    echo $cust_obj->getName() . " logegd in";
                    customer_operations($cust_obj);
                }
            break;

            # to exit from the program
            case "exit":
                echo "you are exited from the program\n";
            break;

            default:
                echo "Choose a valid option";
            break;

        }

    }
    while ($option != "exit");
    $end= microtime(true);
    //echo $end-$start;

?>
