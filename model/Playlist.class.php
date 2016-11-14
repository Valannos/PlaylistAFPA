<?php

class Playlist {
    
    private $id;
    private $userId;
    private $name;
    private $imgUrl;
   
    public function __construct($id, $userId, $name, $imgUrl) {
        $this->id = $id;
        $this->userId = $userId;
        $this->name = $name;
        $this->imgUrl = $imgUrl;
    }
    
    function getId() {
        return $this->id;
    }

    function getUserId() {
        return $this->userId;
    }

    function getName() {
        return $this->name;
    }

    function getImgUrl() {
        return $this->imgUrl;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setUserId($userId) {
        $this->userId = $userId;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setImgUrl($imgUrl) {
        $this->imgUrl = $imgUrl;
    }


    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}