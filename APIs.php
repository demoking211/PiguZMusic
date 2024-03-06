<?php

require_once 'includes/config.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body onload="getDatas()">
    <?php
    
        if(isset($_SESSION['user_id']) && $_SESSION['user_role_id'] == 1)
        {
            echo "You are logged in as " . $_SESSION['user_username'];
        }
        else if(!isset($_SESSION['user_id']))
        {
            echo "Please login";
        }
        else if(isset($_SESSION['user_role_id']))
        {
            echo "You are not allowed to use APIs.";
        }

    ?>
    <hr>
    <h2>APIs</h2>
    <div>
        <h3>Search: </h3>
        <input type="text" id="search-input" name="search" placeholder="Search">
        <button id="search-btn">Search</button>
    </div>
    <p id="results"></p>
    <div>
        <h3>Get Playlist by ID: </h3>
        <div>
            <div>
                <label>ID: </label>
                <input type="text" id="get-playlist-id" name="get-playlist-id">
            </div>
            <div>
                <label>Modules(Optional): </label>
                <input type="text" id="get-playlist-modules" name="get-playlist-modules" placeholder="[Track, User]">
            </div>
            <button id="get-playlist-btn">Get</button>
        </div>
        <h3>Get All Playlists: </h3>
        <div>
            <div>
                <label>Name (Optional): </label>
                <input type="text" id="getAll-playlist-byName" name="getAll-playlist-byName">
            </div>
            <div>
                <label>Mode (Optional): </label>
                <input type="text" id="getAll-playlist-mode" name="getAll-playlist-mode" placeholder="[Standard, User, Mix]">
            </div>
            <div>
                <label>Modules(Optional): </label>
                <input type="text" id="getAll-playlist-modules" name="getAll-playlist-modules" placeholder="[Track, User]">
            </div>
            <div>
                <label>Page(Optional): </label>
                <input type="number" id="getAll-playlist-page" name="getAll-playlist-page" placeholder="1">
            </div>
            <button id="getAll-playlist-btn">Get All</button>
        </div>
        <h3>Create Playlist: </h3>
        <div>
            <div>
                <label>Title: </label>
                <input type="text" id="playlist-title" name="playlist-title">
            </div>
            <div>
                <labe>Description: </label>
                <input type="text" id="playlist-description" name="playlist-description">
            </div>
            <div>
                <labe>Thumbnail: </label>
                <input type="file" id="playlist-thumbnail" name="playlist-thumbnail" accept="image/png, image/gif, image/jpeg">
            </div>
            <div>
                <input type="checkbox" id="playlist-isUserPlaylist" name="playlist-isUserPlaylist">
                <label for="playlist-isUserPlaylist"> isUserPlaylist</label><br>
            </div>
            <button id="create-playlist-btn">Create</button>
        </div>
        <h3>Edit Playlist: </h3>
        <div>
            <div>
                <label>Playlist ID: </label>
                <input type="text" id="edit-playlist-id" name="edit-playlist-id">
            </div>
            <div>
                <label>Title: </label>
                <input type="text" id="edit-playlist-title" name="edit-playlist-title">
            </div>
            <div>
                <label>Description: </label>
                <input type="text" id="edit-playlist-description" name="edit-playlist-description">
            </div>
            <div>
                <labe>Thumbnail: </label>
                <input type="file" id="edit-playlist-thumbnail" name="edit-playlist-thumbnail" accept="image/png, image/gif, image/jpeg">
            </div>
            <div>
                <input type="checkbox" id="edit-playlist-isUserPlaylist" name="edit-playlist-isUserPlaylist">
                <label for="edit-playlist-isUserPlaylist"> isUserPlaylist</label><br>
            </div>
            <button id="edit-playlist-btn">Edit</button>
        </div>
        <h3>Delete Playlist: </h3>
        <div>
            <div>
                <label>Playlist ID: </label>
                <input type="text" id="playlist-id" name="playlist-id">
            </div>
            <button id="delete-playlist-btn">Confirm</button>
        </div>
    </div>
    <div>
        <h3>Get Genre by ID: </h3>
        <div>
            <div>
                <label>ID: </label>
                <input type="text" id="get-genre-id" name="get-genre-id">
            </div>
            <div>
                <label>Modules(Optional): </label>
                <input type="text" id="get-genre-modules" name="get-genre-modules" placeholder="Track">
            </div>
            <button id="get-genre-btn">Get</button>
        </div>
        <h3>Get All Genres: </h3>
        <div>
            <div>
                <label>Name (Optional): </label>
                <input type="text" id="getAll-genre-byName" name="getAll-genre-byName">
            </div>
            <div>
                <label>Modules(Optional): </label>
                <input type="text" id="getAll-genre-modules" name="getAll-genre-modules" placeholder="Track">
            </div>
            <div>
                <label>Page(Optional): </label>
                <input type="number" id="getAll-genre-page" name="getAll-genre-page" placeholder="1">
            </div>
            <button id="getAll-genre-btn">Get All</button>
        </div>
        <h3>Create Genre: </h3>
        <div>
            <div>
                <label>Title: </label>
                <input type="text" id="genre-title" name="genre-title">
            </div>
            <div>
                <labe>Description: </label>
                <input type="text" id="genre-description" name="genre-description">
            </div>
            <button id="create-genre-btn">Create</button>
        </div>
        <h3>Edit Genre: </h3>
        <div>
            <div>
                <label>Genre ID: </label>
                <input type="text" id="edit-genre-id" name="edit-genre-id">
            </div>
            <div>
                <label>Title: </label>
                <input type="text" id="edit-genre-title" name="edit-genre-title">
            </div>
            <div>
                <labe>Description: </label>
                <input type="text" id="edit-genre-description" name="edit-genre-description">
            </div>
            <button id="edit-genre-btn">Edit</button>
        </div>
        <h3>Delete Genre: </h3>
        <div>
            <div>
                <label>Genre ID: </label>
                <input type="text" id="genre-id" name="genre-id">
            </div>
            <button id="delete-genre-btn">Confirm</button>
        </div>
    </div>
    <div>
        <h3>Get Track by ID: </h3>
        <div>
            <div>
                <label>ID: </label>
                <input type="text" id="get-track-id" name="get-track-id">
            </div>
            <div>
                <label>Modules(Optional): </label>
                <input type="text" id="get-track-modules" name="get-track-modules" placeholder="[Genre / Artist]">
            </div>
            <button id="get-track-btn">Get</button>
        </div>
        <h3>Get All Tracks: </h3>
        <div>
            <div>
                <label>Title (Optional): </label>
                <input type="text" id="getAll-track-byTitle" name="getAll-track-byTitle">
            </div>
            <div>
                <label>Genre ID(Optional): </label>
                <input type="text" id="getAll-track-byGenreId" name="getAll-track-byGenreId">
            </div>
            <div>
                <label>Modules(Optional): </label>
                <input type="text" id="getAll-track-modules" name="getAll-track-modules" placeholder="[Genre / Artist]">
            </div>
            <div>
                <label>Page(Optional): </label>
                <input type="number" id="getAll-track-page" name="getAll-track-page" placeholder="1">
            </div>
            <button id="getAll-track-btn">Get</button>
        </div>
        <h3>Create Track: </h3>
        <div>
            <div>
                <label>Title: </label>
                <input type="text" id="track-title" name="track-title">
            </div>
            <div>
                <label>Description: </label>
                <input type="text" id="track-description" name="track-description">
            </div>
            <div>
                <labe>Genre ID: </label>
                <input type="text" id="track-genre-id" name="track-genre-id">
            </div>
            <div>
                <labe>Thumbnail: </label>
                <input type="file" id="track-thumbnail" name="track-thumbnail" accept="image/png, image/gif, image/jpeg">
            </div>
            <div>
                <labe>Music Path: </label>
                <input type="file" id="track-music-path" name="track-music-path" accept=".mp3">
            </div>
            <div>
                <labe>Premium Music Path: </label>
                <input type="file" id="track-premium-music-path" name="track-premium-music-path" accept=".mp3">
            </div>
            <button id="create-track-btn">Create</button>
        </div>
        <h3>Edit Track: </h3>
        <div>
            <div>
                <label>Track ID: </label>
                <input type="text" id="edit-track-id" name="edit-track-id">
            </div>
            <div>
                <label>Title: </label>
                <input type="text" id="edit-track-title" name="edit-track-title">
            </div>
            <div>
                <label>Description: </label>
                <input type="text" id="edit-track-description" name="edit-track-description">
            </div>
            <div>
                <labe>Genre ID: </label>
                <input type="text" id="edit-track-genre-id" name="edit-track-genre-id">
            </div>
            <div>
                <labe>Thumbnail: </label>
                <input type="file" id="edit-track-thumbnail" name="edit-track-thumbnail" accept="image/png, image/gif, image/jpeg">
            </div>
            <div>
                <labe>Music Path: </label>
                <input type="file" id="edit-track-music-path" name="edit-track-music-path" accept=".mp3">
            </div>
            <div>
                <labe>Premium Music Path: </label>
                <input type="file" id="edit-track-premium-music-path" name="edit-track-premium-music-path" accept=".mp3">
            </div>
            <button id="edit-track-btn">Edit</button>
        </div>
        <h3>Delete Track: </h3>
        <div>
            <div>
                <label>Track ID: </label>
                <input type="text" id="track-id" name="track-id">
            </div>
            <button id="delete-track-btn">Confirm</button>
        </div>
    </div>
    <div>
        <h3>Get Artist by ID: </h3>
        <div>
            <div>
                <label>ID: </label>
                <input type="text" id="get-artist-id" name="get-artist-id">
            </div>
            <div>
                <label>Modules(Optional): </label>
                <input type="text" id="get-artist-modules" name="get-artist-modules" placeholder="[Track]">
            </div>
            <button id="get-artist-btn">Get</button>
        </div>
        <h3>Get All Artists: </h3>
        <div>
            <div>
                <label>Name (Optional): </label>
                <input type="text" id="getAll-artist-byName" name="getAll-artist-byName">
            </div>
            <div>
                <label>Modules(Optional): </label>
                <input type="text" id="getAll-artist-modules" name="getAll-artist-modules" placeholder="[Track]">
            </div>
            <div>
                <label>Page(Optional): </label>
                <input type="number" id="getAll-artist-page" name="getAll-artist-page" placeholder="1">
            </div>
            <button id="getAll-artist-btn">Get</button>
        </div>
        <h3>Create Artist: </h3>
        <div>
            <div>
                <label>Name: </label>
                <input type="text" id="artist-name" name="artist-name">
            </div>
            <div>
                <labe>Description: </label>
                <input type="text" id="artist-description" name="artist-description">
            </div>
            <div>
                <labe>Thumbnail: </label>
                <input type="file" id="artist-thumbnail" name="artist-thumbnail" accept="image/png, image/gif, image/jpeg">
            </div>
            <button id="create-artist-btn">Create</button>
        </div>
        <h3>Edit Artist: </h3>
        <div>
            <div>
                <label>Artist ID: </label>
                <input type="text" id="edit-artist-id" name="edit-artist-id">
            </div>
            <div>
                <label>Name: </label>
                <input type="text" id="edit-artist-name" name="edit-artist-name">
            </div>
            <div>
                <label>Description: </label>
                <input type="text" id="edit-artist-description" name="edit-artist-description">
            </div>
            <div>
                <labe>Thumbnail: </label>
                <input type="file" id="edit-artist-thumbnail" name="edit-artist-thumbnail" accept="image/png, image/gif, image/jpeg">
            </div>
            <button id="edit-artist-btn">Edit</button>
        </div>
        <h3>Delete Artist: </h3>
        <div>
            <div>
                <label>Artist ID: </label>
                <input type="text" id="artist-id" name="artist-id">
            </div>
            <button id="delete-artist-btn">Confirm</button>
        </div>
    </div>
</body>
<script src="./js/APIsScript.js"></script>
<script>
    function getDatas()
    {
        var getGenres = document.getElementById('getAll-genre-btn');
        getGenres.click();
    }
</script>