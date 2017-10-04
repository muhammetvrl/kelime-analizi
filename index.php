<?php


function al($bas, $son, $yazi)
{
    @preg_match_all('/' . preg_quote($bas, '/') .
    '(.*?)'. preg_quote($son, '/').'/i', $yazi, $m);
    return @$m[1];
}

	$site = $_GET['sayfaurl'];
	$icerik = file_get_contents($site);
	$baslik = al('<p>' , '</p>' , $icerik);
	$baslik=implode(" ", $baslik);
	print_r($baslik);


 $kelimeler = preg_split('/([\s\-_—,:;?!\/\(\)\[\]{}<=>\r\n"]|(?<!\d)\.(?!\d))/' ,  $baslik , null , PREG_SPLIT_NO_EMPTY);
      
        $kelimes = array();
        
       
        foreach($kelimeler as $kelime)
        {
        	
        	 $uzunluk = strlen($kelime);
         
          if($uzunluk > 3)
              $kelimes[] = $kelime;
              
          }       

$toplamkelimes = array_count_values($kelimes); 

	$kelimebirlestir = array(); 

	$kelimedongu =array(); 

  $alma=array("img","src","strong","alt","assets");

	foreach ($toplamkelimes AS $kelim=> $siklik){ 
	
    if (!in_array($kelim, $alma))
    {
  		if($siklik == 1){ 
  			$kelimebirlestir[] = $kelim; 
  		}
  		
  		else{ 
  			$kelimedongu[$kelim.' ('.$siklik.')'] = $siklik."-".$kelim; 
  		}
    } 

		natsort($kelimedongu); 
		$kelimedongu = array_reverse($kelimedongu, true); 
	}


echo '<table class="table">';
echo "<thead><tr><th>Kelimeler</th><th>Sıklık</th></tr></thead>";
foreach($kelimedongu as $tabkel){
  $kel = explode("-",$tabkel);
  echo "<tr><td>".$kel[1]."</td><td>".$kel[0]."</td></tr>";
}
 
foreach($kelimebirlestir as $tabskel){
  echo "<tr><td>".$tabskel."</td><td>1</td></tr>";
}
echo "</table>";     


?>
