<?php	
session_start();
$site= $_SESSION['seed_link'];
$site="http://".$site;
if(isset($_GET["submit"]))
{
	$con = mysql_connect("localhost","Phishsecure")or die("Unable to connect to MySQL");
	mysql_select_db("phishsecure", $con);
	$result = mysql_query("INSERT into seedset(surl) VALUES ('$site')");		   
}
$win="yes"; 
?>

