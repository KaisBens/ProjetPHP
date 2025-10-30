<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');                                             

class Model_music extends CI_Model {
	public function __construct(){
		$this->load->database();
	}

	public function getAlbums($selectedGenre){
		if($selectedGenre == '0'){
			$query = $this->db->query(
			"SELECT album.name,album.id,year,artist.name as artistName, genre.name as genreName,jpeg 
			FROM album 
			JOIN artist ON album.artistid = artist.id
			JOIN genre ON genre.id = album.genreid
			JOIN cover ON cover.id = album.coverid
			ORDER BY year
			",
			);
		}
		else{
		$query = $this->db->query(
			"SELECT album.name,album.id,year,artist.name as artistName, genre.name as genreName,jpeg 
			FROM album 
			JOIN artist ON album.artistid = artist.id
			JOIN genre ON genre.id = album.genreid
			JOIN cover ON cover.id = album.coverid
			WHERE album.genreId = ?
			ORDER BY year
			",
			array($selectedGenre)
		);
	}
	return $query->result();
	}


	public function getArtists(){
		$query = $this->db->query(
			"SELECT artist.id, artist.name
			FROM artist
			Group by artist.id
			"
		);
		return $query->result();
	}
	public function getSongOfAlbum($album){
		$query = $this->db->query(
			"SELECT song.id, song.name 
			FROM song
			JOIN track on track.songId = song.id
			WHERE track.albumId = ?
			",
			array($album)
		);
		return $query->result();
	}
	public function getSongOfArtistes($artiste){
		$query = $this->db->query(
			"SELECT song.id, song.name 
			FROM album
			JOIN track on album.Id = track.albumId
			JOIN song on track.songId = song.id
			WHERE album.artistId = ?
			",
			array($artiste)
		);
	}
	public function getGenre(){
		$query = $this->db->query(
			"SELECT genre.id,genre.name
			FROM genre
			"
		);
	return $query->result();
	}
	public function getAlbumOfArtist($artisteId){
		$query = $this->db->query(
			"SELECT album.name,album.id,year,artist.name as artistName, genre.name as genreName,jpeg 
			FROM album 
			JOIN artist ON album.artistid = artist.id
			JOIN genre ON genre.id = album.genreid
			JOIN cover ON cover.id = album.coverid
			WHERE album.artistId = ?
			ORDER BY year
			",
			array($artisteId)
		);
		return $query->result();
	}

	public function getLogin($login,$password){
		$query = $this->db->query(
			"SELECT *
			 FROM Login
			  WHERE mail = '$login' AND MotDePasse = '$password'"
		);
		return $query->result();
	}
	public function SignUp($pseudo,$login,$password){
		$query = $this->db->query(
			"INSERT INTO `Login`(`pseudo`, `mail`, `MotDePasse`) 
			VALUES ('$pseudo','$login','$password')"
			);
	}
	public function searchAlbums($search,$selectedGenre){
		if($search == '' AND $selectedGenre == '0'){
			$query = $this->db->query(
			"SELECT album.name,album.id,year,artist.name as artistName, genre.name as genreName,jpeg 
			FROM album 
			JOIN artist ON album.artistid = artist.id
			JOIN genre ON genre.id = album.genreid
			JOIN cover ON cover.id = album.coverid
			ORDER BY year
			",
			);
		}elseif($search == ''){
			$query = $this->db->query(
			"SELECT album.name,album.id,year,artist.name as artistName, genre.name as genreName,jpeg 
			FROM album 
			JOIN artist ON album.artistid = artist.id
			JOIN genre ON genre.id = album.genreid
			JOIN cover ON cover.id = album.coverid
			WHERE album.genreId = $selectedGenre
			ORDER BY year
			",
			);
		}elseif($selectedGenre == '0' AND $search !=''){
			$query = $this->db->query(
			"SELECT album.name,album.id,year,artist.name as artistName, genre.name as genreName,jpeg 
			FROM album 
			JOIN artist ON album.artistid = artist.id
			JOIN genre ON genre.id = album.genreid
			JOIN cover ON cover.id = album.coverid
			WHERE album.name LIKE '%$search%'
			ORDER BY year
			",
			);
		}
		else{
		$query = $this->db->query(
			"SELECT album.name,album.id,year,artist.name as artistName, genre.name as genreName,jpeg 
			FROM album 
			JOIN artist ON album.artistid = artist.id
			JOIN genre ON genre.id = album.genreid
			JOIN cover ON cover.id = album.coverid
			WHERE album.name LIKE '%$search%' AND album.genreId = $selectedGenre
			ORDER BY year
			",
		);
	}
	return $query->result();
	}
	public function getPlaylist(){
		$login = $this->session->userdata('login');
		$query = $this->db->query(
			"SELECT playlist.id,playlist.name
			FROM playlist
			WHERE playlist.mail = ?
			Group by playlist.name
			",array($login)
		);
	return $query->result();
	}

	public function deletePlaylist($playlist_id){
		$this->db->query(
		        "DELETE FROM SongPlaylist WHERE id = ?", array($playlist_id)
		    );

		    // Ensuite, supprimer l'enregistrement dans playlist
		$this->db->query(
		        "DELETE FROM playlist WHERE id = ?", array($playlist_id)
		    );
	}

