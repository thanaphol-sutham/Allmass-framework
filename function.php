<?php

function encode_URL($variable)
{
	//-- ฟังก์ชั่นการเข้ารหัส ตัวแปรแบบ GET ผ่าน URL
	$key = "xitgmLwmp";
	$index = 0;
	$temp = "";
	$variable = str_replace("=", "รฐO", $variable);
	for ($i = 0; $i < strlen($variable); $i++) {
		$temp .= $variable{
			$i} . $key{
			$index};
		$index++;
		if ($index >= strlen($key)) $index = 0;
	}
	$variable = strrev($temp);
	$variable = base64_encode($variable);
	$variable = utf8_encode($variable);
	$variable = urlencode($variable);
	$variable = str_rot13($variable);

	$variable = str_replace("%", "o7o", $variable);
	return "valueID=" . $variable;
}

function decode_URL($enVariable)
{
	//-- ฟังก์ชั่นการถอดรหัส ตัวแปรแบบ GET ผ่าน URL
	// การใช้งาน decode_URL($_SERVER["QUERY_STRING"]);
	$key = "xitgmLwmp";
	if (!empty($enVariable)) {
		$ex = explode("valueID=", $enVariable);
		$enVariable = $ex[1];
	} else {
		$enVariable = "";
	}
	$enVariable = str_replace("o7o", "%", $enVariable);

	$enVariable = str_rot13($enVariable);
	$enVariable = urldecode($enVariable);
	$enVariable = utf8_decode($enVariable);
	$enVariable = base64_decode($enVariable);
	$enVariable = strrev($enVariable);

	$current = 0;
	$temp = "";
	for ($i = 0; $i < strlen($enVariable); $i++) {
		if ($current % 2 == 0) {
			$temp .= $enVariable{
				$i};
		}
		$current++;
	}
	$temp = str_replace("รฐO", "=", $temp);

	parse_str($temp, $variable);
	//echo "temp=".$temp;
	foreach ($variable as $key => $value) {
		$_REQUEST[$key] = $value;
		global $$key;
		$$key = $value;
	}
}

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
function get_URL_Parameter()
{
	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
	global $Login_MenuID;
	$Parameter = (strlen($_SERVER["QUERY_STRING"]) > 0) ? "?" . $_SERVER["QUERY_STRING"] : "?" . encode_URL("Login_MenuID=" . $Login_MenuID);
	return 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER["PHP_SELF"] . $Parameter;
}
function strDec($str, $dot = 1)
{
	$mynumber = number_format($str, $dot);
	$zero = formatStringtoZero("0", $dot);
	$mynumber = str_replace("." . $zero, "", $mynumber);
	$dec =  $mynumber;
	return $dec;
}
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
function formatStringtoZero($num, $length)
{
	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
	// การทำงาน สร้างรูปแบบดังนี้ '000000' โดยความยาวนั้นขึ้นอยู่กับ ค่า length แต่ต้องกำหนดให้มากกว่า 1
	$formated_num = strval($num);
	while (strlen($formated_num) < $length) {
		$formated_num = "0" . $formated_num;
	}
	return $formated_num;
}

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
function changeQuot($Data)
{
	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
	return str_replace("'", "&rsquo;", str_replace('"', '&quot;', $Data));
}

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
function rechangeQuot($Data)
{
	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
	return str_replace("&rsquo;", "'", str_replace('&quot;', '"', $Data));
}
function convertdatetodb($mydate, $lang = "Thai", $spd = "/")
{
	if (!empty($mydate)) {
		$arrdate = explode($spd, $mydate);
		if ($lang == "Thai") {
			$newdate = ($arrdate[2] - 543) . "-" . formatStringtoZero($arrdate[1], 2) . "-" . formatStringtoZero($arrdate[0], 2);
		} else {
			$newdate = $arrdate[2] . "-" . formatStringtoZero($arrdate[1], 2) . "-" . formatStringtoZero($arrdate[0], 2);
		}
		return $newdate;
	} else {
		return '0000-00-00';
	}
}
function convertdatefromdb($mydate, $lang = "Thai", $spd = "/")
{
	if ($mydate == '0000-00-00' || $mydate == '0000-00-00 00:00:00') {
		return '';
	} else {
		if (!empty($mydate)) {
			$arrdate = explode("-", $mydate);
			if ($lang == "Thai") {
				$newdate = substr($arrdate[2], 0, 2) . $spd . $arrdate[1] . $spd . (intval($arrdate[0]) + 543);
			} else {
				$newdate = substr($arrdate[2], 0, 2) . $spd . $arrdate[1] . $spd . intval($arrdate[0]);
			}
			/*
			if($lang=="Thai"){
				$newdate = intval($arrdate[2]).$spd.intval($arrdate[1]).$spd.(intval($arrdate[0])+543);
			}else{
				$newdate = intval($arrdate[2]).$spd.intval($arrdate[1]).$spd.intval($arrdate[0]);
			}
*/
			return $newdate;
		} else {
			return '';
		}
	}
}
function convertdatefromdbxx($mydate, $lang = "Thai", $spd = "/")
{
	if (strlen($mydate) < 2) $mydate == '0000-00-00';
	if ($mydate == '0000-00-00' || $mydate == '0000-00-00 00:00:00') {
		return '';
	} else {
		if (!empty($mydate)) {
			$arrdate = explode("-", $mydate);
			if ($lang == "Thai") {
				$newdate = substr($arrdate[2], 0, 2) . $spd . $arrdate[1] . $spd . (intval($arrdate[0]) + 543);
			} else {
				$newdate = substr($arrdate[2], 0, 2) . $spd . $arrdate[1] . $spd . intval($arrdate[0]);
			}
			return $newdate;
		} else {
			return '';
		}
	}
}
function dateformat($d, $t = 'F j, Y', $lang = 'English')
{
	$t = str_replace(array('Y', 'y', 'F'), array('__{Y}__', '__{y}__', '{F}'), $t);
	if (!empty($d)) {
		if (trim($d) == "0000-00-00" || trim($d) == "0000-00-00 00:00:00") {
			return 'N/A';
		} else {
			list($date, $time) = explode(' ', $d); //2011-01-01 01:23:45 => [2011-01-01,01:23:45]
			list($y, $m, $d) = explode('-', $date); //2011-01-01 => [2011,01,01]
			list($h, $i, $s) = explode(':', $time); //01:23:45 => [01,23,45]
			if ($h == '') {
				$h = 0;
			}
			if ($i == '') {
				$i = 0;
			}
			if ($s == '') {
				$s = 0;
			}
			$date = date($t, mktime($h, $i, $s, $m, $d, $y));
			if ($lang <> 'English') {
				$date = convertdatelang($date);
			}
			$date = str_replace(array('__{', '}__', '{', '}'), '', $date);
			return $date;
		}
	} else {
		return 'N/A';
	}
}
function convertdatelang($date)
{
	$end = current(array_slice(explode('__{', $date), -1));
	$findYear = $end;
	$first = explode('}__', $findYear);
	$findYear = $first[0];
	//$findYear = end(explode('__{',$date)); //__{2011}__-01-01 01:02:03 => 2011}__-01-01 01:02:03
	//$findYear = reset(explode('}__',$findYear)); //2011}__-01-01 01:02:03 => 2011
	$yearDigit = strlen($findYear);

	//default
	$arrFullTxtDay = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
	$arrTxtDay = array('Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun');
	$arrFullTxtMonth = array('{January}', '{February}', '{March}', '{April}', '{May}', '{June}', '{July}', '{August}', '{September}', '{October}', '{November}', '{December}');
	$arrTxtMonth = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');

	//convert
	$arrFullTxtDayConv = array('จันทร์', 'อังคาร', 'พุธ', 'พฤหัสบดี', 'ศุกร์', 'เสาร์', 'อาทิตย์');
	$arrTxtDayConv = array('จ', 'อ', 'พ', 'พฤ', 'ศ', 'ส', 'อา');
	$arrFullTxtMonthConv = array('มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม');
	$arrTxtMonthConv = array('ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.');

	$date = str_replace($arrFullTxtDay, $arrFullTxtDayConv, $date);
	$date = str_replace($arrTxtDay, $arrTxtDayConv, $date);
	$date = str_replace($arrFullTxtMonth, $arrFullTxtMonthConv, $date);
	$date = str_replace($arrTxtMonth, $arrTxtMonthConv, $date);
	if ($yearDigit == '2') {
		$yth = $findYear + 43;
	}
	if ($yearDigit == '4') {
		$yth = $findYear + 543;
	}
	$date = str_replace('__{' . $findYear . '}__', $yth, $date);

	return $date;
}

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
function ShowDateLongWithBE($myDate, $Language = "Thai")
{
	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
	if (trim($myDate) == "0000-00-00" || trim($myDate) == "0000-00-00 00:00:00") {
		return "N/A";
	} else {
		if ($Language == "Thai") {
			$myDateArray = explode("-", $myDate);
			$myDay = sprintf("%d", $myDateArray[2]);
			switch ($myDateArray[1]) {
				case "01":
					$myMonth = "มกราคม";
					break;
				case "02":
					$myMonth = "กุมภาพันธ์";
					break;
				case "03":
					$myMonth = "มีนาคม";
					break;
				case "04":
					$myMonth = "เมษายน";
					break;
				case "05":
					$myMonth = "พฤษภาคม";
					break;
				case "06":
					$myMonth = "มิถุนายน";
					break;
				case "07":
					$myMonth = "กรกฎาคม";
					break;
				case "08":
					$myMonth = "สิงหาคม";
					break;
				case "09":
					$myMonth = "กันยายน";
					break;
				case "10":
					$myMonth = "ตุลาคม";
					break;
				case "11":
					$myMonth = "พฤศจิกายน";
					break;
				case "12":
					$myMonth = "ธันวาคม";
					break;
			}
			$myYear = sprintf("%d", $myDateArray[0]) + 543;
			return ($myDay . " " . $myMonth . " พ.ศ. " . $myYear);
		} else {
			$myDateArray = explode("-", $myDate);
			$myDay = sprintf("%d", $myDateArray[2]);
			switch ($myDateArray[1]) {
				case "01":
					$myMonth = "January";
					break;
				case "02":
					$myMonth = "February";
					break;
				case "03":
					$myMonth = "March";
					break;
				case "04":
					$myMonth = "April";
					break;
				case "05":
					$myMonth = "May";
					break;
				case "06":
					$myMonth = "June";
					break;
				case "07":
					$myMonth = "July";
					break;
				case "08":
					$myMonth = "August";
					break;
				case "09":
					$myMonth = "September";
					break;
				case "10":
					$myMonth = "October";
					break;
				case "11":
					$myMonth = "November";
					break;
				case "12":
					$myMonth = "December";
					break;
			}
			$myYear = sprintf("%d", $myDateArray[0]);
			return ($myDay . " " . $myMonth . " " . $myYear);
		}
	}
}
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
function ShowDateLong($myDate, $Language = "Thai")
{
	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
	if (trim($myDate) == "0000-00-00" || trim($myDate) == "0000-00-00 00:00:00") {
		return "N/A";
	} else {
		if ($Language == "Thai") {
			$myDateArray = explode("-", $myDate);
			$myDay = sprintf("%d", $myDateArray[2]);
			switch ($myDateArray[1]) {
				case "01":
					$myMonth = "มกราคม";
					break;
				case "02":
					$myMonth = "กุมภาพันธ์";
					break;
				case "03":
					$myMonth = "มีนาคม";
					break;
				case "04":
					$myMonth = "เมษายน";
					break;
				case "05":
					$myMonth = "พฤษภาคม";
					break;
				case "06":
					$myMonth = "มิถุนายน";
					break;
				case "07":
					$myMonth = "กรกฎาคม";
					break;
				case "08":
					$myMonth = "สิงหาคม";
					break;
				case "09":
					$myMonth = "กันยายน";
					break;
				case "10":
					$myMonth = "ตุลาคม";
					break;
				case "11":
					$myMonth = "พฤศจิกายน";
					break;
				case "12":
					$myMonth = "ธันวาคม";
					break;
			}
			$myYear = sprintf("%d", $myDateArray[0]) + 543;
			return ($myDay . " " . $myMonth . " " . $myYear);
		} else {
			$myDateArray = explode("-", $myDate);
			$myDay = sprintf("%d", $myDateArray[2]);
			switch ($myDateArray[1]) {
				case "01":
					$myMonth = "January";
					break;
				case "02":
					$myMonth = "February";
					break;
				case "03":
					$myMonth = "March";
					break;
				case "04":
					$myMonth = "April";
					break;
				case "05":
					$myMonth = "May";
					break;
				case "06":
					$myMonth = "June";
					break;
				case "07":
					$myMonth = "July";
					break;
				case "08":
					$myMonth = "August";
					break;
				case "09":
					$myMonth = "September";
					break;
				case "10":
					$myMonth = "October";
					break;
				case "11":
					$myMonth = "November";
					break;
				case "12":
					$myMonth = "December";
					break;
			}
			$myYear = sprintf("%d", $myDateArray[0]);
			return ($myDay . " " . $myMonth . " " . $myYear);
		}
	}
}
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
function ShowDateShot($myDate, $Language = "Thai")
{
	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
	if (trim($myDate) == "0000-00-00" || trim($myDate) == "0000-00-00 00:00:00") {
		return "N/A";
	} else {
		if ($Language == "Thai") {
			$myDateArray = explode("-", $myDate);
			$myDay = sprintf("%d", $myDateArray[2]);
			switch ($myDateArray[1]) {
				case "01":
					$myMonth = "ม.ค.";
					break;
				case "02":
					$myMonth = "ก.พ.";
					break;
				case "03":
					$myMonth = "มี.ค.";
					break;
				case "04":
					$myMonth = "เม.ย.";
					break;
				case "05":
					$myMonth = "พ.ค.";
					break;
				case "06":
					$myMonth = "มิ.ย.";
					break;
				case "07":
					$myMonth = "ก.ค.";
					break;
				case "08":
					$myMonth = "ส.ค.";
					break;
				case "09":
					$myMonth = "ก.ย.";
					break;
				case "10":
					$myMonth = "ต.ค.";
					break;
				case "11":
					$myMonth = "พ.ย.";
					break;
				case "12":
					$myMonth = "ธ.ค.";
					break;
			}
			$myYear = sprintf("%d", $myDateArray[0]) + 543;
			return ($myDay . "/" . $myMonth . "/" . substr($myYear, 2, 2));
		} else {
			$myDateArray = explode("-", $myDate);
			$myDay = sprintf("%d", $myDateArray[2]);
			switch ($myDateArray[1]) {
				case "01":
					$myMonth = "Jan";
					break;
				case "02":
					$myMonth = "Feb";
					break;
				case "03":
					$myMonth = "Mar";
					break;
				case "04":
					$myMonth = "Apr";
					break;
				case "05":
					$myMonth = "May";
					break;
				case "06":
					$myMonth = "June";
					break;
				case "07":
					$myMonth = "July";
					break;
				case "08":
					$myMonth = "Aug";
					break;
				case "09":
					$myMonth = "Sep";
					break;
				case "10":
					$myMonth = "Oct";
					break;
				case "11":
					$myMonth = "Nov";
					break;
				case "12":
					$myMonth = "Dec";
					break;
			}
			$myYear = sprintf("%d", $myDateArray[0]);
			return ($myDay . " " . $myMonth . " " . substr($myYear, 2, 2));
		}
	}
}

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
function ShowampmDate($myTime)
{
	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
	if (trim($myTime) <> "0000-00-00 00:00:00") {
		$TmpTime = explode(" ", $myTime);
		$timeArr = explode(":", $TmpTime[1]);
		$hour = intval($timeArr[0]);
		if ($hour < 13) {
			$ampm = "AM";
			if (strlen($hour) == 1) {
				$newHour = "0" . $hour;
			} else {
				$newHour = $hour;
			}
		} else {
			$ampm = "PM";
			$newHour = $hour - 12;

			if (strlen($newHour) == 1) {
				$newHour = "0" . $newHour;
			} else {
				$newHour = $newHour;
			}
		}

		$newTime = $newHour . ":" . $timeArr[1] . " " . $ampm;
		return $newTime;
	}
}

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
function convertTimeAMPMto24hour($myTime)
{
	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
	$newTime = $myTime;
	if (!empty($myTime)) {
		$newTime = date("H:i:s", strtotime($myTime));
	}
	return $newTime;
}

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
function convertTime24hourtoAMPM($myTime)
{
	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
	$newTime = $myTime;
	if (!empty($myTime)) {
		$newTime = date("h:i A", strtotime($myTime));
	}
	return $newTime;
}

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
function setQuoteSql($value)
{
	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
	# copy มาจากเน็ต เอาไว้ใช้ป้องกัน อักขระ แปลกๆก่อนนำไปใช้ในการ Query
	# Stripslashes if quoted
	if (get_magic_quotes_gpc()) {
		$value = stripslashes($value);
	}
	return $value;
}

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
function getHtmlFile($myFile, $length = 0)
{
	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
	if (file_exists($myFile) && is_file($myFile)) {
		$content = file_get_contents($myFile);
		if ($length > 0) {
			$content = substr($content, 0, $length);
		}

		return $content;
	}
}
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
function UTF8toiso8859_11($string)
{
	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
	if (!ereg("[\241-\377]", $string))
		return $string;

	$UTF8 = array(
		"\xe0\xb8\x81" => "\xa1",
		"\xe0\xb8\x82" => "\xa2",
		"\xe0\xb8\x83" => "\xa3",
		"\xe0\xb8\x84" => "\xa4",
		"\xe0\xb8\x85" => "\xa5",
		"\xe0\xb8\x86" => "\xa6",
		"\xe0\xb8\x87" => "\xa7",
		"\xe0\xb8\x88" => "\xa8",
		"\xe0\xb8\x89" => "\xa9",
		"\xe0\xb8\x8a" => "\xaa",
		"\xe0\xb8\x8b" => "\xab",
		"\xe0\xb8\x8c" => "\xac",
		"\xe0\xb8\x8d" => "\xad",
		"\xe0\xb8\x8e" => "\xae",
		"\xe0\xb8\x8f" => "\xaf",
		"\xe0\xb8\x90" => "\xb0",
		"\xe0\xb8\x91" => "\xb1",
		"\xe0\xb8\x92" => "\xb2",
		"\xe0\xb8\x93" => "\xb3",
		"\xe0\xb8\x94" => "\xb4",
		"\xe0\xb8\x95" => "\xb5",
		"\xe0\xb8\x96" => "\xb6",
		"\xe0\xb8\x97" => "\xb7",
		"\xe0\xb8\x98" => "\xb8",
		"\xe0\xb8\x99" => "\xb9",
		"\xe0\xb8\x9a" => "\xba",
		"\xe0\xb8\x9b" => "\xbb",
		"\xe0\xb8\x9c" => "\xbc",
		"\xe0\xb8\x9d" => "\xbd",
		"\xe0\xb8\x9e" => "\xbe",
		"\xe0\xb8\x9f" => "\xbf",
		"\xe0\xb8\xa0" => "\xc0",
		"\xe0\xb8\xa1" => "\xc1",
		"\xe0\xb8\xa2" => "\xc2",
		"\xe0\xb8\xa3" => "\xc3",
		"\xe0\xb8\xa4" => "\xc4",
		"\xe0\xb8\xa5" => "\xc5",
		"\xe0\xb8\xa6" => "\xc6",
		"\xe0\xb8\xa7" => "\xc7",
		"\xe0\xb8\xa8" => "\xc8",
		"\xe0\xb8\xa9" => "\xc9",
		"\xe0\xb8\xaa" => "\xca",
		"\xe0\xb8\xab" => "\xcb",
		"\xe0\xb8\xac" => "\xcc",
		"\xe0\xb8\xad" => "\xcd",
		"\xe0\xb8\xae" => "\xce",
		"\xe0\xb8\xaf" => "\xcf",
		"\xe0\xb8\xb0" => "\xd0",
		"\xe0\xb8\xb1" => "\xd1",
		"\xe0\xb8\xb2" => "\xd2",
		"\xe0\xb8\xb3" => "\xd3",
		"\xe0\xb8\xb4" => "\xd4",
		"\xe0\xb8\xb5" => "\xd5",
		"\xe0\xb8\xb6" => "\xd6",
		"\xe0\xb8\xb7" => "\xd7",
		"\xe0\xb8\xb8" => "\xd8",
		"\xe0\xb8\xb9" => "\xd9",
		"\xe0\xb8\xba" => "\xda",
		"\xe0\xb8\xbf" => "\xdf",
		"\xe0\xb9\x80" => "\xe0",
		"\xe0\xb9\x81" => "\xe1",
		"\xe0\xb9\x82" => "\xe2",
		"\xe0\xb9\x83" => "\xe3",
		"\xe0\xb9\x84" => "\xe4",
		"\xe0\xb9\x85" => "\xe5",
		"\xe0\xb9\x86" => "\xe6",
		"\xe0\xb9\x87" => "\xe7",
		"\xe0\xb9\x88" => "\xe8",
		"\xe0\xb9\x89" => "\xe9",
		"\xe0\xb9\x8a" => "\xea",
		"\xe0\xb9\x8b" => "\xeb",
		"\xe0\xb9\x8c" => "\xec",
		"\xe0\xb9\x8d" => "\xed",
		"\xe0\xb9\x8e" => "\xee",
		"\xe0\xb9\x8f" => "\xef",
		"\xe0\xb9\x90" => "\xf0",
		"\xe0\xb9\x91" => "\xf1",
		"\xe0\xb9\x92" => "\xf2",
		"\xe0\xb9\x93" => "\xf3",
		"\xe0\xb9\x94" => "\xf4",
		"\xe0\xb9\x95" => "\xf5",
		"\xe0\xb9\x96" => "\xf6",
		"\xe0\xb9\x97" => "\xf7",
		"\xe0\xb9\x98" => "\xf8",
		"\xe0\xb9\x99" => "\xf9",
		"\xe0\xb9\x9a" => "\xfa",
		"\xe0\xb9\x9b" => "\xfb",
	);

	$string = strtr($string, $UTF8);
	return $string;
}

