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
    * Clean Input
    *
    * PHP version 5
    *
    * @param string $input The string you want to clean
    *
    * @category Functions
    * @package  Innebandybokning
    * @author   Markus Thulin <macky_b@hotmail.com>
    * @license  http://www.opensource.org/licenses/mit-license.php MIT
    * @link     https://github.com/thulin82/innebandybokning
    *
    * @return string $output
    */
    public function cleanInput($input)
    {
        $search = array(
        '@<script[^>]*?>.*?</script>@si',   // Strip out javascript
        '@<[\/\!]*?[^<>]*?>@si',            // Strip out HTML tags
        '@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly
        '@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments
        );

        $output = preg_replace($search, '', $input);
        return $output;
    }

    /**
    * Sanitize
    *
    * PHP version 5
    *
    * @param string $input The string you want to clean
    *
    * @category Functions
    * @package  Innebandybokning
    * @author   Markus Thulin <macky_b@hotmail.com>
    * @license  http://www.opensource.org/licenses/mit-license.php MIT
    * @link     https://github.com/thulin82/innebandybokning
    *
    * @return string $output
    */
    public function sanitize($input)
    {
        $output ='';
        if (is_array($input)) {
            foreach ($input as $var=>$val) {
                $output[$var] = self::sanitize($val);
            }
        } else {
            $output = self::cleanInput($input);
        }
        return $output;
    }
}