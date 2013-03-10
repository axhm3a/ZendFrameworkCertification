<?php

class Bootstrap extends Zend_Controller_
{
    public function _initLayout()
    {
        Zend_Layout::startMvc();
        echo "ok";
    }
}