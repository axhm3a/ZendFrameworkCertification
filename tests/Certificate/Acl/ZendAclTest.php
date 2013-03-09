<?php

/**
 * ACL = Access Control List
 *
 * Request Objects = Roles
 * Protected Objects = Resources
 */
class ZendAclTest extends PHPUnit_Framework_TestCase
{
    public function testAcl()
    {
        $acl = new Zend_Acl();

        $guest = new GuestRole();
        $user  = new LoggedInUserRole();
        $admin = new AdminRole();

        $someResource  = new SomeResource();
        $adminResource = new AdminResource();

        $acl->addRole($guest);
        $acl->addRole($user, $guest);
        $acl->addRole($admin, $user);

        $acl->add($someResource);
        $acl->add($adminResource);

        $acl->allow($guest, $someResource);
        $acl->allow($admin, $adminResource);

        $this->assertTrue($acl->isAllowed($guest, $someResource));
        $this->assertFalse($acl->isAllowed($guest, $adminResource));

        $this->assertTrue($acl->isAllowed($user, $someResource));
        $this->assertFalse($acl->isAllowed($user, $adminResource));

        $this->assertTrue($acl->isAllowed($admin, $someResource));
        $this->assertTrue($acl->isAllowed($admin, $adminResource));
    }
}

class SomeResource implements Zend_Acl_Resource_Interface
{
    /**
     * Returns the string identifier of the Resource
     *
     * @return string
     */
    public function getResourceId()
    {
        return 'SomeResource';
    }
}

class AdminResource implements Zend_Acl_Resource_Interface
{
    /**
     * Returns the string identifier of the Resource
     *
     * @return string
     */
    public function getResourceId()
    {
        return 'AdminResource';
    }
}

/**
 * Roles: Multiple Inheritance
 */
class GuestRole implements Zend_Acl_Role_Interface
{
    /**
     * Returns the string identifier of the Role
     *
     * @return string
     */
    public function getRoleId()
    {
        return 'guest';
    }
}

class LoggedInUserRole implements Zend_Acl_Role_Interface
{
    /**
     * Returns the string identifier of the Role
     *
     * @return string
     */
    public function getRoleId()
    {
        return 'user';
    }
}

class AdminRole implements Zend_Acl_Role_Interface
{
    /**
     * Returns the string identifier of the Role
     *
     * @return string
     */
    public function getRoleId()
    {
        return 'admin';
    }
}