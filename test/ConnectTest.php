<?php
/**
* Connect Test
*
* PHP version 7
*
* @category ConnectTest
* @package  Innebandybokning
* @author   Markus Thulin <macky_b@hotmail.com>
* @license  http://www.opensource.org/licenses/mit-license.php MIT
* @link     https://github.com/thulin82/innebandybokning
*/
/**
* Connect Test
*
* PHP version 7
*
* @category ConnnectTest
* @package  Innebandybokning
* @author   Markus Thulin <macky_b@hotmail.com>
* @license  http://www.opensource.org/licenses/mit-license.php MIT
* @link     https://github.com/thulin82/innebandybokning
*/
class ConnectTest extends \PHPUnit\Framework\TestCase
{
    private $_test;
    /**
     * Test Setup
     *
     * @return void
     */
    public function setUp()
    {
    }
    
    /**
     * Test Teardown
     *
     * @return void
     */
    public function tearDown()
    {
    }
    
    /**
     * Test Dummy
     *
     * @return void
     */
    public function testDummy()
    {
        $string  = "testDummy";
        $res     = "testDummy";
        $this->assertEquals($string, $res, "dummy failed");
    }
}