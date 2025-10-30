<h5>Albums list</h5>
<section class="list">
<?php
foreach($albums as $album){
	echo "<div><article>";
	echo "<header class='short-text'>";
	echo anchor("song/view/{$album->id}","{$album->name}");
	echo "</header>";
	echo '<img src="data:image/jpeg;base64,'.base64_encode($album->jpeg).'" />';
	echo "<form action='" . base_url('index.php/albums/addAllSongsToPlaylist') . "' method='post'>";
    echo "<input type='hidden' name='album_id' value='{$album->id}'>";
    	  
	echo "<footer class='short-text'>{$album->year} - {$album->artistName}</footer>";
    echo "</article></div>";
    if ($this->session->userdata('logged')):
    echo "<select name='playlist'>";
	foreach($playlists as $playlist){
        echo "<option value='{$playlist->id}'>{$playlist->name}</option>";
    }
    echo "</select>";
    echo "<button type='submit'>Ajouter toutes les chansons</button>";
    echo "</form>";
    endif;
}

?>
</section>
