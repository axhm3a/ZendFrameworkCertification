<?php

class LogTest extends PHPUnit_Framework_TestCase
{
    public function testDbLogger()
    {
        $log = new Zend_Log();
        $dbWriter = new Zend_Log_Writer_Db(
            Zend_Db::factory(
                'PDO_SQLITE',
                array(
                    'dbname' => dirname(__FILE__) . '/../../../data/test.sqlite'
                )
            ),
            'logs',
            array(
                'message' => 'message'
            )
        );
        $log->addWriter($dbWriter);
        $log->info('Info Message');
    }
}
