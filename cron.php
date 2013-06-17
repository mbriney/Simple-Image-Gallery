<?php

include "config.php";

$directory = 'images/';

$it = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory));

while($it->valid()) {

    if (!$it->isDot()) {

        echo $it->getSubPathName() . "\n";
        echo date('m-d-Y',$it->getMTime()) . "\n";
        echo $it->getMTime() . "\n";
        $size = getimagesize('images/'.$it->getSubPathName());
        echo $size[0].'x'.$size[1] . "\n";
        if ($size[0] > $size[1]){
        	$orientation = 'h';
        } else {
           	$orientation = 'v';
        }
        echo $orientation . "\n";
        $filesize = filesize('images/'.$it->getSubPathName());
        echo $filesize. "\n";

		mysql_query("INSERT INTO image (filename,time,width,height,orientation,size) VALUES('".mysql_real_escape_string($it->getSubPathName())."','".$it->getMTime()."',".$size[0].",".$size[1].",'".$orientation."',".$filesize.") ");
    }

    $it->next();
}


?>