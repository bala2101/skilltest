<?php
ini_set('max_execution_time', 500);
include("connection.php");
/*
function urlOk($url) {
    $headers = @get_headers($url);
    if($headers[0] == 'HTTP/1.1 200 OK') return true;
    else return false;
}

function curl($url) {
        $ch = curl_init();  
        curl_setopt($ch, CURLOPT_URL, $url);    
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 
        $data = curl_exec($ch); 
        curl_close($ch);   
        return $data;   
    }

/*function get_data($data, $start, $end){
        $data = stristr($data, $start); 
        $data = substr($data, strlen($start));  
        $stop = stripos($data, $end);   
        $data = substr($data, 0, $stop);    
		echo $data;
        return $data;   
	}
echo $data;

function get_data($stripdata, $data, $store){
		preg_match($stripdata, $data, $store);
		if(empty($store)){
				$temp = null;
		} else {
			$temp = $store[1];
		}

	return $temp;
}
$html = file_get_contents('http://edu.cba.gov.pl/actbyyearmonth.html');*/

$q = "SELECT Act,Year FROM data";
$res = mysqli_query($conn, $q);
if(!$res){
	echo "ERROR:".mysqli_error($conn);
}

while($row1 = mysqli_fetch_array($res)){
	$da = file_get_contents('http://edu.cba.gov.pl/actdetails.html?year='.$row1['Year'].'&act='.$row1['Act']);
	preg_match('#<div>Poz. (.*)</div>#', $da, $m1);
		$Act = $m1[1];
		if(empty($Act)){
			$q2 = "UPDATE data SET flag='DELETED' WHERE Act='".$row1['Act']."' AND Year='".$row1['Year']."'";
			if(!mysqli_query($conn, $q2))
				echo "ERROR:".mysqli_error($conn);
		}
}

for($year = 2015;$year>2006;$year--){

	for($act=1;;$act++){ //change condition here 
		$data = file_get_contents('http://edu.cba.gov.pl/actdetails.html?year='.$year.'&act='.$act);
		preg_match('#<div>Poz. (.*)</div>#', $data, $m1);
		$Act = $m1[1];
		if(empty($Act)){
			break;
		} else {
			preg_match('#<p class="uchwalaTytul">(.*)</p>#', $data, $m2);
			if(empty($m2)){$Title = null;}
			else{$Title = $m2[1];}
			preg_match("#<div>Rok: (.*)</div>#", $data, $m3);
			if(empty($m3)){$Year = null;}
			else{$Year = $m3[1];}
			preg_match("#<div>Data aktu: (.*)</div>#", $data, $m4);
			if(empty($m4)){$Date = null;}
			else{$Date = $m4[1];}
			preg_match("#<div>Data ogł.: ....-(.*)-..</div>#",$data, $m5);
			if(empty($m5)){$mon = null;}
			else{$mon = $m5[1];}
			switch($mon){
				case 1: $Month = "styczeÅ„";
						break;
				case 2: $Month = "luty";
						break;
				case 3: $Month = "marzec";
						break;
				case 4: $Month = "kwiecieÅ„";
						break;
				case 5: $Month = "maj";
						break;
				case 6: $Month = "czerwiec";
						break;
				case 7: $Month = "lipiec";
						break;
				case 8: $Month = "sierpień";
						break;
				case 9: $Month = "wrzesień";
						break;
				case 10: $Month = "październik";
						break;
				case 11: $Month = "listopad";
						break;
				case 12: $Month = "grudzień";
						break;
				default: $Month = "Not Available";
						break;
			}
			preg_match("#<div>Czas udostępnienia www: $Date (.*)</div>#", $data, $m6);
			if(empty($m6)){$Time = null;}
			else{$Time = $m6[1];}
			preg_match('#<a class="linkPdf" target="_blank" href="(.*)">PDF ogłoszony</a>#', $data, $m7);
			if(empty($m7)){$PDFogloszony = null;}
			else{$PDFogloszony = $m7[1];}
			preg_match('#<a class="linkXades" target="_blank" href="(.*)">PDF XAdES</a>#', $data, $m8);
			if(empty($m8)){$PDFxades = null;}
			else{$PDFxades = $m8[1];}
			preg_match('#<a class="linkHtml" target="_blank" href="(.*)">Wiza.html</a>#', $data, $m9);
			if(empty($m9)){$wiza = null;}
			else{$wiza = $m9[1];}
			preg_match('#<a class="linkXml" target="_blank" href="(.*)">Wiza.xml</a>#', $data, $m10);
			if(empty($m10)){$wizaxml = null;}
			else{$wizaxml = $m10[1];}
			preg_match('#<a class="linkXml" target="_blank" href="(.*)">pozycja.xml</a>#', $data, $m11);
			if(empty($m11)){$pozycja = null;}
			else{$pozycja = $m11[1];}
			preg_match('#<a class="linkPdf" target="_blank" href="(.*)">PDF źródłowy</a>#', $data, $m12);
			if(empty($m12)){$PDFzrodlowy = null;}
			else{$PDFzrodlowy = $m12[1];}
			preg_match('#<a class="linkLapx" href="(.*)">LAPX/ZIPX źródłowy</a>#',$data, $m13);
			if(empty($m13)){$Lapx = null;}
			else{$Lapx = $m13[1];}
			preg_match('#<a class="linkHtml" target="_blank" href="(.*)">Plik HTML aktu źródłowego</a>#', $data, $m14);
			if(empty($m14)){$Plikhtml = null;}
			else{$Plikhtml = $m14[1];}

			$q3 = "SELECT flag FROM data WHERE Act='".$Act."' AND Year='".$Year."'";
			$res1 = mysqli_query($conn, $q3);
			if(!$res1){echo "ERROR:".mysqli_error($conn);}
			$row2 = mysqli_fetch_array($res1);

			if($row2['flag'] == "PRESENT"){
					continue;
			}

			$query = "INSERT INTO `data` VALUES ('','".$Act."','".$Title."','".$Month."','".$Year."','".$Date."','".$Time."','".$PDFogloszony."','".$PDFxades."','".$wiza."','".$wizaxml."','".$pozycja."','".$PDFzrodlowy."','".$Lapx."','".$Plikhtml."','PRESENT')";
			
			if(mysqli_query($conn, $query)){
			}else{
				echo "Error entering data into table:".mysqli_error($conn);
			}
		}
	}
}

echo "All records are inserted successfully!";
?>