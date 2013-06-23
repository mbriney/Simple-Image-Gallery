<?php

include "config.php";

$start = $_GET["start"];

if ($start == ""){
	$result = mysql_query("SELECT filename FROM image ORDER BY id DESC LIMIT 2") or die(mysql_error());  

	while($row = mysql_fetch_array( $result )) {
			$image["prev"] = "none";
		if (isset($image["current"])){
			$image["nxt"] = $row["filename"];
		} else {
			$image["cur"] = $row["filename"];			
		}
	}

} else {
	$count = 0;
	$result = mysql_query("SELECT child.filename FROM image as child, (SELECT id FROM image WHERE filename = '".$start."') as parent WHERE child.id BETWEEN parent.id-1 AND parent.id+1;") or die(mysql_error());  
	while($row = mysql_fetch_array( $result )) {
		if($count == 0){
			$image["prev"] = $row["filename"];
		}
		if($count == 1){
			$image["cur"] = $row["filename"];
		}
		if($count == 2){
			$image["nxt"] = $row["filename"];
		}		
		$count = $count + 1;
	}
}
$json = json_encode($image);
echo $json;
?>