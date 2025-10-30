<?php

echo "<div class='playlist-container'>";
echo "<form action='" . base_url("index.php/playlist/MenuCreate/") . "' method='post'>";
echo "<button type='submit' class='create-button'>Create</button>";
echo "</form>";
foreach($playlists as $playlist){ 
    echo "<div class='playlist-item'>";
    echo "<header class='short-text'>";
    echo anchor("playlist/SongPlaylist/{$playlist->id}","<h3>{$playlist->name}</h3>");
    echo "<form action='" . base_url("index.php/playlist/delete/{$playlist->id}") . "' method='post'>";
    echo "<button type='submit' class='delete-button'>supprimer</button>";
    echo "</form>";
    echo "<form action='" . base_url("index.php/playlist/duplicate/{$playlist->id}") . "' method='post'>";
    echo "<button type='submit' class='delete-button'>dupliquer</button>";
    echo "</form>";
    echo "</header>";
    echo "</div>";
}
echo "</div>";
?>
