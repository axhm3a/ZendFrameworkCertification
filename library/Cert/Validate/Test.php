<?php

class Cert_Validate_Test extends Zend_Validate_Abstract
{
    const FORCEERROR = 'forceError';

    protected $_messages = array(
        self::FORCEERROR => 'You forced me!'
    );

    /**
     * Returns true if and only if $value meets the validation requirements
     *
     * If $value fails validation, then this method returns false, and
     * getMessages() will return an array of messages that explain why the
     * validation failed.
     *
     * @param  mixed $value
     * @return boolean
     * @throws Zend_Validate_Exception If validation of $value is impossible
     */
    public function isValid($value)
    {
        if ($value === 'forceerror') {
            $this->_error();
            return false;
        }
        return true;
    }
}
