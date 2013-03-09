<?php

class ZendDbTest extends \PHPUnit_Framework_TestCase
{
    public function testInstantiateDbAdapter()
    {
        $adapter = \Zend_Db::factory(
            'Pdo_Sqlite',
            array(
                'dbname' => dirname(__FILE__) . '/../../../data/test.sqlite'
            )
        );
        $this->assertInstanceOf('\Zend_Db_Adapter_Pdo_Sqlite', $adapter);
    }

    public function testZendDbFactoryWithZendConfig()
    {
        $config = new Zend_Config(
            array(
                'database' => array(
                    'adapter' => 'Pdo_Sqlite',
                    'params'  => array(
                        'dbname' => dirname(__FILE__) . '/../../../data/test.sqlite'
                    )
                )
            )
        );

        $adapter = Zend_Db::factory($config->database);
        $this->assertInstanceOf('\Zend_Db_Adapter_Pdo_Sqlite', $adapter);
    }

    public function testZendDbAdapterForcingConnection()
    {
        $adapter = \Zend_Db::factory(
            'Pdo_Sqlite',
            array(
                'dbname' => dirname(__FILE__) . '/../../../data/test.sqlite'
            )
        );
        $connection = $adapter->getConnection();
        $this->assertInstanceOf('PDO', $connection);
    }
}
