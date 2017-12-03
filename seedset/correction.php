<?php
/* 
 Checks whether the link is already present in whitelist, blacklist or seedset tables
 @author Chaitali Shah
*/
$url_check=$_GET['link'];
$check="false";
$con1 = mysql_connect("localhost","Phishsecure")or die("Unable to connect to MySQL");
mysql_select_db("phishsecure", $con1);
$result = mysql_query("SELECT wurl FROM whitelist WHERE wurl='$url_check'");
while($row = mysql_fetch_assoc($result))
{
	if(($row['wurl']!==null) || ($row['wurl']!==""))
	{
		$check="true";
	}
}
if($check==="false")
{
	$con = mysql_connect("localhost","Phishsecure")or die("Unable to connect to MySQL");
	mysql_select_db("phishsecure", $con);
	$result1 = mysql_query("SELECT surl FROM seedset WHERE surl='$url_check'");
	while($row1 = mysql_fetch_assoc($result1))
	{
		if(($row1['surl']!==null) || ($row1['surl']!==""))
		{
			$check="true";
		}
	}
}
if($check==="false")
{
	$con = mysql_connect("localhost","Phishsecure")or die("Unable to connect to MySQL");
	mysql_select_db("phishsecure", $con);
	$result1 = mysql_query("SELECT burl FROM blacklist WHERE burl='$url_check'");
	while($row1 = mysql_fetch_assoc($result1))
	{
		if(($row1['burl']!==null) || ($row1['burl']!==""))
		{
			$check="true";
		} 
	}
}
echo $check;
?>