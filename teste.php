#!/usr/bin/php5

<?php
require("gsAPI.php");
$gs = new gsAPI("daniel_symbian", "76c83cfc5d5fd1a6cd0ccfcd6739ef19"); //note: you can also change the default key/secret in gsAPI.php
$sessionID = $gs->startSession();
$user = $gs->authenticate("danielcbit", "<pass>");
if (empty($user) || $user['UserID'] < 1) {
  exit;
}
$playlists = $gs->getUserPlaylists(5);
if (!is_array($playlists)) {
    //something failed.
    exit;
}
foreach ($playlists as $playlist) {
          echo "Playlist: {$playlist['PlaylistName']}\n";
          $songs = $gs->getPlaylistSongs($playlist['PlaylistID']);
          foreach ($songs as $song) {
            echo "Song: {$song['SongID']}\n";
            $infos = $gs->getSongInfo($song['SongID']);
            echo "Song: {$infos['SongName']}\n";
          }
}
?>
