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
                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                            <!-- Modal -->
                            <div style="" class="modal fade" id="createPlaylistModal" tabindex="-1" aria-labelledby="createPlaylistModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="createPlaylistModalLabel">New playlist</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form>
                                                <div class="mb-3">
                                                    <label for="playlist-title" class="col-form-label">Title:</label>
                                                    <input type="text" class="form-control" id="playlist-title">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="playlist-description" class="col-form-label">Description:</label>
                                                    <textarea class="form-control" id="playlist-description"></textarea>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-light" id="create-playlist-btn">Create</button>
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
                            xhr.open("GET", "<?php echo $domain; ?>APIs/UserPlaylist/getUserPlaylist.php?userId=<?php echo $_SESSION["user_id"] ?>");
                            xhr.setRequestHeader("Accept", "/");
                            var data = "";
                            xhr.onreadystatechange = function () {
                                if (xhr.readyState === 4 && this.status == 200) {
                                    data = xhr.responseText;
                                    var lists = JSON.parse(data);
                                    // console.log(lists);

                                    var playlistResult = lists["data"]["userplaylists"].forEach(showPlaylists);
                                    showCreatePlaylist();
                                }
                            };
                            xhr.send();
                        }

                        function getPlaylistTrack(playlistId) {
                            datas = [];
                            let xhr = new XMLHttpRequest();
                            xhr.open("GET", "<?php echo $domain; ?>APIs/PlaylistTrack/getPlaylistTrack.php?playlistId=" + playlistId);
                            xhr.setRequestHeader("Accept", "/");
                            var data = "";
                            xhr.onreadystatechange = function () {
                                if (xhr.readyState === 4 && this.status == 200) {
                                    data = xhr.responseText;
                                    var lists = JSON.parse(data);
                                    if(lists["statusCode"] === 200)
                                    {
                                        lists["data"]["playlisttracks"].forEach(function(track, index, arr) {
                                            showTracks(track, playlistId, index, arr);
                                        });
                                    }
                                }
                            };
                            xhr.send();
                        }

                        function getArtistTrack(artisttrackId, trackId) {
                            datas = [];
                            let xhr = new XMLHttpRequest();
                            xhr.open("GET", "<?php echo $domain; ?>APIs/ArtistTrack/getArtistTrack.php?trackId=" + trackId);
                            xhr.setRequestHeader("Accept", "/");
                            var data = "";
                            xhr.onreadystatechange = function () {
                                if (xhr.readyState === 4 && this.status == 200) {
                                    data = xhr.responseText;
                                    var lists = JSON.parse(data);
                                    if(lists["statusCode"] === 200)
                                    {
                                        lists["data"]["artisttracks"].forEach(function(artist, index, arr) {
                                            showArtists(artist, artisttrackId, index, arr);
                                        });
                                    }
                                }
                            };
                            xhr.send();
                        }

                        function showPlaylists(playlist, index, arr)
                        {
                            var isActive = index === 0 ? ' active' : '';
                            var isShow =index === 0 ? ' show' : '';

                            var playlistPill = '<li class="nav-item" role="presentation">' +
                                        '<button class="nav-link' + isActive +'" id="pills-' + arr[index].playlist.id + '-tab" data-bs-toggle="pill" data-bs-target="#pills-' + arr[index].playlist.id +'" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">' + arr[index].playlist.name + '</button>' +
                                        '</li>'
                            $('#pills-tab').append(playlistPill);

                            if(arr[index].playlist.path == null || arr[index].playlist.path == "")
                            {
                                arr[index].playlist.path = "defaultPlaylistThumbnail.png";
                            }
                            
                            var playlistPillContent = '<div class="tab-pane fade' + isShow + isActive +'" id="pills-' + arr[index].playlist.id +'" role="tabpanel" aria-labelledby="pills-' + arr[index].playlist.id +'" tabindex="0">' +
                                                        '<div class="tab_wrapper">' +
                                                            '<div class="container-fluid">' +
                                                                '<div class="row align-items-center">' +
                                                                    '<div class="col-lg-3">' +
                                                                        '<div class="playlist_img_wrapper">' +
                                                                            '<img class="img-fluid" src="<?php echo $domain . $getImagePath ?>'+ "\\" + arr[index].playlist.path +'" alt="">' +
                                                                        '</div>' +
                                                                    '</div>' +
                                                                    '<div class="col-lg-9 ps-5">' +
                                                                        '<div class="playlist_info pb-3">' +
                                                                            '<h2>' + arr[index].playlist.name + '</h2>' +
                                                                            '<p class="w-75">' + arr[index].playlist.description +'</p>' +
                                                                        '</div>' +
                                                                        '<div class="btn-group gap-4">' +
                                                                            '<button class="main-btn"><i class="fa fa-play" aria-hidden="true"></i> Play</button>' +
                                                                        '</div>' +
                                                                    '</div>' +
                                                                    '<div id="track-container-' + arr[index].playlist.id + '" class="col-lg-12 pt-3">' +
                                                                    '</div>' +
                                                                '</div>' +
                                                            '</div>' +
                                                        '</div>' +
                                                    '</div>'
                            $('#pills-tabContent').append(playlistPillContent);

                            getPlaylistTrack(arr[index].playlist.id);
                        }

                        function showCreatePlaylist()
                        {
                            var createPlaylistBtn = '<li class="nav-item" role="presentation">' +
                                                        '<button class="nav-link sub-btn" id="pills-contact-tab" data-bs-toggle="modal" data-bs-target="#createPlaylistModal" type="button">Create Playlist</button>' +
                                                    '</li>'
                            $('#pills-tab').append(createPlaylistBtn);
                        }

                        function showTracks(track, playlistId, index, arr)
                        {
                            var trackBox = '<div class="track_box">' +
                                                '<div class="track_img_wrapper">' +
                                                    '<img class="img-fluid" src="<?php echo $domain . $getImagePath ?>'+ "\\" + arr[index].track.thumbnail_path +'" alt="">' +
                                                '</div>' +
                                                '<div class="track_info">' +
                                                    '<div class="track_title">' + arr[index].track.name + '</div>' +
                                                    '<div class="track_artist-' + track.id + '"></div>' +
                                                '</div>' +
                                                '<div class="track_play">' +
                                                    '<i class="fa fa-play" aria-hidden="true"></i>' +
                                                '</div>' +
                                                '<div class="track_ctrl">' +
                                                    '<i style="cursor:pointer" class="fa fa-trash" aria-hidden="true" onclick="deletePlaylistTrack(' + track.id +')"></i>' +
                                                '</div>' +
                                            '</div>';
                            
                            $('#track-container-'+playlistId).append(trackBox);

                            getArtistTrack(track.id, arr[index].track.id)
                        }

                        function showArtists(artist, artisttrackId, index, arr)
                        {
                            artist_info = '<div>'+
                                            '<a href=# onclick="loadArtist(\'' + arr[index].artist.id + '\')">' + arr[index].artist.name + '</a>' +
                                          '</div>';

                            $('.track_artist-'+artisttrackId).append(artist_info);
                        }
                    });

                    $(document).ready(function(){
                        $('#createPlaylistModal').on('hidden.bs.modal', function (e) {
                            // Clear input fields
                            $('#playlist-title').val('');
                            $('#playlist-description').val('');
                        });

                        $("#create-playlist-btn").click(function()
                        {
                            var data = 
                            {
                                title: $('#playlist-title').val(),
                                description: $('#playlist-description').val(),
                                isUserPlaylist: 1
                            }
                            var formData = new FormData();
                            for (var item in data) {
                                formData.append(item, data[item]);
                            }

                            if(formData.get("title") != "" && formData.get("description") != "")
                            {
                                $.ajax({
                                    url:"./APIs/Playlist/createPlaylist.php",
                                    method:"POST",
                                    data:formData,
                                    contentType: false,
                                    processData: false,
                                    success:function(response)
                                    {
                                        $('#createPlaylistModal').modal('hide');
                                        $('#pills-profile-tab').click();
                                        var maxScrollHeight = Math.max(document.body.scrollHeight, document.documentElement.scrollHeight);
                                        // Scroll the document to the bottom
                                        window.scrollTo({
                                            top: maxScrollHeight,
                                            behavior: 'smooth' // Optional smooth scrolling effect
                                        });
                                    }
                                });
                            }
                        });
                    });
                </script>
            </div>
        </div>
    </body>
</html>
