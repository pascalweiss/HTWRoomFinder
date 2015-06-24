<?php

//set timezone
date_default_timezone_set('Europe/Berlin');

//site address
define('DIR','http://localhost:8888/HTWRoomFinder/'); // e.g. define('DIR','http://localhost:8888/HTWRoomFinder/');
define('DOCROOT', dirname(__FILE__));

// Credentials for the HTW server
define('DB_TYPE','pgsql');
define('DB_HOST','');
define('DB_NAME','');
define('DB_USER','');
define('DB_PASS','');

//set prefix for sessions
define('SESSION_PREFIX','HTWRoomFinder');

//optionall create a constant for the name of the site
define('SITETITLE','HTWRoomFinder');