function getDateNow()
{
	$today = getdate();
	$Day = $today[mday];
	$Month = $today[mon];
	$Year = $today[year];
	$DateIs = sprintf("%04d-%02d-%02d", $Year, $Month, $Day);
	return ($DateIs);
}

function getTimeNow()
{
	$today = getdate();
	$SS = $today[seconds];
	$MM = $today[minutes];
	$HH = $today[hours];
	$DateIs = sprintf("%02d:%02d:%02d", $HH, $MM, $SS);
	return ($DateIs);
}

//#################################################
function getEndDayOfMonth($myDate)
{
	//#################################################
	$myEndOfMonth = array(0, 31, 0, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
	$myDateArray = explode("-", $myDate);
	$myMonth = $myDateArray[1] * 1;
	$myYear = $myDateArray[0] * 1;
	if ($myMonth >= 1 && $myMonth <= 12) {
		if ($myMonth == 2) {
			//check leap year ---
			if (($myYear % 4) == 0) {
				return 29;
			} else {
				return 28;
			}
		} else {
			return $myEndOfMonth[$myMonth];
		}
	} else {
		return 0;
	}
}

function getPHPVersion($int = 'full')
{
	if ($int == 'short') {
		return (int)phpversion();
	} else {
		return phpversion();
	}
}

function getDBVersion()
{
	$t = mysql_query("select version() as ve");
	$r = mysql_fetch_object($t);
	$iArray = explode('.', $r->ve);
	$iVersion = $iArray[0] . $iArray[1];
	return (int)$iVersion;
}
function sql_safe($value, $allow_wildcards = false, $detect_numeric = false)
{
	//return htmlspecialchars($value,ENT_QUOTES);
	if ($detect_numeric) {
		if (is_numeric($value)) {
			$value = addslashes(stripslashes($value));
		} else {
			$value = "'" . addslashes(stripslashes($value)) . "'";
		}
	} else {
		if (get_magic_quotes_gpc()) {
			if (ini_get('magic_quotes_sybase')) {
				$value = addslashes(str_replace("''", "'", $value));
			} else {
				$value = addslashes(stripslashes($value));
			}
		}
	}
	return $value;
}
function echoDetailIntitle($data)
{
	$mydetail = htmlspecialchars_decode(stripcslashes($data), ENT_NOQUOTES);
	$HTMLData = strip_tags($mydetail);
	$HTMLData = strlimit($HTMLData, 250);
	return $HTMLData;
}

function echoDetailCKEditer($data)
{
	$mydetail = htmlspecialchars_decode(rechangeQuot($data), ENT_NOQUOTES);
	return $mydetail;
}
function echoDetailToediter($data)
{
	$mydetail = rechangeQuot(htmlspecialchars_decode(stripcslashes($data), ENT_NOQUOTES));
	return $mydetail;
}
function echoDetailTooneline($data)
{
	$mydetail = str_replace('<br />', ' ', rechangeQuot(htmlspecialchars_decode(stripcslashes($data), ENT_NOQUOTES)));
	return $mydetail;
}
function encodeFromCKEditer($value)
{
	$detail = preg_replace("/[\n\r]/", "", $value);
	//$detail = str_replace('<br /><br />','<br />', $detail);
	return $detail;
}
function encodetxterea($value)
{
	$detail = str_replace(PHP_EOL, "<br />", $value);
	$detail = preg_replace("/[\n\r]/", "<br />", $value);
	$detail = str_replace('<br /><br />', '<br />', $detail);
	return $detail;
}
function decodetxterea($value)
{
	$detail = str_replace("&lt;br /&gt;", PHP_EOL, $value);
	return $detail;
}

function BBCode($str)
{
	$myUID =  uniqid();
	$simple_search = array(
		'/\[b\](.*?)\[\/b\]/is',
		'/\[i\](.*?)\[\/i\]/is',
		'/\[u\](.*?)\[\/u\]/is',
		'/\[url\=(.*?)\](.*?)\[\/url\]/is',
		'/\[url\](.*?)\[\/url\]/is',
		'/(&gt;&gt;)([0-9]+)/',
		'/\[img\](.*?)\[\/img\]/is',
		'/\[youtube\]http:\/\/(?:www\.)?youtube\.com\/watch\?v=(.*?)\[\/youtube\]/i',
		'/\[youtube\]http:\/\/?youtu\.be\/(.*?)\[\/youtube\]/i',
		'/\[flash=(.*?),(.*?)\](.*?)\[\/flash\]/is',
		'/\[flv\](.*?)\[\/flv\]/is',
		'/\[em\](.*?)\[\/em\]/is',
		'/\[txt\](.*?)\[\/txt\]/is'
	);
	$simple_replace = array(
		'<strong>$1</strong>',
		'<em>$1</em>',
		'<u>$1</u>',
		'<a href="$1">$2</a>',
		'<a href="$1">[link]</a>',
		'<a href=\'index.php#$2\'>$1$2</a>',
		'<a href="$1"><img src="$1" boarder=0 /></a>',
		'<iframe width="480" height="385" src="http://www.youtube.com/embed/$1" frameborder="0" allowfullscreen></iframe>',
		'<iframe width="480" height="385" src="http://www.youtube.com/embed/$1" frameborder="0" allowfullscreen></iframe>',
		'<object width="$1" height="$2"><param name="movie" value="$3"></param><param name="wmode" value="transparent"></param><embed src="$3" type="application/x-shockwave-flash" wmode="transparent" width="$1" height="$2"></embed></object>',
		'<a  href="$1" style="display:block;width:480px;height:385px" id="player' . $myUID . '"></a><script> flowplayer("player' . $myUID . '", "js/flowplayer-3.1.5.swf");</script>',
		'<div class="code">$1</div>'
	);
	// Do simple BBCode's
	$str = preg_replace($simple_search, $simple_replace, trim(remove_newline($str)));

	return $str;
}
function remove_newline($document)
{
	$pat[0] = "/^\s+/";
	$pat[1] = "/\s{2,}/";
	$pat[2] = "/\s+\$/";
	$rep[0] = "";
	$rep[1] = " ";
	$rep[2] = "";

	if (stristr($_SERVER['HTTP_USER_AGENT'], 'WIN')) {
		$document = str_replace("\r\n", "<br/>", $document);
	} else {
		$document = str_replace("\n", "<br/>", $document);
	}
	$document = preg_replace($pat, $rep, $document);
	return $document;
}
function setObjectWH($mSrc, $mW = "320", $mH = "240")
{
	$pattern = "/width=\"[0-9]*\"/";
	$content = preg_replace($pattern, 'width="' . $mW . '"', $mSrc);
	$pattern = "/height=\"[0-9]*\"/";
	$content = preg_replace($pattern, 'height="' . $mH . '"', $content);

	$pattern = "/width=\'[0-9]*\'/";
	$content = preg_replace($pattern, "width='" . $mW . "'", $content);
	$pattern = "/height=\'[0-9]*\'/";
	$content = preg_replace($pattern, "height='" . $mH . "'", $content);

	return $content;
}

function get_real_ip()
{
	$ip = false;
	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		$ip = $_SERVER['HTTP_CLIENT_IP'];
	}
	if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$ips = explode(", ", $_SERVER['HTTP_X_FORWARDED_FOR']);
		if ($ip) {
			array_unshift($ips, $ip);
			$ip = false;
		}
		for ($i = 0; $i < count($ips); $i++) {
			if (!preg_match("/^(10|172\.16|192\.168)\./i", $ips[$i])) {
				if (version_compare(phpversion(), "5.0.0", ">=")) {
					if (ip2long($ips[$i]) != false) {
						$ip = $ips[$i];
						break;
					}
				} else {
					if (ip2long($ips[$i]) != -1) {
						$ip = $ips[$i];
						break;
					}
				}
			}
		}
	}
	return ($ip ? $ip : $_SERVER['REMOTE_ADDR']);
}

function getPrivateIP()
{
	# ฟังก์ชั่นการ ดึงเอา IP ปลอม ออกมา
	if (isset($_SERVER)) {
		if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
			$IP = $_SERVER['HTTP_X_FORWARDED_FOR'];
		elseif (isset($_SERVER['HTTP_CLIENT_IP']))
			$IP = $_SERVER['HTTP_CLIENT_IP'];
		else
			$IP = $_SERVER['REMOTE_ADDR'];
	} else {
		if (getenv('HTTP_X_FORWARDED_FOR'))
			$IP = getenv('HTTP_X_FORWARDED_FOR');
		elseif (getenv('HTTP_CLIENT_IP'))
			$IP = getenv('HTTP_CLIENT_IP');
		else
			$IP = getenv('REMOTE_ADDR');
	}
	$IP = spliti(",", $IP, 2);
	return $IP[0];
}
function checkBBCodeVDO($str)
{
	$str = "[Link]" . $str . "[/Link]";
	$myUID =  uniqid();
	$simple_search = array(
		'/\[Link\]http:\/\/(?:www\.)?youtube\.com\/watch\?v=(.*?)\[\/Link\]/i',
		'/\[Link\]https:\/\/(?:www\.)?youtube\.com\/watch\?v=(.*?)\[\/Link\]/i',
		'/\[Link\]http:\/\/?youtu\.be\/(.*?)\[\/Link\]/i',
		'/\[Link\]https:\/\/?youtu\.be\/(.*?)\[\/Link\]/i'
	);
	$simple_replace = array(
		'<iframe width="480" height="385" src="http://www.youtube.com/embed/$1" frameborder="0" allowfullscreen></iframe>',
		'<iframe width="480" height="385" src="https://www.youtube.com/embed/$1" frameborder="0" allowfullscreen></iframe>',
		'<iframe width="480" height="385" src="http://www.youtube.com/embed/$1" frameborder="0" allowfullscreen></iframe>',
		'<iframe width="480" height="385" src="https://www.youtube.com/embed/$1" frameborder="0" allowfullscreen></iframe>'
	);
	// Do simple BBCode's
	$str = preg_replace($simple_search, $simple_replace, trim(remove_newline($str)));

	return $str;
}
function strlimit($s, $n)
{
	if (iconv_strlen($s, 'UTF-8') > $n)
		return iconv_substr($s, 0, $n, "UTF-8") . "..";
	else
		return $s;
}
function tis620_to_utf8($string)
{
	for ($i = 0; $i < strlen($string); $i++) {
		$s = substr($string, $i, 1);
		$val = ord($s);
		if ($val < 0x80) {
			$utf8 .= $s;
		} elseif ((0xA1 <= $val and $val <= 0xDA) or (0xDF <= $val and $val <= 0xFB)) {
			$unicode = 0x0E00 + $val - 0xA0;
			$utf8 .= chr(0xE0 | ($unicode >> 12));
			$utf8 .= chr(0x80 | (($unicode >> 6) & 0x3F));
			$utf8 .= chr(0x80 | ($unicode & 0x3F));
		}
	}
	return $utf8;
}
function utf8_to_tis620($string)
{
	$str = $string;
	$res = '';
	for ($i = 0; $i < strlen($str); $i++) {
		if (ord($str[$i]) == 224) {
			$unicode = ord($str[$i + 2]) & 0x3F;
			$unicode |= (ord($str[$i + 1]) & 0x3F) << 6;
			$unicode |= (ord($str[$i]) & 0x0F) << 12;
			$res .= chr($unicode - 0x0E00 + 0xA0);
			$i += 2;
		} else {
			$res .= $str[$i];
		}
	}
	return $res;
}
function imageManip($data)
{
	// match all image tags (thanks to Jan Reiter)
	@preg_match_all("/\< *[img][^\>]*[.]*\>/i", $data, $matches);

	if (is_array($matches[0])) {
		// put all those image tags in one string, since preg match all needs the data
		// to be in a string format
		foreach ($matches[0] as $match) {
			$imageMatch .= $match;
		}

		// match all source links within the original preg match all output
		@preg_match_all("/src=\"(.+?)\"/i", $imageMatch, $m);

		// for each match that has the same key as the second match, replace the entire
		// tag with my <img> tag that includes width, height and border="0"
		foreach ($matches[0] as $imageTagKey => $imageTag) {
			foreach ($m[1] as $imageSrcKey => $imageSrc) {
				if ($imageTagKey == $imageSrcKey) {
					//$imageStats = imageProportions($imageSrc);

					$data = str_replace($imageTag, "<img src=\"" . $imageSrc . "\"  border=\"0\" />", $data);
				}
			}
		}
	}

	return $data;
}

function wordWrapIgnoreHTML($string, $length = 45, $wrapString = "\n")
{
	$wrapped = '';
	$word = '';
	$html = false;
	$string = (string) $string;
	for ($i = 0; $i < strlen($string); $i += 1) {
		$char = $string[$i];

		/** HTML Begins */
		if ($char === '<') {
			if (!empty($word)) {
				$wrapped .= $word;
				$word = '';
			}

			$html = true;
			$wrapped .= $char;
		}

		/** HTML ends */
		elseif ($char === '>') {
			$html = false;
			$wrapped .= $char;
		}

		/** If this is inside HTML -> append to the wrapped string */
		elseif ($html) {
			$wrapped .= $char;
		}

		/** Whitespace characted / new line */
		elseif ($char === ' ' || $char === "\t" || $char === "\n") {
			$wrapped .= $word . $char;
			$word = '';
		}

		/** Check chars */
		else {
			$word .= $char;

			if (strlen($word) > $length) {
				$wrapped .= $word . $wrapString;
				$word = '';
			}
		}
	}

	if ($word !== '') {
		$wrapped .= $word;
	}

	return $wrapped;
}

function formatSizeUnits($bytes)
{
	if ($bytes >= 1073741824) {
		$bytes = number_format($bytes / 1073741824, 2) . ' GB';
	} elseif ($bytes >= 1048576) {
		$bytes = number_format($bytes / 1048576, 2) . ' MB';
	} elseif ($bytes >= 1024) {
		$bytes = number_format($bytes / 1024, 2) . ' KB';
	} elseif ($bytes > 1) {
		$bytes = $bytes . ' bytes';
	} elseif ($bytes == 1) {
		$bytes = $bytes . ' byte';
	} else {
		$bytes = '0 bytes';
	}
	return $bytes;
}

