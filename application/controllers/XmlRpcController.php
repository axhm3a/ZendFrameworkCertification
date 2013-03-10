<?php

class XmlRpcController extends Zend_Controller_Action
{
    public function serverAction()
    {
        $server = new Zend_XmlRpc_Server();
        $server->setClass('Md5Service');
        #$server->addFunction('encrypt');
        echo $server->handle();
    }

    public function clientAction()
    {
        $client = new Zend_XmlRpc_Client('http://localhost/ZendFrameworkCertification/public/xmlrpc/server');

        try {
            $this->view->assign('serverResponse', $client->call('encrypt', 'test'));
        } catch (Zend_Exception $exception) {
            var_dump($client->getLastRequest());
            var_dump($exception->getMessage());
        }
    }
}

class Md5Service
{
    /**
     * Encrypts a string using md5 algorithm
     *
     * Note: When using Zend_XmlRpc, you have to put in PHPDoc here!
     *
     * @param   string  $string
     * @return  string
     */
    public function encrypt($string)
    {
        return md5($string);
    }
}