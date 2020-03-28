<?php


class Singleton
{
    private static $instance = null;
    private $pdo;

    protected function __construct()
    {
        $host = '192.168.250.74';
        $user = 'demo1234'; // ersätt med era egna
        $pass = 'demo1234'; // ersätt med era egna
        $dbName = 'demo1234'; // ersätt med era egna
        $dsn = "mysql:dbname=$dbName;host=$host;port=3306;charset=utf8";
        $this->pdo = new PDO($dsn, $user, $pass);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    }

    /**
     * Ge oss koppling mot DB. Skapar sig själv om den inte finns.
     * @return Singleton
     */
    public static function getInstance():Singleton
    {
        if( !self::$instance){
            self:self::$instance = new Singleton();
        }
        return self::$instance;
    }

    /**
     * Ge oss en PDO-objektet som vi jobbar med
     * @return mixed
     */
    public function getPDO()
    {
        return $this->pdo;
    }
}