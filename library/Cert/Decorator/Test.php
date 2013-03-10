<?php

class Cert_Decorator_Test extends Zend_Form_Decorator_Abstract
{
    public function render($content)
    {
        echo $content = '*>'.$content.'<*';
    }
}
