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
            <h1>Lorem ipsum dolor sit amet</h1>
        </div>
    </section>
    <div class="container">
        <section id="main">
            <h1>Velkommen</h1>
            <?php
             
                 include_once  'connect.php';
                 $con=kobleOpp();
                      if($con){
                          echo"Success";
                      };


                      if(isset($_POST["submit"])){
                        $test= $_POST["hotelname"];
                        echo $test;
                      
                     } else{
                         $test = '0';
                         echo $test;
                     }
                         
                 



                    
	
    $sqlHotel = "SELECT * FROM hotel";
    $result=$con->query($sqlHotel);
    if(!$result) die($conn->error);
	$rows=$result->num_rows;

echo "<form action=''method='post'><select name='hotelname'>";
	    for($j=0;$j<$rows;$j++){
          $result->data_seek($j);
          $row=$result->fetch_array(MYSQLI_ASSOC);
          $HotelId = $row['HotellId'];
          $navn = $row['HotelName'];
          $NumRooms=$row['NumberOfRooms'];
          $price=$row['RoomPrice'];
         
					echo  "<option value='".$HotelId ."'>".$navn."</option>";
			       
    };	
           		  
	
    echo"</select>
    <input action=''type='submit'name='submit'value='Velg'></input></form>";

    

            ?>
        </section>
       
    </div> 
    <footer id="main-footer">
        <p>Copyright &copy 2017 Min webside</p>
    </footer>
</body>
</html>