# An Ideal Approach for Detection and Prevention of Phishing Attacks

- Created Google Chrome extension using Javascript, PHP and Python for detecting phishing links in email for Gmail account users.
- The Javascript code fetches the links in email:
		
		`<a href='actual_link'>visual_link</a>`
		
	actual_link: the link that the user is actually redirected
	
	visual_link: the link or text that is visible to the user

- Phishing is detected in two phases:
	1. __URL phase:__ Compares the actual and visual links and checks actual link against the database of genuine URLs and phishing URLs and determines whether there is a possibility of it being a phishing link.
	2. __Webpage matching phase:__ Compares the visual similarity of web pages based on links provided to confirm whether the link is genuine or phishing link.

# Screenshots

## Phishsecure extension 
![Phishsecure extension](https://github.com/rachhshruti/phishing-detection/blob/master/images/phishsecure_extension.jpg)

## Seedset extension
Utility extension to allow users to add URLs, which have been manually typed, to seedset table, which contains a list of safe URLs

![Seedset extension](https://github.com/rachhshruti/phishing-detection/blob/master/images/seedset_extension.jpg)   

# Publication

This project was presented at the International Conference on advances in computer, communication and control (ICAC3) and published in Procedia Computer Science Journal- Elsevier. 

Below is the link,

[An Ideal Approach for detection and prevention of phishing attacks](http://www.sciencedirect.com/science/article/pii/S1877050915007395)
