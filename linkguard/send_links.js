/* 
Gets the actual and visual links from the email body and sends them back to 
popup.js where they are further processed
@author Shruti Rachh
*/
var a = (document.getElementsByClassName('ii gt adP adO')[0].innerHTML);

var locationStart = a.indexOf('<a');
var locationend = a.indexOf('</a>');

// Extracts the actual link i.e. the link that user gets actually redirected to (not visible)
var finalString =a.substring(locationStart,locationend);
var n=finalString.split(/[">]/);
var alink=n[1];

// Extracts the visual link, the text or link visible to user
var f_pos=a.indexOf("blank",0);
var vlink=a.substring((f_pos+7),locationend);

// Sends the request with the links which is then handled by listener on popup.js
var links = alink+" "+vlink;
chrome.extension.sendRequest(links);