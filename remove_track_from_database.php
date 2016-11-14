<?php

include_once(dirname(__FILE__).'/config.inc.php');

$idSupress = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
TrackStore::delete($idSupress);

echo 'track has been removed from database...'
?> </br>
<a href="test_SQL.php">Back to tracklist</a>
