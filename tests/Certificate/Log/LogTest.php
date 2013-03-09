<?php

class LogTest extends PHPUnit_Framework_TestCase
{
    public function testDbLogger()
    {
        $databaseAdapter = Zend_Db::factory(
            'PDO_SQLITE',
            array(
                'dbname' => dirname(__FILE__) . '/../../../data/test.sqlite'
            )
        );
        $databaseTableName = 'logs';
        $columnMapping = array('message' => 'message');

        $log = new Zend_Log();
        $log->addWriter(new Zend_Log_Writer_Db($databaseAdapter, $databaseTableName, $columnMapping));
        $log->info('Info Message');
    }
}
