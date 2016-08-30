<?php



function debug_log($log) {
	$file_name = 'log.txt';
	$handle = fopen($file_name, 'a');
	fwrite($handle, $log."\n");
	fclose($handle);
}
?>