var a = (document.getElementsByClassName('ii gt adP adO')[0].innerHTML);

var locationStart = a.indexOf('<a');
var locationend = a.indexOf('</a>');

var finalString =a.substring(locationStart,locationend);
var n=finalString.split(/[">]/);
var alink=n[1];

var f_pos=a.indexOf("blank",0);
var vlink=a.substring((f_pos+7),locationend);

var links = alink+" "+vlink;
chrome.extension.sendRequest(links);