<?php 
  
//fuksjon for å legge navn og Id i dropdowvn listen  i index.php
function populateHotelDropDown(){

    include_once  'connect.php';
    $con=kobleOpp();
         if($con){
             echo"Success";
         };


    $sqlHotel = "SELECT * FROM hotel";
    $result=$con->query($sqlHotel);
    if(!$result) die($conn->error);
    $rows=$result->num_rows;


    for($j=0;$j<$rows;$j++){
        $result->data_seek($j);
        $row=$result->fetch_array(MYSQLI_ASSOC);
        $HotelId = $row['HotelId'];
        $HotelName = $row['HotelName'];

        echo  "<option value=".$HotelId .">".$HotelName."</option>";
               
  };	
$con->close();

}
?>