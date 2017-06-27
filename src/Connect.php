<?php
/**
* Connect
*
* PHP version 7
*
* @category Connect
* @package  Innebandybokning
* @author   Markus Thulin <macky_b@hotmail.com>
* @license  http://www.opensource.org/licenses/mit-license.php MIT
* @link     https://github.com/thulin82/innebandybokning
*/

class Connect
{

    private $options;
    private $db   = null;
    private $stmt = null;

    public function __construct($options)
    {
        $default = array(
            'dsn' => null,
            'username' => null,
            'password' => null,
            'driver_options' => null,
            'fetch_style' => PDO::FETCH_OBJ,
        );
        $this->options = array_merge($default, $options);

        try {
            $this->db = new PDO($this->options['dsn'], $this->options['username'], $this->options['password'], $this->options['driver_options']);
        } catch (Exception $e) {
            //throw $e;
            throw new PDOException('Could not connect to database, hiding connection details.');
        }
    
        $this->db->SetAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, $this->options['fetch_style']);
    }

    public function executeQuery($query, $params = array())
    {
        $this->stmt = $this->db->prepare($query);
        $this->stmt->execute($params);
        $res = $this->stmt->fetchAll();

        return $res;
    }
}
