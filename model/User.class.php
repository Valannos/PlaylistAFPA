<?php

class User {
    
    
    private $id;
    private $name;
    private $password;
    private $email;
    
    public function __construct($id, $name, $password, $email) {
        $this->email = $email;
        $this->id = $id;
        $this->name = $name;
        $this->password = $password;
    }
    
    
    function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

    function getPassword() {
        return $this->password;
    }

    function getEmail() {
        return $this->email;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function setEmail($email) {
        $this->email = $email;
    }


    
    
    
    
    
    
    
}