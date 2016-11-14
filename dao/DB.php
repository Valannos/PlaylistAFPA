<?php

class DB {

    private static $pdo = null;

    public static function getConnection() {
        
        if (self::$pdo == null) {
            self::$pdo = new PDO(SQL_DSN, SQL_USER, SQL_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
        }
        return self::$pdo;
    }

}
