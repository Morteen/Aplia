<?php
 include_once 'phpScript.php';
if(isset($_POST['FirstName'])){
    include_once  'connect.php';
    $con=kobleOpp();
        
            
        
                $FirstName=$_POST['FirstName'];
                $LastName=$_POST['LastName'];
                $Phone=$_POST['Phone'];
                $email=$_POST['Email'];
                if (AddCustomer($FirstName,$LastName,$Phone,$email) === TRUE){
            
            $Id= getCustomerId();
            echo $Id;
                }
            }
                   


?>