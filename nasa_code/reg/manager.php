<html>
<head>
<title>Management page</title>
<style>
table, th, td {
        border: 1px solid black;
}
</style>
<?php
session_start();
$username=$_POST['usr'];
if(!$username){
$username=$_SESSION["username"];
#$username="Mark";
}
$_SESSION["username"]=$username;

?>
<?php
        $dbhost="localhost";
        $dbuser="iot";
        $dbpass="testing123";
        $dbname="iot";
        $conn = mysql_connect($dbhost, $dbuser, $dbpass, $dbname) or die('Error');
        //get datafrom database
        mysql_select_db('iot');
        $sql2 = "SELECT * FROM device
                WHERE username='".$username."';";
        $ret2 = mysql_query($sql2, $conn);
        $device_count = mysql_num_rows($ret2);

        $sql = "SELECT device.username, device.mac, online.ip
                From device
                LEFT JOIN online
                ON device.mac=online.mac
                WHERE username='".$username."';";
        $ret = mysql_query($sql, $conn);
        $total_records = mysql_num_rows($ret);
        $MAX_dev = 3;
        #mysql_close($conn);
?>

</head>

<body>
<h1>User managemet page</h1>
<h2>Login info</h2>
<?php echo "The time is " . date("h:i:sa"); ?>
<p><?php print "Username: $username";?><p>
<p><?php print "Quota: $device_count/$MAX_dev"; ?></p>
<h2>Add IOT Device</h2>

<?php
if($device_count<$MAX_dev){
?>
<form method="post" action="edit.php">
<input type="hidden" name="act" value="add">
MAC address: <input type="text" name="mac">
<!--<input type="hidden" name="username" value="">-->
<input type="submit" name="submit" value="Submit">
</form>
<?php
}else{
?>
<p>No more quota!</p>
<?php
}
?>

<h2>IOT registered</h2>

<table>
<tr>
<td>IOT MAC address</td>
<td>Status</td>
</tr>
<?php while($row = mysql_fetch_array($ret)){
echo "<tr><td>".$row[mac]."</td>";

if($row[ip]){
echo "<td>".$row[ip]."</td>";
} else {
echo "<td>offline</td>";}

print "<td>";?>
<form method="post" id="my_form" action="edit.php">
<input type="hidden" name="act" value="del" form="my_form">
<input type="hidden" name="mac" value="<?php echo "$row[mac]"?>" form="my_form">
<input type="submit" name="submit" value="Del" form="my_form">
</form>
<?php
echo "</td>";
echo "</tr>";
}
?>
</table>

<button type="button" onClick="window.location.reload()">Refresh</button>
</body>
</html>

