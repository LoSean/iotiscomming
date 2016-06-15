<?php
$action=$_POST["act"];

if(!$action){
die("please choose add/remove");
}

if(!preg_match('/([a-fA-F0-9]{2}[:|\-]?){6}/', $_POST["mac"])) {
echo "invalid mac address";
}else{
include 'macFilter.php';

macFilterManagement("macFilter", "$action", $_POST["mac"]);

$dbhost="localhost";
$dbuser="iot";
$dbpass="testing123";
$dbname="iot";
$conn = mysql_connect($dbhost, $dbuser, $dbpass, $dbname) or die('Error');

session_start();
$username=$_SESSION["username"];

#print $username;

if($action=="add"){
        $sql = "INSERT INTO `device`(`username`, `mac`) VALUES ('".$username."', '".$_POST["mac"]."')";
}else{
        $sql = "DELETE FROM `device` WHERE username='".$username."' AND mac='".$_POST["mac"]."'";
}
mysql_select_db('iot');
$retval = mysql_query( $sql, $conn );

if(! $retval ) {
die('Could not enter data: ' . mysql_error());
}

if($action=="add"){
        echo "Entered data successfully\n";
}else{
        echo "Delete data successfully\n";
}
mysql_close($conn);
}
?>
<form method="get" action="manager.php">
<input type="submit" name="submit" value="Home page">
</form>

