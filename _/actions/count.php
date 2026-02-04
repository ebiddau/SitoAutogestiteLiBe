<?php
$linecount = 0;

if ($handle = opendir('../content/')) {
	$blacklist = array('.', '..', 'thumb');		//file e cartelle da non mostrare
	
	while (false !== ($file = readdir($handle))) {
		if (!in_array($file, $blacklist)) {
			$handle = fopen($file, "r");
			while(!feof($handle)){
			  $line = fgets($handle);
			  $linecount++;
			}

			//fclose($handle);
		}
	}
	closedir($handle);
} 


echo $linecount;