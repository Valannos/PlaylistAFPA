<?php

require_once (dirname(__FILE__) . '/../config.inc.php');
require_once (dirname(__FILE__) . '/DB.php');
require_once (dirname(__FILE__) . '/../model/Playlist.class.php');
require_once (dirname(__FILE__) . '/../model/Track.class.php');

class PlaylistStore {

    static function delete($id) {

        $pdo = DB::getConnection();
        $stmt = $pdo->prepare('DELETE FROM playlist_user WHERE playlist_id = :id');
        $stmt->bindValue(':id', $id);
        $stmt->execute();
    }

    static function save(Playlist $pl) {


        $pdo = DB::getConnection();
        $addPlaylist = $pdo->prepare('INSERT INTO playlist_user (user_id, playlist_name, img_url) VALUES (:user_id, :playlistName, :img_url)');
        $addPlaylist->bindValue('user_id', $pl->getUserId());
        $addPlaylist->bindValue('img_url', $pl->getImgUrl());
        $addPlaylist->bindValue('playlistName', $pl->getName());
        $addPlaylist->execute();
    }

    static function getUserPlaylists($username) {

        $playlists = array();
        $pdo = DB::getConnection();
        $stmt = $pdo->prepare('SELECT  p.img_url AS "url", p.playlist_name AS "name", p.playlist_id AS "id" FROM playlist_user p INNER JOIN user u ON u.user_id = p.user_id WHERE u.username = :currentUser');
        $stmt->bindValue('currentUser', $username);
        $stmt->execute();
        while ($res = $stmt->fetch()) {

            $pl = new Playlist($res['id'], UserStore::getIdFromUserName($username), $res['name'], $res['url']);
            array_push($playlists, $pl);
        }
        return $playlists;
    }

    static function getTracksFromPlaylist($id) {

        $allTracks = array();
        $pdo = DB::getConnection();
        $stmt = $pdo->prepare('SELECT  t.id AS "id", p.playlist_name, t.title AS "title", t.duration AS "duration", t.authorid AS "authorid", t.year AS "year", t.genreid AS "genreid" FROM user u INNER JOIN playlist_user p INNER JOIN playlist_track pt INNER JOIN track t ON u.user_id = p.user_id AND p.playlist_id = pt.playlist_id AND t.id = pt.track_id WHERE pt.playlist_id = :currentPlaylist');
        $stmt->bindValue('currentPlaylist', $id);
        $stmt->execute();

        while ($rep = $stmt->fetch()) {

            $track = new Track($rep['title'], $rep['year'], $rep['duration'], $rep['authorid'], $rep['genreid']);
            $track->setId($rep['id']);
            array_push($allTracks, $track);
        }
        return $allTracks;
    }

    static function getPlaylistNameFromId($id) {

        $pdo = DB::getConnection();
        $stmt = $pdo->prepare('SELECT playlist_name FROM `playlist_user` WHERE playlist_id = :playlistId');
        $stmt->bindValue('playlistId', $id);
        $stmt->execute();
        $rep = $stmt->fetch()['playlist_name'];
        return $rep;
    }

    static function addTrackToPlaylist($playlistId, $trackId) {

        $pdo = DB::getConnection();
        $stmt = $pdo->prepare('INSERT INTO playlist_track (playlist_id, track_id) VALUES ( :playlist_id, :track_id)');
        $stmt->bindValue('playlist_id', $playlistId);
        $stmt->bindValue('track_id', $trackId);
        $stmt->execute();
        if ($stmt) {
            echo 'Track added';
        }
    }

    static function removeTrackFromPlay($playlistId, $trackId) {
        
        $pdo = DB::getConnection();
        $stmt = $pdo->prepare('DELETE FROM playlist_track WHERE playlist_id = :playlist_id AND track_id = :track_id');
        $stmt->bindValue('playlist_id', $playlistId);
        $stmt->bindValue('track_id', $trackId);
        $stmt->execute();
        if ($stmt) {
            
            echo 'Track removed';
        }
    }

}
