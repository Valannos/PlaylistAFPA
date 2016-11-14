<?php

class Author {
    
    private $name;
    private $id;
    
    
    public function __construct($name) {
       $this->name = $name ;
    }
    
    function getName() {
        return $this->name;
    }

    function setName($name) {
        $this->name = $name;
    }
    function getId() {
        return $this->id;
    }



    
    
    
    
    
}
    