chrome.extension.onRequest.addListener(function(links) 
{
	var hr;
	var s=links.split(" ");
	var d_url=s[1];
	if(s[1].indexOf("%") !== -1)	//% is present
	{
		d_url=decode(s[1]);
		var h="http://";
		d_url=h+d_url;
		d_url=d_url.replace(" ","");
	}
	var links = s[0]+" "+d_url;
	function decode(e_url)
	{
		var temp=e_url.split("//");
		var temp1=temp[1];
		var newString = temp1.replace(/<wbr>/g,"");  
		var temp2=newString.split("%");
		var d_url=" ";
		for (var i = 0; i <temp2.length; i++) 
		{
			d_url+=String.fromCharCode(temp2[i]);	
		}
		return d_url;
	}
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
    var url = "http://localhost:8081/linkguard/url_phase.php?link="+links;
	hr.open("GET", url, true);
	
// Set content type header information for sending url encoded variables in the request
   hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    
	// Access the onreadystatechange event for the XMLHttpRequest object
    hr.onreadystatechange = function() 
	{
	    if(hr.readyState == 4 && hr.status == 200)
		{
			var return_data=hr.responseText; 
			document.getElementById('stat').innerHTML=return_data;
		}
    }

	// Send the data to PHP now
	hr.send(); // Actually execute the request
	document.getElementById('stat').innerHTML="Processing...";
});

window.onload = function() 
{
	chrome.windows.getCurrent(function (currentWindow) 
	{
		chrome.tabs.query({active: true, windowId: currentWindow.id},function(activeTabs) 
		{
			chrome.tabs.executeScript(activeTabs[0].id, {file: 'send_links.js', allFrames: true});
		});
	});
};
