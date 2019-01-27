<?php
if(isset($_POST['FirstName'])){
    include_once  'connect.php';
    $con=kobleOpp();
        
            
        
                $FirstName=$_POST['FirstName'];
                $Lastname=$_POST['LastName'];
                $Phone=$_POST['Phone'];
                $email=$_POST['Email'];
                if (AddCustomer($FirstName,$Lastname,$Phone,$email) === TRUE){
            
            $Id= getCustomerId();
            echo Id;
                }
                   


?>