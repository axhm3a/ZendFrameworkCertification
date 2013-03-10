<?php

class RestController extends Zend_Controller_Action
{
    public function serverAction()
    {
        $server = new Zend_Rest_Server();
        $server->setClass('Md5Service');
        echo $server->handle();
    }

    public function clientAction()
    {
        $client = new Zend_Rest_Client('http://localhost/ZendFrameworkCertification/public/rest/server');
        $result = $client->encrypt()->arg('123')->get();
        $this->view->assign('response', $result->__toString());
    }
}

class Md5Service
{
    /**
     * Encrypts a string using md5 algorithm
     *
     * Note: When using Zend_XmlRpc/Zend_Rest, you have to put in PHPDoc here!
     *
     * @param   string  $string
     * @return  string
     */
    public function encrypt($string)
    {
        return md5($string);
    }
}