<?php
	include ("dbconfig.php");
	echo '<center>Welcome to your stat page.';
	$q = "SELECT * FROM `radacct` ;";
	//echo $q;
	// Run query
	$r = mysql_query($q);
	echo "<br>";
	echo "====================<br >";
	$last_status = "No Record";
	while($obj = @mysql_fetch_object($r)) {
		$last_status = "UserName: ".$obj->username . "<br > Received: " . $obj->acctinputoctets . "bytes <br >Sent: " .  $obj->acctoutputoctets . "bytes <br >Time: " . $obj->acctsessiontime . "seconds <br >IP address: " . $obj->framedipaddress . "<br>";
	echo $last_status;
	echo "<br >";
	}
#	echo $last_status;
	#echo "<a href='hotspotlogin.php'>back to index</a>";
#	echo "<a href='javascript:history.go(-1)'>back to index</a></center>";
?>


