<?php
require_once "lib/function.php";
$user_id = '177a86e0f2d2d3e6e15a87592d87b415';
//https://www.avito.ru/astrahanskaya_oblast/avtomobili/vaz_lada/2114_samara?s_trg=4&f=188_901b
$site = 'https://www.avito.ru';
$region = 'moskva_i_mo';
$category = 'tovary_dlya_zhivotnyh?q=';
$name_search = 'купить седло для лошади';
$url = $site.'/'.$region.'/'.$category.'/'.$name_search;
$work_link = 'https://m.avito.ru';
$count = 1; // счетчик объявлений
//echo $vaz;
$source_url = get_base_data($url);
//var_dump($source_url);
foreach ($source_url[1] as $base_link) {
  // code...
  $seller_status = seller_chek($user_id, "$work_link.$base_link");

  if($seller_status !== FALSE){

    $seller_status += ['count' => $count];
    $seller_status += ['request' => $name_search];
  
    writeReport($seller_status);
  }
 $count++;
}
/*
foreach ($source_url[1] as $base_link){
  // code...
  $work_link = 'https://m.avito.ru'.$base_link;
  //$ad = file_get_contents($work_link);
  $source_ad = file_get_contents($work_link);
  $ad = process_ad($source_ad);
  var_dump($ad);

  break;
}*/
//$site = file_get_contents('https://m.avito.ru/moskva/tovary_dlya_zhivotnyh/novoe_sedlo_turist_dlya_loshadi_1348798238');
//var_dump($site);

 ?>
