<?php
$links=$_GET['link'];
$no = explode(" ", $links);
$alink=$no[0];
$vlink="";
for($i=1;$i<count($no);$i++)
	$vlink=$vlink.' '.$no[$i];
$phishing;
global $case_str;
$case_str='other';
 
function getDNSName($link)
{
	if(strstr($link,"www") || strstr($link,"http") || strstr($link,".com") || strstr($link,"https"))
	{
		$arr=explode("//",$link);
		$arr1=explode(".",$arr[1]);
		if(strstr($arr1[0],"www")|| strstr($arr1[0],"mail") || strstr($arr1[0],"in") || strstr($arr1[0],"site2"))
		{
			return $arr1[1];
		}
		else
		{
			return $arr1[0];
		}
	}
	else 
	{
		return null; 
	}
}

function analyseDNS($actual_link)
{
	global $actual_dns;
	if(strstr($actual_link,"www") || strstr($actual_link,"http") || strstr($actual_link,".com") || strstr($actual_link,"https"))
	{
		$arr=explode("//",$actual_link);
		$arr2=explode("/",$arr[1]);
		$arr1=explode(".",$arr2[0]);
		if(strstr($arr1[0],"www")|| strstr($arr1[0],"mail") || strstr($arr1[0],"in") || strstr($arr1[0],"site2"))
		{
			for ($i = 1; $i < count($arr1) ; $i++) 
			{
				if($i==count($arr1)-1)
				{
					global $actual_dns;
					$actual_dns=$actual_dns.$arr1[$i];
				}
				else
				{
					global $actual_dns;
					$actual_dns=$actual_dns.$arr1[$i].".";
				}
			}
		}
		else
		{
			for ($i = 0; $i < count($arr1) ; $i++) 
			{
				if($i==count($arr1)-1)
				{
					global $actual_dns;
					$actual_dns=$actual_dns.$arr1[$i];
				}
				else
				{
					global $actual_dns;
					$actual_dns=$actual_dns.$arr1[$i].".";
				}
			}
		}
	}
	
	$con = mysql_connect("localhost","Phishsecure")or die("Unable to connect to MySQL");
	mysql_select_db("phishsecure", $con);
	$result = mysql_query("SELECT burl FROM blacklist WHERE burl like '%{$actual_link}%'");
	while($row = mysql_fetch_array($result))
	{
		if(($row['burl']!==null) || ($row['burl']!==""))
		{
			$phishing=1;
			return $phishing;
		}
	}
	
	global $actual_dns;
	$result1 = mysql_query("SELECT wurl FROM whitelist WHERE wurl = '$actual_dns'");
	while($row1 = mysql_fetch_array($result1))
	{
		if(($row1['wurl']!==null) || ($row1['wurl']!==""))
		{
			$phishing=0;
			return $phishing;
		}
	}
	mysql_close($con);
	
	$ph=PatternMatching($actual_link);
	if($ph===3)
		echo "The link in the email will lead you to a Genuine site";
	else
		return $ph;
}

function PatternMatching($a_link)
{
	$con = mysql_connect("localhost","Phishsecure")or die("Unable to connect to MySQL");
	mysql_select_db("phishsecure", $con);
	$result2 = mysql_query("SELECT surl FROM seedset");
	while($row2 = mysql_fetch_array($result2))
	{
		if($row2['surl']===$a_link)
		{
			return 3;
		}
		else
		{
			$bv = Similarity($row2['surl'], $a_link);
			if($bv===true)
			{
				$phishing=2;
				break;
			}
			else
			{
				$phishing=0;
			}
		}
	}
	if($phishing === 0)
	{
		$result3 = mysql_query("SELECT wurl FROM whitelist"); 
		while($row3 = mysql_fetch_array($result3))
		{
			$bv = Similarity($row3['wurl'], $a_link);
			if($bv===true)
			{
				$phishing=2;
				break;
			}
			else
			{
				$phishing=0;
			}
		}
	}
	mysql_close($con);
	return $phishing;
}

function Similarity ($str, $a_link) 
{	
	$str1=getDNSName($str);
	$adns1=getDNSName($a_link);
    $thresh=0.8;
    $pos=((strstr($adns1,$str1)) || (strstr($str1,$adns1)));
    if($pos===true)
    {
		global $v;
		$v=$str;
		return true;
	}
	$maxlen=strlen($adns1);
	$minchanges = levenshtein($str1, $adns1);
	$temp=($maxlen-$minchanges)/$maxlen;
	if (($thresh<$temp) && ($temp<1))
	{ 	
		global $v;
		$v=$str;
		return true; 
	}
	return false;
}

function DCT($a_link,$v_link,$phish,$case)
{
	$command = "C:/Python27/dct-fast.py -t $a_link -m $v_link -s $case";
	$tmp=exec($command);
	if($tmp<=0.1 && $tmp>0)
	{
		$phish=1;
		endfunc($phish,$a_link);
	}
	else
	    echo nl2br("The link in the email will lead you to a Genuine site");
}

function LinkGuard($vlink,$alink)
{
	$vdns=getDNSName($vlink);
	$adns=getDNSName($alink);
	if($vdns===$adns)
	{
		if($alink===$vlink)
			echo nl2br("The link in the email will lead you to a Genuine site");
		else
		{
			global $case_str;
			DCT($alink,$vlink,2,$case_str);
		}
	}
	if(($vdns!==null)&&($adns!==null)&&($vdns!==$adns))
	{
		$phishing=1;
		endfunc($phishing,$alink);
	}
	else 
		$phishing=0;

	if((strpos($adns,".")== true) && (preg_match('#[0=9]#',$adns)))
	{
		$phishing=2;
		global $case_str;
		$case_str='IPcase';
		endfunc($phishing,$alink);
	}	
	$a="\nvdns=" ." ".$vdns."\n";
//Click here case
	if($vdns===null)
	{
		$phishing=AnalyseDNS($alink);
		endfunc($phishing,$alink);
	}
}

function endfunc($phishing,$a_link)
{
	if(($phishing===0)||($phishing===2))
	{	
		global $v;
		global $case_str;
		DCT($a_link,$v,$phishing,$case_str);
	}
	if($phishing===1)
	{
		echo nl2br("Warning: The link in this email might be a phishing link.\nContinue if you trust the link");
		$con = mysql_connect("localhost","Phishsecure")or die("Unable to connect to MySQL");
		mysql_select_db("phishsecure", $con);
		$resultnew = mysql_query("SELECT burl FROM blacklist WHERE burl='$a_link'");
		$num_results = mysql_num_rows($resultnew); 
		if ($num_results === 0)
		{
			$result = mysql_query("INSERT into blacklist(burl) VALUES ('$a_link')");
		}
	}
}
set_time_limit(0);
LinkGuard($vlink,$alink);
?>