<?php
define('WEBROOT', strlen(explode('/', $_SERVER["REQUEST_URI"])[1]) > 0 && explode('/', $_SERVER["REQUEST_URI"])[1][0] == '~' ? '/'.explode('/', $_SERVER["REQUEST_URI"])[1].'/' : '/');
define('ROOT', str_replace("framework/webroot/index.php", "", $_SERVER["SCRIPT_FILENAME"]));
define('FRAMEWORK_ROOT', ROOT."framework/");
define('APPLICATION_ROOT', ROOT."application/");

require(FRAMEWORK_ROOT.'config/core.php');
require(FRAMEWORK_ROOT.'router.php');
require(FRAMEWORK_ROOT.'request.php');
require(FRAMEWORK_ROOT.'dispatcher.php');

$dispatcher = new Dispatcher();
$dispatcher->dispatch();
?>
