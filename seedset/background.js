/*
 When the seedset extension is added, it automatically runs in background, when
 a user visits a page by typing in the URL which implies it is a trusted site 
 and the user will see a popup window to add this link to our seedset database
 table
 @author Shruti Rachh
*/
function onRequest(request,sender,sendResponse)
{
	var links=sender.tab.url;
	chrome.pageAction.show(sender.tab.id);	
	sendResponse(links);
}		
chrome.extension.onRequest.addListener(onRequest);


