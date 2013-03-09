<?php

set_include_path(implode(PATH_SEPARATOR, array(
    realpath(__DIR__ . '/../library'),
    get_include_path(),
)));

require_once __DIR__ . '/../vendor/autoload.php';
require_once 'Zend/Loader.php';
Zend_Loader::registerAutoload();