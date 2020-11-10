<?php
	define('HOST', 'localhost');
	if (!defined('ABSPATH'))
		define('ABSPATH', dirname(__FILE__) . '/');
	if (!defined('BASEURL'))
		define('BASEURL', '/Scrap/');
	if (!defined('DBAPI'))
		define('DBAPI', ABSPATH . 'inc/database.php');
	define('HEADER', ABSPATH . 'inc/header.php');
	define('FOOTER', ABSPATH . 'inc/footer.php');
	define('FOOTER_COMPLETE', ABSPATH . 'inc/footer_Complete.php');	
?>
