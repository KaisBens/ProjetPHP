<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Albums extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('model_music');
	}
	public function index(){
		$genre = $this->model_music->getGenre();
		$this->load->view('layout/header');
		$this->load->view('GenreFilter',['genre'=>$genre]);
		$selectedGenre = '0';
		$search = '';
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST['Genre'])){
    	$selectedGenre = $_POST['Genre'];
		}
		}
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST['recherche'])){
    	$search = $_POST['recherche'];
		}
	}
		$albums = $this->model_music->searchAlbums($search, $selectedGenre);
		$playlists = $this->model_music->getPlaylist();
		$this->load->view('albums_list',['albums'=>$albums,'playlists'=>$playlists]);
		$this->load->view('layout/footer');
	}
	public function view($AlbumId){
		$songs = $this->model_music->getSongOfAlbum($AlbumId);
		$this->load->view('layout/header');
		$this->load->view('album_song_list',['songs'=>$songs]);
		$this->load->view('layout/footer');
	}
	public function viewArtiste($artisteId){
		$songs = $this->model_music->getAlbumOfArtist($artisteId);
		$playlists = $this->model_music->getPlaylist();
		$this->load->view('layout/header');
		$this->load->view('album_song_list',['songs'=>$songs, 'playlists'=>$playlists]);
		$this->load->view('layout/footer');
	}
	    public function addAllSongsToPlaylist(){
        $album_id = $this->input->post('album_id');
        $playlistId = $this->input->post('playlist');
        $songs = $this->model_music->getSongOfAlbum($album_id);
        foreach ($songs as $song) {
            $this->model_music->addSongToPlaylist($song->name, $playlistId);
        }
        redirect('playlist'); 
    }

}