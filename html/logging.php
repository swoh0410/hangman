<?php
function debug_log($log) {
	$file_name = 'log.txt';
	$handle = fopen($file_name, 'a');
	if ($handle === false) {
		die('dedub_log fopen error!');
	}
	$bytes_written = fwrite($handle, $log."\n");
	if ($bytes_written === false) {
		die('dedub_log fwrite error!');
	}
	fclose($handle);
}
?>