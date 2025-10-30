<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Playlist extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('model_music');
    }

    public function index(){
        $playlists = $this->model_music->getPlaylist();
        $this->load->view('layout/header');
        $this->load->view('playlist_list', ['playlists' => $playlists]);
        $this->load->view('layout/footer');
    }

    public function view(){
        $playlists = $this->model_music->deletePlaylist();
        $this->load->view('layout/header');
        $this->load->view('playlist_list', ['playlists' => $playlists]);
        $this->load->view('layout/footer');
    }

    public function SongPlaylist($playlist_id){
        $songPlaylists = $this->model_music->getSongOfPlaylist($playlist_id);
        $playlists = $this->model_music->getPlaylist(); // Récupère toutes les playlists
        $id_playlist = null; // Initialise $id_playlist à null
        foreach ($playlists as $playlist_item) {
            if ($playlist_item->id == $playlist_id) {
                $id_playlist = $playlist_item; 
                break;
            }
        }
        $this->load->view('song_playlist', ['songPlaylists' => $songPlaylists, 'id_playlist' => $id_playlist]);
    }

    public function delete($playlist_id) {
        $delete = $this->model_music->deletePlaylist($playlist_id);
        redirect('playlist');
    }

    public function deleteSong($id_playlist, $Song_name){
        $deleteSong = $this->model_music->delete_Song($id_playlist, $Song_name);
         redirect("playlist/SongPlaylist/$id_playlist");
    }

    public function MenuCreate() {
        $genre = $this->model_music->getGenre();
        $this->load->view('layout/header');
        $this->load->view('create_playlist',['genre'=>$genre]);
        $this->load->view('layout/footer');

    }

    public function createPlaylistController() {
        $name_playlist = $this->input->post('name_playlist');
        $random_Song = '0';
        $Genre = '0';
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST['GenreId'])){
        $Genre = $_POST['GenreId'];
        }
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST['random_Song'])){
        $random_Song = $_POST['random_Song'];
        }
    }
        $create = $this->model_music->createPlaylist($name_playlist);
        $random = $this->model_music->AddRandomSong($random_Song, $Genre, $name_playlist);
        redirect('playlist');
    }

    public function addSongToPlaylist(){
        $songName = $this->input->post('song');
        $playlistId = $this->input->post('playlist');
        $this->model_music->addSongToPlaylist($songName, $playlistId);
        redirect('playlist');
    }

    public function duplicate($playlist_id){
        // Charger le modèle si ce n'est pas déjà fait
        $this->load->model('model_music');
        
        // Dupliquer la playlist avec l'ID spécifié
        $this->model_music->duplicatePlaylist($playlist_id);
        
        // Rediriger l'utilisateur vers la page des playlists
        redirect('playlist');
    }
}



