<?php

ini_set("display_errors", "Off");

// Define path to application directory
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));

// Define application environment
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));

// Ensure library/ is on include_path
set_include_path(
    implode(
        PATH_SEPARATOR,
        array(
            realpath(APPLICATION_PATH . '/../library'),
            get_include_path(),
        )
    )
);

require_once 'Zend\Loader.php';
Zend_Loader::registerAutoload();

$frontController = Zend_Controller_Front::getInstance();
$frontController->throwExceptions(true);
$frontController->setControllerDirectory(APPLICATION_PATH . '/controllers');
$frontController->dispatch();
