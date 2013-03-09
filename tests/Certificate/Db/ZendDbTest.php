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
        $sql    = 'SELECT * FROM `bugs`';
        $result = $this->getDbAdapter()->fetchAll($sql);
        $this->assertTrue(is_array($result));

        $sql    = 'SELECT * FROM `bugs` WHERE id = ?';
        $result = $this->getDbAdapter()->fetchAll($sql, 1);
        $this->assertEquals(1, $result[0]['id']);
    }

    public function testInsert()
    {
        // will not insert here, just for demonstration

        /*
        $id = $this->getDbAdapter()->insert(
            'bugs',
            array(
                'description' => 'random'
            )
        );*/
    }

    public function testQuote()
    {
        $name = $this->getDbAdapter()->quote("O'Reilly");
        $this->assertEquals("'O''Reilly'", $name);
    }

    public function testQuoteInto()
    {
        $this->assertEquals(
            "SELECT * FROM bugs WHERE description = 'O''Reilly'",
            $this->getDbAdapter()->quoteInto("SELECT * FROM bugs WHERE description = ?", "O'Reilly")
        );
    }

    public function testQuery()
    {
        /** @var $statement Zend_Db_Statement */
        $statement = $this->getDbAdapter()->query('SELECT * FROM bugs WHERE id = :id', array('id' => 1));
        $this->assertInstanceOf('Zend_Db_Statement', $statement);
        $result = $statement->execute();
        $this->assertTrue($result);
        $dbResult = $statement->fetchAll();
        $this->assertTrue(is_array($dbResult));
        $this->assertEquals(1, $dbResult[0]['id']);
    }

    public function testSimpleFetch()
    {
        /** @var $statement Zend_Db_Statement */
        $statement = $this->getDbAdapter()->query('SELECT * FROM bugs WHERE id = :id', array('id' => 1));
        $this->assertInstanceOf('Zend_Db_Statement', $statement);
        $statement->execute();

        while ($row = $statement->fetch()) {
            $this->assertEquals(1, $row['id']);
        }
    }

    /**
     * @return Zend_Db_Adapter_Pdo_Sqlite
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
