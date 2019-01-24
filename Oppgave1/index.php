<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <title>Min web-side</title>
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
            

<form name="bookingForm"action='index.php'method="get" >
<label class="bookingtext">Fornavn</label>    
<input type="text"name="FirstName"/>
<label class="bookingtext">Etternavn</label>    
<input type="text"name="LastName"/>
<label class="bookingtext">Telefon</label>    
<input type="text"name="Phone"/>
<label class="bookingtext">Email</label>    
<input type="text"name="Email"/>
<label>Antall rom</label>
<input type="number" name="quantity" min="1" max="10">
  
<select name='hotelname'>
    <?php  
   include_once 'phpScript.php';
   populateHotelDropDown();

    ?>
</select>

<input type="submit" name="submit" value="Lagre booking" />
</form>
<?php
/*his/her phone, email and selecting the hotel
from a drop-down list, the*/
if($_GET){
    echo 'Parameterene for SQl spørringen er : HotelId:'.$_GET['hotelname'].$_GET['FirstName'].$_GET['LastName'].$_GET['Phone']."<br>";
    echo $_GET['Email']."<br>".$_GET['quantity'];
 }
?>

                    
	
   


    

    

            
        </section>
       
    </div> 
    <footer id="main-footer">
        <p>Copyright &copy 2017 Min webside</p>
    </footer>
</body>
</html>