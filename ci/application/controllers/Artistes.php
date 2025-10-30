<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class artistes extends CI_Controller{

	public function __construct(){
		parent ::__construct();
		$this->load->model('model_music');
	}
	public function index(){
		$artistes = $this->model_music->getArtists();
		$this->load->view('layout/header');
		$playlists = $this->model_music->getPlaylist();
		$this->load->view('artistes_list',['artistes'=>$artistes,'playlists'=>$playlists]);
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

    public function addSongOfArtistToPlaylist(){
        $playlistId = $this->input->post('playlist');
        $artistId = $this->input->post('artistId'); 
        $this->model_music->addAllSongsOfArtistInPlaylist($artistId, $playlistId);
        redirect('playlist');

    }


}