<h5 class="playlist-title">Créer une nouvelle Playlist</h5>
<form action="<?= base_url('index.php/playlist/createPlaylistController') ?>" method="post" class="playlist-form">
    <label for="name_playlist" class="playlist-label">Nom de la Playlist:</label>
    <input type="text" name="name_playlist" id="name_playlist" class="playlist-input" required>
    <input type="number" name="random_Song" id="random_Song" class="random_Song" required>
    <?php
    echo "<select id='GenreId' name='GenreId'>";
    echo "<option value='0'>Select genre</option>";
    foreach($genre as $genre) {
        echo "<option value='{$genre->id}'>{$genre->name}</option>";
    }
    echo "</select>";
    ?>
    <button type="submit" name="submit" class="playlist-button">Créer</button>
</form>
