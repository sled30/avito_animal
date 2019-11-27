<?php
function get_base_data($url){
  // code...
 $source_data = file_get_contents($url);
 $arr_source_link = pars_find($source_data);

 return $arr_source_link;
}

function pars_find($source_data){
  $match = '/itemprop="url"
 href=\"(.{3,})\"/';

  preg_match_all($match, $source_data, $text);

  return $text;
}

function seller_chek($user_id, $base_link){
  // code...
  $declaration = file_get_contents($base_link);
  $match = '/href="\/user\/(.{0,32})\//';
  preg_match_all($match, $declaration, $seller_id);
  if($user_id == $seller_id[1][0]){

    $data = extract_data($declaration);
    var_dump($data);
    return $data;
  }
  else {
    return false;
  }
}

function extract_data($declaration){
  // code...
  preg_match_all('/itemID":"(\d{0,})"/', $declaration, $seller_id);
  preg_match_all('/views":{"today":(\d{1,}),"total":(\d{1,})}/', $declaration, $view);

$arr_data = array('id' => $seller_id[1][0], 'total_views' => $view[2][0], 'today_views' => $view[1][0], 'date' => date( "d.m.y H:i" ));

return $arr_data;
}

function writeReport($data){
  if(!is_array($data)){
      return false;
    }
    $openFile = fopen('report.csv', 'a');
    fputcsv($openFile, $data);
    fclose($openFile);
  return true;
}
