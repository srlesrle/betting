<?php  
class XmlToJson {  	
	public function Parse ($url) {  		
		$fileContents= file_get_contents($url);
		$fileContents = str_replace(array("\n", "\r", "\t"), '', $fileContents);
		$fileContents = trim(str_replace('"', "'", $fileContents));
		$simpleXml = simplexml_load_string($fileContents);
		$json = json_encode($simpleXml);
		return $json;  	
	}  
}
$file = 'data/oddxml.json';
//if(file_exists($file)){ 
//	unlink($file);
//}
$fp = fopen($file, "w+") or die ('Error ');  
fwrite($fp, XmlToJson::Parse('data/oddxml.xml'));//XmlToJson::Parse("www.bet-at-home.com/oddxml.aspx?lang=en"));  
fclose($fp);
echo filesize($file);
?>
