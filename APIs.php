<?php

require_once 'includes/config.php';


if(isset($_SESSION['user_id']) && isset($_SESSION['user_role_id']))
{
    echo "You are logged in as " . $_SESSION['user_username'];
}
else if(!isset($_SESSION['user_id']))
{
    echo "Please login";
}
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
    <hr>
    <h2>APIs</h2>
    <div>
        <h3>Search: </h3>
        <input type="text" id="search-input" name="search" placeholder="Search">
        <button id="search-btn">Search</button>
    </div>
    <p id="results"></p>
    <div>
        <h3>Register: </h3>
        <div>
            <div>
                <label>Username: </label>
                <input type="text" id="register-username" name="register-username">
            </div>
            <div>
                <labe>Email: </label>
                <input type="text" id="register-email" name="register-email">
            </div>
            <div>
                <labe>Password: </label>
                <input type="text" id="register-password" name="register-password">
            </div>
            <div>
                <labe>Comfirm Password: </label>
                <input type="text" id="register-confrim-password" name="register-confrim-password">
            </div>
            <button id="register-btn">Create</button>
        </div>
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
    <div>
        <h3>Get ArtistTrack by ArtistTrackID: </h3>
        <div>
            <div>
                <label>Artist Track ID: </label>
                <input type="text" id="get-artisttrack-byArtistTrackID-artisttrack-id" name="get-artisttrack-byArtistTrackID-artisttrack-id">
            </div>
            <button id="get-artisttrack-byArtistTrackID-btn">Get</button>
        </div>
        <h3>Get ArtistTrack: </h3>
        <div>
            <div>
                <label>Artist ID: </label>
                <input type="text" id="get-artisttrack-byArtistORTrackID-artist-id" name="get-artisttrack-byArtistORTrackID-artist-id">
            </div>
            <div>
                <label>Track ID: </label>
                <input type="text" id="get-artisttrack-byArtistORTrackID-track-id" name="get-artisttrack-byArtistORTrackID-track-id">
            </div>
            <button id="get-artisttrack-byArtistORTrackID-btn">Get</button>
        </div>
        <h3>Create ArtistTrack: </h3>
        <div>
            <div>
                <label>Artist ID: </label>
                <input type="text" id="artisttrack-artist-id" name="artisttrack-artist-id">
            </div>
            <div>
                <label>Track ID: </label>
                <input type="text" id="artisttrack-track-id" name="artisttrack-track-id">
            </div>
            <button id="create-artisttrack-btn">Create</button>
        </div>
        <h3>Edit ArtistTrack: </h3>
        <div>
            <div>
                <label>Artist Track ID: </label>
                <input type="text" id="edit-artisttrack-id" name="edit-artisttrack-id">
            </div>
            <div>
                <label>Artist ID (Optional): </label>
                <input type="text" id="edit-artisttrack-artist-id" name="edit-artisttrack-artist-id">
            </div>
            <div>
                <label>Track ID(Optional): </label>
                <input type="text" id="edit-artisttrack-track-id" name="edit-artisttrack-track-id">
            </div>
            <button id="edit-artisttrack-btn">Edit</button>
        </div>
        <h3>Delete ArtistTrack: </h3>
        <div>
            <div>
                <label>Artist Track ID: </label>
                <input type="text" id="artisttrack-id" name="artisttrack-id">
            </div>
            <button id="delete-artisttrack-btn">Confirm</button>
        </div>
    </div>
    <div>
        <h3>Get PlaylistTrack by PlaylistTrackID: </h3>
        <div>
            <div>
                <label>Playlist Track ID: </label>
                <input type="text" id="get-playlisttrack-byPlaylistTrackID-playlisttrack-id" name="get-playlisttrack-byPlaylistTrackID-playlisttrack-id">
            </div>
            <button id="get-playlisttrack-byPlaylistTrackID-btn">Get</button>
        </div>
        <h3>Get PlaylistTrack: </h3>
        <div>
            <div>
                <label>Playlist ID: </label>
                <input type="text" id="get-playlisttrack-byPlaylistORTrackID-playlist-id" name="get-playlisttrack-byPlaylistORTrackID-playlist-id">
            </div>
            <div>
                <label>Track ID: </label>
                <input type="text" id="get-playlisttrack-byPlaylistORTrackID-track-id" name="get-playlisttrack-byPlaylistORTrackID-track-id">
            </div>
            <button id="get-playlisttrack-byPlaylistORTrackID-btn">Get</button>
        </div>
        <h3>Create PlaylistTrack: </h3>
        <div>
            <div>
                <label>Playlist ID: </label>
                <input type="text" id="playlisttrack-playlist-id" name="playlistrack-playlist-id">
            </div>
            <div>
                <label>Track ID: </label>
                <input type="text" id="playlisttrack-track-id" name="playlisttrack-track-id">
            </div>
            <button id="create-playlisttrack-btn">Create</button>
        </div>
        <h3>Edit PlaylistTrack: </h3>
        <div>
            <div>
                <label>Playlist Track ID: </label>
                <input type="text" id="edit-playlisttrack-id" name="edit-playlisttrack-id">
            </div>
            <div>
                <label>Playlist ID (Optional): </label>
                <input type="text" id="edit-playlisttrack-playlist-id" name="edit-playlisttrack-playlist-id">
            </div>
            <div>
                <label>Track ID(Optional): </label>
                <input type="text" id="edit-playlisttrack-track-id" name="edit-playlisttrack-track-id">
            </div>
            <button id="edit-playlisttrack-btn">Edit</button>
        </div>
        <h3>Delete PlaylistTrack: </h3>
        <div>
            <div>
                <label>Playlist Track ID: </label>
                <input type="text" id="playlisttrack-id" name="playlisttrack-id">
            </div>
            <button id="delete-playlisttrack-btn">Confirm</button>
        </div>
    </div>
    <div>
        <h3>Get UserPlaylist by UserPlaylistID: </h3>
        <div>
            <div>
                <label>User Playlist ID: </label>
                <input type="text" id="get-userplaylist-byUserPlaylistID-userplaylist-id" name="get-userplaylist-byUserPlaylistID-userplaylist-id">
            </div>
            <button id="get-userplaylist-byUserPlaylistID-btn">Get</button>
        </div>
        <h3>Get UserPlaylist: </h3>
        <div>
            <div>
                <label>Playlist ID: </label>
                <input type="text" id="get-userplaylist-byPlaylistORUserID-playlist-id" name="get-userplaylist-byPlaylistORUserID-playlist-id">
            </div>
            <div>
                <label>User ID: </label>
                <input type="text" id="get-userplaylist-byPlaylistORUserID-user-id" name="get-userplaylist-byPlaylistORUserID-user-id">
            </div>
            <button id="get-userplaylist-byPlaylistORUserID-btn">Get</button>
        </div>
        <h3>Create UserPlaylist: </h3>
        <div>
            <div>
                <label>Playlist ID: </label>
                <input type="text" id="userplaylist-playlist-id" name="userplaylist-playlist-id">
            </div>
            <div>
                <label>User ID: </label>
                <input type="text" id="userplaylist-user-id" name="userplaylist-user-id">
            </div>
            <button id="create-userplaylist-btn">Create</button>
        </div>
        <h3>Edit UserPlaylist: </h3>
        <div>
            <div>
                <label>User Playlist ID: </label>
                <input type="text" id="edit-userplaylist-id" name="edit-userplaylist-id">
            </div>
            <div>
                <label>Playlist ID (Optional): </label>
                <input type="text" id="edit-userplaylist-playlist-id" name="edit-userplaylist-playlist-id">
            </div>
            <div>
                <label>User ID(Optional): </label>
                <input type="text" id="edit-userplaylist-user-id" name="edit-userplaylist-user-id">
            </div>
            <button id="edit-userplaylist-btn">Edit</button>
        </div>
        <h3>Delete UserPlaylist: </h3>
        <div>
            <div>
                <label>User Playlist ID: </label>
                <input type="text" id="userplaylist-id" name="userplaylist-id">
            </div>
            <button id="delete-userplaylist-btn">Confirm</button>
        </div>
    </div>
</body>
<script src="./js/APIsScript.js"></script>
<script>
    function getDatas()
    {
        var getArtists = document.getElementById('getAll-artist-btn');
        getArtists.click();
    }
</script>