function postWithBadword($str)
{
	$bad_words = getBadWord();
	$filtered_string = str_ireplace(array_values($bad_words), array_keys($bad_words), $str);
	return $filtered_string;
}
function getURL()
{
	$Parameter = (strlen($_SERVER["QUERY_STRING"]) > 0) ? "?" . $_SERVER["QUERY_STRING"] : "";
	return 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER["PHP_SELF"] . $Parameter; #$_SERVER['REQUEST_URI'];
}
function date_diff_d($start, $end = "now")
{
	if ($end == "now") {
		$end = date("Y-m-d H:i:s");
	} else {
		$end = $end;
	}
	$sdate = strtotime($start);
	$edate = strtotime($end);
	$time = $edate - $sdate;
	if ($time >= 86400) {
		// Days + Hours + Minutes
		$pday = ($edate - $sdate) / 86400;
		$preday = explode('.', $pday);
		$timeshift = $preday[0];
	}
	return $timeshift;
}
function array_merge_default($default, $data)
{
	$intersect = array_intersect_key($data, $default); //Get data for which a default exists
	$diff = array_diff_key($default, $data); //Get defaults which are not present in data
	return $diff + $intersect; //Arrays have different keys, return the union of the two
}
function generate_password($length = 20)
{
	//$chars =  'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'.'0123456789``-=~!@#$%^&*()_+,./<>?;:[]{}\|';
	/*
	$chars =  'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'.'0123456789-=!@#$%^&*()_+,./<>?:[]{}\|';
	  $str = '';
	  $max = strlen($chars) - 1;
	  for ($i=0; $i <= $length; $i++)
		$str .= $chars[mt_rand(0, $max)];
	*/
	$UpperChar = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$LowerChar = 'abcdefghijklmnopqrstuvwxyz';
	$Number = '0123456789';
	$SpChar = '-=!@#$%^&*()_+,./<>?:[]{}|';

	$countst01 = round((20 * $length) / 100);
	$countst02 = round((40 * $length) / 100);
	$countst03 = round((30 * $length) / 100);
	$countst04 = round((10 * $length) / 100);

	$randomString01 = substr(str_shuffle($UpperChar), 0, $countst01);
	$randomString02 = substr(str_shuffle($LowerChar), 0, $countst02);
	$randomString03 = substr(str_shuffle($Number), 0, $countst03);
	$randomString04 = substr(str_shuffle($SpChar), 0, $countst04);

	$str = $randomString01 . $randomString02 . $randomString03 . $randomString04;
	$str = str_shuffle($str);
	return $str;
}
function emoticons($text)
{
	$text = nl2br($text);
	$icons = array(
		'(:01:)'   =>  '<img src="' . _HTTP_PATH_ . '/images/admin_images/emo/ball/01.png" class="emo1"/>',
		'(:02:)'   =>  '<img src="' . _HTTP_PATH_ . '/images/admin_images/emo/ball/02.png" class="emo1"/>',
		'(:03:)'   =>  '<img src="' . _HTTP_PATH_ . '/images/admin_images/emo/ball/03.png" class="emo3"/>',
		'(:04:)'   =>  '<img src="' . _HTTP_PATH_ . '/images/admin_images/emo/ball/04.png" class="emo3"/>',
		'(:05:)'   =>  '<img src="' . _HTTP_PATH_ . '/images/admin_images/emo/ball/05.png" class="emo3"/>',
		'(:06:)'   =>  '<img src="' . _HTTP_PATH_ . '/images/admin_images/emo/ball/06.png" class="emo3"/>',
		'(:07:)'   =>  '<img src="' . _HTTP_PATH_ . '/images/admin_images/emo/ball/07.png" class="emo3"/>',
		'(:08:)'   =>  '<img src="' . _HTTP_PATH_ . '/images/admin_images/emo/ball/08.png" class="emo3"/>',
		'(:09:)'   =>  '<img src="' . _HTTP_PATH_ . '/images/admin_images/emo/ball/09.png" class="emo3"/>',
		'(:10:)'   =>  '<img src="' . _HTTP_PATH_ . '/images/admin_images/emo/ball/10.png" class="emo3"/>',
		'(:11:)'   =>  '<img src="' . _HTTP_PATH_ . '/images/admin_images/emo/ball/11.png" class="emo3"/>',
		'(:12:)'   =>  '<img src="' . _HTTP_PATH_ . '/images/admin_images/emo/ball/12.png" class="emo3"/>',
		'(:13:)'   =>  '<img src="' . _HTTP_PATH_ . '/images/admin_images/emo/ball/13.png" class="emo3"/>',

		'(:w001:)'   =>  '<img src="' . _HTTP_PATH_ . '/images/admin_images/emo/whitehead/white-head-emoticon-001.gif" class="emo1"/>',
		'(:w002:)'   =>  '<img src="' . _HTTP_PATH_ . '/images/admin_images/emo/whitehead/white-head-emoticon-002.gif" class="emo1"/>',
		'(:w003:)'   =>  '<img src="' . _HTTP_PATH_ . '/images/admin_images/emo/whitehead/white-head-emoticon-003.gif" class="emo3"/>',
		'(:w004:)'   =>  '<img src="' . _HTTP_PATH_ . '/images/admin_images/emo/whitehead/white-head-emoticon-004.gif" class="emo3"/>',
		'(:w005:)'   =>  '<img src="' . _HTTP_PATH_ . '/images/admin_images/emo/whitehead/white-head-emoticon-005.gif" class="emo3"/>',
		'(:w006:)'   =>  '<img src="' . _HTTP_PATH_ . '/images/admin_images/emo/whitehead/white-head-emoticon-006.gif" class="emo3"/>',
		'(:w007:)'   =>  '<img src="' . _HTTP_PATH_ . '/images/admin_images/emo/whitehead/white-head-emoticon-007.gif" class="emo3"/>',
		'(:w008:)'   =>  '<img src="' . _HTTP_PATH_ . '/images/admin_images/emo/whitehead/white-head-emoticon-008.gif" class="emo3"/>',
		'(:w009:)'   =>  '<img src="' . _HTTP_PATH_ . '/images/admin_images/emo/whitehead/white-head-emoticon-009.gif" class="emo3"/>'

	);
	$text = " " . $text . " ";
	foreach ($icons as $search => $replace) {
		$text = str_replace(" " . $search . " ", " " . $replace . " ", $text);
	}
	return trim($text);
}
function generate_code($option)
{
	$txt = $option["prefix"];
	$txttable = $option["table"];
	$txtfield = $option["table"] . "_" . $option["field"];
	if (!empty($option["flag"])) {
		$txtflag = $option["table"] . "_" . $option["flag"];
	}
	//--
	$prelen = strlen($txt) + $option["numberlength"];
	//--
	$sql = "SELECT * FROM ";
	$sql .= " (";
	$sql .= "SELECT " . $txtfield . ",CONCAT(REPLACE(LEFT(" . $txtfield . ", 1), '_', ''),SUBSTRING(" . $txtfield . ", 2)) AS NewSeNo FROM " . $txttable;
	if (is_array($option["where"])) {
		$num = count($option["where"]);
		$sql .= " WHERE ";
		if ($num > 0) {
			$i = 0;
			foreach ($option["where"] as $key => $val) {
				if ($i > 0) {
					$sql .= ' AND ';
				}
				$sql .= $key . $val;
				$i++;
			}
		}
	} else {
		$sql .= " WHERE 1";
	}
	if (!empty($option["flag"])) {
		$sql .= " AND " . $txtflag . " = 0";
	}
	$sql .= ") base WHERE 1 ";
	//$sql .= " AND CHAR_LENGTH(base.NewSeNo) = ".$prelen;
	$sql .= " ORDER BY NewSeNo DESC";
	$z = new __webctrl;
	$z->sql($sql, '1', '1');
	$v = $z->row();
	$RecordCount = $z->num();
	if ($RecordCount > 0) {
		$Row = $v[0];
		$strtxt = str_replace($txt, '', $Row["NewSeNo"]);
	} else {
		$strtxt = 0;
	}
	$strtxt = intval($strtxt) + 1;
	$stroutput = $txt . formatStringtoZero($strtxt, $option["numberlength"]);
	return $stroutput;
}
function generate_codewithym($option)
{
	$txt = $option["prefix"];
	$txttable = $option["table"];
	$txtfield = $option["table"] . "_" . $option["field"];
	$txtorder = $option["table"] . "_" . $option["order"];
	$txtdad = (empty($option["opdad"]) ? "" : $option["opdad"]);
	$txtformatym = (empty($option["formatym"]) ? "Y-m" : $option["formatym"]);
	$txtreset = (empty($option["resetcount"]) ? "Y" : $option["resetcount"]); // Y , YM
	$txtnowymd = date($txtformatym);
	//--
	$prelen = strlen($txt) + strlen($txtnowymd) + $option["numberlength"] + strlen($txtdad);
	//--
	$sql = "SELECT * FROM";
	$sql .= " (";
	$sql .= "SELECT " . $txtfield . ",CONCAT(REPLACE(LEFT(" . $txtfield . ", 1), '_', ''),SUBSTRING(" . $txtfield . ", 2)) AS NewSeNo FROM " . $txttable;
	if (is_array($option["where"])) {
		$num = count($option["where"]);
		$sql .= " WHERE ";
		if ($num > 0) {
			$i = 0;
			foreach ($option["where"] as $key => $val) {
				if ($i > 0) {
					$sql .= ' AND ';
				}
				$sql .= $key . $val;
				$i++;
			}
		}
	} else {
		$sql .= " WHERE 1";
	}
	if (!empty($option["flag"])) {
		$sql .= " AND " . $txtflag . " = 0";
	}
	$sql .= ") base WHERE 1 ";
	//$sql .= " AND CHAR_LENGTH(base.NewSeNo) = ".$prelen;
	$sql .= " ORDER BY NewSeNo DESC";
	$z = new __webctrl;
	$z->sql($sql, '1', '1');
	$v = $z->row();
	$RecordCount = $z->num();
	$Row = $v[0];
	$txtnewprefix = $txt . date($txtformatym) . $txtdad;
	$arrtxtdbprefix = substr($Row["NewSeNo"], -$option["numberlength"]);
	//$arrtxtdbprefix = explode($txtdad,$Row["NewSeNo"]);

	$txtym = substr($Row["NewSeNo"], strlen($txt), strlen($txtnowymd));

	$txtnowy = date("Y");
	$txtnowm = date("n");
	$txtnowym = date("Yn");

	$txtiny = date("Y", strtotime($txtym));
	$txtinm = date("n", strtotime($txtym));
	$txtinym = date("Yn", strtotime($txtym));
	$txtinformat = date($txtformatym, strtotime($txtym));

	if ($txtreset == "Y") {
		if ($txtnowy > $txtiny) {
			$txtprefix = $txt . $txtnowymd . $txtdad;
			$strtxt = 0;
		} else {
			$txtprefix = $txt . $txtnowymd . $txtdad;
			//$strtxt = $arrtxtdbprefix[count($arrtxtdbprefix)-1];
			$strtxt = $arrtxtdbprefix;
		}
	} else {
		if ($txtnowym > $txtinym) {
			$txtprefix = $txt . $txtnowymd . $txtdad;
			$strtxt = 0;
		} else {
			$txtprefix = $txt . $txtnowymd . $txtdad;
			//$strtxt = $arrtxtdbprefix[count($arrtxtdbprefix)-1];
			$strtxt = $arrtxtdbprefix;
		}
	}

	$strtxt = intval($strtxt) + 1;
	$stroutput = $txtprefix . formatStringtoZero($strtxt, $option["numberlength"]);

	return $stroutput;
}
function generate_codeguarantee($option)
{
	$txt = $option["prefix"];
	$txttable = $option["table"];
	$txtfield = $option["field"];
	$txtdad = (empty($option["opdad"]) ? "" : $option["opdad"]);
	$txtformatym = (empty($option["formatym"]) ? "YYYYMM" : $option["formatym"]);
	$txtreset = (empty($option["resetcount"]) ? "Y" : $option["resetcount"]); // Y , Y-m
	$txtlang = (empty($option["formatlang"]) ? "English" : $option["formatlang"]); // Y , YM
	$txtcheckfield = (empty($option["checkfield"]) ? "" : $option["checkfield"]);
	//--
	$prelen = strlen($txt) + strlen($txtformatym) + strlen($txtdad);
	$numberlen = intval($option["numberlength"]) - $prelen;
	//--
	$sql = "SELECT * FROM";
	$sql .= " (";
	$sql .= "SELECT " . $txtfield . ",CONCAT(REPLACE(LEFT(" . $txtfield . ", 1), '_', ''),SUBSTRING(" . $txtfield . ", 2)) AS NewSeNo FROM " . $txttable;
	if (is_array($option["where"])) {
		$num = count($option["where"]);
		$sql .= " WHERE ";
		if ($num > 0) {
			$i = 0;
			foreach ($option["where"] as $key => $val) {
				if ($i > 0) {
					$sql .= ' AND ';
				}
				$sql .= $key . $val;
				$i++;
			}
		}
	} else {
		$sql .= " WHERE 1";
	}
	if (!empty($txtcheckfield)) {
		if ($txtreset == 'Y') {
			$sql .= " AND SUBSTRING(" . $txtcheckfield . ",1,4) = '" . date($txtreset) . "'";
		} else if ($txtreset == 'Y-m') {
			$sql .= " AND SUBSTRING(" . $txtcheckfield . ",1,7) = '" . date($txtreset) . "'";
		} else if ($txtreset == 'Y-m-d') {
			$sql .= " AND SUBSTRING(" . $txtcheckfield . ",1,10) = '" . date($txtreset) . "'";
		} else {
			$sql .= " AND SUBSTRING(" . $txtcheckfield . ",1,4) = '" . date($txtreset) . "'";
		}
	}
	$sql .= ") Base WHERE 1 ";
	//$sql .= " AND CHAR_LENGTH(base.NewSeNo) = ".$prelen;
	$sql .= " ORDER BY NewSeNo DESC";
	$z = new __webctrl;
	$z->sql($sql, '1', '1');
	$v = $z->row();
	$RecordCount = $z->num();
	if ($RecordCount > 0) {
		$Row = $v[0];
		$NewSeNo = $Row["NewSeNo"];
		$inlistnumber = substr($NewSeNo, $prelen, strlen($NewSeNo));
	} else {
		$NewSeNo = "";
		$inlistnumber = 0;
	}
	$txtnowd = date("d");
	$txtnowm = date("m");
	$txtnowy = ($txtlang == 'Thai' ? date("Y") + 543 : date("Y"));
	switch ($txtformatym) {
		case 'YYMM':
			$txtnowy = substr($txtnowy, -2);
			$txtinformatdate = $txtnowy . $txtnowm;
			break;
		case 'YYYYMM':
			$txtinformatdate = $txtnowy . $txtnowm;
			break;
		default:
	}
	$txtprefix = $txt . $txtinformatdate . $txtdad;
	$strtxt = intval($inlistnumber) + 1;
	$stroutput = $txtprefix . formatStringtoZero($strtxt, $numberlen);
	return $stroutput;
}

