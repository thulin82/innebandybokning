<?php
/**
* Autoloader
*
* PHP version 5
*
* @param string $class The name of the class.
*  
* @category Autoloader
* @package  Innebandybokning
* @author   Markus Thulin <macky_b@hotmail.com>
* @license  http://www.opensource.org/licenses/mit-license.php MIT
* @link     https://github.com/thulin82/arsenal_webscrape
*
* @return void
 */
function myAutoloader($class)
{
    $path = sprintf('src/%s.php', $class);
    if (is_file($path)) {
        include $path;
    }
}
spl_autoload_register('myAutoloader');