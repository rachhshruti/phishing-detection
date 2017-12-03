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
	
// Create some variables we need to send to our PHP file
var url = "http://localhost:8081/seed/new/correction.php?link="+links;
hr.open("GET", url, true);	

// Set content type header information for sending url encoded variables in the request
hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    
	hr.send(); // Actually execute the request
	
	// Access the onreadystatechange event for the XMLHttpRequest object
    hr.onreadystatechange = function() 
	{
	    if(hr.readyState == 4 && hr.status == 200) 
		{
			return_data=hr.responseText;
			if(return_data=="false")
			{
				nw=window.open('http://localhost:8081/seed/new/seedset.php?link='+links,'seed','width=400,height=200');
				//nw.moveTo(300,300);
			}
		}
    }	
});
}
