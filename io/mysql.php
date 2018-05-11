<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 18-5-9
 * Time: 下午10:10
 */


class AsyncMysql
{
    private $dbSource = '';
    private $dbConfig = [];

    public function __construct()
    {
        $this->dbSource = new swoole_mysql;
        $this->dbConfig = [
            'host' => '127.0.0.1',
            'port' => '3306',
            'user' => 'root',
            'password' => '123456',
            'database' => 'swoole',
            'charset' => 'utf8'
        ];
    }

    public function add()
    {

    }

    public function update()
    {

    }


    public function execute($id, $username)
    {
        $this->dbSource->connect($this->dbConfig, function ($db, $result) use ($id, $username) {
            if ($result === false) {
                var_dump($db->connect_error);
            }

            $sql = "update test set `username`={$username} where id={$id}";
            $db->query($sql, function ($db, $result) {
                if ($result === true) {

                } elseif ($result === false) {

                } else {
                    print_r($result);
                }
                $db->close();
            });
        });
        return true;
    }
}

$mysql = new AsyncMysql();
var_dump($mysql);
$mysql->execute(1, '松遥峰');