<h5>Artists list </h5>
<section class="list">
<?php
foreach($artistes as $artiste){
    echo "<form action='" . base_url("index.php/artistes/addSongOfArtistToPlaylist") . "' method='post'>";
    echo anchor("Albums/viewArtiste/{$artiste->id}","{$artiste->name}");
    if ($this->session->userdata('logged')):
    echo "<select name='playlist'>";
    foreach ($playlists as $playlist) {
        echo "<option value='{$playlist->id}'>{$playlist->name}</option>";
    }
    echo "</select>";
    echo "<input type='hidden' name='artistId' value='{$artiste->id}' />"; // Utilisez l'identifiant de l'artiste ici
    echo "<button type='submit' class='add-to-playlist'>Ajouter toutes les chansons</button>";
    echo "</form>";
    endif;
    echo "<br>"; 
}
?>
</section>