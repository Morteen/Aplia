<?php
if(isset($_POST['HotelId'])){
    include_once  'connect.php';
    $con=kobleOpp();
        
         $Id=$_POST['HotelId'];
        
         $customerId=$_POST['customerId'];
         $ArrivalDate=$_POST['ArrivalDate'];
         $DepartureDate=$_POST['DepartureDate'];
         $Quantity=$_POST['Quantity'];
         
         $bookingSql="INSERT INTO Bookings(CustomerId,HotelId,ArrivalDate,DepartDate,TotalRooms)VALUES($CustomerId,$HotelId,'$ArrivalDate','$DepartureDate',$Quantity)";
         if($con->query($bookingSql)===true){
        echo "Ok";
        }
        }else{
            echo"Hotelid mangler"
        }


?>