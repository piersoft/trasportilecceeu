<?php

$lat=$_GET["lat"];
$lon=$_GET["lon"];
$urlgd  ="stops.txt";
$inizio=0;
$homepage ="";
$map="";
$csv = array_map('str_getcsv',file($urlgd));

//	$csv=str_replace(array("\r", "\n"),"",$csv);
$count = 0;
foreach($csv as $data=>$csv1){
  $count = $count+1;
}
//var_dump($csv);
$alert="";
  $optionf=array([]);
  $c=0;
for ($i=$inizio;$i<$count;$i++){

$long10=floatval($csv[$i][5]);
$lat10=floatval($csv[$i][4]);
$theta = floatval($lon)-floatval($long10);
$dist =floatval( sin(deg2rad($lat)) * sin(deg2rad($lat10)) +  cos(deg2rad($lat)) * cos(deg2rad($lat10)) * cos(deg2rad($theta)));
$dist = floatval(acos($dist));
$dist = floatval(rad2deg($dist));
$miles = floatval($dist * 60 * 1.1515 * 1.609344);
$data=0.0;

$t=0;
//	$t=floatval(100*1000);
if ($miles >=1){
  $t=floatval(2);
  $data1=number_format($miles, 2, '.', '');
  $data =number_format($miles, 2, '.', '')." Km";
} else {
  $t=floatval(2*1000);
  $data1=number_format(($miles*1000), 0, '.', '');
  $data =number_format(($miles*1000), 0, '.', '')." mt";

}


  $csv[$i][100]= array("distance" => "value");

  $csv[$i][100]= $miles;
  $csv[$i][101]= array("distancemt" => "value");

  $csv[$i][101]= $data;
  $csv[$i][102]= array("mapurl" => "value");

  $csv[$i][102]= $data;


      if ($data1 < $t)
      {
        $c++;
        $distanza[$i]['distanza'] =$csv[$i][100];
        $distanza[$i]['distanzamt'] =$csv[$i][101];
      //  $distanza[$i]['id'] =$csv[$i][0];
        $distanza[$i]['lat'] =$csv[$i][4];
        $distanza[$i]['lon'] =$csv[$i][5];
        $distanza[$i]['stop_id'] =$csv[$i][0];
        $distanza[$i]['stop_code'] =$csv[$i][1];
        $distanza[$i]['stop_name'] =$csv[$i][2];
        $distanza[$i]['stop_desc'] =$csv[$i][3];
        $distanza[$i]['mapurl']="https://www.openstreetmap.org/?mlat=".$csv[$i][4]."&mlon=".$csv[$i][5]."#map=19/".$csv[$i][4]."/".$csv[$i][5];

        $i++;

      }


}

//echo $homepage;
if ($c >0){


sort($distanza);
for ($i=$inizio;$i<$c;$i++){

//	if ($distanza[$i]['distanzamt'] !== null)
	$alert .="La fermata n° ".$distanza[$i]['stop_code']." ".$distanza[$i]['stop_name']." dista: ".$distanza[$i]['distanzamt']." mappa: ".$distanza[$i]['mapurl']."\n<br>";
}
}
echo 	$alert;
?>
