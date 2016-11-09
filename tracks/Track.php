<?php

class Track{
    private $id;
    private $title;
    private $year;
    private $duration;
    private $artiste;

    function __construct($id, $title, $year, $duration, $artiste) {
        $this->id = $id;
        $this->title = $title;
        $this->year = $year;
        $this->duration = $duration;
        $this->artiste = $artiste;
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

    function getArtiste() {
        return $this->artiste;
    }
    function currentTrackDisplay() {
        if (empty($this->duration)) {
            echo '<li>Track N°'.$this->id.' : '.$this->title.' from '.$this->artiste.' released in '.$this->year.'.'.'<button>Suppr</button> </li>' ;
        }
        else
        {
            echo '<li>Track N°'.$this->id.' : '.$this->title.' from '.$this->artiste.' released in '.$this->year.'. Duration is '.$this->duration.'<button>Suppr</button> </li>';
        }
    }


}
?>
