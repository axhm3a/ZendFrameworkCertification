<?php

class ZendAuthTest extends PHPUnit_Framework_TestCase
{
    /**
     * Zend_Auth implements the Singleton pattern
     */
    public function testGetInstance()
    {
        $this->assertInstanceOf('Zend_Auth', Zend_Auth::getInstance());
    }

    public function testAuthViaDb()
    {
        $auth            = Zend_Auth::getInstance();

        // Create Database Adapter
        $databaseAdapter = \Zend_Db::factory(
            'Pdo_Sqlite',
            array(
                'dbname' => dirname(__FILE__) . '/../../../data/test.sqlite'
            )
        );

        // Create Authentication adapter
        $authAdapter     = new Zend_Auth_Adapter_DbTable(
            $databaseAdapter,
            'USER',
            'username',
            'password'/*,
            'MD5(?)' MD5 not available in SQlite, but this would be the syntax */
        );
        $authAdapter->setIdentity('cbergau')
                    ->setCredential('123');

        $auth->setStorage(new Zend_Auth_Storage_NonPersistent());

        // Authenticate
        $result = $auth->authenticate($authAdapter);

        $this->assertEquals(Zend_Auth_Result::SUCCESS, $result->getCode());
    }
}
