<?php

require_once (dirname(__FILE__) . '/../config.inc.php');
require_once (dirname(__FILE__) . '/DB.php');


class AuthorStore {

    
    
    static function save($name) {
        $pdo = DB::getConnection();
        $insert_author = $pdo->prepare('INSERT INTO author (name) VALUES (:author)');
        $insert_author->bindValue(':author', $name);
        $insert_author->execute();
    }

    static function getAuthorNameById($id) {

        $pdo = DB::getConnection();
        $stmt = $pdo->prepare('SELECT name FROM `author` WHERE author.id = :id');
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $res = $stmt->fetch()['name'];
        if ($res) {
            return $res;
        } else {
            return 'null';
        }
    }

    static function getAuthorByName($name) {

        $pdo = DB::getConnection();
        $stmt = $pdo->prepare('SELECT id FROM `author` WHERE author.name = :name');
        $stmt->bindValue(':name', $name);
        $stmt->execute();
        $res = $stmt->fetch()['id'];
        if ($res) {
            return $res;
        } else {
            return -1;
        }
    }
    static function getAllAuthors() {
        
        $allAuthors = array();
        $pdo = DB::getConnection();
        $stmt = $pdo->prepare('SELECT id FROM `author`');
        $stmt->execute();
        while ($res = $stmt->fetch()) {
           array_push($allAuthors ,$res['id']); 
        }
        return $allAuthors;
    }
    static function delete($id) {
        
        if (!empty($id)) {
            
    $pdo = DB::getConnection();        
    $insert = $pdo->prepare('DELETE FROM `author` WHERE id = :id');
    $insert->bindValue(":id", $id);
    $insert->execute();
}
        
    }

}
