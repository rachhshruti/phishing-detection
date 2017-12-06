/* 
Gets the actual and visual links from the email body and sends them back to 
popup.js where they are further processed
@author Shruti Rachh, Mrunal Mahajan
*/
var emailBody = (document.getElementsByClassName("ii gt adP adO")[0].innerHTML);

var locationStart = emailBody.indexOf('<a');
var locationEnd = emailBody.indexOf('</a>');
var hrefLink = emailBody.substring(locationStart,locationEnd);

// Extracts the visual link, the text or link visible to user
var n = hrefLink.split(/[">]/);
var vlink = n[1];

// Extracts the actual link i.e. the link that user gets actually redirected to (not visible)
locationStart = hrefLink.indexOf('href=')
locationEnd = hrefLink.indexOf(' target')
var alink = hrefLink.substring(locationStart+6,locationEnd-1);

// Sends the request with the links which is then handled by listener on popup.js
var links = alink+" "+vlink;
chrome.extension.sendRequest(links);