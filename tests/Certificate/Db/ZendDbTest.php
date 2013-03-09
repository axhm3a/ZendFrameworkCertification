<?php

class ZendDbTest extends \PHPUnit_Framework_TestCase
{
    public function testInstantiateDbAdapter()
    {
        $this->assertInstanceOf('\Zend_Db_Adapter_Pdo_Sqlite', $this->getDbAdapter());
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
        $this->assertInstanceOf('PDO', $this->getDbAdapter()->getConnection());
    }

    public function testZendDbFetchAll()
    {
        $sql = 'SELECT * FROM `bugs`';
        $result = $this->getDbAdapter()->fetchAll($sql);
        $this->assertTrue(is_array($result));

        $sql = 'SELECT * FROM `bugs` WHERE id = ?';
        $result = $this->getDbAdapter()->fetchAll($sql, 1);
        $this->assertEquals(1, $result[0]['id']);
    }


    /**
     * @return Zend_Db_Adapter_Abstract
     */
    public function getDbAdapter()
    {
        return \Zend_Db::factory(
            'Pdo_Sqlite',
            array(
                'dbname' => dirname(__FILE__) . '/../../../data/test.sqlite'
            )
        );
    }
}
