<?php
if(isset($_POST['HotelId'])){
    include_once  'connect.php';
    $con=kobleOpp();
        
         $Id=$_POST['HotelId'];
$data=Array();
         $hotelQuery="SELECT* FROM hotel WHERE HotelId='$Id'";
         
        
         $result=$con->query($hotelQuery);
    if(!$result) die($con->error);
    $rows=$result->num_rows;
    for($j=0;$j<$rows;$j++){
        $result->data_seek($j);
        $row=$result->fetch_array(MYSQLI_ASSOC);
         
        $data['HotelName']=$row['HotelName'];
       $data['RoomPrice']=$row['RoomPrice'];
       $data[]=$row;
       
    
    
               
    };
    echo json_encode($data);  
}else{echo "HotelId mangler";}


?>