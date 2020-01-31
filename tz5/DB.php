<?php
define('DB_HOST', 'localhost');
define('DB_NAME', 'amasty');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHAR', 'utf8');
// source http://phpfaq.ru/pdo/pdo_wrapper

class DB
{
    protected static $instance = null;

    public function __construct()
    {
    }

    public function __clone()
    {
    }

    public static function instance()
    {
        if (self::$instance === null) {
            $opt = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => true,
            ];
            $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHAR;
            self::$instance = new PDO($dsn, DB_USER, DB_PASS, $opt);
        }
        return self::$instance;
    }

    public static function __callStatic($method, $args)
    {
        return call_user_func_array([self::instance(), $method], $args);
    }

    public static function run($sql, $args = [])
    {
        if (!$args) {
            return self::instance()->query($sql);
        }
        $stmt = self::instance()->prepare($sql);
        $stmt->execute($args);
        return $stmt;
    }
}