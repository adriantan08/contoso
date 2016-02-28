<?php
class util_model extends CI_Model {
	
	
	function getSmHostName(){
		if(ENVIRONMENT == 'production')
			return SM_HOST_PROD;
		else
			return SM_HOST_QA;
	}
	function getSmUriSegment(){
		if(ENVIRONMENT == 'production')
			return SM_URI_SEGMENT_PROD;
		else
			return SM_URI_SEGMENT_QA;
	}
	
	
	function getMonth($string){
		if($string == 'Jan')
			return '01';
		else if($string == 'Feb')
			return '02';
		else if($string == 'Mar')
			return '03';
		else if($string == 'Apr')
			return '04';
		else if($string == 'May')
			return '05';
		else if($string == 'Jun')
			return '06';	
		else if($string == 'Jul')
			return '07';	
		else if($string == 'Aug')
			return '08';
		else if($string == 'Sep')
			return '09';
		else if($string == 'Oct')
			return '10';
		else if($string == 'Nov')
			return '11';
		else if($string == 'Dec')
			return '12';
	}
	
	function getImInSm($queue){
		include_once "lib/simplehtmldom/simple_html_dom.php";
		//submit form in smtracker
		$url = "http://".$this->getSmHostName()."/pls/".$this->getSmUriSegment()."/pg_tracker.inc_groups";
		
		$datatopost = array (
			"i_group" => $queue
		);
		$ch = curl_init();
		curl_setopt ($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt ($ch, CURLOPT_POSTFIELDS, $datatopost);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$output = curl_exec($ch);
		$info = curl_getinfo($ch);
		$http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		
		//ERROR_HANDLING
		if ($output === false) {
			trigger_error('Failed to execute cURL session: ' . curl_error($ch), E_USER_ERROR);
		}
		
		$html = str_get_html($output);
		$anchorArray = $html->find('a');
		
		$arr = array();
		for($i=0; $i<count($anchorArray); $i++){
			if(strpos($anchorArray[$i], "IM")){
				$pos = strpos($anchorArray[$i], "IM");
				$string = substr($anchorArray[$i], $pos, 10);
				$arr[] = $this->getIncidentDetails($string);
				
			}
		}
		curl_close($ch);
		
		return $arr;
	}
	
	function getFrInSm($queue){
		include_once "lib/simplehtmldom/simple_html_dom.php";
		//submit form in smtracker
		$url = "http://".$this->getSmHostName()."/pls/".$this->getSmUriSegment()."/pg_tracker.ful_groups";
		
		$datatopost = array (
			"i_group" => $queue
		);
		$ch = curl_init();
		curl_setopt ($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt ($ch, CURLOPT_POSTFIELDS, $datatopost);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$output = curl_exec($ch);
		$info = curl_getinfo($ch);
		$http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		//echo $output;
		//ERROR_HANDLING
		if ($output === false) {
			trigger_error('Failed to execute cURL session: ' . curl_error($ch), E_USER_ERROR);
		}
		
		$html = str_get_html($output);
		$anchorArray = $html->find('a');
		//echo "Tickets in Queue of ".$queue.":<br/>";
		//echo "<ul>";
		$arr = array();
		for($i=0; $i<count($anchorArray); $i++){
			if(strpos($anchorArray[$i], "FR")){
				$pos = strpos($anchorArray[$i], "FR");
				$string = substr($anchorArray[$i], $pos, 10);
				$arr[] = $this->getFulfillmentDetails($string);
				//echo "<li>".$string."</li>";
			}
		}
		//echo "</ul>";
			
		
		curl_close($ch);
		//echo $output;
		return $arr;
	}
	
	
	function getIncidentDetails($im){
		include_once "lib/simplehtmldom/simple_html_dom.php";
		/* Index of data[] Guide
			//Basic Info
			0 - IM#
			1 - Reported
			2 - Impact
			3 - Urgency
			4 - Priority
			5 - Current Status
			
			// Technical Details
			6 - Title
			7 - Target Date
			8 - Affected CI
			9 - CI SLA Def
			10 - CI Max Outage
			11 - Service
			12 - Caller Phone#
			13 - Assignment Group
			14 - Assignee
			15 - Medium Code
			16 - Service Impact
			17 - Priority
			18 - Closure Code
			19 - Relations (related tickets)
			20 - SLA%
			21 - Description
			
			//Latest Additional Fields (Triplets) - 7/2/2014
			22 - Category
			23 - Area
			24 - Sub-Area
			
			//Latest Additional Fields - 8-12-2014
			25 - History
			
		*/
	
		$data = array();
		$data[] = $im;
		$ch = curl_init();
		$url = "http://".$this->getSmHostName()."/pls/".$this->getSmUriSegment()."/pg_tracker.sm_details?i_id=".$im;
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$output = curl_exec($ch);
		$info = curl_getinfo($ch);
		$http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		
		//ERROR_HANDLING
		if ($output === false) {
			trigger_error('Failed to execute cURL session: ' . curl_error($ch), E_USER_ERROR);
		}
		
		$html = str_get_html($output);
		$spanArray = $html->find('span');
		$tripCategory = '';
		$tripArea = '';
		$tripSubArea = '';
		
		for($i=0; $i<count($spanArray); $i++){
		
			if (strpos($spanArray[$i], 'Current Status:') !== FALSE){
				$i++;
				$currentStatus = $spanArray[$i];
				$data[] = trim(strip_tags($currentStatus));
			}
			if (strpos($spanArray[$i], 'Impact:') !== FALSE){
				$i++;
				$impact = $spanArray[$i];
				$data[] = trim(strip_tags($impact));
			}
			if (strpos($spanArray[$i], 'Urgency:') !== FALSE){
				$i++;
				$urgency = $spanArray[$i];
				$data[] = trim(strip_tags($urgency));
			}
			if (strpos($spanArray[$i], 'Priority:') !== FALSE){
				$i++;
				$priority = $spanArray[$i];
				$data[] = trim(strip_tags($priority));
			}
			if (strpos($spanArray[$i], 'Reported:') !== FALSE){
				$i++;
				$reported = $spanArray[$i];
				$data[] = trim(strip_tags($reported));
			}
			if (strpos($spanArray[$i], 'Client Problem/Request') !== FALSE){
				$i++;
				$description = $spanArray[$i];
				
			}
			if (strpos($spanArray[$i], 'Category:') !== FALSE){
				$i++;
				$currentStatus = $spanArray[$i];
				$tripCategory = trim(strip_tags($currentStatus));
			}
			
			if (strpos($spanArray[$i], 'Area:') !== FALSE){
				$i++;
				$currentStatus = $spanArray[$i];
				$tripArea = trim(strip_tags($currentStatus));
			}
			
			if (strpos($spanArray[$i], 'Sub-Area') !== FALSE){
				$i++;
				$currentStatus = $spanArray[$i];
				$tripSubArea = trim(strip_tags($currentStatus));
			}
			
		}
		
		//First, get the <table></table> content within the script tag xtraSection
		$html2 = str_get_html($output);
		$scriptArray = $html2->find('script');
		$technicalDetails = '';
		for($j=0; $j<count($scriptArray); $j++){
			//We can further play around here if we want to get other data being displayed by certain JS,
			//but for now, we only get the technical details part
			if(strpos($scriptArray[$j], 'var xtraSection') != 0){
				$startIndex = strpos($scriptArray[$j], '<table');
				$endIndex = strpos($scriptArray[$j], '</table>');
				$technicalDetails = substr($scriptArray[$j], $startIndex, $endIndex);
				break;
			}
			
		}
		
		
		$html2 = str_get_html($technicalDetails);
		$scriptArray = $html2->find('table');
		$technicalDetails = $scriptArray[0];
		$html2 = str_get_html($technicalDetails);
		$rowArray = $html2->find('tr');
		//since each row would contain two cell data
		
		for($k=0; $k<count($rowArray); $k++){
			$html2 = str_get_html($rowArray[$k]);
			$cellData = $html2->find('td');
			$data[] = trim(strip_tags($cellData[1]));
			
		}
		//FIX for those issues wherein document.write keeps on getting included in the Array
		if($data[6] == 'document.write(openTwistie(xtraSection.label));'){
			unset($data[6]);
			$data = array_values($data);
		}
		
		
		//GET HISTORY////////////////////////////////////////////////////
		$html3 = str_get_html($output);
		$tdArray = $html3->find('td');
		$history = "";
		for($i=0; $i<count($tdArray); $i++){
			if (strpos($tdArray[$i], 'History') !== FALSE){
				$i++;
				$history = $tdArray[$i];
				$history = str_replace("'","\'", strip_tags($history,"<br>"));
				break;
			}
			
			
		}
		//Further changing/filtering history
		$history = str_replace("\'", "", $history);
		$history = str_replace("'", "", $history);
	
		
		curl_close($ch);
		
		
		//Compute for SLA %
		//Format is 03-JUL-13 17:00:00
		date_default_timezone_set('America/Danmarkshavn');
		$sla = $data[7];
		
		$tempMonth = $sla[3].$sla[4].$sla[5];
		$sla = $sla[7].$sla[8].'-'.$this->getMonth($tempMonth).'-'.$sla[0].$sla[1].' '.$sla[10].$sla[11].':'.$sla[13].$sla[14].':'.$sla[16].$sla[17];
		//SET SGT
		$slaSGT = date('Y/m/d H:i:s', strtotime($sla));
		$sla = strtotime(date('Y/m/d H:i:s', strtotime($sla)));
		
		
		//Convert SLA to SGT. Store it first in a variable, then override data[7]
		$temp= new DateTime();
		$yr = $slaSGT[0].$slaSGT[1].$slaSGT[2].$slaSGT[3];
		$month = $slaSGT[5].$slaSGT[6]; 
		$day = $slaSGT[8].$slaSGT[9];
		$hr = $slaSGT[11].$slaSGT[12];
		$min = $slaSGT[14].$slaSGT[15];
		$sec = $slaSGT[17].$slaSGT[18];
		$temp->setDate($yr, $month, $day);
		$temp->setTime($hr, $min, $sec);
		//$temp->setTimeZone(new DateTimeZone('Asia/Singapore'));
		$temp->add(new DateInterval('PT8H'));
		$slaSGT = $temp->format('d-M-y H:i:s');
		
		
		$opened = $data[1];
		$tempMonth = $opened[3].$opened[4].$opened[5];
		$opened = $opened[7].$opened[8].'-'.$this->getMonth($tempMonth).'-'.$opened[0].$opened[1].' '.$opened[10].$opened[11].':'.$opened[13].$opened[14].':'.$opened[16].$opened[17];
		//SET SGT
		$openedSGT = date('Y/m/d H:i:s', strtotime($opened));
		$opened = strtotime(date('Y/m/d H:i:s', strtotime($opened)));
		
		//Convert Open to SGT. Store it first in a variable, then override data[7]
		$temp= new DateTime();
		$yr = $openedSGT[0].$openedSGT[1].$openedSGT[2].$openedSGT[3];
		$month = $openedSGT[5].$openedSGT[6]; 
		$day = $openedSGT[8].$openedSGT[9];
		$hr = $openedSGT[11].$openedSGT[12];
		$min = $openedSGT[14].$openedSGT[15];
		$sec = $openedSGT[17].$openedSGT[18];
		$temp->setDate($yr, $month, $day);
		$temp->setTime($hr, $min, $sec);
		//$temp->setTimeZone(new DateTimeZone('Asia/Singapore'));
		$temp->add(new DateInterval('PT8H'));
		$openedSGT = $temp->format('d-M-y H:i:s');
		
		
		
		//Get GMT Timezone
		date_default_timezone_set('Asia/Singapore');
		$sysdate = strtotime(date('Y/m/d H:i:s'));
		//echo 'Sysdate: '.$sysdate.'<br/><br/>';
		
		
		$min1 = ($sysdate - $opened)/60;
		$min2 = ($sla - $opened)/60;
		//echo 'SLA-Sysdate (MIN1): '.$min1.' minutes. ('.$sla.'-'.$sysdate.')<br/>';
		//echo 'SLA-Opened (MIN2): '.$min2.' minutes. ('.$sla.'-'.$opened.')<br/>';
		
		$sla_perc = round(abs(($min1/$min2)*100),2);
		$data[20] = $sla_perc;
		
		
		//convert and set all timezones stored in the DB for SLA and OPENED from GMT to SGT:
		$data[1] = $openedSGT;
		$data[7] = $slaSGT;
		
		//Replace ' for the title
		$data[6] = str_replace("'","",$data[6]);
		$data[6] = str_replace("\xBF","-",$data[6]);
		$data[6] = str_replace("\xA0","",$data[6]);
		//Replace funky characters such as ç, ã to c, a
		$data[6] = iconv('UTF-8', 'ISO-8859-1//TRANSLIT//IGNORE', $data[6]);
		
		
		$description = str_replace("'","",$description);
		$description = str_replace("\xBF","-",$description);
		$description = str_replace("\xA0","",$description);
		$description = str_replace("\\","",$description);
		$description = iconv('UTF-8', 'ISO-8859-1//TRANSLIT//IGNORE', $description);
		
		$data[] = str_replace("'", "", trim(strip_tags($description, "<br>")));
		
		
		$data[] = $tripCategory;
		$data[] = $tripArea;
		$data[] = $tripSubArea;
		
		$data[] = $history;
		
		//11-21-2014 - Fix for CI Special Character
		//\xBFHL is a character that looks something like a long -
		$data[8] = str_replace("\xBF","-",$data[8]);
		
		return $data;
	}
	
	function getFulfillmentDetails($fr){
		include_once "lib/simplehtmldom/simple_html_dom.php";
		$data = array();
		
		$ch = curl_init();
		$url = "http://".$this->getSmHostName()."/pls/".$this->getSmUriSegment()."/pg_tracker.fulfillment_details?i_id=".$fr;
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$output = curl_exec($ch);
		$info = curl_getinfo($ch);
		$http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		
		//ERROR_HANDLING
		if ($output === false) {
			trigger_error('Failed to execute cURL session: ' . curl_error($ch), E_USER_ERROR);
		}
		
		$html = str_get_html($output);
		$spanArray = $html->find('td');
		
		
		/* Index of data[] Guide
			//Basic Info
			0 - FR#
			1 - Category
			2 - Status
			3 - Title
			4 - Request Priority
			5 - Request Type
			6 - Service
			7 - Service Type
			8 - Configuration Item
			9 - Open Date
			10 - SLA
			11 - Closed Date
			12 - Assignment Group
			13 - Assignee
			14 - Closure Code
			15 - SLA %
			16 - Description
			
			//New Field - 9-10-2014
			17 - History
		*/
		
		
		$data[] = $fr;
		$data[] = trim(strip_tags($spanArray[1]));
		$data[] = trim(strip_tags($spanArray[3]));
		$data[] = trim(strip_tags($spanArray[5]));
		$data[] = trim(strip_tags($spanArray[13]));
		$data[] = trim(strip_tags($spanArray[15]));
		$data[] = trim(strip_tags($spanArray[17]));
		$data[] = trim(strip_tags($spanArray[19]));
		$data[] = trim(strip_tags($spanArray[21]));
		$data[] = trim(strip_tags($spanArray[27]));
		$data[] = trim(strip_tags($spanArray[29]));
		$data[] = trim(strip_tags($spanArray[31]));
		$data[] = trim(strip_tags($spanArray[33]));
		$data[] = trim(strip_tags($spanArray[35]));
		$data[] = trim(strip_tags($spanArray[39]));
		
		$description = str_replace("'","", trim(strip_tags($spanArray[7])));
		$description = str_replace("'","",$description);
		$description = str_replace("\xBF","",$description);
		$description = str_replace("\xA0","",$description);
		//Fix in case there's a escape character in the last of the string
		$description = str_replace("\\","",$description);
		$description = iconv('UTF-8', 'ISO-8859-1//TRANSLIT//IGNORE', $description);
		
		
		//I don't know why I need to store this twice. :( Index problems
		$data[] = $description;
		$data[] = $description;
		
		
		//GET HISTORY HERE
		$data[] = str_replace("'","", trim(strip_tags($spanArray[43])));
		$data[17] = str_replace("\xBF","",$data[17]);
		$data[17] = str_replace("\xA0","",$data[17]);
		$data[17] = str_replace("\'","",$data[17]);
		$data[17] = str_replace("'","",$data[17]);
		
		curl_close($ch);
		//////////////////////////////////////////////////////////////////////////
		//Compute for SLA %
		//Format is 03-JUL-13 17:00:00
		date_default_timezone_set('America/Danmarkshavn');
		$sla = $data[10];
		$tempMonth = $sla[3].$sla[4].$sla[5];
		$sla = $sla[7].$sla[8].'-'.$this->getMonth($tempMonth).'-'.$sla[0].$sla[1].' '.$sla[10].$sla[11].':'.$sla[13].$sla[14].':'.$sla[16].$sla[17];
		//SET SGT
		$slaSGT = date('Y/m/d H:i:s', strtotime($sla));
		
		$sla = strtotime(date('Y/m/d H:i:s', strtotime($sla)));
		
		//Convert SLA to SGT. Store it first in a variable, then override data[]
		$temp= new DateTime();
		$yr = $slaSGT[0].$slaSGT[1].$slaSGT[2].$slaSGT[3];
		$month = $slaSGT[5].$slaSGT[6]; 
		$day = $slaSGT[8].$slaSGT[9];
		$hr = $slaSGT[11].$slaSGT[12];
		$min = $slaSGT[14].$slaSGT[15];
		$sec = $slaSGT[17].$slaSGT[18];
		$temp->setDate($yr, $month, $day);
		$temp->setTime($hr, $min, $sec);
		//$temp->setTimeZone(new DateTimeZone('Asia/Singapore'));
		$temp->add(new DateInterval('PT8H'));
		$slaSGT = $temp->format('d-M-y H:i:s');
		
		$opened = $data[9];
		$tempMonth = $opened[3].$opened[4].$opened[5];
		$opened = $opened[7].$opened[8].'-'.$this->getMonth($tempMonth).'-'.$opened[0].$opened[1].' '.$opened[10].$opened[11].':'.$opened[13].$opened[14].':'.$opened[16].$opened[17];
		//SET SGT
		$openedSGT = date('Y/m/d H:i:s', strtotime($opened));
		$opened = strtotime(date('Y/m/d H:i:s', strtotime($opened)));
		
		//Convert SLA to SGT. Store it first in a variable, then override data[]
		$temp= new DateTime();
		$yr = $openedSGT[0].$openedSGT[1].$openedSGT[2].$openedSGT[3];
		$month = $openedSGT[5].$openedSGT[6]; 
		$day = $openedSGT[8].$openedSGT[9];
		$hr = $openedSGT[11].$openedSGT[12];
		$min = $openedSGT[14].$openedSGT[15];
		$sec = $openedSGT[17].$openedSGT[18];
		$temp->setDate($yr, $month, $day);
		$temp->setTime($hr, $min, $sec);
		//$temp->setTimeZone(new DateTimeZone('Asia/Singapore'));
		$temp->add(new DateInterval('PT8H'));
		$openedSGT = $temp->format('d-M-y H:i:s');
		
		
		
		//Get GMT Timezone
		date_default_timezone_set('Asia/Singapore');
		$sysdate = strtotime(date('Y/m/d H:i:s'));
		//echo 'Sysdate: '.$sysdate.'<br/><br/>';
		
		
		$min1 = ($sysdate - $opened)/60;
		$min2 = ($sla - $opened)/60;
		//echo 'SLA-Sysdate (MIN1): '.$min1.' minutes. ('.$sla.'-'.$sysdate.')<br/>';
		//echo 'SLA-Opened (MIN2): '.$min2.' minutes. ('.$sla.'-'.$opened.')<br/>';
		
		$sla_perc = round(abs(($min1/$min2)*100),2);
		//echo $sla_perc.'<br/>';
		
		$data[15] = $sla_perc;
		//convert and set all timezones stored in the DB for SLA and OPENED from GMT to SGT:
		$data[9] = $openedSGT;
		$data[10] = $slaSGT;
		
		//Remove ' in title to prevent any SQL error
		$data[3] = str_replace("'","",$data[3]);
		$data[3] = str_replace("\xBF","-",$data[3]);
		$data[3] = str_replace("\xA0","",$data[3]);
		//Replace funky characters such as ç, ã to c, a
		$data[3] = iconv('UTF-8', 'ISO-8859-1//TRANSLIT//IGNORE', $data[3]);
		
		//11-21-2014 - Fix for CI Special Character
		//\xBFHL is a character that looks something like a long -
		$data[8] = str_replace("\xBF","-",$data[8]);
		
		return $data;
	}

}
?>