<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class song extends CI_Controller{

	public function __construct(){
		parent ::__construct();
		$this->load->model('model_music');
	}
	public function view($AlbumId){
		$songs = $this->model_music->getSongOfAlbum($AlbumId);
		$playlists = $this->model_music->getPlaylist();
		$this->load->view('layout/header');
		$this->load->view('album_song_list2',['songs'=>$songs, 'playlists'=>$playlists]);
		$this->load->view('layout/footer');
	}
	public function view2($artisteId){
		$songs = $this->model_music->getSongOfArtistes($artisteId);
		$playlists = $this->model_music->getPlaylist();
		$this->load->view('layout/header');
		$this->load->view('album_song_list2',['songs'=>$songs, 'playlists'=>$playlists]);
		$this->load->view('layout/footer');
	}
	public function addSongToPlaylist(){
        $song_id = $this->input->post('song_id');
        $songName = $this->model_music->getSongNameById($song_id);
        $playlistId = $this->input->post('playlist');
        $this->model_music->addSongToPlaylist($songName, $playlistId);
	redirect('playlist'); 
    }

}