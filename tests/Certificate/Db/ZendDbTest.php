<?php

namespace Certificate\Db;

class ZendDbTest extends \PHPUnit_Framework_TestCase
{
    /**
     * How to create a DbAdapter
     */
    public function testInstantiateDbAdapter()
    {
        $adapter = \Zend_Db::factory(
            'Pdo_Sqlite',
            array(
                'dbname' => dirname(__FILE__) . '/../../data/test.sqlite'
            )
        );
        $this->assertInstanceOf('\Zend_Db_Adapter_Pdo_Sqlite', $adapter);
    }
}
