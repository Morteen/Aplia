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
    <section id="showcase">
        <div class="container">
            <h2>Mortens booking side</h2>
        </div>
    </section>
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
         if($con){
             echo"Success <br>";
         };


    /*$sqlCustomer = "INSERT INTO customer(FirstName,LastName,Phone,Email)VALUES(?,?,?,?)";
    $stmt=$con->prepare( $sqlCustomer);
    $stmt->bind_param("ssss",$FirstName,$Lastname,$Phone,$email);*/
    $sql = "INSERT INTO customer(FirstName,LastName,Phone,Email)VALUES('$FirstName', '$Lastname','$Phone','$email')";

if ($con->query($sql) === TRUE) {
    echo "New record created successfully<br>";
////////////////////////////
$sqlReturnId="SELECT CustomerId FROM customer ORDER BY CustomerId DESC LIMIT 1";
    $result=$con->query($sqlReturnId);
    if(!$result) die($conn->error);
    $rows=$result->num_rows;
    for($j=0;$j<$rows;$j++){
        $result->data_seek($j);
        $row=$result->fetch_array(MYSQLI_ASSOC);
         
        $CustomerId=$row['CustomerId'];
    
    
               
  };
  $TestInn= new DateTime($ArrivalDate);
  echo $ArrivalDate."<br>".$DepartureDate."<br>";
  $bookingSql="INSERT INTO Bookings(CustomerId,HotelId,ArrivalDate,DepartDate,TotalRooms)VALUES($CustomerId,$HotelId,$ArrivalDate,$TestInn,$Quantity)";
  if($con->query($bookingSql) ==true){
    echo "New record created successfully<br>";
  }else{
    echo "Error: " . $bookingSql . "<br>" . $con->error;
  }
  //////////////	
 
    

    /////////////////
} else {
    echo "Error: " . $sql . "<br>" . $con->error;
}
    
    
$con->close();



 }
?>

                    
	
   


    

    

            
        </section>
       
    </div> 
    <footer id="main-footer">
        <p>Copyright &copy 2017 Aplia Test</p>
    </footer>
</body>

</html>