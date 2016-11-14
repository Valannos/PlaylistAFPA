<?php

require_once (dirname(__FILE__) . '/../config.inc.php');
require_once (dirname(__FILE__) . '/DB.php');
require_once (dirname(__FILE__) . '/../model/User.class.php');

class UserStore {

    static function delete($id) {

        $pdo = DB::getConnection();
        $stmt = $pdo->prepare('DELETE FROM `user` WHERE user_id = :id');
        $stmt->bindValue(':id', $id);
        $stmt->execute();
    }

    static function save(User $user) {

        if (self::checkUserName($user->getName())) {

            $_SESSION['usr_not_valid'] = true;
           return false;
        }
        if (empty($user->getName())) {
            $_SESSION['empty_username'] = true;
            return false;
        }
        if (empty($user->getPassword())) {
            $_SESSION['empty_password'] = true;
            return false;
        } else {

            $pdo = DB::getConnection();
            $addPlaylist = $pdo->prepare('INSERT INTO `user` (username, password, email) VALUES (:username, :password, :email)');
            $addPlaylist->bindValue(':username', $user->getName());
            $addPlaylist->bindValue(':password', $user->getPassword());
            $addPlaylist->bindValue(':email', $user->getPassword());
            $addPlaylist->execute();
            return true;
        }
    }

    static function getIdFromUserName($name) {

        $pdo = DB::getConnection();
        $stmt = $pdo->prepare('SELECT user_id FROM `user` WHERE username = :name');
        $stmt->bindValue(':name', $name);
        $stmt->execute();
        $res = $stmt->fetch()['user_id'];
        return $res;
    }

    static function checkUserName($name) {

        $pdo = DB::getConnection();
        $stmt = $pdo->prepare('SELECT username FROM user WHERE username= :usr');
        $stmt->bindValue('usr', $name);
        $stmt->execute();
        $res = $stmt->fetch();
        if (empty($res)) {
            return false;
        } else {
            return true;
        }
    }

    static function checkUserPass($name, $pass) {

        $pdo = DB::getConnection();

        $stmt = $pdo->prepare('SELECT password FROM `user` WHERE username = :usr');
        $stmt->bindValue('usr', $name);
        $stmt->execute();
        $res = $stmt->fetch()['password'];
        if (password_verify($pass, $res)) {

            return true;
        } else {
            return false;
        }
    }

    static function getAllUsersNames() {

        $allUserNames = array();
        $pdo = DB::getConnection();
        $stmt = $pdo->prepare('SELECT username FROM user');
        $stmt->execute();

        while ($res = $stmt->fetch()['username']) {

            array_push($allUserNames, $res);
        }
        return $allUserNames;
    }

}
