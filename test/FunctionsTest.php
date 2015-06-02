<?php
/**
* Functions Test
*
* PHP version 5
*
* @category FunctionsTest
* @package  Innebandybokning
* @author   Markus Thulin <macky_b@hotmail.com>
* @license  http://www.opensource.org/licenses/mit-license.php MIT
* @link     https://github.com/thulin82/arsenal_webscrape
*/
/**
* Functions Test
*
* PHP version 5
*
* @category FunctionsTest
* @package  Innebandybokning
* @author   Markus Thulin <macky_b@hotmail.com>
* @license  http://www.opensource.org/licenses/mit-license.php MIT
* @link     https://github.com/thulin82/arsenal_webscrape
*/
class FunctionsTest extends \PHPUnit_Framework_TestCase
{
    private $_test;
    /**
     * Test Setup
     *
     * @return void
     */
    public function setUp() 
    {
        $this->_test = new Functions();
    }
    
    /**
     * Test Teardown
     *
     * @return void
     */
    public function tearDown() 
    {
        unset($this->_test);
    }
    
    /**
     * Test Sanitize(String) in Functions
     *
     * @return void
     */
    public function testSanitize() 
    {
        $string  = "test00900åäö";
        $res     = $this->_test->sanitize($string);
        $this->assertEquals($string, $res, "sanitize fail");
    }
    
    /**
     * Test Sanitize(Array) in Functions
     *
     * @return void
     */
    public function testSanitizeArray() 
    {
        $array   = ["first" => "test00900åäö", "second" => "åäö00900test"];
        $res     = $this->_test->sanitize($array);
        $this->assertEquals($array, $res, "sanitize fail");
    }
    
    /**
     * Test Sanitize(Evil Javascript) in Functions
     *
     * @return void
     */
    public function testSanitizeBadString() 
    {
        $string  = "Hi! <script src='http://www.evilsite.com"
            . "/bad_script.js'></script> It's a good day!";
        $exp     = "Hi!  It's a good day!";
        $res     = $this->_test->sanitize($string);
        $this->assertEquals($exp, $res, "sanitize fail");
    }
}