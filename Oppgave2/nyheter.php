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

    <link rel="stylesheet" type="text/css" href="../Oppgave1/css/style.css" />




    <title>Aplia RSS</title>

</head>
<body>
   <header id="main-header">
       <div class="container">
           <h1>Aplia Rss </h1>
       </div>
</header>
    <nav id="navbar">
        <div class="container">
            <ul>
                <li><a href="../oppgave1/index.php">Hjem</a></li>
                <li><a href="../Oppgave1/search.php">Søk</a></li>
                
               
            </ul>
        </div>
    </nav>
    
    <div class="container">
        <section id="main">


        
            
            


<?php
include"core/nytimes_reader_inc.php";
foreach(hent_nyhter() as $article){
    ?>
    <div class="rssArticle">
    <h3><?php echo $article['title']?></h3>
    <a href=<?php echo $article['link'] ?>>
    <p>Article decription:<?php echo $article['description']?></p>
   </a>
    <?php
    foreach ($article['media'] as $media) {

      ?>
      <a hrf=<?php echo $media['content'] ?> >
      <img src="<?php echo $media['content'];?>">
      </a>
      <p>Media decription :<?php echo $media['description']?></p>
     <p>Media Credit:<?php echo $media['credit']?></p>
     
      <?php
    }
    ?>
     <p>PubDate::<?php echo $article['pubDate']?></p>
     <p>Creator:<?php echo $article['creator']?></p>
    
    <hr>
    </div>
    <?php
}
?>
     

            
        </section>
       
    </div> 
    
</body>

</html>
