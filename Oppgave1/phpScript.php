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

    echo "<option value='' selected disabled hidden>Velg Hotell her</option>";
    for($j=0;$j<$rows;$j++){
        $result->data_seek($j);
        $row=$result->fetch_array(MYSQLI_ASSOC);
        $HotelId = $row['HotelId'];
        $HotelName = $row['HotelName'];

        echo  "<option value=".$HotelId .">".$HotelName."</option>";
               
  };	
$con->close();

}


function populateCityDropD(){


    include_once  'connect.php';
    $con=kobleOpp();
         if($con){
             echo"Success";
         };


    $sqlHotel = "SELECT DISTINCT City  FROM hotel";
    $result=$con->query($sqlHotel);
    if(!$result) die($conn->error);
    $rows=$result->num_rows;

    echo "<option value='' selected disabled hidden>Velg ønsket by</option>";
    for($j=0;$j<$rows;$j++){
        $result->data_seek($j);
        $row=$result->fetch_array(MYSQLI_ASSOC);
        $CityName = $row['City'];

        echo  "<option value=".$CityName.">".$CityName."</option>";
               
  };	
$con->close();



}



function AddCustomer($FirstName,$Lastname,$Phone,$email){
    include_once  'connect.php';
    $con=kobleOpp();

    $sql = "INSERT INTO customer(FirstName,LastName,Phone,Email)VALUES('$FirstName', '$Lastname','$Phone','$email')";
    return $con->query($sql);
    $con->close();
}

function getCustomerId(){
    include_once  'connect.php';
    $con=kobleOpp();
    $sqlReturnId="SELECT CustomerId FROM customer ORDER BY CustomerId DESC LIMIT 1";
    $result=$con->query($sqlReturnId);
    if(!$result) die($conn->error);
    $rows=$result->num_rows;
    for($j=0;$j<$rows;$j++){
        $result->data_seek($j);
        $row=$result->fetch_array(MYSQLI_ASSOC);
         
        $CustomerId=$row['CustomerId'];
    
    
               
    };
    return $CustomerId;
}
function getNumRooms($HotelId){
    include_once  'connect.php';
    $con=kobleOpp();
    $NumOfRooms=0;
   
    $numRoomsSql="SELECT NumberOfRooms FROM hotel WHERE HotelId=$HotelId ";
    $res=$con->query($numRoomsSql);
    if(!$res) die($conn->error);
   
    $rows1=$res->num_rows;
    
    for($i=0;$i<$rows1;$i++){
        $res->data_seek($i);
        $row=$res->fetch_array(MYSQLI_ASSOC);
        
        $NumOfRooms=$row['NumberOfRooms'];
       

    
               
    };
    return  $NumOfRooms;
    
         
    

}
function getRoomPrice($HotelId){
    include_once 'connect.php';
    $con=kobleOpp();
        $RoomPrice=0;
   
    $numRoomsSql="SELECT RoomPrice FROM hotel WHERE HotelId=$HotelId ";
    $res=$con->query($numRoomsSql);
    if(!$res) die($conn->error);
   
    $rows1=$res->num_rows;
    
    for($i=0;$i<$rows1;$i++){
        $res->data_seek($i);
        $row=$res->fetch_array(MYSQLI_ASSOC);
        
        $RoomPrice=$row['RoomPrice'];
       

    
               
    };
       
    return $RoomPrice;

}

function getHotelName($HotelId){
    include_once 'connect.php';
    $con=kobleOpp();
    $HotelName="";
   
    $numRoomsSql="SELECT HotelName FROM hotel WHERE HotelId=$HotelId ";
    $res=$con->query($numRoomsSql);
    if(!$res) die($conn->error);
   
    $rows1=$res->num_rows;
    
    for($i=0;$i<$rows1;$i++){
        $res->data_seek($i);
        $row=$res->fetch_array(MYSQLI_ASSOC);
        
        $HotelName=$row['HotelName'];
       

    
               
    };
       
    return $HotelName;

}




function getHotels($City,$ArrivalDate,$DepartureDate){
    $con=kobleOpp();
    if($con){
       
    }else{echo"Får ikke koblet opp!";};
    /*$sql="SELECT DISTINCT *FROM hotel
    INNER JOIN
    bookings ON hotel.HotelId = bookings.HotelId
    WHERE hotel.City LIKE '$City'
    AND (bookings.ArrivalDate NOT BETWEEN '$ArrivalDate' AND'$DepartureDate')
    GROUP BY bookings.TotalRooms
    HAVING hotel.NumberOfRooms>sum(bookings.TotalRooms-200)
    ORDER BY hotel.RoomPrice DESC";*/

    $sql="SELECT DISTINCT * FROM hotel WHERE hotel.City LIKE'$City'
    AND HotelId NOT IN(SELECT HotelId from bookings where ArrivalDate BETWEEN '$ArrivalDate' AND '$DepartureDate' )
    and hotel.NumberOfRooms>(SELECT sum(bookings.TotalRooms/2)FROM hotel
     INNER JOIN
     bookings ON hotel.HotelId = bookings.HotelId
     WHERE hotel.City LIKE '$City'
     AND bookings.ArrivalDate NOT BETWEEN '$ArrivalDate' AND '$DepartureDate'
    )
     ORDER BY hotel.RoomPrice DESC";


$response = array();
$res=$con->query($sql);
if(!$res) die($con->error);
$rows=$res->num_rows;
for($i=0;$i<$rows;$i++){
    $res->data_seek($i);
    $row=$res->fetch_array(MYSQLI_ASSOC);
    $response[] = $row;
};
return $response;
}
 function addBooking($CustomerId,$HotelId,$ArrivalDate,$DepartureDate,$Quantity){
    $con=kobleOpp();
    $bookingSql="INSERT INTO Bookings(CustomerId,HotelId,ArrivalDate,DepartDate,TotalRooms)VALUES($CustomerId,$HotelId,'$ArrivalDate','$DepartureDate',$Quantity)";
    if($con->query($bookingSql)===true){
    return true;
}
 }


?>