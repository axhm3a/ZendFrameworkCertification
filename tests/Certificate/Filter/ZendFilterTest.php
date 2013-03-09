<?php

class ZendFilterTest extends PHPUnit_Framework_TestCase
{
    public function testFilterAlnum()
    {
        $filter = new Zend_Filter_Alnum();
        $this->assertEquals('HallodasisteinTest123', $filter->filter('(H)a((((llo das ist ein Test 123'));
        $filter = new Zend_Filter_Alnum(true);
        $this->assertEquals('Hallo das ist ein Test 123', $filter->filter('(H)a((((llo das ist ein Test 123'));
    }

    public function testFilterAlpha()
    {
        $filter = new Zend_Filter_Alpha();
        $this->assertEquals('HallodasisteinTest', $filter->filter('(H)a((((llo das ist ein Test 123'));
        $filter = new Zend_Filter_Alpha(true);
        $this->assertEquals('Hallo das ist ein Test ', $filter->filter('(H)a((((llo das ist ein Test 123'));
    }

    public function testFilterBasename()
    {
        $filter = new Zend_Filter_BaseName();
        $this->assertEquals('test.sqlite', $filter->filter('/data/test.sqlite'));
    }

    public function testFilterDigits()
    {
        $filter = new Zend_Filter_Digits();
        $this->assertEquals('2013', $filter->filter('März 2013'));
    }

    public function testFilterDir()
    {
        $filter = new Zend_Filter_Dir();
        $this->assertEquals('/etc', $filter->filter('/etc/passwd'));
    }

    public function testFilterHtmlEntities()
    {
        $filter = new Zend_Filter_HtmlEntities();
        $this->assertEquals('&amp;', $filter->filter('&'));
    }

    public function testFilterInt()
    {
        $filter = new Zend_Filter_Int();
        $this->assertEquals(1, $filter->filter(1));
        $this->assertEquals(0, $filter->filter('Dies ist eine 1'));
        $this->assertEquals(11, $filter->filter('11'));
        $this->assertEquals(11, $filter->filter(' 11'));
        $this->assertEquals(0, $filter->filter('d11'));
        $this->assertEquals(-4, $filter->filter('-4'));
        $this->assertEquals(-4, $filter->filter(' -4'));
    }

    public function testFilterRealPath()
    {
        $this->markTestSkipped('Can not really test this. Different OS');
        $filter = new Zend_Filter_RealPath();
        $path = '/var/www/../www';
        $this->assertEquals('/var/www', $filter->filter($path));
    }

    public function testFilterStringToLower()
    {
        $filter = new Zend_Filter_StringToLower();
        $this->assertEquals('lowerme', $filter->filter('LOWERME'));
    }

    public function testFilterStringToUpper()
    {
        $filter = new Zend_Filter_StringToUpper();
        $this->assertEquals('UPPERME', $filter->filter('upperme'));
    }

    public function testFilterStringTrim()
    {
        $filter = new Zend_Filter_StringTrim();
        $this->assertEquals('trimme', $filter->filter('    trimme      '));
    }

    public function testFilterStripTags()
    {
        $filter = new Zend_Filter_StripTags();
        $this->assertEquals('link', $filter->filter('<a onclick="javascript:alert(document.cookie)">link</a>'));

        $filter = new Zend_Filter_StripTags();
        $filter->setTagsAllowed('a');
        $this->assertEquals('<a>link</a>', $filter->filter('<a onclick="javascript:alert(document.cookie)">link</a>'));
    }
}
