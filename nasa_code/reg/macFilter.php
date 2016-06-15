<!DOCTYPE html>
<?php
require_once "PHPTelnet.php";
function macFilterManagement($option, $operation, $mac) {
	echo "Hello World<br>";
	$telnet = new PHPTelnet();
	$telent->show_connect_error = 0;
	$result = $telnet->Connect('192.168.1.1', 'root', 'nasa2016');

	switch ($result) {
	case 0:
		echo "login success<br>";
		if ($option == "macFilter") {
			echo "macFilter<br>";
		$telnet->Docommand("./macFilter.sh $operation $mac", $result);
		echo $result;
		} elseif ($option == "getIP") {
			echo "getIP<br>";
//			$telnet->DoCommand("./getIP.sh", $result);
			echo $result;
		}
		break;
	case 1:
		echo '[PHP Telnet] Connect failed: Unable to open network connection';
		break;
	case 2:
		echo '[PHP Telnet] Connect failed: Unknown host';
		break;
	case 3:
		echo '[PHP Telnet] Connect failed: Login failed';
		break;
	case 4:	
		echo '[PHP Telnet] Connect failed: Your PHP version does not support PHP Telnet';
		break;
	}
//	$telnet->Disconnect();
}
?>