function convert($number)
{
	$txtnum1 = array('ศูนย์', 'หนึ่ง', 'สอง', 'สาม', 'สี่', 'ห้า', 'หก', 'เจ็ด', 'แปด', 'เก้า', 'สิบ');
	$txtnum2 = array('', 'สิบ', 'ร้อย', 'พัน', 'หมื่น', 'แสน', 'ล้าน', 'สิบ', 'ร้อย', 'พัน', 'หมื่น', 'แสน', 'ล้าน');
	$number = str_replace(",", "", $number);
	$number = str_replace(" ", "", $number);
	$number = str_replace("บาท", "", $number);
	$number = explode(".", $number);
	if (sizeof($number) > 2) {
		return 'ทศนิยมหลายตัวนะจ๊ะ';
		exit;
	}
	$strlen = strlen($number[0]);
	$convert = '';
	for ($i = 0; $i < $strlen; $i++) {
		$n = substr($number[0], $i, 1);
		if ($n != 0) {
			if ($i == ($strlen - 1) and $n == 1) {
				$convert .= 'เอ็ด';
			} elseif ($i == ($strlen - 2) and $n == 2) {
				$convert .= 'ยี่';
			} elseif ($i == ($strlen - 2) and $n == 1) {
				$convert .= '';
			} else {
				$convert .= $txtnum1[$n];
			}
			$convert .= $txtnum2[$strlen - $i - 1];
		}
	}
	$convert .= 'บาท';
	if (
		$number[1] == '0' or $number[1] == '00' or
		$number[1] == ''
	) {
		$convert .= 'ถ้วน';
	} else {
		$strlen = strlen($number[1]);
		for ($i = 0; $i < $strlen; $i++) {
			$n = substr($number[1], $i, 1);
			if ($n != 0) {
				if ($i == ($strlen - 1) and $n == 1) {
					$convert
						.= 'เอ็ด';
				} elseif (
					$i == ($strlen - 2) and
					$n == 2
				) {
					$convert .= 'ยี่';
				} elseif (
					$i == ($strlen - 2) and
					$n == 1
				) {
					$convert .= '';
				} else {
					$convert .= $txtnum1[$n];
				}
				$convert .= $txtnum2[$strlen - $i - 1];
			}
		}
		$convert .= 'สตางค์';
	}
	return $convert;
}
class Currency
{
	public function bahtEng($thb)
	{
		list($thb, $ths) = explode('.', $thb);
		$ths = substr($ths . '00', 0, 2);
		$thb = Currency::engFormat(intval($thb)) . ' Baht';
		if (intval($ths) > 0) {
			$thb .= ' and ' . Currency::engFormat(intval($ths)) . ' Satang';
		}
		return $thb;
	}
	// ตัวเลขเป็นตัวหนังสือ (ไทย)
	public function bahtThai($thb)
	{
		list($thb, $ths) = explode('.', $thb);
		$ths = substr($ths . '00', 0, 2);
		$thaiNum = array('', 'หนึ่ง', 'สอง', 'สาม', 'สี่', 'ห้า', 'หก', 'เจ็ด', 'แปด', 'เก้า');
		$unitBaht = array('บาท', 'สิบ', 'ร้อย', 'พัน', 'หมื่น', 'แสน', 'ล้าน', 'สิบ', 'ร้อย', 'พัน', 'หมื่น', 'แสน', 'ล้าน');
		$unitSatang = array('สตางค์', 'สิบ');
		$THB = '';
		$j = 0;
		for ($i = strlen($thb) - 1; $i >= 0; $i--, $j++) {
			$num = $thb[$i];
			$tnum = $thaiNum[$num];
			$unit = $unitBaht[$j];
			switch (true) {
				case $j == 0 && $num == 1 && strlen($thb) > 1:
					$tnum = 'เอ็ด';
					break;
				case $j == 1 && $num == 1:
					$tnum = '';
					break;
				case $j == 1 && $num == 2:
					$tnum = 'ยี่';
					break;
				case $j == 6 && $num == 1 && strlen($thb) > 7:
					$tnum = 'เอ็ด';
					break;
				case $j == 7 && $num == 1:
					$tnum = '';
					break;
				case $j == 7 && $num == 2:
					$tnum = 'ยี่';
					break;
				case $j != 0 && $j != 6 && $num == 0:
					$unit = '';
					break;
			}
			$S = $tnum . $unit;
			$THB = $S . $THB;
		}
		if ($ths == '00') {
			$THS = 'ถ้วน';
		} else {
			$j = 0;
			$THS = '';
			for ($i = strlen($ths) - 1; $i >= 0; $i--, $j++) {
				$num = $ths[$i];
				$tnum = $thaiNum[$num];
				$unit = $unitSatang[$j];
				switch (true) {
					case $j == 0 && $num == 1 && strlen($ths) > 1:
						$tnum = 'เอ็ด';
						break;
					case $j == 1 && $num == 1:
						$tnum = '';
						break;
					case $j == 1 && $num == 2:
						$tnum = 'ยี่';
						break;
					case $j != 0 && $j != 6 && $num == 0:
						$unit = '';
						break;
				}
				$S = $tnum . $unit;
				$THS = $S . $THS;
			}
		}
		return $THB . $THS;
	}
	// ตัวเลขเป็นตัวหนังสือ (eng)
	private function engFormat($number)
	{
		list($thb, $ths) = explode('.', $thb);
		$ths = substr($ths . '00', 0, 2);
		$max_size = pow(10, 18);
		if (!$number)
			return "zero";
		if (is_int($number) && $number < abs($max_size)) {
			switch ($number) {
				case $number < 0:
					$prefix = "negative";
					$suffix = Currency::engFormat(-1 * $number);
					$string = $prefix . " " . $suffix;
					break;
				case 1:
					$string = "one";
					break;
				case 2:
					$string = "two";
					break;
				case 3:
					$string = "three";
					break;
				case 4:
					$string = "four";
					break;
				case 5:
					$string = "five";
					break;
				case 6:
					$string = "six";
					break;
				case 7:
					$string = "seven";
					break;
				case 8:
					$string = "eight";
					break;
				case 9:
					$string = "nine";
					break;
				case 10:
					$string = "ten";
					break;
				case 11:
					$string = "eleven";
					break;
				case 12:
					$string = "twelve";
					break;
				case 13:
					$string = "thirteen";
					break;
				case 15:
					$string = "fifteen";
					break;
				case $number < 20:
					$string = Currency::engFormat($number % 10);
					if ($number == 18) {
						$suffix = "een";
					} else {
						$suffix = "teen";
					}
					$string .= $suffix;
					break;
				case 20:
					$string = "twenty";
					break;
				case 30:
					$string = "thirty";
					break;
				case 40:
					$string = "forty";
					break;
				case 50:
					$string = "fifty";
					break;
				case 60:
					$string = "sixty";
					break;
				case 70:
					$string = "seventy";
					break;
				case 80:
					$string = "eighty";

					break;
				case 90:
					$string = "ninety";
					break;
				case $number < 100:
					$prefix = Currency::engFormat($number - $number % 10);
					$suffix = Currency::engFormat($number % 10);
					$string = $prefix . "-" . $suffix;
					break;
				case $number < pow(10, 3):
					$prefix = Currency::engFormat(intval(floor($number / pow(10, 2)))) . " hundred";
					if ($number % pow(10, 2))
						$suffix = " and " . Currency::engFormat($number % pow(10, 2));
					$string = $prefix . $suffix;
					break;
				case $number < pow(10, 6):
					$prefix = Currency::engFormat(intval(floor($number / pow(10, 3)))) . " thousand";
					if ($number % pow(10, 3))
						$suffix = Currency::engFormat($number % pow(10, 3));
					$string = $prefix . " " . $suffix;
					break;
				case $number < pow(10, 9):
					$prefix = Currency::engFormat(intval(floor($number / pow(10, 6)))) . " million";
					if ($number % pow(10, 6))
						$suffix = Currency::engFormat($number % pow(10, 6));
					$string = $prefix . " " . $suffix;
					break;
				case $number < pow(10, 12):
					$prefix = Currency::engFormat(intval(floor($number / pow(10, 9)))) . " billion";
					if ($number % pow(10, 9))
						$suffix = Currency::engFormat($number % pow(10, 9));
					$string = $prefix . " " . $suffix;
					break;
				case $number < pow(10, 15):
					$prefix = Currency::engFormat(intval(floor($number / pow(10, 12)))) . " trillion";
					if ($number % pow(10, 12))
						$suffix = Currency::engFormat($number % pow(10, 12));
					$string = $prefix . " " . $suffix;
					break;
				case $number < pow(10, 18):
					$prefix = Currency::engFormat(intval(floor($number / pow(10, 15)))) . " quadrillion";
					if ($number % pow(10, 15))
						$suffix = Currency::engFormat($number % pow(10, 15));
					$string = $prefix . " " . $suffix;
					break;
			}
		}
		return $string;
	}
}
function checkIDCard($id)
{
	if (strlen($id) != 13) return false;
	for ($i = 0, $sum = 0; $i < 12; $i++)
		$sum += (int)($id{
			$i}) * (13 - $i);
	if ((11 - ($sum % 11)) % 10 == (int)($id{
		12})) return true;
	return false;
}
function formatstringinpattern($str, $pattern = 'idcard')
{
	if ($pattern == 'idcard') {
		$pattern = "_ ____ _____ __ _";
		$pattern_ex = " ";
	} else {
		$pattern = "_-____-_____-__-_";
		$pattern_ex = "-";
	}
	$patternlength = strlen($pattern);
	$arpattern = array();
	for ($i = 0; $i < $patternlength; $i++) {
		if ($pattern{
			$i} == $pattern_ex) {
			$arpattern[$i - 1] = $pattern_ex;
		}
	}
	$obj_l = strlen($str);
	$strreturn = "";
	for ($i = 0; $i < $obj_l; $i++) {
		$countstr_r = strlen($strreturn);
		if ($arpattern[$countstr_r]) {
			$strreturn .= $str{
				$i} . $pattern_ex;
		} else {
			$strreturn .= $str{
				$i};
		}
	}
	return $strreturn;
}
function zipFilesAndDownload($file_names, $archive_file_name, $file_path)
{
	//create the object
	$archivwithpath = _RELATIVE_PATH_UPLOAD_ . "/" . $archive_file_name;
	$zip = new ZipArchive();
	//create the file and throw the error if unsuccessful
	if ($zip->open($archivwithpath, ZIPARCHIVE::CREATE) !== TRUE) {
		exit("cannot open <$archive_file_name>\n");
	}

	//add each files of $file_name array to archive
	foreach ($file_names as $files) {
		$zip->addFile($file_path . $files, $files);
	}
	$zip->close();
	//then send the headers to foce download the zip file
	// header("Content-type: application/zip");
	/*
	header("Content-Disposition: attachment; filename=$archive_file_name");
	header('Last-Modified: ' . gmdate('D, d M Y H:i:s', filemtime($archive_file_name)) . ' GMT');
	header("Pragma: no-cache");
	header("Expires: 0");
	*/
	header("Content-type: application/zip");
	header('Pragma: public');
	header('Expires: 0');
	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	header('Last-Modified: ' . gmdate('D, d M Y H:i:s', filemtime($archivwithpath)) . ' GMT');
	header('Content-Type: application/force-download');
	header('Content-Disposition: inline; filename="' . $archive_file_name . '"');
	header('Content-Transfer-Encoding: binary');
	header('Content-Length: ' . filesize($archivwithpath));
	header('Connection: close');

	readfile($archivwithpath);
	recursiveDelete($file_path);
	unlink($archivwithpath);
	exit;
}
function recursiveDelete($str)
{
	if (is_file($str)) {
		return @unlink($str);
	} elseif (is_dir($str)) {
		$scan = glob(rtrim($str, '/') . '/*');
		foreach ($scan as $index => $path) {
			recursiveDelete($path);
		}
		return @rmdir($str);
	}
}
function getBrowser()
{
	$u_agent = $_SERVER['HTTP_USER_AGENT'];
	$bname = 'Unknown';
	$platform = 'Unknown';
	$version = "";

	//First get the platform?
	if (preg_match('/linux/i', $u_agent)) {
		$platform = 'linux';
	} elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
		$platform = 'mac';
	} elseif (preg_match('/windows|win32/i', $u_agent)) {
		$platform = 'windows';
	}

	// Next get the name of the useragent yes seperately and for good reason
	if (preg_match('/MSIE/i', $u_agent) && !preg_match('/Opera/i', $u_agent)) {
		$bname = 'Internet Explorer';
		$ub = "MSIE";
	} elseif (preg_match('/Firefox/i', $u_agent)) {
		$bname = 'Mozilla Firefox';
		$ub = "Firefox";
	} elseif (preg_match('/Chrome/i', $u_agent)) {
		$bname = 'Google Chrome';
		$ub = "Chrome";
	} elseif (preg_match('/Safari/i', $u_agent)) {
		$bname = 'Apple Safari';
		$ub = "Safari";
	} elseif (preg_match('/Opera/i', $u_agent)) {
		$bname = 'Opera';
		$ub = "Opera";
	} elseif (preg_match('/Netscape/i', $u_agent)) {
		$bname = 'Netscape';
		$ub = "Netscape";
	}

	// finally get the correct version number
	$known = array('Version', $ub, 'other');
	$pattern = '#(?<browser>' . join('|', $known) .
		')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
	if (!preg_match_all($pattern, $u_agent, $matches)) {
		// we have no matching number just continue
	}

	// see how many we have
	$i = count($matches['browser']);
	if ($i != 1) {
		//we will have two since we are not using 'other' argument yet
		//see if version is before or after the name
		if (strripos($u_agent, "Version") < strripos($u_agent, $ub)) {
			$version = $matches['version'][0];
		} else {
			$version = $matches['version'][1];
		}
	} else {
		$version = $matches['version'][0];
	}

	// check if we have a number
	if ($version == null || $version == "") {
		$version = "?";
	}

	return array(
		'userAgent' => $u_agent,
		'name'      => $bname,
		'version'   => $version,
		'platform'  => $platform,
		'pattern'    => $pattern
	);
}
function is_image($path)
{
	$a = getimagesize($path);
	$image_type = $a[2];

	if (in_array($image_type, array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_BMP))) {
		return true;
	}
	return false;
}
function videoType($url)
{
	if (strpos($url, 'youtube') > 0) {
		return 'youtube';
	} elseif (strpos($url, 'youtu.be') > 0) {
		return 'youtube';
	} elseif (strpos($url, 'vimeo') > 0) {
		return 'vimeo';
	} else {
		return 'unknown';
	}
}
function save_base64_image($base64_image_string, $output_file_without_extentnion, $path_with_end_slash = "")
{
	//usage:  if( substr( $img_src, 0, 5 ) === "data:" ) {  $filename=save_base64_image($base64_image_string, $output_file_without_extentnion, getcwd() . "/application/assets/pins/$user_id/"); }
	//
	//data is like:    data:image/png;base64,asdfasdfasdf
	$splited = explode(',', substr($base64_image_string, 5), 2);
	$mime = $splited[0];
	$data = $splited[1];

	$mime_split_without_base64 = explode(';', $mime, 2);
	$mime_split = explode('/', $mime_split_without_base64[0], 2);
	if (count($mime_split) == 2) {
		$extension = $mime_split[1];
		if ($extension == 'jpeg') $extension = 'jpg';
		//if($extension=='javascript')$extension='js';
		//if($extension=='text')$extension='txt';
		$output_file_with_extentnion = $output_file_without_extentnion . '.' . $extension;
	}
	file_put_contents($path_with_end_slash . $output_file_with_extentnion, base64_decode($data));
	return $output_file_with_extentnion;
}
function save_image_tojpg($file, $output_file_without_extentnion)
{
	$fileoutputjpg = $output_file_without_extentnion;
	$fileoutputjpg = strtolower($fileoutputjpg);
	$vowels = array(".jpg", ".jpeg");
	$fileoutputjpg = str_replace($vowels, "", $fileoutputjpg);
	$fileoutputjpg = $output_file_without_extentnion . ".jpg";
	$image = imagecreatefrompng($file);
	imagejpeg($image, $fileoutputjpg, 100);
	imagedestroy($image);
	return $fileoutputjpg;
}
function getListPrefix($op = true)
{
	$Marray = new StdClass;
	$sql = "";
	$arrfield = array();
	$arrfield[] = _TABLE_REF_PREFIX_ . "_Code AS Code";
	$arrfield[] = _TABLE_REF_PREFIX_ . "_FULLNAME AS PrefixName";
	$arrfield[] = _TABLE_REF_PREFIX_ . "_INITIALS AS PrefixShotName";
	$sql .= "SELECT " . implode(',', $arrfield) . " FROM " . _TABLE_REF_PREFIX_ . " WHERE 1";
	$sql .= " AND " . _TABLE_REF_PREFIX_ . "_Status = 'On'";
	if ($op) {
		$sql .= " AND " . _TABLE_REF_PREFIX_ . "_Code IN ('003','004','005')";
	}
	$sql .= " ORDER BY " . _TABLE_REF_PREFIX_ . "_Code ASC";
	$z = new __webctrl;
	$z->sql($sql);
	$RecordCount = $z->num();
	$Marray->datacount = $RecordCount;
	if ($RecordCount > 0) {
		$v = $z->row();
		foreach ($v as $Row) {
			$ar = array();
			$ar["code"] = $Row["Code"];
			$ar["name"] = $Row["PrefixName"];
			$ar["shotname"] = $Row["PrefixShotName"];
			$Marray->data[] = $ar;
		}
	}
	return $Marray;
}
function getListEdulev($op = false, $flag = "Thai")
{
	$Marray = new StdClass;
	$sql = "";
	$arrfmain = array();
	$arrfmain[] = "TB.*";
	$sql .= "SELECT " . implode(',', $arrfmain) . " FROM (";
	$arrfield = array();
	$arrfield[] = _TABLE_REF_EDULEV_ . "_Code AS Code";
	$arrfield[] = _TABLE_REF_EDULEV_ . "_NameThai AS NameThai";
	$sql .= "SELECT " . implode(',', $arrfield) . " FROM " . _TABLE_REF_EDULEV_ . " WHERE 1";
	$sql .= " AND " . _TABLE_REF_EDULEV_ . "_Status = 'On'";
	if ($op) {
		$sql .= " AND " . _TABLE_REF_EDULEV_ . "_Code IN ('40','60','80')";
	}
	unset($arrfield);
	$sql .= ") TB";
	$sql .= " WHERE 1";
	$sql .= " ORDER BY TB.Code ASC";
	$z = new __webctrl;
	$z->sql($sql);
	$RecordCount = $z->num();
	$Marray->datacount = $RecordCount;
	if ($RecordCount > 0) {
		$v = $z->row();
		foreach ($v as $Row) {
			$ar = array();
			$ar["code"] = $Row["Code"];
			$ar["name"] = $Row["Name" . $flag];
			$Marray->data[] = $ar;
		}
	}
	return $Marray;
}
function getListUni($op = false, $flag = "Thai")
{
	$Marray = new StdClass;
	$sql = "";
	$arrfmain = array();
	$arrfmain[] = "TB.*";
	$sql .= "SELECT " . implode(',', $arrfmain) . " FROM (";
	$arrfield = array();
	$arrfield[] = _TABLE_REF_UNIV_ . "_Code AS Code";
	$arrfield[] = _TABLE_REF_UNIV_ . "_NameThai AS NameThai";
	$sql .= "SELECT " . implode(',', $arrfield) . " FROM " . _TABLE_REF_UNIV_ . " WHERE 1";
	$sql .= " AND " . _TABLE_REF_UNIV_ . "_Status = 'On'";
	if ($op) {
		$sql .= " AND " . _TABLE_REF_UNIV_ . "_Code IN ('00700','00500')";
	}
	unset($arrfield);
	$sql .= ") TB";
	$sql .= " WHERE 1";
	$sql .= " ORDER BY TB.Code ASC";
	$z = new __webctrl;
	$z->sql($sql);
	$RecordCount = $z->num();
	$Marray->datacount = $RecordCount;
	if ($RecordCount > 0) {
		$v = $z->row();
		foreach ($v as $Row) {
			$ar = array();
			$ar["code"] = $Row["Code"];
			$ar["name"] = $Row["Name" . $flag];
			$Marray->data[] = $ar;
		}
	}
	return $Marray;
}
function getListCountries($flag = "Thai")
{
	$Marray = new StdClass;
	$sql = "SELECT " . _TABLE_ADDRCOUNTRIES_ . "_countryNameth AS NameThai," . _TABLE_ADDRCOUNTRIES_ . "_countryNameen AS NameEnglish," . _TABLE_ADDRCOUNTRIES_ . "_countryCode AS CountryCode FROM " . _TABLE_ADDRCOUNTRIES_ . " WHERE 1";
	$z = new __webctrl;
	$z->sql($sql);
	$RecordCount = $z->num();
	$Marray->datacount = $RecordCount;
	if ($RecordCount > 0) {
		$v = $z->row();
		foreach ($v as $Row) {
			$ar = array();
			$ar["code"] = $Row["CountryCode"];
			$ar["name"] = $Row["Name" . $flag];
			$Marray->data[] = $ar;
		}
	}
	return $Marray;
}
function getListProvince($geid = 0, $flag = "Thai")
{
	$Marray = new StdClass;
	$sql = "SELECT " . _TABLE_ADDRPROVINCE_ . "_NameThai AS ProvinceNameThai," . _TABLE_ADDRPROVINCE_ . "_NameEnglish AS ProvinceNameEnglish," . _TABLE_ADDRPROVINCE_ . "_Code AS ProvinceCode FROM " . _TABLE_ADDRPROVINCE_ . " WHERE 1";
	if ($geid > 0) {
		$sql .= " AND " . _TABLE_ADDRPROVINCE_ . "_GEOCode = " . (int)$geid;
	}
	$z = new __webctrl;
	$z->sql($sql);
	$RecordCount = $z->num();
	$Marray->datacount = $RecordCount;
	if ($RecordCount > 0) {
		$v = $z->row();
		foreach ($v as $Row) {
			$ar = array();
			$ar["code"] = $Row["ProvinceCode"];
			$ar["name"] = $Row["ProvinceName" . $flag];
			$Marray->data[] = $ar;
		}
	}
	return $Marray;
}
function getListAmphur($provincecode = '', $flag = "Thai")
{
	$Marray = new StdClass;
	$sql = "SELECT " . _TABLE_ADDRAMPHUR_ . "_NameThai AS AmphurNameThai," . _TABLE_ADDRAMPHUR_ . "_NameEnglish AS AmphurNameEnglish," . _TABLE_ADDRAMPHUR_ . "_Code AS AmphurCode FROM " . _TABLE_ADDRAMPHUR_ . " WHERE 1";
	if (!empty($provincecode)) {
		$sql .= " AND " . _TABLE_ADDRAMPHUR_ . "_ProvinceCode = " . (int)$provincecode;
	}
	$z = new __webctrl;
	$z->sql($sql);
	$RecordCount = $z->num();
	$Marray->datacount = $RecordCount;
	if ($RecordCount > 0) {
		$v = $z->row();
		foreach ($v as $Row) {
			$ar = array();
			$ar["code"] = $Row["AmphurCode"];
			$ar["name"] = $Row["AmphurName" . $flag];
			$Marray->data[] = $ar;
		}
	}
	return $Marray;
}
function getListDistrice($amphurcode = '', $flag = "Thai")
{
	$Marray = new StdClass;
	$sql = "SELECT " . _TABLE_ADDRDISTRICTS_ . "_NameThai AS DistriceNameThai," . _TABLE_ADDRDISTRICTS_ . "_NameEnglish AS DistriceNameEnglish," . _TABLE_ADDRDISTRICTS_ . "_Code AS DistriceCode FROM " . _TABLE_ADDRDISTRICTS_ . " WHERE 1";
	if (!empty($amphurcode)) {
		$sql .= " AND " . _TABLE_ADDRDISTRICTS_ . "_AmphuresCode = " . (int)$amphurcode;
	}
	$z = new __webctrl;
	$z->sql($sql);
	$RecordCount = $z->num();
	$Marray->datacount = $RecordCount;
	if ($RecordCount > 0) {
		$v = $z->row();
		foreach ($v as $Row) {
			$ar = array();
			$ar["code"] = $Row["DistriceCode"];
			$ar["name"] = $Row["DistriceName" . $flag];
			$Marray->data[] = $ar;
		}
	}
	return $Marray;
}
function getInfoCountries($id, $flag = "Thai")
{
	$Marray = new StdClass;
	$sql = "SELECT " . _TABLE_ADDRCOUNTRIES_ . "_countryNameth AS NameThai," . _TABLE_ADDRCOUNTRIES_ . "_countryNameen AS NameEnglish," . _TABLE_ADDRCOUNTRIES_ . "_countryCode AS CountryCode FROM " . _TABLE_ADDRCOUNTRIES_ . " WHERE " . _TABLE_ADDRCOUNTRIES_ . "_countryCode = '" . $id . "'";
	$z = new __webctrl;
	$z->sql($sql);
	$v = $z->row();
	$Row = $v[0];
	$Marray->name = $Row["Name" . $flag];
	$Marray->code = $Row["CountryCode"];
	return $Marray;
}
function getInfoProvince($id, $flag = "Thai")
{
	$Marray = new StdClass;
	$sql = "SELECT " . _TABLE_ADDRPROVINCE_ . "_NameThai AS ProvinceNameThai," . _TABLE_ADDRPROVINCE_ . "_NameEnglish AS ProvinceNameEnglish," . _TABLE_ADDRPROVINCE_ . "_Code AS ProvinceCode FROM " . _TABLE_ADDRPROVINCE_ . " WHERE " . _TABLE_ADDRPROVINCE_ . "_Code = '" . $id . "'";
	$z = new __webctrl;
	$z->sql($sql);
	$v = $z->row();
	$Row = $v[0];
	$Marray->name = $Row["ProvinceName" . $flag];
	$Marray->code = $Row["ProvinceCode"];
	return $Marray;
}
function getInfoAmphur($id, $flag = "Thai")
{
	$Marray = new StdClass;
	$sql = "SELECT " . _TABLE_ADDRAMPHUR_ . "_NameThai AS AmphurNameThai," . _TABLE_ADDRAMPHUR_ . "_NameEnglish AS AmphurNameEng," . _TABLE_ADDRAMPHUR_ . "_Code AS AmphurCode FROM " . _TABLE_ADDRAMPHUR_ . " WHERE " . _TABLE_ADDRAMPHUR_ . "_Code = '" . $id . "'";
	$z = new __webctrl;
	$z->sql($sql);
	$v = $z->row();
	$Row = $v[0];
	$Marray->name = $Row["AmphurName" . $flag];
	$Marray->code = $Row["AmphurCode"];
	return $Marray;
}
function getInfoDistrice($id, $flag = "Thai")
{
	$Marray = new StdClass;
	$sql = "SELECT " . _TABLE_ADDRDISTRICTS_ . "_NameThai AS DistriceNameThai," . _TABLE_ADDRDISTRICTS_ . "_NameEnglish AS DistriceNameEng," . _TABLE_ADDRDISTRICTS_ . "_Code AS DistriceCode," . _TABLE_ADDRDISTRICTS_ . "_ZIPCode AS ZIPCode FROM " . _TABLE_ADDRDISTRICTS_ . " WHERE " . _TABLE_ADDRDISTRICTS_ . "_Code = '" . $id . "'";
	$z = new __webctrl;
	$z->sql($sql);
	$v = $z->row();
	$Row = $v[0];
	$Marray->name = $Row["DistriceName" . $flag];
	$Marray->code = $Row["DistriceCode"];
	$Marray->zipcode = $Row["ZIPCode"];
	return $Marray;
}
function get_remote_data($url, $post_paramtrs = false)
{
	$c = curl_init();
	curl_setopt($c, CURLOPT_URL, $url);
	curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
	if ($post_paramtrs) {
		curl_setopt($c, CURLOPT_POST, TRUE);
		curl_setopt($c, CURLOPT_POSTFIELDS, "var1=bla&" . $post_paramtrs);
	}
	curl_setopt($c, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($c, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; rv:33.0) Gecko/20100101 Firefox/33.0");
	curl_setopt($c, CURLOPT_COOKIE, 'CookieName1=Value;');
	curl_setopt($c, CURLOPT_MAXREDIRS, 10);
	$follow_allowed = (ini_get('open_basedir') || ini_get('safe_mode')) ? false : true;
	if ($follow_allowed) {
		curl_setopt($c, CURLOPT_FOLLOWLOCATION, 1);
	}
	curl_setopt($c, CURLOPT_CONNECTTIMEOUT, 9);
	curl_setopt($c, CURLOPT_REFERER, $url);
	curl_setopt($c, CURLOPT_TIMEOUT, 60);
	curl_setopt($c, CURLOPT_AUTOREFERER, true);
	curl_setopt($c, CURLOPT_ENCODING, 'gzip,deflate');
	$data = curl_exec($c);
	$status = curl_getinfo($c);
	curl_close($c);
	preg_match('/(http(|s)):\/\/(.*?)\/(.*\/|)/si',  $status['url'], $link);
	$data = preg_replace('/(src|href|action)=(\'|\")((?!(http|https|javascript:|\/\/|\/)).*?)(\'|\")/si', '$1=$2' . $link[0] . '$3$4$5', $data);
	$data = preg_replace('/(src|href|action)=(\'|\")((?!(http|https|javascript:|\/\/)).*?)(\'|\")/si', '$1=$2' . $link[1] . '://' . $link[3] . '$3$4$5', $data);
	if ($status['http_code'] == 200) {
		return $data;
	} elseif ($status['http_code'] == 301 || $status['http_code'] == 302) {
		if (!$follow_allowed) {
			if (!empty($status['redirect_url'])) {
				$redirURL = $status['redirect_url'];
			} else {
				preg_match('/href\=\"(.*?)\"/si', $data, $m);
				if (!empty($m[1])) {
					$redirURL = $m[1];
				}
			}
			if (!empty($redirURL)) {
				return  call_user_func(__FUNCTION__, $redirURL, $post_paramtrs);
			}
		}
	}
	return "ERRORCODE22 with $url!!<br/>Last status codes<b/>:" . json_encode($status) . "<br/><br/>Last data got<br/>:$data";
}
function generate_token($length = 10)
{
	$UpperChar = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$LowerChar = 'abcdefghijklmnopqrstuvwxyz';
	$Number = '0123456789';

	$countst01 = round((20 * $length) / 100);
	$countst02 = round((40 * $length) / 100);
	$countst03 = round((30 * $length) / 100);

	$randomString01 = substr(str_shuffle($UpperChar), 0, $countst01);
	$randomString02 = substr(str_shuffle($LowerChar), 0, $countst02);
	$randomString03 = substr(str_shuffle($Number), 0, $countst03);

	$str = $randomString01 . $randomString02 . $randomString03;
	$str = str_shuffle($str);
	return $str;
}
function generate_tokeninid($id = 0, $length = 10)
{
	$UpperChar = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$LowerChar = 'abcdefghijklmnopqrstuvwxyz';
	$Number = '0123456789';

	$countst01 = round((20 * $length) / 100);
	$countst02 = round((40 * $length) / 100);
	$countst03 = round((30 * $length) / 100);
	$countst04 = round((10 * $length) / 100);

	$randomString01 = substr(str_shuffle($UpperChar), 0, $countst01);
	$randomString02 = substr(str_shuffle($LowerChar), 0, $countst02);
	$randomString03 = substr(str_shuffle($Number), 0, $countst03);
	$randomString04 = substr(str_shuffle($id), 0, $countst04);

	$str = $randomString01 . $randomString02 . $randomString03 . $randomString04;
	$str = str_shuffle($str);
	return $str;
}
function getuserToken($id)
{
	$sql = "SELECT " . _TABLE_ADMIN_USERTOKEN_ . "_TokenID FROM " . _TABLE_ADMIN_USERTOKEN_ . " WHERE " . _TABLE_ADMIN_USERTOKEN_ . "_UserID = " . (int)$id . " AND " . _TABLE_ADMIN_USERTOKEN_ . "_Status = 'Active'";
	$sql .= " ORDER BY " . _TABLE_ADMIN_USERTOKEN_ . "_CreateDate DESC";
	$z = new __webctrl;
	$z->sql($sql, 1, 1);
	$v = $z->row();
	$num = $z->num();
	$Row = $v[0];
	return $Row[_TABLE_ADMIN_USERTOKEN_ . "_TokenID"];
}
function savetxt($filename, $content, $chmod = 0777)
{
	// In our example we're opening $filename in append mode.
	// The file pointer is at the bottom of the file hence
	// that's where $somecontent will go when we fwrite() it.
	if (!$handle = fopen($filename, 'a')) {
		die("Cannot open file ($filename)");
	}
	// Write $somecontent to our opened file.
	if (fwrite($handle, $content) === false) {
		die("Cannot write to file ($filename)");
	}
	fclose($handle);
	chmod($filename, $chmod);
	return "Success, wrote ($content) to file ($filename)";
}
if (!function_exists("array_column")) {
	function array_column($array, $column_name)
	{
		return array_map(function ($element) use ($column_name) {
			return $element[$column_name];
		}, $array);
	}
}
function getOption($option)
{
	$Marray = new StdClass;
	$xtable = $option["table"];
	$xorderby = $option["orderby"];
	$xascdesc = $option["ascdesc"];
	$arrf = array();
	foreach ($option["field"] as $val) {
		$arrf[] = 'a.' . $xtable . '_' . $val . ' AS ' . $val;
	}
	$sql = "SELECT " . implode(',', $arrf) . " FROM " . $xtable . " a";
	$sql .= " WHERE 1";
	$sql .= " ORDER BY a." . $xtable . "_" . $xorderby . " " . $xascdesc;
	unset($arrf);
	$z = new __webctrl;
	$z->sql($sql);
	$n = $z->num();
	$v = $z->row();
	$Marray->num = $n;
	$Marray->data = $v;
	return $Marray;
}
function getOptionInfo($option)
{
	$Marray = new StdClass;
	$xtable = $option["table"];
	$xwhere = $option["where"];
	$xdata = $option["data"];
	$arrf = array();
	foreach ($option["field"] as $val) {
		$arrf[] = 'a.' . $xtable . '_' . $val . ' AS ' . $val;
	}
	$sql = "SELECT " . implode(',', $arrf) . " FROM " . $xtable . " a";
	$sql .= " WHERE 1";
	if (!empty($xwhere)) {
		$sql .= " AND " . $xtable . "_" . $xwhere . " = '" . $xdata . "'";
	}
	$z = new __webctrl;
	$z->sql($sql);
	$n = $z->num();
	$v = $z->row();
	$Marray->num = $n;
	if ($n > 0) {
		$Marray->data = $v[0];
	} else {
		$Marray->data = array();
	}
	return $Marray;
}
function getGroup($option)
{
	//print_r($option);
	$Marray = new StdClass;
	$systemLang = $option["lang"];
	$key = $option["modkey"];
	$xtable = $option["table"];
	$xtabledetail = $xtable . "_detail";
	$modtextselect = $option["modtextselect"];
	$selectid = $option["selectid"];

	$sql = "";
	$sqlsub = "";
	foreach ($systemLang as $lkey => $lval) {
		$sqlsub .= "," . $lkey . "." . $xtabledetail . "_Subject AS Subject" . $lkey;
		$sqlsub .= "," . $lkey . "." . $xtabledetail . "_Status AS Status" . $lkey;
	}
	$sql = "SELECT  a.*" . $sqlsub . " FROM " . $xtable . " a";
	foreach ($systemLang as $lkey => $lval) {
		$sql .= " LEFT JOIN " . $xtabledetail . " " . $lkey . " ON (a." . $xtable . "_ID = " . $lkey . "." . $xtabledetail . "_ContentID AND " . $lkey . "." . $xtabledetail . "_Lang = '" . $lkey . "')";
	}
	$sql .= " WHERE a." . $xtable . "_Key='" . $key . "'";
	$sql .= " AND a." . $xtable . "_Status = 'On'";
	$sql .= " ORDER BY a." . $xtable . "_Order ASC,a." . $xtable . "_ID DESC";
	$z = new __webctrl;
	$z->sql($sql);
	$v = $z->row();
	$n = $z->num();
	$found = array();
	$arr["id"] = 0;
	$arr["selected"] = ($selectid == 0 ? true : false);
	foreach ($systemLang as $lkey => $lval) {
		$arr["Subject" . $lkey] = $modtextselect[$lkey];
	}
	$found[] = $arr;
	if ($n > 0) {
		foreach ($v as $row) {
			$arr["id"] = $row[$xtable . "_ID"];
			$arr["selected"] = ($selectid == $row[$xtable . "_ID"] ? true : false);
			foreach ($systemLang as $lkey => $lval) {
				$arr["Subject" . $lkey] = $row["Subject" . $lkey];
			}
			$found[] = $arr;
		}
	}
	$Marray->num = $n + 1;
	$Marray->data = $found;
	return $Marray;
}
function CallAPI($method, $url, $data = false, $auth_mode = 'basic', $custom_header = NULL, $debug = false)
{
	$header = array();
	$executionStartTime = microtime(true);
	$curl = curl_init();

	switch ($method) {
		case "POST":
			curl_setopt($curl, CURLOPT_POST, 1);

			if ($data)
				curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
			break;
		case "PUT":
			$data["_METHOD"] = "PUT";
			curl_setopt($curl, CURLOPT_POST, 1);
			//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			if ($data)
				curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
			break;
		default:
			if ($data)
				$url = sprintf("%s?%s", $url, http_build_query($data));
	}
	if ($auth_mode == 'basic') {
		curl_setopt($curl, CURLOPT_USERPWD, "pgvim:QaZwSxEdCrFv");
	} else if ($auth_mode == 'jwt') {
		$header[] = "Authorization: Bearer " . $_SESSION['jwt'];
	}

	if (!empty($custom_header)) {
		$header = array_merge($header, $custom_header);
	}

	curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	$result = curl_exec($curl);
	curl_close($curl);

	if ($debug) {
		print_r($result);
	}

	$executionEndTime = microtime(true);
	$seconds = $executionEndTime - $executionStartTime;

	return json_decode($result, true);
}
function characterToHTMLEntity($str)
{
	$search = array('&', '<', '>', '€', '‘', '’', '“', '”', '–', '—', '¡', '¢', '£', '¤', '¥', '¦', '§', '¨', '©', 'ª', '«', '¬', '®', '¯', '°', '±', '²', '³', '´', 'µ', '¶', '·', '¸', '¹', 'º', '»', '¼', '½', '¾', '¿', 'À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', '×', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'Þ', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ð', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', '÷', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'þ', 'ÿ', 'Œ', 'œ', '‚', '„', '…', '™', '•', '˜');

	$replace  = array('&amp;', '&lt;', '&gt;', '&euro;', '&lsquo;', '&rsquo;', '&ldquo;', '&rdquo;', '&ndash;', '&mdash;', '&iexcl;', '&cent;', '&pound;', '&curren;', '&yen;', '&brvbar;', '&sect;', '&uml;', '&copy;', '&ordf;', '&laquo;', '&not;', '&reg;', '&macr;', '&deg;', '&plusmn;', '&sup2;', '&sup3;', '&acute;', '&micro;', '&para;', '&middot;', '&cedil;', '&sup1;', '&ordm;', '&raquo;', '&frac14;', '&frac12;', '&frac34;', '&iquest;', '&Agrave;', '&Aacute;', '&Acirc;', '&Atilde;', '&Auml;', '&Aring;', '&AElig;', '&Ccedil;', '&Egrave;', '&Eacute;', '&Ecirc;', '&Euml;', '&Igrave;', '&Iacute;', '&Icirc;', '&Iuml;', '&ETH;', '&Ntilde;', '&Ograve;', '&Oacute;', '&Ocirc;', '&Otilde;', '&Ouml;', '&times;', '&Oslash;', '&Ugrave;', '&Uacute;', '&Ucirc;', '&Uuml;', '&Yacute;', '&THORN;', '&szlig;', '&agrave;', '&aacute;', '&acirc;', '&atilde;', '&auml;', '&aring;', '&aelig;', '&ccedil;', '&egrave;', '&eacute;', '&ecirc;', '&euml;', '&igrave;', '&iacute;', '&icirc;', '&iuml;', '&eth;', '&ntilde;', '&ograve;', '&oacute;', '&ocirc;', '&otilde;', '&ouml;', '&divide;', '&oslash;', '&ugrave;', '&uacute;', '&ucirc;', '&uuml;', '&yacute;', '&thorn;', '&yuml;', '&OElig;', '&oelig;', '&sbquo;', '&bdquo;', '&hellip;', '&trade;', '&bull;', '&asymp;');

	//REPLACE VALUES
	$str = str_replace($search, $replace, $str);

	//RETURN FORMATED STRING
	return $str;
}
function HTMLEntityTocharacter($str)
{
	$search  = array('&#39;', '&#039;', '&amp;', '&lt;', '&gt;', '&euro;', '&lsquo;', '&rsquo;', '&ldquo;', '&rdquo;', '&ndash;', '&mdash;', '&iexcl;', '&cent;', '&pound;', '&curren;', '&yen;', '&brvbar;', '&sect;', '&uml;', '&copy;', '&ordf;', '&laquo;', '&not;', '&reg;', '&macr;', '&deg;', '&plusmn;', '&sup2;', '&sup3;', '&acute;', '&micro;', '&para;', '&middot;', '&cedil;', '&sup1;', '&ordm;', '&raquo;', '&frac14;', '&frac12;', '&frac34;', '&iquest;', '&Agrave;', '&Aacute;', '&Acirc;', '&Atilde;', '&Auml;', '&Aring;', '&AElig;', '&Ccedil;', '&Egrave;', '&Eacute;', '&Ecirc;', '&Euml;', '&Igrave;', '&Iacute;', '&Icirc;', '&Iuml;', '&ETH;', '&Ntilde;', '&Ograve;', '&Oacute;', '&Ocirc;', '&Otilde;', '&Ouml;', '&times;', '&Oslash;', '&Ugrave;', '&Uacute;', '&Ucirc;', '&Uuml;', '&Yacute;', '&THORN;', '&szlig;', '&agrave;', '&aacute;', '&acirc;', '&atilde;', '&auml;', '&aring;', '&aelig;', '&ccedil;', '&egrave;', '&eacute;', '&ecirc;', '&euml;', '&igrave;', '&iacute;', '&icirc;', '&iuml;', '&eth;', '&ntilde;', '&ograve;', '&oacute;', '&ocirc;', '&otilde;', '&ouml;', '&divide;', '&oslash;', '&ugrave;', '&uacute;', '&ucirc;', '&uuml;', '&yacute;', '&thorn;', '&yuml;', '&OElig;', '&oelig;', '&sbquo;', '&bdquo;', '&hellip;', '&trade;', '&bull;', '&asymp;');

	$replace = array('’', '’', '&', '<', '>', '€', '‘', '’', '“', '”', '–', '—', '¡', '¢', '£', '¤', '¥', '¦', '§', '¨', '©', 'ª', '«', '¬', '®', '¯', '°', '±', '²', '³', '´', 'µ', '¶', '·', '¸', '¹', 'º', '»', '¼', '½', '¾', '¿', 'À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', '×', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'Þ', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ð', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', '÷', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'þ', 'ÿ', 'Œ', 'œ', '‚', '„', '…', '™', '•', '˜');


	//REPLACE VALUES
	$str = str_replace($search, $replace, $str);

	//RETURN FORMATED STRING
	return $str;
}
class MultiToSingle
{
	//public $result=[];
	public $result = array();
	public function __construct($array)
	{
		if (!is_array($array)) {
			echo "Give a array";
		}
		foreach ($array as $key => $value) {
			if (is_array($value)) {
				for ($i = 0; $i < count($value); $i++) {
					$this->result[] = $value[$i];
				}
			} else {
				$this->result[] = $value;
			}
		}
	}
}
function insertArrayAtPosition($array, $insert, $position)
{
	/*
    $array : The initial array i want to modify
    $insert : the new array i want to add, eg array('key' => 'value') or array('value')
    $position : the position where the new array will be inserted into. Please mind that arrays start at 0
    */
	return array_slice($array, 0, $position, TRUE) + $insert + array_slice($array, $position, NULL, TRUE);
}
function getNextKey($k, $array)
{
	$keys = array_keys($array);
	$key  = array_search($k, $keys);
	if (count($array) - 1 == $key) {
		return $keys[0];
	} else {
		return $keys[$key + 1];
	}
	return 0; 									//else return nothing ( leaving the final answer unaffected
}
function garbagereplace($string)
{
	$garbagearray = array('@', '#', '$', '%', '^', '&', '*', '?');
	$garbagecount = count($garbagearray);
	for ($i = 0; $i < $garbagecount; $i++) {
		$string = str_replace($garbagearray[$i], '-', $string);
	}
	$string = str_replace(" ", "+", $string);
	return $string;
}
function getInfoPersonnel($id)
{
	$Marray = new StdClass;
	$sql = "";
	$ArrMain = array();
	$ArrMain[] = "TBmain.*";
	$sql .= "SELECT " . implode(',', $ArrMain) . " FROM ";
	$sql .= "(";
	$arrf = array();
	$arrf[] = "a." . _TABLE_PERSONNEL_ . "_ID AS PersonnelID";
	$arrf[] = "a." . _TABLE_PERSONNEL_ . "_MemberID AS MemberID";
	$arrf[] = "a." . _TABLE_PERSONNEL_ . "_Gender AS Gender";
	$arrf[] = "a." . _TABLE_PERSONNEL_ . "_PREFIX_NAME_ID AS PREFIX_NAME_ID";
	$arrf[] = "a." . _TABLE_PERSONNEL_ . "_STF_FNAME AS STF_FNAME";
	$arrf[] = "a." . _TABLE_PERSONNEL_ . "_STF_MNAME AS STF_MNAME";
	$arrf[] = "a." . _TABLE_PERSONNEL_ . "_STF_LNAME AS STF_LNAME";
	$arrf[] = "CONCAT(a." . _TABLE_PERSONNEL_ . "_PREFIX_NAME_Text,a." . _TABLE_PERSONNEL_ . "_STF_FNAME,' ',a." . _TABLE_PERSONNEL_ . "_STF_LNAME) AS Fullname";
	$arrf[] = "TBMember.*";
	$sql .= "SELECT " . implode(',', $arrf) . " FROM " . _TABLE_PERSONNEL_ . " a ";
	$sql .= " LEFT JOIN (";
	$arrfmember = array();
	$arrfmember[] = "a." . _TABLE_MEMBER_ . "_ID AS TBMemberID";
	$arrfmember[] = "a." . _TABLE_MEMBER_ . "_Level AS MyLevel";
	$arrfmember[] = "a." . _TABLE_MEMBER_ . "_Username AS Username";
	$arrfmember[] = "a." . _TABLE_MEMBER_ . "_UserType AS UserType";
	$arrfmember[] = "a." . _TABLE_MEMBER_ . "_Image AS Image";
	$arrfmember[] = "a." . _TABLE_MEMBER_ . "_PositionText AS PositionText";
	$arrfmember[] = "CONCAT(a." . _TABLE_MEMBER_ . "_PREFIX_NAME_Text,a." . _TABLE_MEMBER_ . "_STF_FNAME,' ',a." . _TABLE_MEMBER_ . "_STF_LNAME) AS MemberName";
	$sql .= "SELECT " . implode(',', $arrfmember) . " FROM " . _TABLE_MEMBER_ . " a ";
	$sql .= " WHERE 1 ";
	unset($arrfmember);
	$sql .= " ) TBMember ON (a." . _TABLE_PERSONNEL_ . "_MemberID = TBMember.TBMemberID)";
	$sql .= " WHERE 1 ";
	$sql .= " AND a." . _TABLE_PERSONNEL_ . "_ID = " . intval($id);
	unset($arrf);
	$sql .= ") TBmain";
	$sql .= " WHERE 1";
	$z = new __webctrl;
	$z->sql($sql);
	$RecordCount = $z->num();
	$v = $z->row();
	$Row = $v[0];
	$UserType = $Row["UserType"];
	$Marray->UserType = $UserType;
	$Marray->fullname = $Row["Fullname"];
	$Marray->fname = $Row["STF_FNAME"];
	$Marray->lname = $Row["STF_LNAME"];
	if ($UserType == 'personnel') {
		$picturefile = _HTTP_PERSONNEL_UPLOAD_ . '/' . (!empty($Row["Image"]) ? $Row["Image"] : "staff.png");
	} else {
		$picturefile = _HTTP_STUDENT_UPLOAD_ . '/' . (!empty($Row["Image"]) ? $Row["Image"] : "staff.png");
	}
	$data = '';
	$code = '404';
	if (true === function_exists('curl_init')) {
		$ch = curl_init($picturefile);
		curl_setopt_array($ch, array(CURLOPT_RETURNTRANSFER  => true));
		$data = curl_exec($ch);
		$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
	}
	if ($code == "404" || $code == "00") {
		$picturefile = _HTTP_PATH_ . "/web/img/upload/user.jpg";
	}
	$Marray->imgprofile = $picturefile;
	return $Marray;
}
function getInfoStaff($id)
{
	$Marray = new StdClass;

	$sql = "";
	$sql .= "SELECT * FROM ";
	$sql .= "(";
	$arrf = array();
	$arrf[] = "a." . _TABLE_MEMBER_ . '_ID AS ID';
	$arrf[] = "a." . _TABLE_MEMBER_ . '_PREFIX_NAME_ID AS PREFIX_NAME_ID';
	$arrf[] = "a." . _TABLE_MEMBER_ . '_STF_FNAME AS STF_FNAME';
	$arrf[] = "a." . _TABLE_MEMBER_ . '_STF_MNAME AS STF_MNAME';
	$arrf[] = "a." . _TABLE_MEMBER_ . '_STF_LNAME AS STF_LNAME';
	$arrf[] = "CONCAT(a." . _TABLE_MEMBER_ . "_STF_FNAME,' ',a." . _TABLE_MEMBER_ . "_STF_LNAME) AS Fullname";
	$arrf[] = "a." . _TABLE_MEMBER_ . '_Level AS MyLevel';
	$arrf[] = "a." . _TABLE_MEMBER_ . '_Username AS Username';
	$arrf[] = "a." . _TABLE_MEMBER_ . "_UserType AS UserType";
	$arrf[] = "a." . _TABLE_MEMBER_ . "_PositionText AS PositionText";
	$arrf[] = "a." . _TABLE_MEMBER_ . "_Image AS Image";

	$arrf[] = ' b.' . _TABLE_MEMBER_GROUP_ . "_ID AS GID ";
    $arrf[] = ' b.' . _TABLE_MEMBER_GROUP_ . "_Name AS GName ";

	$sql .= "SELECT " . implode(',', $arrf) . " FROM " . _TABLE_MEMBER_ . " a ";
	$sql .= " LEFT JOIN " . _TABLE_MEMBER_GROUP_ . " b ON (a." . _TABLE_MEMBER_ . "_PositionCode = b." . _TABLE_MEMBER_GROUP_ . "_ID )";
	$sql .= " WHERE 1 ";
	$sql .= " AND a." . _TABLE_MEMBER_ . "_ID = " . intval($id);
	unset($arrf);
	$sql .= ") TB";
	$sql .= " WHERE TB.ID = " . intval($id);
	$z = new __webctrl;
	$z->sql($sql, '1', '1');
	$v = $z->row();
	$RecordCount = $z->num();
	$Row = $v[0];
	$UserType = $Row["UserType"];

	$z->sql($sql);
	$vCount = $z->row();


	$vP = $z->row();


	$Marray->fullname = $Row["Fullname"];
	$Marray->fname = $Row["STF_FNAME"];
	$Marray->lname = $Row["STF_LNAME"];
	$Marray->level = $Row["MyLevel"];
	$Marray->logintype = (!empty($_SESSION['Session_Login_Type']) ? $_SESSION['Session_Login_Type'] : 'None');
	$Marray->staffposition = $Row["GName"];
	$Marray->UserType = $UserType;
	if ($UserType == 'personnel') {
		$picturefile = _HTTP_PATH_UPLOAD_ .'/member/member_'.md5( $Row["ID"]).'/'. (!empty($Row["Image"]) ? $Row["Image"] : "staff.png");
	} else {
		$picturefile = _HTTP_PATH_UPLOAD_ .'/member/member_'.md5( $Row["ID"]).'/'. (!empty($Row["Image"]) ? $Row["Image"] : "staff.png");
	}
	$data = '';
	$code = '404';
	if (true === function_exists('curl_init')) {
		$ch = curl_init($picturefile);
		curl_setopt_array($ch, array(CURLOPT_RETURNTRANSFER  => true));
		$data = curl_exec($ch);
		$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
	}
	if ($code == "404" || $code == "00") {
		$picturefile =  '../admin/assets/images/profile.png';
	}
	$Marray->imgprofile = $picturefile;

	//last login
	$ArrFieldx[] = _TABLE_MEMBER_LOGIN_ . "_MemberID AS MemberID";
	$ArrFieldx[] = _TABLE_MEMBER_LOGIN_ . "_Type  AS Type";
	$ArrFieldx[] = _TABLE_MEMBER_LOGIN_ . "_CreateDate  AS CreateDate";
	$sqlx = "SELECT " . implode(",", $ArrFieldx) . " FROM " . _TABLE_MEMBER_LOGIN_ . " WHERE " . _TABLE_MEMBER_LOGIN_ . "_Type = 'Login' AND " . _TABLE_MEMBER_LOGIN_ . "_MemberID = " . intval($id);
	$sqlx .= " ORDER BY " . _TABLE_MEMBER_LOGIN_ . "_CreateDate DESC";
	$zx = new __webctrl;
	$zx->sql($sqlx, '2', '1');
	$vx = $zx->row();
	$RecordCountx = $zx->num();
	if ($RecordCountx > 1) {
		$RowD = $vx[1];
		$datelastlogin = (!empty($RowD['CreateDate']) ? $RowD['CreateDate'] : '0000-00-00 00:00:00');
	} else {
		$datelastlogin = '0000-00-00 00:00:00';
	}
	$Marray->datelastlogin = $datelastlogin;
	$Marray->datelastlogintext = dateformat($datelastlogin, 'j F Y H:i', 'Thai');
	return $Marray;
}
function getPmaInStaff($staffid = 0)
{
	$Marray = new StdClass;
	$z = new __webctrl;
	$sql = "";
	$ArrMainF = array();
	$ArrMainF[] = "TB.*";
	$sql .= "SELECT " . implode(',', $ArrMainF) . " FROM ";
	$sql .= "(";
	$sql .= "SELECT " . _TABLE_MEMBER_PMA_ . "_MemberID AS MemberID," . _TABLE_MEMBER_PMA_ . "_MainGroupID AS MainGroupID," . _TABLE_MEMBER_PMA_ . "_GroupID AS GroupID," . _TABLE_MEMBER_PMA_ . "_Permission AS PMA FROM " . _TABLE_MEMBER_PMA_;
	$sql .= " WHERE " . _TABLE_MEMBER_PMA_ . "_MemberID = " . intval($staffid);
	$sql .= ") TB";
	$sql .= " LEFT JOIN (";
	$sql .= "SELECT " . _TABLE_MEMBER_GROUPPMA_ . "_MainGroupKey AS MainGroupKey FROM " . _TABLE_MEMBER_GROUPPMA_;
	$sql .= " WHERE " . _TABLE_MEMBER_GROUPPMA_ . "_MemberID = " . intval($staffid);
	$sql .= ") TBJoin ON (TB.MainGroupID = TBJoin.MainGroupKey)";
	$sql .= " ORDER BY TB.MainGroupID ASC,TB.GroupID ASC";
	unset($ArrMainF);
	$z->sql($sql);
	$RecordCount = $z->num();
	$vPMA = $z->row();
	$arrayPMA = array();
	$arrayPMASee = array();
	$arrayPMAEdit = array();
	$query = "GroupID='A'";
	$mydataPMA = ArraySearch($vPMA, $query, 1);
	if (count($mydataPMA) > 0) {
		// $arrayPMA["A"] = array_column($mydataPMA, 'PMA');
		$MainGroup = "(" . $vPMA[array_key_first($mydataPMA)]["MainGroupID"] . ")";
		$arrayPMA["A"] = $vPMA[array_key_first($mydataPMA)]["PMA"];
		$arrayPMASee["A"] = ($vPMA[array_key_first($mydataPMA)]["PMA"] == 'RW' || $vPMA[array_key_first($mydataPMA)]["PMA"] == 'R' ? true : false);
		$arrayPMAEdit["A"] = ($vPMA[array_key_first($mydataPMA)]["PMA"] == 'RW' ? true : false);
	} else {
		$MainGroup = "";
		$arrayPMA["A"] = "NA";
		$arrayPMASee["A"] = false;
		$arrayPMAEdit["A"] = false;
	}
	$query = "GroupID='B'";
	$mydataPMA = ArraySearch($vPMA, $query, 1);
	if (count($mydataPMA) > 0) {
		// $arrayPMA["B"] = array_column($mydataPMA, 'PMA');
		$arrayPMA["B"] = $vPMA[array_key_first($mydataPMA)]["PMA"];
		$arrayPMASee["B"] = ($vPMA[array_key_first($mydataPMA)]["PMA"] == 'RW' || $vPMA[array_key_first($mydataPMA)]["PMA"] == 'R' ? true : false);
		$arrayPMAEdit["B"] = ($vPMA[array_key_first($mydataPMA)]["PMA"] == 'RW' ? true : false);
	} else {
		$arrayPMA["B"] = "NA";
		$arrayPMASee["B"] = false;
		$arrayPMAEdit["B"] = false;
	}
	$query = "GroupID='C'";
	$mydataPMA = ArraySearch($vPMA, $query, 1);
	if (count($mydataPMA) > 0) {
		// $arrayPMA["C"] = array_column($mydataPMA, 'PMA');
		$arrayPMA["C"] = $vPMA[array_key_first($mydataPMA)]["PMA"];
		$arrayPMASee["C"] = ($vPMA[array_key_first($mydataPMA)]["PMA"] == 'RW' || $vPMA[array_key_first($mydataPMA)]["PMA"] == 'R' ? true : false);
		$arrayPMAEdit["C"] = ($vPMA[array_key_first($mydataPMA)]["PMA"] == 'RW' ? true : false);
	} else {
		$arrayPMA["C"] = "NA";
		$arrayPMASee["C"] = false;
		$arrayPMAEdit["C"] = false;
	}
	$Marray->datastaffid = $staffid;
	$Marray->datarecordcount = $RecordCount;
	$Marray->datapma = $arrayPMA;
	$Marray->datapmasee = $arrayPMASee;
	$Marray->datapmaedit = $arrayPMAEdit;

	$sql = "";
	$ArrMainF = array();
	$ArrMainF[] = "TBmain.*";
	//$ArrMainF[] = "CONCAT(TBmain.prefixname_Name,TBmain.STF_FNAME,' ',TBmain.STF_LNAME) AS FullnameThai";
	$sql .= "SELECT " . implode(',', $ArrMainF) . " FROM ";
	$sql .= "(";
	$arrf = array();
	$arrf[] = "a." . _TABLE_MEMBER_ . '_ID AS ID';
	$arrf[] = "a." . _TABLE_MEMBER_ . '_PREFIX_NAME_ID AS PREFIX_NAME_ID';
	$arrf[] = "a." . _TABLE_MEMBER_ . '_STF_FNAME AS STF_FNAME';
	$arrf[] = "a." . _TABLE_MEMBER_ . '_STF_MNAME AS STF_MNAME';
	$arrf[] = "a." . _TABLE_MEMBER_ . '_STF_LNAME AS STF_LNAME';
	$arrf[] = "CONCAT(c." . _TABLE_REF_PREFIX_ . "_FULLNAME,a." . _TABLE_MEMBER_ . "_STF_FNAME,' ',a." . _TABLE_MEMBER_ . "_STF_LNAME) AS FullnameThai";
	$arrf[] = "a." . _TABLE_MEMBER_ . '_Level AS StaffLevel';
	$arrf[] = "a." . _TABLE_MEMBER_ . '_Username AS Username';
	$arrf[] = "a." . _TABLE_MEMBER_ . "_UserType AS UserType";
	$arrf[] = "a." . _TABLE_MEMBER_ . "_PositionText AS PositionText";
	$arrf[] = "a." . _TABLE_MEMBER_ . "_Image AS Image";
	$arrf[] = "c." . _TABLE_REF_PREFIX_ . "_Code AS prefixname_ID";
	$arrf[] = "c." . _TABLE_REF_PREFIX_ . "_FULLNAME AS prefixname_Name";
	$sql .= "SELECT " . implode(',', $arrf) . " FROM " . _TABLE_MEMBER_ . " a ";
	$sql .= " LEFT JOIN " . _TABLE_REF_PREFIX_ . " c ON (a." . _TABLE_MEMBER_ . "_PREFIX_NAME_ID = c." . _TABLE_REF_PREFIX_ . "_Code )";
	$sql .= " WHERE 1 ";
	$sql .= " AND a." . _TABLE_MEMBER_ . "_ID = " . intval($staffid);
	unset($arrf);
	$sql .= ") TBmain";
	$sql .= " WHERE 1";
	unset($ArrMainF);
	$z->sql($sql);
	$RecordCount = $z->num();
	if ($RecordCount > 0) {
		$v = $z->row();
		$Row = $v[0];
		$Fullname = $Row["FullnameThai"];
		$StaffLevel = $Row["StaffLevel"];
		$Username = $Row["Username"];
		$StaffType = (!empty($Row["StaffTypeID"]) ? $Row["StaffTypeID"] : 0);
		$PositionText = $Row["PositionText"];
		$UserType = $Row["UserType"];
		if ($UserType == 'student') {
			$sql = "SELECT COUNT(*) AS CountData FROM " . _TABLE_STUDENT_;
			$sqlP = "SELECT " . _TABLE_STUDENT_ . "_ID AS PID FROM " . _TABLE_STUDENT_ . " WHERE " . _TABLE_STUDENT_ . "_MemberID = " . intval($staffid);
			$picturefile = _HTTP_STUDENT_UPLOAD_ . (!empty($Row["Image"]) ? $Row["Image"] : "staff.png");
		} else {
			$sql = "SELECT COUNT(*) AS CountData FROM " . _TABLE_PERSONNEL_;
			$sqlP = "SELECT " . _TABLE_PERSONNEL_ . "_ID AS PID FROM " . _TABLE_PERSONNEL_ . " WHERE " . _TABLE_PERSONNEL_ . "_MemberID = " . intval($staffid);
			$picturefile = _HTTP_PERSONNEL_UPLOAD_ . (!empty($Row["Image"]) ? $Row["Image"] : "staff.png");
		}
		$z->sql($sql);
		$vCount = $z->row();
		$CountRecord = $vCount[0]["CountData"];
		$z->sql($sqlP);
		$vP = $z->row();
		$PID = $vP[0]["PID"];

		$data = '';
		$code = '404';
		if (true === function_exists('curl_init')) {
			$ch = curl_init($picturefile);
			curl_setopt_array($ch, array(CURLOPT_RETURNTRANSFER  => true));
			$data = curl_exec($ch);
			$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			curl_close($ch);
		}
		if ($code == "404" || $code == "00") {
			$picturefile = _HTTP_PATH_ . "/web/img/upload/user.jpg";
		}
	} else {
		$PID = 0;
		$Fullname = "";
		$StaffLevel = "User";
		$Username = "";
		$StaffType = 0;
		$PositionText = "ผู้ใช้งานทั่วไป";
		$UserType = "student";
		$picturefile = "";
	}
	$Marray->pid = $PID;
	$Marray->datafullname = $Fullname;
	$Marray->imgprofile = $picturefile;
	$Marray->datalevel = $StaffLevel;
	$Marray->datausername = $Username;
	$Marray->datastafftype = $StaffType;
	$Marray->datastaffposition = $PositionText . " " . $MainGroup;
	$Marray->datastafftype = $UserType;
	$Marray->countmember = $CountRecord;
	return $Marray;
}

function get_min_year($table)
{
	$sql = "";
	$sql .= "SELECT MIN(" . $table . "_Year) as Yearx";
	$sql .= " FROM " . $table;

	$z = new __webctrl;
	$z->sql($sql);
	$RecordCount = $z->num();
	if ($RecordCount > 0) {
		$v = $z->row();
		$Row = $v[0];
		return $Row['Yearx'];
	} else {
		return '-';
	}
}

function getDocumentFile($id, $flag, $subid = 0)
{
	// $id=2;
	$Marray = new StdClass;

	$arrf = array();
	$arrf[] = "a." . _TABLE_DOCUMENT_FILE_ . '_ID AS ID';

	$sqlx = "SELECT " . implode(',', $arrf) . " FROM " . _TABLE_DOCUMENT_FILE_ . " a ";
	$sqlx .= " WHERE 1 ";
	$sqlx .= " AND  a." . _TABLE_DOCUMENT_FILE_ . '_CID' . "= " . intval($id);
	$sqlx .= " AND  a." . _TABLE_DOCUMENT_FILE_ . '_Flag' . "= '" . $flag . "'";
	$sqlx .= " AND  a." . _TABLE_DOCUMENT_FILE_ . '_SubID' . "= " . intval($subid);
	unset($arrf);
	$z = new __webctrl;
	$z->sql($sqlx);
	$vx = $z->row();
	$RecordCount = $z->num();
	if ($RecordCount > 0) {
		$Rowx = $vx[0];
		$docID = $Rowx['ID'];
	} else {
		$docID = 0;
	}

	$ArrField[] = _TABLE_DOCUMENT_FILE_ . "_ID AS ID";
	$ArrField[] = _TABLE_DOCUMENT_FILE_ . "_CID AS CID";
	$ArrField[] = _TABLE_DOCUMENT_FILE_ . "_Subject AS Caption";
	$ArrField[] = _TABLE_DOCUMENT_FILE_ . "_FileName AS FileName";
	$ArrField[] = _TABLE_DOCUMENT_FILE_ . "_FileType AS FileType";
	$ArrField[] = _TABLE_DOCUMENT_FILE_ . "_Flag AS Flag";
	$ArrField[] = _TABLE_DOCUMENT_FILE_ . "_SubID AS SubID";

	$sql = "SELECT " . implode(",", $ArrField) . " FROM " . _TABLE_DOCUMENT_FILE_ . " WHERE 1 ";
	$sql .= " AND " . _TABLE_DOCUMENT_FILE_ . '_ID' . " = " . intval($docID);
	unset($ArrField);

	// return $sql;
	// $z = new __webctrl;
	$z->sql($sql);
	$v = $z->row();
	$RecordCount = $z->num();
	if ($RecordCount > 0) {
		$Row = $v[0];
		$Marray->cid = $Row["CID"];
		$Marray->caption = $Row["Caption"];
		$Marray->filename = $Row["FileName"];
		$Marray->filetype = $Row["FileType"];
		$Marray->flag = $Row["Flag"];
		$Marray->subid = $Row['SubID'];
	} else {
		$Marray->cid = '';
		$Marray->caption = '';
		$Marray->filename = '';
		$Marray->filetype = '';
		$Marray->flag = '';
		$Marray->subid = '';
	}

	return $Marray;
}
function formatBytes($size, $precision = 2)
{
	$base = log($size, 1024);
	$suffixes = array('', 'K', 'M', 'G', 'T');
	return round(pow(1024, $base - floor($base)), $precision) . ' ' . $suffixes[floor($base)];
}
function formatInYear($sumday)
{
	$Marray = new StdClass;
	$years = floor($sumday / 365);
	$months = floor(($sumday - ($years * 365)) / 30.5);
	$days = ($sumday - ($years * 365) - ($months * 30.5));
	$Marray->year = $years;
	$Marray->month = $months;
	$Marray->day = $days;
	return $Marray;
}
function getFaculty($id)
{
	// $id=2;
	$Marray = new StdClass;

	$arrf = array();
	$arrf[] = _TABLE_PGVIMEOFFICE_REF_FAC_ . '_Name AS Name';

	$sqlx = "SELECT " . implode(',', $arrf) . " FROM " . _TABLE_PGVIMEOFFICE_REF_FAC_;
	$sqlx .= " WHERE 1 ";
	$sqlx .= " AND  " . _TABLE_PGVIMEOFFICE_REF_FAC_ . '_ID' . "= " . intval($id);
	unset($arrf);
	$z = new __webctrl;
	$z->sql($sqlx);
	$v = $z->row();
	$RecordCount = $z->num();

	if ($RecordCount > 0) {
		$Row = $v[0];
		$Marray->facName = $Row["Name"];
	} else {
		$Marray->facName = '';
	}

	return $Marray;
}
function thainumDigit($num)
{
	return str_replace(array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9'), array("o", "๑", "๒", "๓", "๔", "๕", "๖", "๗", "๘", "๙"), $num);
}
if (!function_exists('array_key_first')) {
	function array_key_first(array $arr)
	{
		foreach ($arr as $key => $unused) {
			return $key;
		}
		return NULL;
	}
}

function getDateRangeForAllWeeks($start, $end)
{
	$fweek = getDateRangeForWeek($start);
	$lweek = getDateRangeForWeek($end);
	$week_dates = [];
	while ($fweek['sunday'] != $lweek['sunday']) {
		$week_dates[] = $fweek;
		$date = new DateTime($fweek['sunday']);
		$date->modify('next day');

		$fweek = getDateRangeForWeek($date->format("Y-m-d"));
	}
	$week_dates[] = $lweek;

	return $week_dates;
}

function getDateRangeForWeek($date)
{
	$dateTime = new DateTime($date);
	$monday = clone $dateTime->modify(('Sunday' == $dateTime->format('l')) ? 'Monday last week' : 'Monday this week');
	$sunday = clone $dateTime->modify('Sunday this week');
	return ['monday' => $monday->format("Y-m-d"), 'sunday' => $sunday->format("Y-m-d")];
}
function getDatesFromRange($start, $end, $format = 'Y-m-d')
{
	$array = array();
	$interval = new DateInterval('P1D');

	$realEnd = new DateTime($end);
	$realEnd->add($interval);

	$period = new DatePeriod(new DateTime($start), $interval, $realEnd);

	foreach ($period as $date) {
		$array[] = $date->format($format);
	}

	return $array;
}
function getmax_value($option)
{
	$txt = $option["prefix"];
	$txttable = $option["table"];
	$txtfield = $txttable . "_No";
	$sql = "SELECT * FROM";
	$sql .= " (";
	$sql .= "SELECT " . $txtfield . ",CONCAT(REPLACE(LEFT(" . $txtfield . ", 1), '_', ''),SUBSTRING(" . $txtfield . ", 2)) AS NewSeNo FROM " . $txttable;
	if (is_array($option["where"])) {
		$num = count($option["where"]);
		$sql .= " WHERE ";
		if ($num > 0) {
			$i = 0;
			foreach ($option["where"] as $key => $val) {
				if ($i > 0) {
					$sql .= ' AND ';
				}
				$sql .= $key . $val;
				$i++;
			}
		}
	} else {
		$sql .= " WHERE 1";
	}
	if (!empty($option["flag"])) {
		$sql .= " AND " . $txtflag . " = 0";
	}
	$sql .= ") base WHERE 1 ";
	$sql .= " AND NewSeNo LIKE '" . $txt . "%'";
	$sql .= " ORDER BY NewSeNo DESC";
	$z = new __webctrl;
	$z->sql($sql, 1, 1);
	$RecordCount = $z->num();
	if ($RecordCount > 0) {
		$v = $z->row();
		$listnumberlist = $v[0]["NewSeNo"];
		$res = str_replace($txt, "", $listnumberlist);
		$listnumber = intval($res);
	} else {
		$listnumber = 1;
	}
	return $listnumber;
}
function savelogsupdate($option, $id)
{
	$from = $option["TBFROM"];
	$to = $option["TBTO"];
	$ref = $option["Ref"];
	$tbdetail = $option["TBDETAIL"];
	$sql = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '" . $from . "'";
	$z = new __webctrl;
	$z->sql($sql);
	$RecordCount = $z->num();
	$v = $z->row();
	$arrfield = array();
	$arrfieldto = array();
	foreach ($v as $kRow => $Row) {
		if ($kRow > 0) {
			$arrfield[] = $Row["COLUMN_NAME"];
			$arrfieldto[] = str_replace($from, $to, $Row["COLUMN_NAME"]);
		}
	}
	$sql = "";
	$sql .= "SELECT " . implode(', ', $arrfield) . " FROM " . $from . " WHERE " . $from . "_ID = " . intval($id);
	$z = new __webctrl;
	$z->sql($sql);
	$RecordCount = $z->num();
	if ($RecordCount > 0) {
		$v = $z->row();
		$Row = $v[0];
		$insert = array();
		foreach ($arrfieldto as $key => $val) {
			$insert[$val] = "'" . sql_safe($Row[$arrfield[$key]]) . "'";
		}
		$insert[$to . "_" . $ref] = sql_safe(intval($id), false, true);
		$insert[$to . "_Update"] = "NOW()";
		$insert[$to . "_UpdateBy"] = sql_safe($_SESSION['Session_Staff_ID'], false, true);
		if (isset($option["Remark"])) {
			$insert[$to . "_Remark"] = "'" . sql_safe(encodetxterea($option["Remark"])) . "'";
		}
		$z = new __webctrl;
		$z->insert($to, $insert);
		$itemlast = $z->insertid();
		unset($insert);

		$update = array();
		$update[_TABLE_PERSONNEL_FILE_ . "_CID"] = 0;
		$update[_TABLE_PERSONNEL_FILE_ . "_SID"] = "'" . sql_safe($itemlast) . "'";
		$update[_TABLE_PERSONNEL_FILE_ . "_Status"] = "'complete'";
		$z = new __webctrl;
		$z->update(_TABLE_PERSONNEL_FILE_, $update, array(_TABLE_PERSONNEL_FILE_ . "_CID=" => intval($id)));
		unset($update);

		$ardetail = array();
		$ardetail[] = $option["TBDETAIL"] . "_Order AS ListOrder";
		$ardetail[] = $option["TBDETAIL"] . "_WorkingsetID AS ListRefID";
		$ardetail[] = $option["TBDETAIL"] . "_Row AS ListRow";
		$ardetail[] = $option["TBDETAIL"] . "_Name AS ListName";
		$ardetail[] = $option["TBDETAIL"] . "_Value AS ListValue";
		$sql = "SELECT " . implode(', ', $ardetail) . " FROM " . $option["TBDETAIL"] . " WHERE " . $option["TBDETAIL"] . "_" . $option["RefDetail"] . " = " . intval($id);
		unset($ardetail);
		$z = new __webctrl;
		$z->sql($sql);
		$RecordCount = $z->num();
		if ($RecordCount > 0) {
			$v = $z->row();
			foreach ($v as $Row) {
				$insert = array();
				$insert[$option["TBDETAILTO"] . "_Order"] = sql_safe($Row["ListOrder"], false, true);
				$insert[$option["TBDETAILTO"] . "_LogsID"] = sql_safe($itemlast, false, true);
				$insert[$option["TBDETAILTO"] . "_" . $option["RefDetail"]] = sql_safe($Row["ListRefID"], false, true);
				$insert[$option["TBDETAILTO"] . "_Row"] = "'" . sql_safe($Row["ListRow"]) . "'";
				$insert[$option["TBDETAILTO"] . "_Name"] = "'" . sql_safe($Row["ListName"]) . "'";
				$insert[$option["TBDETAILTO"] . "_Value"] = "'" . sql_safe($Row["ListValue"]) . "'";
				$z->insert($option["TBDETAILTO"], $insert);
				unset($insert);
			}
		}
	}
	/*
	$cols = implode(', ',$arrfield);
	$colsto = str_replace($from,$to,$cols);
	$sql = "";
	$sql .= "INSERT INTO ".$to;
	$sql .= " (".$to."_".$ref.",".$to."_Update,".$to."_UpdateBy,".$to."_Remark,".$colsto.") ";
	$sql .= "SELECT ".$from."_ID,NOW(),(SELECT ".$_SESSION['Session_Staff_ID']."),(SELECT '".$option["Remark"]."'),".$cols." FROM ".$from." WHERE ".$from."_ID = ".intval($id);
	$z = new __webctrl;
	$z->query($sql);
	/*
	echo $cols;
	echo $colsto;
	echo '<pre>';
	print_r($arrfield);
	echo '</pre>';
	//echo $sql;
	/*
	$cols = implode(', ',array_keys($option));
	$colsto = str_replace($from,$to,$cols);
	$sql = "";
	$sql .= "INSERT INTO ".$to;
	$sql .= " (".$to."_".$ref.",".$to."_Update,".$to."_UpdateBy,".$colsto.") ";
	$sql .= "SELECT ".$from."_ID,NOW(),(SELECT ".$_SESSION['Session_Staff_ID']."),".$cols." FROM ".$from." WHERE ".$from."_ID = ".intval($id);
	echo $sql;
	*/
	//$z = new __webctrl;
	//$z->query($sql);
}
function getCourseLogsDetail($op)
{
	$Type = $op["Type"];
	$MaxLogsID = $op["LogsID"];
	$ID = $op["ID"];
	$Marray = new StdClass;

	$sql = "";
	$arrfmain[] = "TB.*";
	$arrfmain[] = "TBPersonnel.*";
	$sql .= "SELECT " . implode(',', $arrfmain) . " FROM (";
	$arrfield = array();
	$arrfield[] = _TABLE_REF_EDUCOURSELOGSDETAIL_ . "_Order AS OrderIndex";
	$arrfield[] = _TABLE_REF_EDUCOURSELOGSDETAIL_ . "_Row AS WorkingRow";
	$arrfield[] = _TABLE_REF_EDUCOURSELOGSDETAIL_ . "_LogsID AS LogsID";
	$arrfield[] = _TABLE_REF_EDUCOURSELOGSDETAIL_ . "_CourseID AS CourseID";
	$arrfield[] = "MAX(IF(" . _TABLE_REF_EDUCOURSELOGSDETAIL_ . "_Name = 'StaffID', " . _TABLE_REF_EDUCOURSELOGSDETAIL_ . "_Value, NULL)) AS StaffID";
	$arrfield[] = "MAX(IF(" . _TABLE_REF_EDUCOURSELOGSDETAIL_ . "_Name = 'StaffName', " . _TABLE_REF_EDUCOURSELOGSDETAIL_ . "_Value, NULL)) AS StaffName";
	$arrfield[] = "MAX(IF(" . _TABLE_REF_EDUCOURSELOGSDETAIL_ . "_Name = 'StaffType', " . _TABLE_REF_EDUCOURSELOGSDETAIL_ . "_Value, NULL)) AS StaffType";
	$sql .= "SELECT " . implode(',', $arrfield) . " FROM " . _TABLE_REF_EDUCOURSELOGSDETAIL_ . " WHERE 1";
	$sql .= " AND " . _TABLE_REF_EDUCOURSELOGSDETAIL_ . "_Type IN (" . $Type . ")";
	$sql .= " AND " . _TABLE_REF_EDUCOURSELOGSDETAIL_ . "_LogsID = " . intval($MaxLogsID);
	$sql .= " AND " . _TABLE_REF_EDUCOURSELOGSDETAIL_ . "_CourseID = " . intval($ID);
	$sql .= " AND ";
	$sql .= "(";
	$sql .= _TABLE_REF_EDUCOURSELOGSDETAIL_ . "_CreateDate IN ";
	$sql .= "(";
	$sql .= "SELECT max(" . _TABLE_REF_EDUCOURSELOGSDETAIL_ . "_CreateDate) FROM " . _TABLE_REF_EDUCOURSELOGSDETAIL_;
	$sql .= " WHERE " . _TABLE_REF_EDUCOURSELOGSDETAIL_ . "_Type IN ('AddUser')";
	$sql .= " AND " . _TABLE_REF_EDUCOURSELOGSDETAIL_ . "_LogsID = " . intval($MaxLogsID);
	$sql .= " AND " . _TABLE_REF_EDUCOURSELOGSDETAIL_ . "_CourseID = " . intval($ID);
	$sql .= " GROUP BY " . _TABLE_REF_EDUCOURSELOGSDETAIL_ . "_CourseID";
	$sql .= ")";
	$sql .= ")";
	$sql .= " GROUP BY " . _TABLE_REF_EDUCOURSELOGSDETAIL_ . "_Order," . _TABLE_REF_EDUCOURSELOGSDETAIL_ . "_Row";
	unset($arrfield);
	$sql .= ") TB";
	$sql .= " LEFT JOIN (";
	//Personnel
	$arrf = array();
	$arrf[] = "a." . _TABLE_PERSONNEL_ . "_ID AS PersonnelID";
	$arrf[] = "a." . _TABLE_PERSONNEL_ . "_MemberID AS MemberID";
	$arrf[] = "a." . _TABLE_PERSONNEL_ . "_Gender AS Gender";
	$arrf[] = "a." . _TABLE_PERSONNEL_ . "_CITIZEN_ID AS CITIZEN_ID";
	$arrf[] = "a." . _TABLE_PERSONNEL_ . "_PREFIX_NAME_ID AS PREFIX_NAME_ID";
	$arrf[] = "a." . _TABLE_PERSONNEL_ . "_STF_FNAME AS STF_FNAME";
	$arrf[] = "a." . _TABLE_PERSONNEL_ . "_STF_MNAME AS STF_MNAME";
	$arrf[] = "a." . _TABLE_PERSONNEL_ . "_STF_LNAME AS STF_LNAME";
	$arrf[] = "CONCAT(a." . _TABLE_PERSONNEL_ . "_PREFIX_NAME_Text,a." . _TABLE_PERSONNEL_ . "_STF_FNAME,' ',a." . _TABLE_PERSONNEL_ . "_STF_LNAME) AS FullnameThai";
	$arrf[] = "a." . _TABLE_PERSONNEL_ . "_importpost AS PositionNow";
	$arrf[] = "a." . _TABLE_PERSONNEL_ . "_ExpertiseText AS ExpertiseText";
	$arrf[] = "a." . _TABLE_PERSONNEL_ . "_WorkingAgeYear AS WorkingAgeYear";
	$arrf[] = "a." . _TABLE_PERSONNEL_ . "_WorkingAgeMonth AS WorkingAgeMonth";
	$arrf[] = "a." . _TABLE_PERSONNEL_ . "_WorkingAgeDay AS WorkingAgeDay";
	$arrf[] = "a." . _TABLE_PERSONNEL_ . "_BIRTHDAY AS Birthay";
	$arrf[] = "a." . _TABLE_PERSONNEL_ . "_Teacher_Code AS Teacher_Code";
	$arrf[] = "FLOOR(DATEDIFF(CURDATE(),a." . _TABLE_PERSONNEL_ . "_StartWorkDate)/365) AS RealOperatingLife";
	$arrf[] = "IF(a." . _TABLE_PERSONNEL_ . "_RetirementDate='0000-00-00',LAST_DAY(IF(MONTH(a." . _TABLE_PERSONNEL_ . "_BIRTHDAY)<=9,DATE_ADD( CONCAT(DATE_FORMAT(a." . _TABLE_PERSONNEL_ . "_BIRTHDAY, '%Y-'), '09-30'), INTERVAL 60 YEAR ),DATE_ADD(a." . _TABLE_PERSONNEL_ . "_BIRTHDAY, INTERVAL 61 YEAR ))),a." . _TABLE_PERSONNEL_ . "_RetirementDate) AS RealLastDay";
	$arrf[] = "COUNT(TBJoin.PersonnelID) AS CountArticle";
	$arrf[] = "TBMember.Image";
	$arrf[] = "TBEduMAXLev.*";
	$sql .= "SELECT " . implode(',', $arrf) . " FROM " . _TABLE_PERSONNEL_ . " a ";
	$sql .= " LEFT JOIN (";
	$arrfjoin = array();
	$arrfjoin[] = "a." . _TABLE_PERSONNEL_ARTICLE_ . "_ID AS ID";
	$arrfjoin[] = "a." . _TABLE_PERSONNEL_ARTICLE_ . "_PersonnelID AS PersonnelID";
	$arrfjoin[] = "a." . _TABLE_PERSONNEL_ARTICLE_ . "_MemberID AS MemberID";
	$arrfjoin[] = "a." . _TABLE_PERSONNEL_ARTICLE_ . "_CreateDate AS CreateDate";
	$sql .= "SELECT " . implode(',', $arrfjoin) . " FROM " . _TABLE_PERSONNEL_ARTICLE_ . " a ";
	$sql .= " WHERE a." . _TABLE_PERSONNEL_ARTICLE_ . "_Type = 'Articles'";
	unset($arrfjoin);
	$sql .= ") TBJoin ON (a." . _TABLE_PERSONNEL_ . "_ID = TBJoin.PersonnelID)";
	$sql .= " LEFT JOIN (";
	$arrfmember = array();
	$arrfmember[] = "a." . _TABLE_MEMBER_ . "_ID AS TBMemberID";
	$arrfmember[] = "a." . _TABLE_MEMBER_ . "_Level AS MyLevel";
	$arrfmember[] = "a." . _TABLE_MEMBER_ . "_Username AS Username";
	$arrfmember[] = "a." . _TABLE_MEMBER_ . "_UserType AS UserType";
	$arrfmember[] = "a." . _TABLE_MEMBER_ . "_Image AS Image";
	$sql .= "SELECT " . implode(',', $arrfmember) . " FROM " . _TABLE_MEMBER_ . " a ";
	$sql .= " WHERE 1 ";
	unset($arrfmember);
	$sql .= " ) TBMember ON (a." . _TABLE_PERSONNEL_ . "_MemberID = TBMember.TBMemberID)";
	$sql .= " LEFT JOIN (";
	$arrfedu = array();
	$arrfedu[] = "a." . _TABLE_PERSONNEL_LEAVE_ . "_PersonnelID AS EDUPersonnelID";
	$arrfedu[] = "a." . _TABLE_PERSONNEL_LEAVE_ . "_MemberID AS EDUMemberID";
	$arrfedu[] = "a." . _TABLE_PERSONNEL_LEAVE_ . "_LeaveTypeID AS LeaveTypeID";
	$arrfedu[] = "a." . _TABLE_PERSONNEL_LEAVE_ . "_LeaveTypeText AS LeaveTypeText";
	$arrfedu[] = "a." . _TABLE_PERSONNEL_LEAVE_ . "_LeaveStartDate AS LeaveStartDate";
	$arrfedu[] = "a." . _TABLE_PERSONNEL_LEAVE_ . "_LeaveEndDate AS LeaveEndDate";
	$sql .= "SELECT " . implode(',', $arrfedu) . " FROM " . _TABLE_PERSONNEL_LEAVE_ . " a ";
	$sql .= " WHERE 1 ";
	$sql .= " AND a." . _TABLE_PERSONNEL_LEAVE_ . "_LastUpdate IN (SELECT max(" . _TABLE_PERSONNEL_LEAVE_ . "_LastUpdate) FROM " . _TABLE_PERSONNEL_LEAVE_ . " WHERE " . _TABLE_PERSONNEL_LEAVE_ . "_Status = 'Active' GROUP BY " . _TABLE_PERSONNEL_LEAVE_ . "_PersonnelID)";
	unset($arrfedu);
	$sql .= " ) TBEduMAXLev ON (a." . _TABLE_PERSONNEL_ . "_ID = TBEduMAXLev.EDUPersonnelID)";
	$sql .= " WHERE 1";
	$sql .= " GROUP BY a." . _TABLE_PERSONNEL_ . "_ID";
	unset($arrf);
	//end Personnel
	$sql .= ") TBPersonnel ON (TB.StaffID = TBPersonnel.PersonnelID)";
	$sql .= " ORDER BY TB.OrderIndex ASC";
	unset($arrfmain);
	$z = new __webctrl;
	$z->sql($sql);
	$RecordCount = $z->num();
	$v = $z->row();
	$found = array();
	$foundLeaveType = array();
	if ($RecordCount > 0) {
		foreach ($v as $Row) {
			$StaffID = $Row["StaffID"];
			$StaffType = $Row["StaffType"];
			$Fullname = $Row["FullnameThai"];
			$PositionNow = (!empty($Row["PositionNow"]) ? $Row["PositionNow"] : "-");
			$ExpertiseText = (!empty($Row["ExpertiseText"]) ? $Row["ExpertiseText"] : "-");
			$LeaveTypeID = (!empty($Row["LeaveTypeID"]) ? $Row["LeaveTypeID"] : "");
			$LeaveTypeText = (!empty($Row["LeaveTypeText"]) ? $Row["LeaveTypeText"] : "");
			$CountDocument = $Row["CountArticle"] . " เล่ม";
			$Teacher_Code = (!empty($Row["Teacher_Code"]) ? $Row["Teacher_Code"] : "");
			$CITIZEN_ID = (!empty($Row["CITIZEN_ID"]) ? $Row["CITIZEN_ID"] : "");
			$picturefile = _RELATIVE_PERSONNEL_UPLOAD_ . (!empty($Row["Image"]) ? $Row["Image"] : "staff.png");
			if (is_file($picturefile)) {
				$showpicturefile = str_replace(_RELATIVE_PERSONNEL_UPLOAD_, _HTTP_PERSONNEL_UPLOAD_, $picturefile);
			} else {
				$showpicturefile = "../img/icon/user.png";
			}
			if (!empty($LeaveTypeID) && ($LeaveTypeID == 'G' || $LeaveTypeID == 'H' || $LeaveTypeID == 'I')) {
				$LeaveType = true;
			} else {
				$LeaveType = false;
			}
			$arr["StaffID"] = $StaffID;
			$arr["StaffType"] = $StaffType;
			$arr["Fullname"] = $Fullname;
			$arr["PositionNow"] = $PositionNow;
			$arr["ExpertiseText"] = $ExpertiseText;
			$arr["CountDocument"] = $CountDocument;
			$arr["LeaveType"] = $LeaveType;
			$arr["LeaveTypeID"] = $LeaveTypeID;
			$arr["LeaveTypeText"] = $LeaveTypeText;
			$arr["showpicturefile"] = $showpicturefile;
			$arr["Teacher_Code"] = $Teacher_Code;
			$arr["CITIZENID"] = $CITIZEN_ID;
			$found[] = $arr;
			$foundLeaveType[] = $LeaveType;
		}
	}
	if (in_array(true, $foundLeaveType, TRUE)) {
		$Marray->dataleave = true;
	} else {
		$Marray->dataleave = false;
	}
	//$Marray->sql = $sql;
	$Marray->data = $found;
	return $Marray;
}


function DateThaiFull($strDate)
{
	$strYear = date("Y", strtotime($strDate)) + 543;
	$strMonth = date("n", strtotime($strDate));
	$strDay = date("j", strtotime($strDate));
	$strHour = date("H", strtotime($strDate));
	$strMinute = date("i", strtotime($strDate));
	$strSeconds = date("s", strtotime($strDate));
	$strMonthCut = array("", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคท", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤษจิกายน", "ธันวาคม");
	$strMonthThai = $strMonthCut[$strMonth];
	//$strYear = substr($strYear,-2);
	return $strDay . " " . $strMonthThai . " " . $strYear;
}
function savelogsaccess($option)
{
	$ISTB = $option["TBISTABLE"];
	$Module = $option["TBMOD"];
	$from = $option["TBFROM"];
	$fromid01 = (isset($option["TBFROMID01"]) ? $option["TBFROMID01"] : 0);
	$fromid02 = (isset($option["TBFROMID02"]) ? $option["TBFROMID02"] : 0);
	$type = $option["TBTYPE"];
	$Remark = $option["REMARK"];
	$by = (isset($option["BY"]) ? $option["BY"] : $_SESSION['Session_Staff_ID']);
	$ua = getBrowser();
	$yourbrowser = $ua['name'] . " " . $ua['version'];
	$z = new __webctrl;
	$itemรinsert = 0;
	if ($ISTB) {
		switch ($Module) {
			case 'Personel':
				$insert[$from . "_PersonnelID"] = sql_safe($fromid01, false, true);
				$insert[$from . "_MemberID"] = sql_safe($fromid02, false, true);
				$insert[$from . "_Type"] = "'" . sql_safe($type) . "'";
				$insert[$from . "_Remark"] = "'" . sql_safe($Remark) . "'";
				$insert[$from . "_CreateDate"] = "NOW()";
				$insert[$from . "_LastUpdate"] = "NOW()";
				$insert[$from . "_UpdateBy"] = sql_safe($by, false, true);
				$insert[$from . "_IP"] = "'" . get_real_ip() . "'";
				$insert[$from . "_Browser"] = "'" . sql_safe($yourbrowser) . "'";
				$insert[$from . "_Platform"] = "'" . sql_safe($ua['platform']) . "'";
				$insert[$from . "_userAgent"] = "'" . sql_safe($ua['userAgent']) . "'";
				$z->insert($from, $insert);
				$itemรinsert = $z->insertid();
				unset($insert);
				break;
			case 'PersonelOrder':
				$itemรinsert = $fromid01;
				break;
			case 'Subject':
				$itemรinsert = $fromid01;
				break;
			default:
				$itemรinsert = $fromid01;
		}
	}
	$typyToLogs = $Module . $type;
	$insert[_TABLE_MEMBER_LOGIN_ . "_MemberID"] = "'" . sql_safe($by) . "'";
	$insert[_TABLE_MEMBER_LOGIN_ . "_IP"] = "'" . get_real_ip() . "'";
	$insert[_TABLE_MEMBER_LOGIN_ . "_Type"] = "'" . sql_safe($typyToLogs) . "'";
	$insert[_TABLE_MEMBER_LOGIN_ . "_CreateDate"] = "NOW()";
	$insert[_TABLE_MEMBER_LOGIN_ . "_RelateIDLogs"] = sql_safe($itemรinsert, false, true);
	$insert[_TABLE_MEMBER_LOGIN_ . "_Remark"] = "'" . sql_safe($Remark) . "'";
	$insert[_TABLE_MEMBER_LOGIN_ . "_Browser"] = "'" . sql_safe($yourbrowser) . "'";
	$insert[_TABLE_MEMBER_LOGIN_ . "_Platform"] = "'" . sql_safe($ua['platform']) . "'";
	$insert[_TABLE_MEMBER_LOGIN_ . "_userAgent"] = "'" . sql_safe($ua['userAgent']) . "'";
	$z->insert(_TABLE_MEMBER_LOGIN_, $insert);
	unset($insert);
}
