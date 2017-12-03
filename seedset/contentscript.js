/*
 Gets the seedset URL typed in by user and sends it to seedset.php where
 it is desplayed on the UI
 @author Shruti Rachh, Mrunal Mahajan, Chaitali Shah
*/
if((document.getElementsByTagName("div")[0].innerHTML))
{
	chrome.extension.sendRequest("request message", function(links) {
	var hr;
	var return_data;
	var result;
	var nw;
	try
	{
		hr=new XMLHttpRequest();
	}
	catch (e)
	{
		try
		{
			hr=new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch (e)
		{
			try
			{
				hr=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e)
			{
				alert("Your browser does not support AJAX, or Javascript is turned off.");
				return false;
			}
		}
	}
	
	// Sends the link to correction.php which checks if it is already present in one of whitelist, blacklist or seedset tables
	var url = "http://localhost:8081/seed/new/correction.php?link="+links;
	hr.open("GET", url, true);	
	hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	hr.send();
	
	// Sends the link to seedset.php once it is confirmed that it is not present in any of the database tables
    hr.onreadystatechange = function() 
	{
	    if(hr.readyState == 4 && hr.status == 200) 
		{
			return_data=hr.responseText;
			if(return_data=="false")
			{
				nw=window.open('http://localhost:8081/seed/new/seedset.php?link='+links,'seed','width=400,height=200');
			}
		}
    }	
});
}
