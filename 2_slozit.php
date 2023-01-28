<?php

 //--------------------vytvoření prázdného čtverce mapy-------------------------

 //počet čtverečků ve výsledném obrázku
 $ctverecky_x = 40;
 $ctverecky_y = 40;
 //vytvoření prázdného obrázku bez průhlednosti
 $img = imagecreatetruecolor(256*$ctverecky_x,256*$ctverecky_y); //velikost pbrázku x, y 
 imagesavealpha($img, false); 

 //vyplnění obrázku bílou
 $color = imagecolorallocatealpha($img,255,255,255,127); 
 imagefill($img, 0, 0, $color); 

 //uložení obrázku do souboru
 imagepng($img, "00test.png"); 

 //zničení obrázku v paměti 
 imagedestroy($img); 

 //-----------------přidávání čtverečků do výsledku-----------------------------

  //cyklus, který projede celou mapu
  for($velke_y = 0; $velke_y < 8; $velke_y++){
   for($velke_x = 0; $velke_x < 6; $velke_x++){ 

   //souřadnice velkých čtverců
   //$velke_x = 3;
   //$velke_y = 1;
   $offset_x_malec = $velke_x*$ctverecky_x;
   $offset_y_malec = $velke_y*$ctverecky_y;
 
   //přidání čtverce s mapu do cílového obrázku
   $zapisovat_kam = imagecreatefrompng("00test.png");
 
   for($y = (0+$offset_y_malec); $y < ($ctverecky_y+1+$offset_y_malec); $y++){
    for($x = (55+$offset_x_malec); $x < ($ctverecky_x+1+55+$offset_x_malec); $x++){

     $x_s_nulami = str_pad($x, 3, '0', STR_PAD_LEFT); 
     $y_s_nulami = str_pad($y, 3, '0', STR_PAD_LEFT); 
  	  
     $nazev_ctverecku = $x_s_nulami . "_" . $y_s_nulami . ".png";

     if (file_exists($nazev_ctverecku)) {
      $vzit_odkud = imagecreatefrompng($nazev_ctverecku);
      imagecopymerge($zapisovat_kam, $vzit_odkud, (256*($x-55-$offset_x_malec)), ((256*$ctverecky_y)-(256*($y-$offset_y_malec))), 0, 0, 256, 256, 100);
     } 
 
    } 
   }
   
   //stažení obrázku do serveru
   imagepng($zapisovat_kam, 'mapa' . $velke_x . '_' . $velke_y . '.png');
   imagedestroy($zapisovat_kam);
   imagedestroy($vzit_odkud);
   echo "Na server uložen obrázek mapa" . $velke_x . "_" . $velke_y . ".png.<br />";
   flush();
   ob_flush();
   
  } 
 }  

 //imagedestroy($zapisovat_kam);
 //imagedestroy($vzit_odkud);

?>
