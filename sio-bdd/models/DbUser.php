<?php

namespace models;

use models\base\Database;

class DbUser
{

    /**
     * @var $pdo \PDO
     */
    protected $pdo;

    function __construct()
    {
        $this->pdo = Database::connect();
    }

    function createDb($dbName){
        $stmt = $this->pdo->prepare("CREATE DATABASE `$dbName`");
        $stmt->execute();
    }

    function createAccount($team, $user, $password)
    {
        $user = $this->pdo->quote($user);
        $password = $this->pdo->quote($password);

        $queries = array(
            "CREATE USER $user@'%' IDENTIFIED BY $password;",
            "GRANT ALL PRIVILEGES ON `$team`.* TO $user@'%';",
            "FLUSH PRIVILEGES;"
        );

        foreach ($queries as $query) {
            $this->pdo->exec($query);
        }

    }
}