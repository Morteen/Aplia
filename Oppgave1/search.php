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
    <title>Aplia Search</title>

    <script>
  $( function() {
    $( ".datepicker" ).datepicker({dateFormat: 'yy-mm-dd'});
  } );
  </script>


</head>
<body>
   <header id="main-header">
       <div class="container">
           <h1>Aplia test search </h1>
       </div>
</header>
    <nav id="navbar">
        <div class="container">
            <ul>
                <li><a href="index.php">Hjem</a></li>
                
               
            </ul>
        </div>
    </nav>
    
    <div class="container">
        <section id="main">
            <h3>Finn ønsket by og hotell her</h3>

            



            
            

<form name="searchForm"action='search.php'method="post"id="searchForm" >

<table>
<tr>
    <td>
        <label>Søk her</label><br>
    <select name='City' class="StyleTextfield">
    <option value='' selected disabled hidden>Velg ønsket by</option>
    <?php  
   include_once 'phpScript.php';
   populateCityDropD();

    ?>
</select>
</td>
<td>
    <label>Ankomst dato</label><br><input type="text" class="datepicker StyleTextfield" name="ArrivalDate">
</td>
<td>
    <label>Avreise dato</label><br><input type="text" class="datepicker StyleTextfield" name="DepartureDate">
</td>


    <td></td> <td><input method="post" type="submit" name="submit" value="Kjør søk" class="btn btn-primary" style='margin-top:27px'/></td> <td></td>
</tr>
</table>


</form>
<table id='result'>
</table>
<?php

if(isset($_POST['submit'])){ 

    //||empty($_POST['CityName'])||empty($_POST['DepartureDate'])
    if(empty($_POST['ArrivalDate'])){
        echo "<div class='alert alert-warning' role='alert'>Et eller flere felt er ikke fylt ut!</div>";
     }else{


        $ArrivalDate=$_POST['ArrivalDate'];
        $DepartureDate=$_POST['DepartureDate'];
        $City=$_POST['City'];


$HotelData=getHotels($City, $ArrivalDate, $DepartureDate);
     }//Slutt på emptyfield sjekk

}  //Slutt på submit 
	
?>  
<script type="text/javascript">

hotelData=<?php echo json_encode($HotelData)?>;
console.log(hotelData)
for (var hotel of hotelData){
    console.log(hotel);
    $("#result").append("<tr><td>"+hotel.HotelName+"</td><td>"+hotel.RoomPrice+"</td><td></td>"+
    "<td><button class='btn btn-primary js-addToBooking' data-hotel-id=" + hotel.HotelId + ">  Bestill </button> </td>" 
    )
}


                




</script>

    

    

            
        </section>
       
    </div> 
    
</body>

</html>