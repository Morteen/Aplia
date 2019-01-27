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
      $("#submitform").hide();
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


</form  >
<table id='result' class="table table-bordered table-hover">
</table>
<form  name="submitform"action='search.php'method="post"id="submitform">

<table>
    <tr>
        <td><label class="bookingtext">Fornavn</label><br><input type="text"name="FirstName"class="StyleTextfield"/></td>
        <td><label class="bookingtext">Etternavn</label><br><input type="text"name="LastName"class="StyleTextfield"/></td>
        <td><label class="bookingtext">Email</label><br><input type="email"name="Email"class="StyleTextfield"/> </td>
    </tr>
    
    
    <tr>
    <td><label class="bookingtext">Telefon</label><br><input type="text"name="Phone"class="StyleTextfield"/> </td>
        <td>
        </td>
    
    </tr>
    <tr>
    <td><label class="bookingtext">Hotel</label><br><input type="text"name="HotelName"id ="HotelName"class="StyleTextfield"/> </td>
    <td><label class="bookingtext">Pris</label><br><input type="text"name="Price"id ="Price"class="StyleTextfield"/> </td>
   
    </tr>
    
    <tr>
        
        <td><label>Ankomst dato</label><br><input type="text" class="StyleTextfield" id="ArrivalDate1"name="ArrivalDate1"></td>
        <td><label>Avreise dato</label><br><input type="text" class="StyleTextfield" id="DepartureDate1" name="DepartureDate1"></td>
        <td><label>Antall rom</label><br><input type="number" id="quantity"name="quantity" min="1" max="30"class="StyleTextfield"></td>
        <td></td>
    </tr>
    
    <tr>
        <td></td>
        <td><br><input method="post" name="booking"id="bookingBtn" value="Lagre booking" class="btn btn-primary"/></td>
    </tr>
</table>
<input type="hidden" id="hotelId" name="HotelId" >


</form>

<?php

if(isset($_POST['submit'])){ 
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

var hotelData=<?php echo json_encode($HotelData)?>;
var ArrivalDate=<?php echo json_encode($ArrivalDate)?>;
var  DepartureDate=<?php echo json_encode($DepartureDate)?>;
var Id="";
console.log(hotelData)
for (var hotel of hotelData){
    console.log(hotel);
    $("#result").append("<tr><td>"+hotel.HotelName+"</td><td>"+hotel.RoomPrice+"</td><td></td>"+
    "<td><button class='btn btn-primary js-addToBooking' data-hotel-id="+ hotel.HotelId +" >  Bestill </button> </td>" 
    )
}


        
$("#result").on("click",".js-addToBooking",function () {
                var button = $(this);
               console.log("Knappen virker")
                var HotelId=button.attr("data-hotel-id");
                id=HotelId;
                $.ajax({
                            url:"getHotel.php",
                            method: "POST",
                            data:{HotelId:HotelId},
                           dataType: 'json',
                           success:function(data){
                               console.log(data);
                                                          
                               $('#ArrivalDate1').val(ArrivalDate);
                               $('#DepartureDate1').val(DepartureDate);
                               $('#HotelName').val(data.HotelName);
                               $('#Price').val(data.RoomPrice);
                               $("#hotelId").val(data.HotelId);

                               $("#submitform").show();
                               $("#result").hide();

                           },error: function(xhr, status, error){
                              console.log(error+" ",status)
                           } 
                           
                        })
              
               

            })        
            $("#bookingBtn").on("click",function () {
              //$CustomerId,$HotelId,'$ArrivalDate','$DepartureDate',$Quantity
              id;
              var customerId=2;
              var ArrivalDate=$("#ArrivalDate1").val();
              var DepartureDate=$("#DepartureDate1").val();
              var Quantity=$("#quantity").val();


              $.ajax({
                            url:"addBooking.php",
                            method: "POST",
                            data:{HotelId:id,customerId:customerId,ArrivalDate:ArrivalDate,DepartureDate:DepartureDate,Quantity},
                           dataType: 'text',
                           success:function(data){
                               console.log(data);
                                                          
                               

                           },error: function(xhr, status, error){
                              console.log(error+" ",status)
                           } 
                           
                        })


            })



</script>

    

    

            
        </section>
       
    </div> 
    
</body>

</html>
