<?php

//set timezone
date_default_timezone_set('Europe/Berlin');

//site address
define('DIR','http://localhost:8888/HTWRoomFinder/');
define('DOCROOT', dirname(__FILE__));

// Credentials for the HTW server
define('DB_TYPE','pgsql');
define('DB_HOST','db.f4.htw-berlin.de');
define('DB_NAME','_s0544768__htwroomfinder');
define('DB_USER','_s0544768__htwroomfinder_generic');
define('DB_PASS','13h%mdI-Sa#DevPSQ');

//set prefix for sessions
define('SESSION_PREFIX','HTWRoomFinder');

//optionall create a constant for the name of the site
define('SITETITLE','HTWRoomFinder');