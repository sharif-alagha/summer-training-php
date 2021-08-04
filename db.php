<?php

class DB {
    const HOST = 'localhost';
    const USERNAME = 'root';
    const PASSWORD = '';
    const DB = 'training';

    public $conn;

    function __construct() {        
        $this->conn = new mysqli(self::HOST, self::USERNAME, self::PASSWORD, self::DB);
    }
}