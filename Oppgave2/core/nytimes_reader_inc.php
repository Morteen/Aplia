<?php
//http://rss.nytimes.com/services/xml/rss/nyt/HomePage.xml
function hent_nyhter(){
   $data= file_get_contents('http://www.nytimes.com/services/xml/rss/nyt/HomePage.xml');
   $data=simplexml_load_string($data);
   $articles=array();
   $category=array();
   $image=array();
   
  foreach($data->channel->item as $item){
     
   
     $category[]=array(
        'domain'=>(string)$item->category->attributes(),
        'text'=>(string)$item->category
      );

     //prøver å hente arrayen med bilde info
     $media[] =array(  
       'content'=>(string)$item->children('media', True)->content->attributes(),
        'description'=>(string)$item->children('media', True)->description,
        'credit'=>(string)$item->children('media', True)->credit
     );
    
     $articles[]= array( 
        'title'=>(string)$item->title,
        'description'=>(string)$item->description,
        'link'=>(string)$item->link,
        'pubDate'=> (string)$item->pubDate,
        'category'=>$category,
        'media'=>$media,
        'creator'=>$item->children('dc',true)->creator
        
     );
  }
   return $articles;
}
?>