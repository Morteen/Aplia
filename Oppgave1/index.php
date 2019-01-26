<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
 
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css" 
integrity="sha384-PmY9l28YgO4JwMKbTvgaS7XNZJ30MK9FAZjjzXtlqyZCqBY6X6bXIkM++IkyinN+" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js" 
integrity="sha384-vhJnz1OVIdLktyixHY4Uk3OHEwdQqPppqYR8+5mjsauETgLOcEynD9oPHhhz18Nw" crossorigin="anonymous"></script>


    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <title>Aplia test</title>

    <script>
  $( function() {
    $( ".datepicker" ).datepicker({dateFormat: 'yy-mm-dd'});
  } );
  </script>


</head>
<body>
   <header id="main-header">
       <div class="container">
           <h1>Aplia test</h1>
       </div>
</header>
    <nav id="navbar">
        <div class="container">
            <ul>
                <li><a href="#">Hjem</a></li>
                
                <li><a href="#">Søk</a></li>
            </ul>
        </div>
    </nav>
   
    <div class="container">
        <section id="main">
            <h1>Velkommen</h1>

            



            
            

<form name="bookingForm"action='index.php'method="post" >


<table >
    <tr>
        <td><label class="bookingtext">Fornavn</label><br><input type="text"name="FirstName"class="StyleTextfield"/></td>
        <td><label class="bookingtext">Etternavn</label><br><input type="text"name="LastName"class="StyleTextfield"/></td>
        <td><label class="bookingtext">Email</label><br><input type="email"name="Email"class="StyleTextfield"/> </td>
    </tr>
    
    
    <tr>
        <td><label>Antall rom</label><br><input type="number" name="quantity" min="1" max="10"class="StyleTextfield"></td>
        <td><label>Velg hotell</label><br><select name='hotelname' class="StyleTextfield">
<option value="" selected disabled hidden>Velg Hotell her</option>
    <?php  
   include_once 'phpScript.php';
   populateHotelDropDown();

    ?>
</select></td>
<td><label class="bookingtext">Telefon</label><br><input type="text"name="Phone"class="StyleTextfield"/> </td>
    </tr>
    
    <tr>
        <td><label>Ankomst dato</label><br><input type="text" class="datepicker StyleTextfield" name="ArrivalDate"></td>
        <td><label>Avreise dato</label><br><input type="text" class="datepicker StyleTextfield" name="DepartureDate"></td>
        <td></td>
    </tr>
    
    <tr>
        <td></td>
        <td><br><input method="post" type="submit" name="submit" value="Lagre booking" class="btn btn-primary"/></td>
    </tr>
</table>

</form>

<?php
/*his/her phone, email and selecting the hotel
from a drop-down list, the*/
if(isset($_POST['submit'])){

if(empty($_POST['FirstName'])||empty($_POST['LastName'])||empty($_POST['Phone'])||empty($_POST['Email'])||empty($_POST['quantity'])||empty($_POST['ArrivalDate'])||empty($_POST['DepartureDate'])){





echo "Et eller flere felt er ikke fylt ut";



}else{
   
    $FirstName=$_POST['FirstName'];
    $Lastname=$_POST['LastName'];
    $Phone=$_POST['Phone'];
    $email=$_POST['Email'];
    $Quantity=$_POST['quantity'];
    $ArrivalDate=$_POST['ArrivalDate'];
    $DepartureDate=$_POST['DepartureDate'];
    $HotelId=$_POST['hotelname'];
    $CustomerId="";
    
    include_once  'connect.php';
    $con=kobleOpp();
         if(!$con){
             echo"Får ikke koblet opp til server <br>";
         };
    
    
    
  
    
    if (AddCustomer($FirstName,$Lastname,$Phone,$email) === TRUE){
   
    ////////////////////////////
    $CustomerId=getCustomerId();
    
    $checkRoomsSql="SELECT hotel.HotelName,hotel.NumberOfRooms,hotel.RoomPrice,bookings.TotalRooms FROM hotel,bookings WHERE ArrivalDate BETWEEN '$ArrivalDate' And '$DepartureDate' And hotel.HotelId=$HotelId ";
    
    $res=$con->query($checkRoomsSql);
    if(!$res) die($conn->error);
    $rows1=$res->num_rows;
   
    $TakenRooms=0;
    $NumOfRooms=0;
    $RoomPrice=0;
    $HotelName="";
    
    for($i=0;$i<$rows1;$i++){
        $res->data_seek($i);
        $row=$res->fetch_array(MYSQLI_ASSOC);
         
        $HotelName=$row['HotelName'];
        $TakenRooms=$TakenRooms+$row['TotalRooms'];
        $RoomPrice=$row['RoomPrice'];
        $NumOfRooms=$row['NumberOfRooms'];
    
               
    };
    if($NumOfRooms===0){
        $NumOfRooms=getNumRooms($HotelId);
        $RoomPrice=getRoomPrice($HotelId);
        $HotelName=getHotelName($HotelId);
      
    }
    
if($TakenRooms===0){
   if(($Quantity/2)>$NumOfRooms){
    echo "Det er ikke ledig kapasitet på hotellet  for.$Quantity. personer i denne perioden !<br>";
}else{

    $bookingSql="INSERT INTO Bookings(CustomerId,HotelId,ArrivalDate,DepartDate,TotalRooms)VALUES($CustomerId,$HotelId,'$ArrivalDate','$DepartureDate',$Quantity)";
    if($con->query($bookingSql) ==true){
    echo "Bookingen er registrert <br>";
    }else{
    echo "<div class='alert alert-danger' role='alert'>'Error: ' . $bookingSql . $con->error.</div>";
    }

}
   
}
if($TakenRooms+($Quantity/2)>$NumOfRooms){
    echo "Det er ikke ledig kapasitet på hotellet  for.$Quantity. personer i denne perioden !<br>";
}else{


    $bookingSql="INSERT INTO Bookings(CustomerId,HotelId,ArrivalDate,DepartDate,TotalRooms)VALUES($CustomerId,$HotelId,'$ArrivalDate','$DepartureDate',$Quantity)";
    if($con->query($bookingSql) ==true){

    $TotalPrice =$RoomPrice*$Quantity;
    echo "<div class='alert alert-success' role='alert'>$FirstName din booking ved hotell $HotelName <br>fra  $ArrivalDate til $DepartureDate er registert<br> Prisen er $RoomPrice pr person pr natt Totalt: $TotalPrice</div>";
    }else{



    echo "Error: " . $bookingSql . "<br>" . $con->error;
    }
}


  
    } else {
    echo "Error: " . $sql . "<br>" . $con->error;
    }
    
    $con->close();
    
}

 }
?>            
	
   


    

    

            
        </section>
       
    </div> 
    
</body>

</html>