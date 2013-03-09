<?php

class ZendValidateTest extends PHPUnit_Framework_TestCase
{
    public function testIsValidWithStaticIsMethod()
    {
        $this->assertFalse(Zend_Validate::is('asd', 'EmailAddress'));
    }

    public function testIsValidProvidesMessagesAfterFailure()
    {
        $validator = new Zend_Validate_StringLength(3);
        if (!$validator->isValid('asdf')) {
            $this->assertTrue(is_array($validator->getMessages()));
        }
    }

    // The next validators have to be known for the exam

    public function testAlnum()
    {
        $v = new Zend_Validate_Alnum();
        $this->assertTrue($v->isValid('ASDÖ123'));
        $this->assertFalse($v->isValid('ASD123!'));
        $this->assertFalse($v->isValid(' ASD123')); // has a whitespace!

        $v = new Zend_Validate_Alnum(true); // allow whitespaces
        $this->assertTrue($v->isValid(' ASD123')); // has a whitespace but its allowed now!
    }

    public function testAlpha()
    {
        $v = new Zend_Validate_Alpha();
        $this->assertTrue($v->isValid('ABC'));
        $this->assertFalse($v->isValid('ABC1')); // has a number
    }

    public function testBarcode()
    {
        $v = new Zend_Validate_Barcode('upc-a');
        $this->assertTrue($v->isValid('065100004327'));
    }

    public function testBetween()
    {
        $v = new Zend_Validate_Between(1, 10);
        $this->assertTrue($v->isValid(1));
        $this->assertTrue($v->isValid(10));
        $this->assertFalse($v->isValid(10.1));
    }

    public function testCcnum()
    {
        $v = new Zend_Validate_Ccnum();
        $this->assertTrue($v->isValid('374200000000004'));
    }

    public function testDate()
    {
        $v = new Zend_Validate_Date();
        $this->assertFalse($v->isValid('ff'));
        $this->assertTrue($v->isValid('2009-01-01'));
        $this->assertFalse($v->isValid('2009-01-331'));
    }

    public function testDigits()
    {
        $v = new Zend_Validate_Digits();
        $this->assertTrue($v->isValid('12'));
        $this->assertTrue($v->isValid('00'));
        $this->assertFalse($v->isValid('0.0'));
        $this->assertFalse($v->isValid(1.2));
        $this->assertFalse($v->isValid('f00'));
    }

    public function testFloat()
    {
        $v = new Zend_Validate_Float();
        $this->assertTrue($v->isValid(1.2));
        $this->assertTrue($v->isValid(1));
        $this->assertTrue($v->isValid("1"));
        $this->assertFalse($v->isValid("1e"));
    }

    public function testGreaterThan()
    {
        $v = new Zend_Validate_GreaterThan(5);
        $this->assertFalse($v->isValid(4.9));
        $this->assertFalse($v->isValid(5));
        $this->assertTrue($v->isValid(5.1));
    }

    public function testHex()
    {
        $v = new Zend_Validate_Hex();
        $this->assertTrue($v->isValid(0xff));
        $this->assertTrue($v->isValid(123));
        $this->assertTrue($v->isValid('ae23'));
    }

    public function testHostname()
    {
        $v = new Zend_Validate_Hostname(Zend_Validate_Hostname::ALLOW_IP);
        $this->assertTrue($v->isValid('127.0.0.1'));
    }

    public function testInArray()
    {
        $v = new Zend_Validate_InArray(array(1, 2, 'a'));
        $this->assertTrue($v->isValid(1));
        $this->assertTrue($v->isValid(1.0));
        $this->assertTrue($v->isValid(2));
        $this->assertTrue($v->isValid('a'));
        $this->assertFalse($v->isValid('b'));
    }

    public function testInt()
    {
        $v = new Zend_Validate_Int();
        $this->assertTrue($v->isValid(1));
        $this->assertTrue($v->isValid(0.0));
        $this->assertFalse($v->isValid(0.1));
        $this->assertTrue($v->isValid("1"));
    }

    public function testIp()
    {
        $v = new Zend_Validate_Ip();
        $this->assertTrue($v->isValid('1.2.3.4'));
        $this->assertTrue($v->isValid('10.0.0.1'));
        $this->assertTrue($v->isValid('255.255.255.255'));
        $this->assertFalse($v->isValid('0.0.0.256'));
        $this->assertFalse($v->isValid('1.2.3.4.5'));
    }

    public function testLessThan()
    {
        $v = new Zend_Validate_LessThan(10);
        $this->assertFalse($v->isValid(10));
        $this->assertTrue($v->isValid(9.9));
        $this->assertTrue($v->isValid(-1));
    }

    public function testNotEmpty()
    {
        $v = new Zend_Validate_NotEmpty();
        $this->assertFalse($v->isValid(null));
        $this->assertTrue($v->isValid(1));
        $this->assertTrue($v->isValid(0xff));
        $this->assertFalse($v->isValid(''));
        $this->assertTrue($v->isValid(' '));
    }

    public function testRegex()
    {
        $v = new Zend_Validate_Regex('/[a-z]/');
        $this->assertTrue($v->isValid('abc123'));
        $this->assertTrue($v->isValid('abc'));
    }

    public function testStringLength()
    {
        $v = new Zend_Validate_StringLength(1, 3);
        $this->assertTrue($v->isValid('asd'));
        $this->assertFalse($v->isValid('asds'));
    }
}