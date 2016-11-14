<?php

class Track {

    private $id;
    private $title;
    private $year;
    private $duration;
    private $authorId;
    private $genreId;

    function __construct($title, $year, $duration, $authorId, $genreId) {

        $this->title = $title;
        $this->year = $year;
        $this->duration = $duration;
        $this->authorId = $authorId;
        $this->genreId = $genreId;
    }

    function getId() {
        return $this->id;
    }

    function getTitle() {
        return $this->title;
    }

    function getYear() {
        return $this->year;
    }

    function getDuration() {
        return $this->duration;
    }

    function getAuthorId() {
        return $this->authorId;
    }

    

    function getGenreId() {
        return $this->genreId;
    }

    function setGenreId($genreId) {
        $this->genreId = $genreId;
    }
    function setId($id) {
        $this->id = $id;
    }


}
