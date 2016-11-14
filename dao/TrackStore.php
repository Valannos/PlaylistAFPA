<?php

require_once (dirname(__FILE__) . '/../config.inc.php');
require_once (dirname(__FILE__) . '/DB.php');
require_once (dirname(__FILE__) . '/../model/Track.class.php');

class TrackStore {

    static function delete($id) {

        $pdo = DB::getConnection();
        $stmt = $pdo->prepare('DELETE FROM track WHERE id = :id');
        $stmt->bindValue(':id', $id);
        $stmt->execute();
    }

    static function save(Track $track) {

        $pdo = DB::getConnection();


        $stmt = $pdo->prepare('INSERT INTO track (title, authorid, year, duration, genreid) VALUES (:title, :authorid, :year, :duration, :genreid)');
        $stmt->bindValue('title', $track->getTitle());
        $stmt->bindValue('authorid', $track->getAuthorId());
        $stmt->bindValue('year', $track->getYear());
        $stmt->bindValue('duration', $track->getDuration());
        $stmt->bindValue('genreid', $track->getGenreId());
        $res = $stmt->execute();
        if ($res) {
            return $pdo->lastInsertId();
        } else {
            return -1;
        }
    }

    static function update(Track $track) {

        $pdo = DB::getConnection();

        $stmt = $pdo->prepare('UPDATE track SET title = :title, authorid = :author, year = :year, duration = :duration, genreid = :genre WHERE id = :id');
        $stmt->bindValue('id', $track->getId());
        $stmt->bindValue('author', $track->getAuthorId());
        $stmt->bindValue('year', $track->getYear());
        $stmt->bindValue('title', $track->getTitle());
        $stmt->bindValue('duration', $track->getDuration());
        $stmt->bindValue('genre', $track->getGenreId());
        $stmt->execute();
    }

    static function getAllTracks() {

        $allTracks = array();
        $pdo = DB::getConnection();
        $stmt = $pdo->prepare("SELECT t.id AS 'trackId' , t.title, a.id AS 'authorId', t.year, t.duration, g.id AS 'genreId' 
                    FROM track t 
                    INNER JOIN author a 
                    ON a.id = t.authorid 
                    INNER JOIN genre g 
                    ON g.id = t.genreid");

        $stmt->execute();
        while ($res = $stmt->fetch()) {

            $track = new Track($res['title'], $res['year'], $res['duration'], $res['authorId'], $res['genreId']);

            $track->setId($res['trackId']);
            array_push($allTracks, $track);
        }
        return $allTracks;
    }

    static function getTrackById($id) {

        $pdo = DB::getConnection();
        $stmt = $pdo->prepare("SELECT id, title, authorId, year, duration, genreId 
                    FROM track 
                    WHERE id = :id");
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $res = $stmt->fetch();
        $track = new Track($res['title'], $res['year'], $res['duration'], $res['authorId'], $res['genreId']);
        $track->setId($id);
        return $track;
    }

}
