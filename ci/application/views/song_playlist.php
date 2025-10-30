<section class="list">
<?php
foreach($songPlaylists as $songPlaylist){ 
    echo "<div><article>";
    echo "<header class='short-text'>";
    echo "<form action='" . base_url("index.php/Playlist/deleteSong/{$id_playlist -> id}/{$songPlaylist-> name}") . "' method='post'>";
    echo  "{$songPlaylist->name}";
    echo "<button type='submit' class='delete-button'>Delete</button>";
    echo "</form>";
	echo "<br>"; 
    echo "</header>";
    echo "</article></div>";
}

?>
</section>
