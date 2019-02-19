<?php


class Apps_Libs_DbConnection{
    protected $username = 'root';
    protected $password = 'root';
    protected $host = 'localhost';
    protected $database = 'php-news';

    protected $queryParams = [];
    protected $tableName = '';
    protected static $connectionInstance = null;
    public function __construct(){
        $this->connect();
    }

    /**
     * Create connect to database
     * 
     * @return new PDO
     */
    public function connect(){
        if(self::$connectionInstance === null){
            try
            {
                self::$connectionInstance = new PDO('mysql:host='.$this->host.';dbname='.$this->database,$this->username,$this->password);
                self::$connectionInstance->setAttribute(PDO::AFTER_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch (Exception $ex)
            {
                echo "ERRO:".$ex->getMessage();
                die();
            }
        }
        return self::$connectionInstance;
    }

    function query($sql, $param = []){
        $q = self::$connectionInstance->prepare($sql);
        if(is_array($param) && $param)
        {
            $q->excute($param);
        }
        else
        {
            $q->excute();
        }
        return $q;
    }

    public function buildQueryParams($params)
    {
        $default = [
            'select' => '',
            'where' => '',
            'other' => '',
            'params' => ''
        ];
        $this->queryParams = array_merge($default,$params);
        return this;
    }
    public function select()
    {
        $sql = 'select '.$this->queryParams['select']." from ".$tableName. "where ".$this->queryParams['other'];
    }

    public function selectOne()
    {

    }

    public function insert()
    {

    }

    public function update()
    {

    }

    public function delete()
    {

    }
}

?>