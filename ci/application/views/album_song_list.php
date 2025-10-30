<h5>Albums list</h5>
<section class="list">
<?php
foreach($songs as $song){
	echo "<div><article>";
	echo "<header class='short-text'>";
	echo anchor("song/view/{$song->id}","{$song->name}");
	echo "</header>";
	echo '<img src="data:image/jpeg;base64,'.base64_encode($song->jpeg).'" />';
	echo "<form action='" . base_url('index.php/Song/addSongToPlaylist') . "' method='post'>";
    echo "<input type='hidden' name='song_id' value='{$song->id}'>";
    	  
	echo "<footer class='short-text'>{$song->year} - {$song->artistName}</footer>";
    echo "</article></div>";
    if ($this->session->userdata('logged')):
	    echo "<select name='playlist'>";
		foreach($playlists as $playlist){
	        echo "<option value='{$playlist->id}'>{$playlist->name}</option>";
	    }
	    echo "</select>";
	    echo "<button type='submit'>Ajouter la chanson</button>";
	    echo "</form>";
	endif;
	}

?>
</section>
