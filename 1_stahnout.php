<?php

 //pomocné funkce
 function get_http_response_code($url) {
  $headers = get_headers($url);
  return substr($headers[0], 9, 3);
 }
 
 echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /></head><body>';

 // stahování obrázků z mapy
  for($y = 0; $y < 241; $y++){
   for($x = 55; $x < 241; $x++){

    $x_s_nulami = str_pad($x, 3, '0', STR_PAD_LEFT); 
    $y_s_nulami = str_pad($y, 3, '0', STR_PAD_LEFT);  

    if(get_http_response_code("http://[ip address]/tilecache-all/tkm/15/000/000/" . $x_s_nulami . "/000/000/" . $y_s_nulami . ".png")!="404"){
     //file_get_contents("http://[ip address]/tilecache-all/tkm/15/000/000/" . $x_s_nulami . "/000/000/" . $y_s_nulami . ".png");
     file_put_contents($x_s_nulami . "_" . $y_s_nulami . ".png", file_get_contents("http://[ip address]/tilecache-all/tkm/15/000/000/" . $x_s_nulami . "/000/000/" . $y_s_nulami . ".png"));
     echo "Obrázek x: " . $x . ", y: " . $y . " existuje, STÁHNUT.<br />";
    }else{
     echo "Obrázek x: " . $x . ", y: " . $y . " neexistuje, nestáhnut.<br />";
    }             
    //file_put_contents($x_s_nulami . "_" . $y_s_nulami . ".png", file_get_contents("http://[ip address]/tilecache-all/tkm/15/000/000/" . $x_s_nulami . "/000/000/" . $y_s_nulami . ".png"));   
   
    flush();
    ob_flush();
    
    //if ($x == 149){
    // break;
    //} 
   }  
   //break;
  }
?>
