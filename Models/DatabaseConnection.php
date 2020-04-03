<?php

/**
 * DatabaseConnection Model holds the database connection setting
 *
 * @var string $host
 * @var string $username
 * @var string $password
 * @var string $database
 */

class DatabaseConnection {

    private $host = "172.20.0.2";
    private $username = "homestead";
    private $password = "secret";
    private $database = "homestead";

    /**
     * Create mysqli connection
     *
     */
    function connectDB() {
        $conn = mysqli_connect($this->host,$this->username,$this->password,$this->database);
        return $conn;
    }

}