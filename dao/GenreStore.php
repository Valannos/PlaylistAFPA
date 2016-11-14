<?php

require_once (dirname(__FILE__) . '/../config.inc.php');
require_once (dirname(__FILE__) . '/DB.php');

class GenreStore {

    static function save($name) {
        $pdo = DB::getConnection();
        $insert_author = $pdo->prepare('INSERT INTO genre (name) VALUES (:genre)');
        $insert_author->bindValue(':genre', $name);
        $insert_author->execute();
    }

    static function getGenreNameById($id) {

        $pdo = DB::getConnection();
        $stmt = $pdo->prepare('SELECT name FROM `genre` WHERE genre.id = :id');
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        $res = $stmt->fetch()['name'];
        if ($res) {
            return $res;
        } else {
            return 'null';
        }
    }

    static function getGenreByName($name) {

        $pdo = DB::getConnection();
        $stmt = $pdo->prepare('SELECT id FROM `genre` WHERE genre.name = :name');
        $stmt->bindValue(':name', $name);
        $stmt->execute();
        $res = $stmt->fetch()['id'];
        if ($res) {
            return $res;
        } else {
            return -1;
        }
    }

    static function getAllGenres() {

        $allGenres = array();
        $pdo = DB::getConnection();
        $stmt = $pdo->prepare('SELECT id FROM `genre`');
        $stmt->execute();
        while ($res = $stmt->fetch()) {
            array_push($allGenres, $res['id']);
        }
        return $allGenres;
    }

    static function delete($id) {




        if (!empty($id)) {
            $pdo = DB::getConnection();
            $insert = $pdo->prepare('DELETE FROM genre WHERE id = :id');
            $insert->bindValue(":id", $id);
            $insert->execute();
        }
    }

}
