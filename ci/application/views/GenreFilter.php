<form method="post" action="albums">
    <?php
    
echo"<form class'search-bar' action='/search' method='post'>";
    echo"<input type'search' name='recherche' placeholder='Search...'>";
    echo "<select id='GenreId' name='Genre'>";
    echo "<option value='0'>Select genre</option>";
    foreach($genre as $genre) {
        echo "<option value='{$genre->id}'>{$genre->name}</option>";
    }
    echo "</select>";
    ?>
    <button type="submit">Submit</button>
</form>
