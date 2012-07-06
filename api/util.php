<?PHP 
        function log_action($msg) {
		$today = date("d.m.Y");
		$filename = "log/$today.txt";
		if (!file_exists($filename)) {
			chmod($filename, 0777);
		}
		$fd = fopen($filename, "a");
		$str = "[" . date("d/m/Y h:i:s", mktime()) . "] " . $msg;
		fwrite($fd, $str . PHP_EOL);
		fclose($fd);
		chmod($filename, 0644);
	}
	 
	 
	 function contains($string,$substring) {
	        $pos = strpos($string, $substring);
	 
	        if($pos === false) {
	                // string needle NOT found in haystack
	                return false;
	        }
	        else {
	                // string needle found in haystack
	                return true;
	        }
	 
	}
?>