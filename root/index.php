<?php
namespace Blog;

ini_set('display_errors', 1);
error_reporting(E_ALL ^ E_NOTICE);
//ini_set('display_startup_errors', 1);
define('BASE_PATH', $_SERVER['DOCUMENT_ROOT']);
define('SITE_PATH', $_SERVER['SERVER_NAME'].'/Blog/');

function autoload($class)
{
	//var_dump($class);
	$filename = BASE_PATH.'/'.str_replace('\\', '/', $class).'.php';
	//var_dump($filename);
	require_once $filename;
}
spl_autoload_register(__NAMESPACE__.'\autoload');

try {
	Session::getInstance()->start();
	Bootstrap::getInstance()->route();
} catch(Exception $e) {
	echo $e->getMessage().'<br/>';
	echo $e->getTraceAsString().'<br/>';
}	
