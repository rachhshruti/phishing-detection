# An Ideal Approach for Detection and Prevention of Phishing Attacks

- Created Google Chrome extension using Javascript, PHP and Python for detecting phishing links in email for Gmail account users.
- The Javascript code fetches the links in email:
		
		`<a href='actual_link'>visual_link</a>`
		
	actual_link: the link that the user is actually redirected
	
	visual_link: the link or text that is visible to the user

- Phishing is detected in two phases:
	1. __URL phase:__ Compares the actual and visual links and checks actual link against the database of genuine URLs and phishing URLs and determines whether there is a possibility of it being a phishing link.
	2. __Webpage matching phase:__ Compares the visual similarity of web pages based on links provided to confirm whether the link is genuine or phishing link.

# Requirements

- [Gmail Account](https://www.google.com/gmail/about/#)
- [Google Chrome](https://www.google.com/chrome/index.html)
- WAMP or equivalent server for PHP depending on OS
- [Python-2.7.x](https://www.python.org/downloads/) along with libraries:
	- PIL
	- Numpy
	- Scipy
	- Skimage
	- PyQt4

# Running the extension

1. Go to More Tools in Google Chrome -> Extensions -> Check the Developer mode -> Load unpacked extension -> Path to folder where manifest.json is
2. Create a databse phishsecure in phpmyadmin page which can be opened by clinking on wamp server icon
3. Import the sql file provided in the database folder in the database created above which will create the tables needed to run
this extension. (Note: the tables are currently empty but you should be able to find some online databases for whitelist and blacklist tables)
4. Open your Gmail and click on the image ![Phishsecure extension](https://github.com/rachhshruti/phishing-detection/blob/master/images/phishsecure_extension_tn.jpg) next to the address bar to run the extension
5. Similarly, you could optionally add the seedset extension which will let you add list of your own trusted sites and it automatically runs in the background when you manually type the url in the address bar, so you do not click on it's icon ![Seedset extension](https://github.com/rachhshruti/phishing-detection/blob/master/images/seedset_extension_tn.jpg) 

# Screenshots

## Phishsecure extension 
![Phishsecure extension](https://github.com/rachhshruti/phishing-detection/blob/master/images/phishsecure_extension.jpg)

## Seedset extension
![Seedset extension](https://github.com/rachhshruti/phishing-detection/blob/master/images/seedset_extension.jpg)   

# Authors

1. Shruti Rachh
2. Mrunal Mahajan
3. Chaitali Shah

# Publication

This project was presented at the International Conference on advances in computer, communication and control (ICAC3) and published in Procedia Computer Science Journal- Elsevier. 

Below is the link,

[An Ideal Approach for detection and prevention of phishing attacks](http://www.sciencedirect.com/science/article/pii/S1877050915007395)
