<?php

require_once 'includes/config.php';

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/playlist.css">
        <?php require 'includes/cdn_linker.php'?>

        <title>PiguZMusic - Playlist</title>
    </head>
    <body>
        <div class="playlist_pg">
            <div id="main_wrapper">
                <!-- Sidebar Area -->
                <?php require 'fixed_layout/sidemenu.php'?>

                <!-- Main Content Area -->
                <div class="content_wrapper">
                    <!-- Top Bar -->
                    <?php require 'fixed_layout/topspace.php'?>

                    <!-- Content Here -->
                    <div class="main_content">
                        <div id="main_index">
                            <div class="page_header pb_sec">
                                <h1>PLAYLIST</h1>
                            </div>
                            <ul class="nav nav-pills mb-5 gap-3" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-main" type="button" role="tab" aria-controls="pills-home" aria-selected="true">User Playlist</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-playlist" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">More User Playlist</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-recommend" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Recommended Playlist</button>
                                </li>
                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-main" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
                                    <div class="tab_wrapper">
                                            <div class="container-fluid">
                                                <div class="row align-items-center">
                                                    <div class="col-lg-3">
                                                        <div class="playlist_img_wrapper">
                                                            <img class="img-fluid" src="https://dummyimage.com/1000x1000/" alt="">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-9 ps-5">
                                                        <div class="playlist_info pb-3">
                                                            <h2>User Playlist</h2>
                                                            <p class="w-75">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Tempore, ratione iste architecto libero ea, vitae ullam eveniet illo iusto blanditiis nisi alias, ipsam hic. Error veritatis cumque omnis nostrum fuga?</p>
                                                        </div>
                                                        <div class="btn-group gap-4">
                                                            <button class="main-btn"><i class="fa fa-play" aria-hidden="true"></i> Play</button>
                                                            <button class="sub-btn" type="button" data-bs-toggle="modal" data-bs-target="#addNew">Add New Playlist</button>
                                                        </div>
                                                    </div>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="addNew" tabindex="-1" aria-labelledby="addNewPlaylist" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h1 class="modal-title fs-5 text-black" id="addNewPlaylist">Add New Playlist</h1>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form class="addPlaylist text-black" action="">
                                                                        <label for="title">Title</label>
                                                                        <input type="text" id="title" name="title" placeholder="Enter a title..">
                                                                        <label for="description">Description</label>
                                                                        <textarea name="description" id="description" placeholder="Enter some description.."></textarea>
                                                                        <input type="submit" name="submit" value="Submit">
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12 pt-3">
                                                        <div class="track_box">
                                                            <div class="track_img_wrapper">
                                                                <img class="img-fluid" src="https://dummyimage.com/1000x1000/" alt="">
                                                            </div>
                                                            <div class="track_info">
                                                                <div class="track_title">Demo track</div>
                                                                <div class="track_artist">Artist</div>
                                                            </div>
                                                            <div class="track_play">
                                                                <i class="fa fa-play" aria-hidden="true"></i>
                                                            </div>
                                                            <div class="track_ctrl">
                                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                                            </div>
                                                        </div>
                                                        <div class="track_box">
                                                            <div class="track_img_wrapper">
                                                                <img class="img-fluid" src="https://dummyimage.com/1000x1000/" alt="">
                                                            </div>
                                                            <div class="track_info">
                                                                <div class="track_title">Demo track</div>
                                                                <div class="track_artist">Artist</div>
                                                            </div>
                                                            <div class="track_play">
                                                                <i class="fa fa-play" aria-hidden="true"></i>
                                                            </div>
                                                            <div class="track_ctrl">
                                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                                            </div>
                                                        </div>
                                                        <div class="track_box">
                                                            <div class="track_img_wrapper">
                                                                <img class="img-fluid" src="https://dummyimage.com/1000x1000/" alt="">
                                                            </div>
                                                            <div class="track_info">
                                                                <div class="track_title">Demo track</div>
                                                                <div class="track_artist">Artist</div>
                                                            </div>
                                                            <div class="track_play">
                                                                <i class="fa fa-play" aria-hidden="true"></i>
                                                            </div>
                                                            <div class="track_ctrl">
                                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                                            </div>
                                                        </div>
                                                        <div class="track_box">
                                                            <div class="track_img_wrapper">
                                                                <img class="img-fluid" src="https://dummyimage.com/1000x1000/" alt="">
                                                            </div>
                                                            <div class="track_info">
                                                                <div class="track_title">Demo track</div>
                                                                <div class="track_artist">Artist</div>
                                                            </div>
                                                            <div class="track_play">
                                                                <i class="fa fa-play" aria-hidden="true"></i>
                                                            </div>
                                                            <div class="track_ctrl">
                                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                                            </div>
                                                        </div>
                                                        <div class="track_box">
                                                            <div class="track_img_wrapper">
                                                                <img class="img-fluid" src="https://dummyimage.com/1000x1000/" alt="">
                                                            </div>
                                                            <div class="track_info">
                                                                <div class="track_title">Demo track</div>
                                                                <div class="track_artist">Artist</div>
                                                            </div>
                                                            <div class="track_play">
                                                                <i class="fa fa-play" aria-hidden="true"></i>
                                                            </div>
                                                            <div class="track_ctrl">
                                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                                            </div>
                                                        </div>
                                                        <div class="track_box">
                                                            <div class="track_img_wrapper">
                                                                <img class="img-fluid" src="https://dummyimage.com/1000x1000/" alt="">
                                                            </div>
                                                            <div class="track_info">
                                                                <div class="track_title">Demo track</div>
                                                                <div class="track_artist">Artist</div>
                                                            </div>
                                                            <div class="track_play">
                                                                <i class="fa fa-play" aria-hidden="true"></i>
                                                            </div>
                                                            <div class="track_ctrl">
                                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <div class="tab-pane fade" id="pills-playlist" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
                                    <div class="tab_wrapper">
                                        <div class="container-fluid">
                                            <div class="row align-items-center pb_sec">
                                                <div class="col-lg-4">
                                                    <div class="tab2_playlist_img_wrapper">
                                                        <img class="img-fluid" src="https://dummyimage.com/1000x1000/" alt="">
                                                    </div>
                                                    <button class="main-btn mt-3"><i class="fa fa-play" aria-hidden="true"></i> Play</button>
                                                </div>
                                                <div class="col-lg-8">
                                                    <div class="morePlaylist_right">
                                                        <div class="playlist_info_box mb-3">
                                                            <h2>Playlist 1</h2>
                                                            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Suscipit, excepturi quis animi.</p>
                                                        </div>
                                                        <hr>
                                                        <div class="playlist_iframe">
                                                            <div class="playlistTrack_box pb-3 d-flex align-items-center">
                                                                <div class="track_img_wrapper morePlaylist">
                                                                    <img class="img-fluid" src="https://dummyimage.com/1000x1000/" alt="">
                                                                    <i class="fa fa-play" aria-hidden="true"></i>
                                                                </div>
                                                                <div class="track_info">
                                                                    <div class="track_title">Demo Track</div>
                                                                    <div class="track_artist">Artist</div>
                                                                </div>
                                                            </div>
                                                            <div class="playlistTrack_box pb-3 d-flex align-items-center">
                                                                <div class="track_img_wrapper morePlaylist">
                                                                    <img class="img-fluid" src="https://dummyimage.com/1000x1000/" alt="">
                                                                    <i class="fa fa-play" aria-hidden="true"></i>
                                                                </div>
                                                                <div class="track_info">
                                                                    <div class="track_title">Demo Track</div>
                                                                    <div class="track_artist">Artist</div>
                                                                </div>
                                                            </div>
                                                            <div class="playlistTrack_box pb-3 d-flex align-items-center">
                                                                <div class="track_img_wrapper morePlaylist">
                                                                    <img class="img-fluid" src="https://dummyimage.com/1000x1000/" alt="">
                                                                    <i class="fa fa-play" aria-hidden="true"></i>
                                                                </div>
                                                                <div class="track_info">
                                                                    <div class="track_title">Demo Track</div>
                                                                    <div class="track_artist">Artist</div>
                                                                </div>
                                                            </div>
                                                            <div class="playlistTrack_box pb-3 d-flex align-items-center">
                                                                <div class="track_img_wrapper morePlaylist">
                                                                    <img class="img-fluid" src="https://dummyimage.com/1000x1000/" alt="">
                                                                    <i class="fa fa-play" aria-hidden="true"></i>
                                                                </div>
                                                                <div class="track_info">
                                                                    <div class="track_title">Demo Track</div>
                                                                    <div class="track_artist">Artist</div>
                                                                </div>
                                                            </div>
                                                            <div class="playlistTrack_box pb-3 d-flex align-items-center">
                                                                <div class="track_img_wrapper morePlaylist">
                                                                    <img class="img-fluid" src="https://dummyimage.com/1000x1000/" alt="">
                                                                    <i class="fa fa-play" aria-hidden="true"></i>
                                                                </div>
                                                                <div class="track_info">
                                                                    <div class="track_title">Demo Track</div>
                                                                    <div class="track_artist">Artist</div>
                                                                </div>
                                                            </div>
                                                            <div class="playlistTrack_box pb-3 d-flex align-items-center">
                                                                <div class="track_img_wrapper morePlaylist">
                                                                    <img class="img-fluid" src="https://dummyimage.com/1000x1000/" alt="">
                                                                    <i class="fa fa-play" aria-hidden="true"></i>
                                                                </div>
                                                                <div class="track_info">
                                                                    <div class="track_title">Demo Track</div>
                                                                    <div class="track_artist">Artist</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row align-items-center pb_sec">
                                                <div class="col-lg-4">
                                                    <div class="tab2_playlist_img_wrapper">
                                                        <img class="img-fluid" src="https://dummyimage.com/1000x1000/" alt="">
                                                    </div>
                                                    <button class="main-btn mt-3"><i class="fa fa-play" aria-hidden="true"></i> Play</button>
                                                </div>
                                                <div class="col-lg-8">
                                                    <div class="morePlaylist_right">
                                                        <div class="playlist_info_box mb-3">
                                                            <h2>Playlist 1</h2>
                                                            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Suscipit, excepturi quis animi.</p>
                                                        </div>
                                                        <hr>
                                                        <div class="playlist_iframe">
                                                            <div class="playlistTrack_box pb-3 d-flex align-items-center">
                                                                <div class="track_img_wrapper morePlaylist">
                                                                    <img class="img-fluid" src="https://dummyimage.com/1000x1000/" alt="">
                                                                    <i class="fa fa-play" aria-hidden="true"></i>
                                                                </div>
                                                                <div class="track_info">
                                                                    <div class="track_title">Demo Track</div>
                                                                    <div class="track_artist">Artist</div>
                                                                </div>
                                                            </div>
                                                            <div class="playlistTrack_box pb-3 d-flex align-items-center">
                                                                <div class="track_img_wrapper morePlaylist">
                                                                    <img class="img-fluid" src="https://dummyimage.com/1000x1000/" alt="">
                                                                    <i class="fa fa-play" aria-hidden="true"></i>
                                                                </div>
                                                                <div class="track_info">
                                                                    <div class="track_title">Demo Track</div>
                                                                    <div class="track_artist">Artist</div>
                                                                </div>
                                                            </div>
                                                            <div class="playlistTrack_box pb-3 d-flex align-items-center">
                                                                <div class="track_img_wrapper morePlaylist">
                                                                    <img class="img-fluid" src="https://dummyimage.com/1000x1000/" alt="">
                                                                    <i class="fa fa-play" aria-hidden="true"></i>
                                                                </div>
                                                                <div class="track_info">
                                                                    <div class="track_title">Demo Track</div>
                                                                    <div class="track_artist">Artist</div>
                                                                </div>
                                                            </div>
                                                            <div class="playlistTrack_box pb-3 d-flex align-items-center">
                                                                <div class="track_img_wrapper morePlaylist">
                                                                    <img class="img-fluid" src="https://dummyimage.com/1000x1000/" alt="">
                                                                    <i class="fa fa-play" aria-hidden="true"></i>
                                                                </div>
                                                                <div class="track_info">
                                                                    <div class="track_title">Demo Track</div>
                                                                    <div class="track_artist">Artist</div>
                                                                </div>
                                                            </div>
                                                            <div class="playlistTrack_box pb-3 d-flex align-items-center">
                                                                <div class="track_img_wrapper morePlaylist">
                                                                    <img class="img-fluid" src="https://dummyimage.com/1000x1000/" alt="">
                                                                    <i class="fa fa-play" aria-hidden="true"></i>
                                                                </div>
                                                                <div class="track_info">
                                                                    <div class="track_title">Demo Track</div>
                                                                    <div class="track_artist">Artist</div>
                                                                </div>
                                                            </div>
                                                            <div class="playlistTrack_box pb-3 d-flex align-items-center">
                                                                <div class="track_img_wrapper morePlaylist">
                                                                    <img class="img-fluid" src="https://dummyimage.com/1000x1000/" alt="">
                                                                    <i class="fa fa-play" aria-hidden="true"></i>
                                                                </div>
                                                                <div class="track_info">
                                                                    <div class="track_title">Demo Track</div>
                                                                    <div class="track_artist">Artist</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-recommend" role="tabpanel" aria-labelledby="pills-contact-tab" tabindex="0">
                                <div class="tab_wrapper">
                                        <div class="container-fluid">
                                            <div class="row align-items-center pb_sec">
                                                <div class="col-lg-4">
                                                    <div class="tab2_playlist_img_wrapper">
                                                        <img class="img-fluid" src="https://dummyimage.com/1000x1000/" alt="">
                                                    </div>
                                                    <button class="main-btn mt-3"><i class="fa fa-play" aria-hidden="true"></i> Play</button>
                                                </div>
                                                <div class="col-lg-8">
                                                    <div class="morePlaylist_right">
                                                        <div class="playlist_info_box mb-3">
                                                            <h2>Playlist 1</h2>
                                                            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Suscipit, excepturi quis animi.</p>
                                                        </div>
                                                        <hr>
                                                        <div class="playlist_iframe">
                                                            <div class="playlistTrack_box pb-3 d-flex align-items-center">
                                                                <div class="track_img_wrapper morePlaylist">
                                                                    <img class="img-fluid" src="https://dummyimage.com/1000x1000/" alt="">
                                                                    <i class="fa fa-play" aria-hidden="true"></i>
                                                                </div>
                                                                <div class="track_info">
                                                                    <div class="track_title">Demo Track</div>
                                                                    <div class="track_artist">Artist</div>
                                                                </div>
                                                            </div>
                                                            <div class="playlistTrack_box pb-3 d-flex align-items-center">
                                                                <div class="track_img_wrapper morePlaylist">
                                                                    <img class="img-fluid" src="https://dummyimage.com/1000x1000/" alt="">
                                                                    <i class="fa fa-play" aria-hidden="true"></i>
                                                                </div>
                                                                <div class="track_info">
                                                                    <div class="track_title">Demo Track</div>
                                                                    <div class="track_artist">Artist</div>
                                                                </div>
                                                            </div>
                                                            <div class="playlistTrack_box pb-3 d-flex align-items-center">
                                                                <div class="track_img_wrapper morePlaylist">
                                                                    <img class="img-fluid" src="https://dummyimage.com/1000x1000/" alt="">
                                                                    <i class="fa fa-play" aria-hidden="true"></i>
                                                                </div>
                                                                <div class="track_info">
                                                                    <div class="track_title">Demo Track</div>
                                                                    <div class="track_artist">Artist</div>
                                                                </div>
                                                            </div>
                                                            <div class="playlistTrack_box pb-3 d-flex align-items-center">
                                                                <div class="track_img_wrapper morePlaylist">
                                                                    <img class="img-fluid" src="https://dummyimage.com/1000x1000/" alt="">
                                                                    <i class="fa fa-play" aria-hidden="true"></i>
                                                                </div>
                                                                <div class="track_info">
                                                                    <div class="track_title">Demo Track</div>
                                                                    <div class="track_artist">Artist</div>
                                                                </div>
                                                            </div>
                                                            <div class="playlistTrack_box pb-3 d-flex align-items-center">
                                                                <div class="track_img_wrapper morePlaylist">
                                                                    <img class="img-fluid" src="https://dummyimage.com/1000x1000/" alt="">
                                                                    <i class="fa fa-play" aria-hidden="true"></i>
                                                                </div>
                                                                <div class="track_info">
                                                                    <div class="track_title">Demo Track</div>
                                                                    <div class="track_artist">Artist</div>
                                                                </div>
                                                            </div>
                                                            <div class="playlistTrack_box pb-3 d-flex align-items-center">
                                                                <div class="track_img_wrapper morePlaylist">
                                                                    <img class="img-fluid" src="https://dummyimage.com/1000x1000/" alt="">
                                                                    <i class="fa fa-play" aria-hidden="true"></i>
                                                                </div>
                                                                <div class="track_info">
                                                                    <div class="track_title">Demo Track</div>
                                                                    <div class="track_artist">Artist</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row align-items-center pb_sec">
                                                <div class="col-lg-4">
                                                    <div class="tab2_playlist_img_wrapper">
                                                        <img class="img-fluid" src="https://dummyimage.com/1000x1000/" alt="">
                                                    </div>
                                                    <button class="main-btn mt-3"><i class="fa fa-play" aria-hidden="true"></i> Play</button>
                                                </div>
                                                <div class="col-lg-8">
                                                    <div class="morePlaylist_right">
                                                        <div class="playlist_info_box mb-3">
                                                            <h2>Playlist 1</h2>
                                                            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Suscipit, excepturi quis animi.</p>
                                                        </div>
                                                        <hr>
                                                        <div class="playlist_iframe">
                                                            <div class="playlistTrack_box pb-3 d-flex align-items-center">
                                                                <div class="track_img_wrapper morePlaylist">
                                                                    <img class="img-fluid" src="https://dummyimage.com/1000x1000/" alt="">
                                                                    <i class="fa fa-play" aria-hidden="true"></i>
                                                                </div>
                                                                <div class="track_info">
                                                                    <div class="track_title">Demo Track</div>
                                                                    <div class="track_artist">Artist</div>
                                                                </div>
                                                            </div>
                                                            <div class="playlistTrack_box pb-3 d-flex align-items-center">
                                                                <div class="track_img_wrapper morePlaylist">
                                                                    <img class="img-fluid" src="https://dummyimage.com/1000x1000/" alt="">
                                                                    <i class="fa fa-play" aria-hidden="true"></i>
                                                                </div>
                                                                <div class="track_info">
                                                                    <div class="track_title">Demo Track</div>
                                                                    <div class="track_artist">Artist</div>
                                                                </div>
                                                            </div>
                                                            <div class="playlistTrack_box pb-3 d-flex align-items-center">
                                                                <div class="track_img_wrapper morePlaylist">
                                                                    <img class="img-fluid" src="https://dummyimage.com/1000x1000/" alt="">
                                                                    <i class="fa fa-play" aria-hidden="true"></i>
                                                                </div>
                                                                <div class="track_info">
                                                                    <div class="track_title">Demo Track</div>
                                                                    <div class="track_artist">Artist</div>
                                                                </div>
                                                            </div>
                                                            <div class="playlistTrack_box pb-3 d-flex align-items-center">
                                                                <div class="track_img_wrapper morePlaylist">
                                                                    <img class="img-fluid" src="https://dummyimage.com/1000x1000/" alt="">
                                                                    <i class="fa fa-play" aria-hidden="true"></i>
                                                                </div>
                                                                <div class="track_info">
                                                                    <div class="track_title">Demo Track</div>
                                                                    <div class="track_artist">Artist</div>
                                                                </div>
                                                            </div>
                                                            <div class="playlistTrack_box pb-3 d-flex align-items-center">
                                                                <div class="track_img_wrapper morePlaylist">
                                                                    <img class="img-fluid" src="https://dummyimage.com/1000x1000/" alt="">
                                                                    <i class="fa fa-play" aria-hidden="true"></i>
                                                                </div>
                                                                <div class="track_info">
                                                                    <div class="track_title">Demo Track</div>
                                                                    <div class="track_artist">Artist</div>
                                                                </div>
                                                            </div>
                                                            <div class="playlistTrack_box pb-3 d-flex align-items-center">
                                                                <div class="track_img_wrapper morePlaylist">
                                                                    <img class="img-fluid" src="https://dummyimage.com/1000x1000/" alt="">
                                                                    <i class="fa fa-play" aria-hidden="true"></i>
                                                                </div>
                                                                <div class="track_info">
                                                                    <div class="track_title">Demo Track</div>
                                                                    <div class="track_artist">Artist</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Search Here -->
                    <div class="main_content d-none" id="search">
                        <div class="search_trigger d-flex align-items-start">
                            <h2 class="mb-5" id="search_result">Best Match</h2>
                            <div id="close_search" style="cursor: pointer"><i class="fa fa-times"></i></div>
                        </div>
                        <h3 class="mb-3">Artist</h3>
                        <div class="artist_area">
                            <div class="container-fluid">
                                <div class="row align-items-center"></div>
                            </div>
                        </div>
                        <h3 class="mb-3 mt-5">Track</h3>
                        <div class="track_area d-flex justify-content-center flex-column">
                            <div class="search_track_wrapper">
                                <div class="container-fluid">
                                    <div class="row"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Player Control -->
                <?php require 'fixed_layout/musicplayer.php'?>
                <script src="js/playlist.js"></script>
                <script>
                    // Added space on top and bottom of content box
                    $(document).ready(function(){
                        var topBarHeight = $(".top_bar").outerHeight() + 50;
                        var playerBarHeight = $(".player_wrapper").outerHeight() + 50;
                        $(".main_content").css({
                            'padding-top' : topBarHeight,
                            'padding-bottom' : playerBarHeight
                        });

                        getUserPlaylist();

                        function getUserPlaylist() {
                            datas = [];
                            let xhr = new XMLHttpRequest();
                            xhr.open("GET", "http://localhost/PiguZMusic/APIs/Playlist/getAllPlaylists.php?mode=user");
                            xhr.setRequestHeader("Accept", "/");
                            var data = "";
                            xhr.onreadystatechange = function () {
                                if (xhr.readyState === 4 && this.status == 200) {
                                    data = xhr.responseText;
                                    var lists = JSON.parse(data);
                                    console.log(lists);

                                    var playlistResult = lists["data"]["playlists"];
                                    var imgPath = "<?php echo $domain . $getImagePath?>" + "\\" + playlistResult[0].path;
                                    console.log(playlistResult);
                                    const mainPlaylistImg = $('.playlist_img_wrapper img'),
                                        mainPlaylistTitle = $('.playlist_info h2'),
                                        mainPlaylistDesc = $('.playlist_info p');

                                    mainPlaylistImg.attr('src', imgPath);
                                    mainPlaylistTitle.html(playlistResult[0].name);
                                    mainPlaylistDesc.html(playlistResult[0].description);
                                }
                            };
                            xhr.send();
                        }
                    });
                </script>
            </div>
        </div>
    </body>
</html>
