<?php
/**
* SqlFunctions Test
*
* PHP version 7
*
* @category SqlFunctionsTest
* @package  Innebandybokning
* @author   Markus Thulin <macky_b@hotmail.com>
* @license  http://www.opensource.org/licenses/mit-license.php MIT
* @link     https://github.com/thulin82/innebandybokning
*/
class SqlFunctionsTest extends \PHPUnit\Framework\TestCase
{
    private $_test;
    private $_database;
    /**
     * Test Setup
     *
     * @return void
     */
    public function setUp()
    {
        $array = array('dsn' => 'sqlite::memory:');
        $this->_test = new Connect($array);
        $this->_database = new SqlFunctions($this->_test);
    }
    
    /**
     * Test Teardown
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->_test);
        unset($this->_database);
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
