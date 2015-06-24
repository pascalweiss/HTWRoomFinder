# HTWRoomFinder

A webapp for students, professors and teaching staff of HTW-Berlin. 
It displays all available rooms at a certain date/time. 
It uses [simple-MVC](https://github.com/simple-mvc-framework/framework) to structure the PHP code. 

Requirements
============
To make it work you need to crawl the www.htw-berlin.de and store it to a postgreSQl database.
This can be done with the [LSFEventScraper](https://github.com/pascalweiss/LSFEventScraper)

![](https://github.com/pascalweiss/pics/blob/master/htw-roomfinder.png?raw=true)

Configuration
=============
To display the available rooms, the app needs to connect to a database. 
Therefor you need to provide the credentials to your database (collected by [LSFEventScraper](https://github.com/pascalweiss/LSFEventScraper)) to the app. 
This can be done in ```config.php```