	public function delete_Song($playlist_id,$Song_name){
		$Song_name = urldecode($Song_name);
		$this->db->query(
			"DELETE FROM SongPlaylist Where id = ? AND name=?",
			array($playlist_id, $Song_name)
		);
	}

	public function createPlaylist($name_playlist){
		$name_playlist_escaped = $this->db->escape($name_playlist);
		$login = $this->session->userdata('login');
		$test = $this->db->query(
			"SELECT *
			FROM playlist
			WHERE playlist.name = ?"
			,array($name_playlist));
		if($test->num_rows() > 0){
			redirect('playlist');
			echo("erreur la playlist existe déja");
		} else{


		$query = $this->db->query(
			"INSERT INTO playlist (name, mail) VALUES ($name_playlist_escaped, ?);
			",array($login)
		);
	}
	}

	public function getSongOfPlaylist($playlist_id){
		$query = $this->db->query(
			"SELECT SongPlaylist.name
			FROM SongPlaylist
			WHERE $playlist_id = SongPlaylist.id;

			"
		);
	return $query->result();
	}
	public function addSongToPlaylist($songName, $playlistId){
        $query = $this->db->query(
            "INSERT INTO SongPlaylist (id, name) VALUES (?, ?)",
            array($playlistId, $songName)
        );
    }

    public function addAllSongsOfArtistInPlaylist($artistId, $playlistId){
	    // Récupérer toutes les chansons de l'artiste spécifié
	    $query = $this->db->query(
			"SELECT song.name 
			FROM song, track, album
			WHERE song.id = track.songId
			AND track.albumId = album.id
			AND album.artistId = ?",
	        array($artistId)
	    );
	    
	    $songs = $query->result();

	    // Ajouter chaque chanson dans la playlist spécifiée
	    foreach ($songs as $song) {
	        $this->db->query(
	            "INSERT INTO SongPlaylist (id, name) VALUES (?, ?)",
	            array($playlistId, $song->name)
	        );
	    }
	}

	public function duplicatePlaylist($playlist_id){
    // Récupérer les informations de la playlist à dupliquer
    $playlist = $this->db->get_where('playlist', array('id' => $playlist_id))->row();
    
    // Créer une nouvelle entrée pour la playlist avec les mêmes informations
    $data = array(
        'name' => $playlist->name . ' (Copy)',
    );
     
    $this->db->insert('playlist', $data);
    
    // Récupérer l'ID de la nouvelle playlist
    $new_playlist_id = $this->db->insert_id();
    
    // Dupliquer les chansons de la playlist originale dans la nouvelle playlist
    $this->db->query(
        "INSERT INTO SongPlaylist (id, name)
        SELECT ?, name
        FROM SongPlaylist
        WHERE id = ?",
        array($new_playlist_id, $playlist_id));
	}

	public function AddRandomSong($random_Song, $Genre, $name_playlist) {
    $login = $this->session->userdata('login');

    // Récupérer l'ID de la playlist
    $playlist_query = $this->db->query("SELECT id FROM playlist WHERE name = ? AND mail = ?", array($name_playlist, $login));
    if ($playlist_query->num_rows() > 0) {
        $playlist_id = $playlist_query->row()->id;
    } else {
        // Gérer le cas où la playlist n'existe pas
        throw new Exception("Playlist not found");
    }
	$used = array();
	if($Genre == '0'){
		for ($i = 0; $i < $random_Song; $i++) {
	    // Récupérer le nom de la chanson
	    $song = $this->db->query("SELECT song.id 
		    FROM song 
		    JOIN track ON song.id = track.songId
		    JOIN album ON album.id = track.albumId")->result_array();
        // Générer un ID de chanson aléatoire
        $random = rand(1, count($song));
        $song_id = $song[$random];
        if(!in_array($song_id, $used)){
			$song_query = $this->db->query("SELECT song.name FROM song WHERE song.id = ?", array($song_id));
	        
	    	$this->model_music->addSongToPlaylist( $song_query->row()->name,$playlist_id); 
	    	array_push($used, $random);
	    } else{
	    	$i = $i -1;
    	}
    }
	}else{
		for ($i = 0; $i < $random_Song; $i++) {
	    // Récupérer le nom de la chanson
	    $song = $this->db->query("SELECT song.id 
		    FROM song 
		    JOIN track ON song.id = track.songId
		    JOIN album ON album.id = track.albumId
		    WHERE album.genreId = ?", array($Genre))->result_array();
        // Générer un ID de chanson aléatoire
        $random = rand(1, count($song));
        $song_id = $song[$random];
        if(!in_array($song_id, $used)){
			$song_query = $this->db->query("SELECT song.name FROM song WHERE song.id = ?", array($song_id));
	        
	    	$this->model_music->addSongToPlaylist( $song_query->row()->name,$playlist_id); 
	    	array_push($used, $random);
	    } else{
	    	$i = $i -1;
    	}
    }
	}

    
}
public function getSongNameById($songId){
    $query = $this->db->get_where('song', ['id' => $songId]);
    $result = $query->row();
    return $result ? $result->name : null;
}
}
