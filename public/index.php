<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// timezone
date_default_timezone_set("Europe/Minsk");

// Define path to application directory
defined('APPLICATION_PATH') || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));

// Define application environment
if ($_SERVER['REMOTE_ADDR'] == "127.0.0.1") define('APPLICATION_ENV', 'development');
else define('APPLICATION_ENV', 'production');

// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APPLICATION_PATH . '/../library'),
    get_include_path(),
)));

/** Zend_Application */
require_once 'Zend/Application.php';

// Create application, bootstrap, and run
$application = new Zend_Application(
    APPLICATION_ENV,
    APPLICATION_PATH . '/configs/application.ini'
);

$application->bootstrap()
            ->run();