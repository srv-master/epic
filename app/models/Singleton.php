<?php


class Singleton
{
    private static $instance = null;
    private $pdo;

    protected function __construct()
    {
        global $dbName, $user, $pass;

        $dsn = "mysql:dbname=".DB_NAME.";host=".HOST.";port=3306;charset=utf8";
        $this->pdo = new PDO($dsn, USER, PASS);
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