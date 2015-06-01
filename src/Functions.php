<?php
/**
* Functions
*
* PHP version 5
*
* @category Functions
* @package  Innebandybokning
* @author   Markus Thulin <macky_b@hotmail.com>
* @license  http://www.opensource.org/licenses/mit-license.php MIT
* @link     https://github.com/thulin82/arsenal_webscrape
*/
/**
* Functions
*
* PHP version 5
*
* @category Functions
* @package  Innebandybokning
* @author   Markus Thulin <macky_b@hotmail.com>
* @license  http://www.opensource.org/licenses/mit-license.php MIT
* @link     https://github.com/thulin82/arsenal_webscrape
*/
class Functions
{
    /**
    * DataBase Escape
    *
    * PHP version 5
    *
    * @param String $post The Post you want to "wash"
    *
    * @category Functions
    * @package  Innebandybokning
    * @author   Markus Thulin <macky_b@hotmail.com>
    * @license  http://www.opensource.org/licenses/mit-license.php MIT
    * @link     https://github.com/thulin82/innebandybokning
    *
    * @return String $post
    */
    public function dbEscape($post)
    {
        if (is_string($post)) {
            if (get_magic_quotes_gpc()) {
                $post = stripslashes($post);
            }
            return $post;
        }
    
        foreach ($post as $key => $val) {
            $post[$key] = dbEscape($val);
        }
       
        return $post;
    }
}