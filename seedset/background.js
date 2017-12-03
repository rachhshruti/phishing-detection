function onRequest(request,sender,sendResponse)
{
	var links=sender.tab.url;
	chrome.pageAction.show(sender.tab.id);	
	sendResponse(links);
}		
chrome.extension.onRequest.addListener(onRequest);


