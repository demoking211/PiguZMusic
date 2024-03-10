$(document).ready(function(){
    $("#search-btn").click(function()
    {
        var input = $("#search-input").val();
        if(input != "")
        {
            $.ajax({
                url:"./APIs/search.php",
                method:"GET",
                data:{track:input,
                      artist:input},

                success:function(response)
                {
                    // Example of retrieving first element data.
                    var results = JSON.parse(response);
                    if(results.statusCode === 200)
                    {
                        console.log(results["data"]["tracks"]);
                        // results["data"]["tracks"].forEach(showTracks);
                    }
                    else
                    {
                        console.log(results.statusCode);
                        console.log(results.message);
                    }
                }
            });
        }
        else
        {
            console.log("nothing");
        }
    });

    $("#register-btn").click(function()
    {
        var data = 
        {
            username: $('#register-username').val(),
            email: $('#register-email').val(),
            password: $('#register-password').val(),
            confirmPassword: $('#register-confrim-password').val()
        }
        var formData = new FormData();
        for (var item in data) {
            formData.append(item, data[item]);
        }

        if(formData.get("username") != "" && formData.get("email") != "" && formData.get("password") && formData.get("confirmPassword"))
        {
            $.ajax({
                url:"./APIs/register.php",
                method:"POST",
                data:formData,
                contentType: false,
                processData: false,
                success:function(response)
                {
                    var results = JSON.parse(response);
                    if(results.statusCode === 200)
                    {
                        console.log(results["data"]["user"]);
                    }
                    else
                    {
                        console.log(results.statusCode);
                        console.log(results.message);
                    }
                }
            });
        }
        else
        {
            console.log("nothing");
        }
    });

    $("#get-playlist-btn").click(function()
    {
        var id = $("#get-playlist-id").val();
        var modules = $("#get-playlist-modules").val().toLowerCase().split(" ").join("");
        var modulesList = modules.split(",");
        if(id != "")
        {
            $.ajax({
                url:"./APIs/Playlist/getPlaylist.php",
                method:"GET",
                data:{playlistId:id,
                      modules:modulesList},

                success:function(response)
                {
                    var results = JSON.parse(response);
                    if(results.statusCode === 200)
                    {
                        console.log(results["data"]["playlist"]);
                    }
                    else
                    {
                        console.log(results.statusCode);
                        console.log(results.message);
                    }
                }
            });
        }
        else
        {
            console.log("nothing");
        }
    });

    $("#getAll-playlist-btn").click(function()
    {
        var name = $("#getAll-playlist-byName").val();
        var mode = $("#getAll-playlist-mode").val().toLowerCase();
        var modules = $("#getAll-playlist-modules").val().toLowerCase().split(" ").join("");
        var modulesList = modules.split(",");
        var page = $("#getAll-track-page").val() > 0 ? $("#getAll-track-page").val() : 1;
        $.ajax({
            url:"./APIs/Playlist/getAllPlaylists.php",
            method:"GET",
            data:{name:name,
                  mode:mode,
                  modules:modulesList,
                  page:page},

            success:function(response)
            {
                var results = JSON.parse(response);
                if(results.statusCode === 200)
                {
                    console.log(results["data"]["playlists"]);
                }
                else
                {
                    console.log(results.statusCode);
                    console.log(results.message);
                }
                console.log(response)
            }
        });
    });

    $("#create-playlist-btn").click(function()
    {
        var isUserPlaylist = $('#playlist-isUserPlaylist').is(':checked') ? 1 : 0;

        var data = 
        {
            title: $('#playlist-title').val(),
            description: $('#playlist-description').val(),
            isUserPlaylist: isUserPlaylist
        }
        var formData = new FormData();
        for (var item in data) {
            formData.append(item, data[item]);
        }
        if($('#playlist-thumbnail')[0].files[0])
        {
            formData.append('thumbnail', $('#playlist-thumbnail')[0].files[0]);
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
                    var results = JSON.parse(response);
                    if(results.statusCode === 200)
                    {
                        console.log(results["data"]["playlist"]);
                    }
                    else
                    {
                        console.log(results.statusCode);
                        console.log(results.message);
                    }
                }
            });
        }
        else
        {
            console.log("nothing");
        }
    });

    $("#edit-playlist-btn").click(function()
    {
        var isUserPlaylist = $('#edit-playlist-isUserPlaylist').is(':checked') ? 1 : 0;

        var data = 
        {
            id: $('#edit-playlist-id').val(),
            title: $('#edit-playlist-title').val(),
            description: $('#edit-playlist-description').val(),
            isUserPlaylist: isUserPlaylist
        }
        var formData = new FormData();
        for (var item in data) {
            formData.append(item, data[item]);
        }
        if($('#edit-playlist-thumbnail')[0].files[0])
        {
            formData.append('thumbnail', $('#edit-playlist-thumbnail')[0].files[0]);
        }

        if(formData.get("id") != "")
        {
            $.ajax({
                url:"./APIs/Playlist/editPlaylist.php",
                method:"POST",
                data:formData,
                contentType: false,
                processData: false,
                success:function(response)
                {
                    var results = JSON.parse(response);
                    if(results.statusCode === 200)
                    {
                        console.log(results["data"]["playlist"]);
                    }
                    else
                    {
                        console.log(results.statusCode);
                        console.log(results.message);
                    }
                }
            });
        }
        else
        {
            console.log("nothing");
        }
    });

    $("#delete-playlist-btn").click(function()
    {
        var id = $("#playlist-id").val();
        if(id != "")
        {
            $.ajax({
                url:"./APIs/Playlist/deletePlaylist.php",
                method:"POST",
                data:{playlistId:id},

                success:function(response)
                {
                    var results = JSON.parse(response);
                    if(results.statusCode === 200)
                    {
                        console.log("Successfully Removed.");
                    }
                    else
                    {
                        console.log(results.statusCode);
                        console.log(results.message);
                    }
                }
            });
        }
        else
        {
            console.log("nothing");
        }
    });

    $("#get-genre-btn").click(function()
    {
        var id = $("#get-genre-id").val();
        var modules = $("#get-genre-modules").val().toLowerCase();
        if(id != "")
        {
            $.ajax({
                url:"./APIs/Genre/getGenre.php",
                method:"GET",
                data:{genreId:id,
                      modules:modules},

                success:function(response)
                {
                    var results = JSON.parse(response);
                    if(results.statusCode === 200)
                    {
                        console.log(results["data"]["genre"]);
                    }
                    else
                    {
                        console.log(results.statusCode);
                        console.log(results.message);
                    }
                }
            });
        }
        else
        {
            console.log("nothing");
        }
    });

    $("#getAll-genre-btn").click(function()
    {
        var name = $("#getAll-genre-byName").val();
        var modules = $("#getAll-genre-modules").val().toLowerCase();
        var page = $("#getAll-genre-page").val() > 0 ? $("#getAll-genre-page").val() : 1;
        $.ajax({
            url:"./APIs/Genre/getAllGenres.php",
            method:"GET",
            data:{name:name,
                  modules:modules,
                  page:page},

            success:function(response)
            {
                var results = JSON.parse(response);
                if(results.statusCode === 200)
                {
                    console.log(results["data"]["genres"]);
                }
                else
                {
                    console.log(results.statusCode);
                    console.log(results.message);
                }
            }
        });
    });

    $("#create-genre-btn").click(function()
    {
        var title = $("#genre-title").val();
        var description = $("#genre-description").val();
        const genre_details = {title:title, description:description};
        if(title != "" && description != "")
        {
            $.ajax({
                url:"./APIs/Genre/createGenre.php",
                method:"POST",
                data:{genreDetails:genre_details},

                success:function(response)
                {
                    var results = JSON.parse(response);
                    if(results.statusCode === 200)
                    {
                        console.log(results["data"]["genre"]);
                    }
                    else
                    {
                        console.log(results.statusCode);
                        console.log(results.message);
                    }
                }
            });
        }
        else
        {
            console.log("nothing");
        }
    });

    $("#edit-genre-btn").click(function()
    {
        var id = $("#edit-genre-id").val();
        var title = $("#edit-genre-title").val();
        var description = $("#edit-genre-description").val();
        const genre_details = {genreId:id, title:title, description:description};
        if(id != "")
        {
            $.ajax({
                url:"./APIs/Genre/editGenre.php",
                method:"POST",
                data:{genreDetails:genre_details},

                success:function(response)
                {
                    var results = JSON.parse(response);
                    if(results.statusCode === 200)
                    {
                        console.log(results["data"]["genre"]);
                    }
                    else
                    {
                        console.log(results.statusCode);
                        console.log(results.message);
                    }
                }
            });
        }
        else
        {
            console.log("nothing");
        }
    });

    $("#delete-genre-btn").click(function()
    {
        var id = $("#genre-id").val();
        if(id != "")
        {
            $.ajax({
                url:"./APIs/Genre/deleteGenre.php",
                method:"POST",
                data:{genreId:id},

                success:function(response)
                {
                    var results = JSON.parse(response);
                    if(results.statusCode === 200)
                    {
                        console.log("Successfully Removed.");
                    }
                    else
                    {
                        console.log(results.statusCode);
                        console.log(results.message);
                    }
                }
            });
        }
        else
        {
            console.log("nothing");
        }
    });

    $("#get-track-btn").click(function()
    {
        var id = $("#get-track-id").val();
        var modules = $("#get-track-modules").val().toLowerCase().split(" ").join("");
        var modulesList = modules.split(",");
        if(id != "")
        {
            $.ajax({
                url:"./APIs/Track/getTrack.php",
                method:"GET",
                data:{trackId:id,
                      modules:modulesList},

                success:function(response)
                {
                    var results = JSON.parse(response);
                    if(results.statusCode === 200)
                    {
                        console.log(results["data"]["track"]);
                    }
                    else
                    {
                        console.log(results.statusCode);
                        console.log(results.message);
                    }
                }
            });
        }
        else
        {
            console.log("nothing");
        }
    });

    $("#getAll-track-btn").click(function()
    {
        var title = $("#getAll-track-byTitle").val();
        var genreId = $("#getAll-track-byGenreId").val();
        var modules = $("#getAll-track-modules").val().toLowerCase().split(" ").join("");
        var modulesList = modules.split(",");
        var page = $("#getAll-track-page").val() > 0 ? $("#getAll-track-page").val() : 1;
        $.ajax({
            url:"./APIs/Track/getAllTracks.php",
            method:"GET",
            data:{title:title,
                  genreId:genreId,
                  modules:modulesList,
                  page:page},

            success:function(response)
            {
                var results = JSON.parse(response);
                if(results.statusCode === 200)
                {
                    // console.log(results["data"]["tracks"]);
                    results["data"]["tracks"].forEach(showTracks);
                }
                else
                {
                    console.log(results.statusCode);
                    console.log(results.message);
                }
            }
        });
    });

    $("#create-track-btn").click(function()
    {
        var data = 
        {
            title: $('#track-title').val(),
            description: $('#track-description').val(),
            genreId: $('#track-genre-id').val()
        }
        var formData = new FormData();
        for (var item in data) {
            formData.append(item, data[item]);
        }
        if($('#track-thumbnail')[0].files[0])
        {
            formData.append('thumbnail', $('#track-thumbnail')[0].files[0]);
        }
        if($('#track-music-path')[0].files[0])
        {
            formData.append('music-path', $('#track-music-path')[0].files[0]);
        }
        if($('#track-premium-music-path')[0].files[0])
        {
            formData.append('premium-music-path', $('#track-premium-music-path')[0].files[0]);
        }

        if(formData.get("title") != "" && formData.get("description") != "" && formData.get("genreId") != "" && $('#track-thumbnail')[0].files[0] && $('#track-music-path')[0].files[0] && $('#track-premium-music-path')[0].files[0])
        {
            $.ajax({
                url:"./APIs/Track/createTrack.php",
                method:"POST",
                data:formData,
                contentType: false,
                processData: false,
                success:function(response)
                {
                    var results = JSON.parse(response);
                    if(results.statusCode === 200)
                    {
                        console.log(results["data"]["track"]);
                    }
                    else
                    {
                        console.log(results.statusCode);
                        console.log(results.message);
                    }
                }
            });
        }
        else
        {
            console.log("nothing");
        }
    });

    $("#edit-track-btn").click(function()
    {
        var data = 
        {
            id: $('#edit-track-id').val(),
            title: $('#edit-track-title').val(),
            description: $('#edit-track-description').val(),
            genreId: $('#edit-track-genre-id').val()
        }
        var formData = new FormData();
        for (var item in data) {
            formData.append(item, data[item]);
        }
        if($('#edit-track-thumbnail')[0].files[0])
        {
            formData.append('thumbnail', $('#edit-track-thumbnail')[0].files[0]);
        }
        if($('#edit-track-music-path')[0].files[0])
        {
            formData.append('music-path', $('#edit-track-music-path')[0].files[0]);
        }
        if($('#edit-track-premium-music-path')[0].files[0])
        {
            formData.append('premium-music-path', $('#edit-track-premium-music-path')[0].files[0]);
        }

        if(formData.get("id") != "")
        {
            $.ajax({
                url:"./APIs/Track/editTrack.php",
                method:"POST",
                data:formData,
                contentType: false,
                processData: false,
                success:function(response)
                {
                    var results = JSON.parse(response);
                    if(results.statusCode === 200)
                    {
                        console.log(results["data"]["track"]);
                    }
                    else
                    {
                        console.log(results.statusCode);
                        console.log(results.message);
                    }
                }
            });
        }
        else
        {
            console.log("nothing");
        }
    });

    $("#delete-track-btn").click(function()
    {
        var id = $("#track-id").val();
        if(id != "")
        {
            $.ajax({
                url:"./APIs/Track/deleteTrack.php",
                method:"POST",
                data:{trackId:id},

                success:function(response)
                {
                    var results = JSON.parse(response);
                    if(results.statusCode === 200)
                    {
                        console.log("Successfully Removed.");
                    }
                    else
                    {
                        console.log(results.statusCode);
                        console.log(results.message);
                    }
                }
            });
        }
        else
        {
            console.log("nothing");
        }
    });

    $("#get-artist-btn").click(function()
    {
        var id = $("#get-artist-id").val();
        var modules = $("#get-artist-modules").val().toLowerCase().split(" ").join("");
        var modulesList = modules.split(",");
        if(id != "")
        {
            $.ajax({
                url:"./APIs/Artist/getArtist.php",
                method:"GET",
                data:{artistId:id,
                      modules:modulesList},

                success:function(response)
                {
                    var results = JSON.parse(response);
                    if(results.statusCode === 200)
                    {
                        console.log(results["data"]["artist"]);
                    }
                    else
                    {
                        console.log(results.statusCode);
                        console.log(results.message);
                    }
                }
            });
        }
        else
        {
            console.log("nothing");
        }
    });

    $("#getAll-artist-btn").click(function()
    {
        var name = $("#getAll-artist-byName").val();
        var modules = $("#getAll-artist-modules").val().toLowerCase().split(" ").join("");
        var modulesList = modules.split(",");
        var page = $("#getAll-artist-page").val() > 0 ? $("#getAll-artist-page").val() : 1;
        $.ajax({
            url:"./APIs/Artist/getAllArtists.php",
            method:"GET",
            data:{name:name,
                  modules:modulesList,
                  page:page},

            success:function(response)
            {
                var results = JSON.parse(response);
                if(results.statusCode === 200)
                {
                    console.log(results["data"]["artists"]);
                    // results["data"]["artists"].forEach(showArtists);
                }
                else
                {
                    console.log(results.statusCode);
                    console.log(results.message);
                }
                console.log(response)
            }
        });
    });

    $("#create-artist-btn").click(function()
    {
        var data = 
        {
            name: $('#artist-name').val(),
            description: $('#artist-description').val()
        }
        var formData = new FormData();
        for (var item in data) {
            formData.append(item, data[item]);
        }
        if($('#artist-thumbnail')[0].files[0])
        {
            formData.append('thumbnail', $('#artist-thumbnail')[0].files[0]);
        }

        if(formData.get("name") != "" && formData.get("description") != "" && $('#artist-thumbnail')[0].files[0])
        {
            $.ajax({
                url:"./APIs/Artist/createArtist.php",
                method:"POST",
                data:formData,
                contentType: false,
                processData: false,
                success:function(response)
                {
                    var results = JSON.parse(response);
                    if(results.statusCode === 200)
                    {
                        console.log(results["data"]["artist"]);
                    }
                    else
                    {
                        console.log(results.statusCode);
                        console.log(results.message);
                    }
                }
            });
        }
        else
        {
            console.log("nothing");
        }
    });

    $("#edit-artist-btn").click(function()
    {
        var data = 
        {
            id: $('#edit-artist-id').val(),
            name: $('#edit-artist-name').val(),
            description: $('#edit-artist-description').val()
        }
        var formData = new FormData();
        for (var item in data) {
            formData.append(item, data[item]);
        }
        if($('#edit-artist-thumbnail')[0].files[0])
        {
            formData.append('thumbnail', $('#edit-artist-thumbnail')[0].files[0]);
        }

        if(formData.get("id") != "")
        {
            $.ajax({
                url:"./APIs/Artist/editArtist.php",
                method:"POST",
                data:formData,
                contentType: false,
                processData: false,
                success:function(response)
                {
                    var results = JSON.parse(response);
                    if(results.statusCode === 200)
                    {
                        console.log(results["data"]["artist"]);
                    }
                    else
                    {
                        console.log(results.statusCode);
                        console.log(results.message);
                    }
                }
            });
        }
        else
        {
            console.log("nothing");
        }
    });

    $("#delete-artist-btn").click(function()
    {
        var id = $("#artist-id").val();
        if(id != "")
        {
            $.ajax({
                url:"./APIs/Artist/deleteArtist.php",
                method:"POST",
                data:{artistId:id},

                success:function(response)
                {
                    var results = JSON.parse(response);
                    if(results.statusCode === 200)
                    {
                        console.log("Successfully Removed.");
                    }
                    else
                    {
                        console.log(results.statusCode);
                        console.log(results.message);
                    }
                }
            });
        }
        else
        {
            console.log("nothing");
        }
    });

    $("#get-artisttrack-byArtistTrackID-btn").click(function()
    {
        var artistTrackId = $('#get-artisttrack-byArtistTrackID-artisttrack-id').val();

        if(artistTrackId != "")
        {
            $.ajax({
                url:"./APIs/ArtistTrack/getArtistTrack.php",
                method:"GET",
                data:{artistTrackId: artistTrackId},
                success:function(response)
                {
                    var results = JSON.parse(response);
                    if(results.statusCode === 200)
                    {
                        console.log(results["data"]["artisttracks"]);
                    }
                    else
                    {
                        console.log(results.statusCode);
                        console.log(results.message);
                    }
                    console.log(response)
                }
            });
        }
        else
        {
            console.log("nothing");
        }
    });

    $("#get-artisttrack-byArtistORTrackID-btn").click(function()
    {
        var artistId = $('#get-artisttrack-byArtistORTrackID-artist-id').val();
        var trackId = $('#get-artisttrack-byArtistORTrackID-track-id').val();

        if(artistId != "" || trackId != "")
        {
            $.ajax({
                url:"./APIs/ArtistTrack/getArtistTrack.php",
                method:"GET",
                data:{artistId: artistId,
                    trackId: trackId},
                success:function(response)
                {
                    var results = JSON.parse(response);
                    if(results.statusCode === 200)
                    {
                        console.log(results["data"]["artisttracks"]);
                    }
                    else
                    {
                        console.log(results.statusCode);
                        console.log(results.message);
                    }
                    console.log(response)
                }
            });
        }
        else
        {
            console.log("nothing");
        }
    });

    $("#create-artisttrack-btn").click(function()
    {
        var data = 
        {
            artistId: $('#artisttrack-artist-id').val(),
            trackId: $('#artisttrack-track-id').val()
        }
        var formData = new FormData();
        for (var item in data) {
            formData.append(item, data[item]);
        }

        if(formData.get("artistId") != "" && formData.get("trackId") != "")
        {
            $.ajax({
                url:"./APIs/ArtistTrack/createArtistTrack.php",
                method:"POST",
                data:formData,
                contentType: false,
                processData: false,
                success:function(response)
                {
                    var results = JSON.parse(response);
                    if(results.statusCode === 200)
                    {
                        console.log(results["data"]["artisttrack"]);
                    }
                    else
                    {
                        console.log(results.statusCode);
                        console.log(results.message);
                    }
                }
            });
        }
        else
        {
            console.log("nothing");
        }
    });

    $("#edit-artisttrack-btn").click(function()
    {
        var data = 
        {
            artistTrackId : $('#edit-artisttrack-id').val(),
            artistId: $('#edit-artisttrack-artist-id').val(),
            trackId: $('#edit-artisttrack-track-id').val()
        }
        var formData = new FormData();
        for (var item in data) {
            formData.append(item, data[item]);
        }

        if(formData.get("artistTrackId") != "")
        {
            $.ajax({
                url:"./APIs/ArtistTrack/editArtistTrack.php",
                method:"POST",
                data:formData,
                contentType: false,
                processData: false,
                success:function(response)
                {
                    var results = JSON.parse(response);
                    if(results.statusCode === 200)
                    {
                        console.log(results["data"]["artisttrack"]);
                    }
                    else
                    {
                        console.log(results.statusCode);
                        console.log(results.message);
                    }
                }
            });
        }
        else
        {
            console.log("nothing");
        }
    });

    $("#delete-artisttrack-btn").click(function()
    {
        var id = $("#artisttrack-id").val();
        if(id != "")
        {
            $.ajax({
                url:"./APIs/ArtistTrack/deleteArtistTrack.php",
                method:"POST",
                data:{artistTrackId:id},

                success:function(response)
                {
                    var results = JSON.parse(response);
                    if(results.statusCode === 200)
                    {
                        console.log("Successfully Removed.");
                    }
                    else
                    {
                        console.log(results.statusCode);
                        console.log(results.message);
                    }
                }
            });
        }
        else
        {
            console.log("nothing");
        }
    });

    $("#get-playlisttrack-byPlaylistTrackID-btn").click(function()
    {
        var playlistTrackId = $('#get-playlisttrack-byPlaylistTrackID-playlisttrack-id').val();

        if(playlistTrackId != "")
        {
            $.ajax({
                url:"./APIs/PlaylistTrack/getPlaylistTrack.php",
                method:"GET",
                data:{playlistTrackId: playlistTrackId},
                success:function(response)
                {
                    var results = JSON.parse(response);
                    if(results.statusCode === 200)
                    {
                        console.log(results["data"]["playlisttracks"]);
                    }
                    else
                    {
                        console.log(results.statusCode);
                        console.log(results.message);
                    }
                    console.log(response)
                }
            });
        }
        else
        {
            console.log("nothing");
        }
    });

    $("#get-playlisttrack-byPlaylistORTrackID-btn").click(function()
    {
        var playlistId = $('#get-playlisttrack-byPlaylistORTrackID-playlist-id').val();
        var trackId = $('#get-playlisttrack-byPlaylistORTrackID-track-id').val();

        if(playlistId != "" || trackId != "")
        {
            $.ajax({
                url:"./APIs/PlaylistTrack/getPlaylistTrack.php",
                method:"GET",
                data:{playlistId: playlistId,
                    trackId: trackId},
                success:function(response)
                {
                    var results = JSON.parse(response);
                    if(results.statusCode === 200)
                    {
                        console.log(results["data"]["playlisttracks"]);
                    }
                    else
                    {
                        console.log(results.statusCode);
                        console.log(results.message);
                    }
                    console.log(response)
                }
            });
        }
        else
        {
            console.log("nothing");
        }
    });

    $("#create-playlisttrack-btn").click(function()
    {
        var data = 
        {
            playlistId: $('#playlisttrack-playlist-id').val(),
            trackId: $('#playlisttrack-track-id').val()
        }
        var formData = new FormData();
        for (var item in data) {
            formData.append(item, data[item]);
        }

        if(formData.get("playlistId") != "" && formData.get("trackId") != "")
        {
            $.ajax({
                url:"./APIs/PlaylistTrack/createPlaylistTrack.php",
                method:"POST",
                data:formData,
                contentType: false,
                processData: false,
                success:function(response)
                {
                    var results = JSON.parse(response);
                    if(results.statusCode === 200)
                    {
                        console.log(results["data"]["playlisttrack"]);
                    }
                    else
                    {
                        console.log(results.statusCode);
                        console.log(results.message);
                    }
                }
            });
        }
        else
        {
            console.log("nothing");
        }
    });

    $("#edit-playlisttrack-btn").click(function()
    {
        var data = 
        {
            playlistTrackId : $('#edit-playlisttrack-id').val(),
            playlistId: $('#edit-playlisttrack-playlist-id').val(),
            trackId: $('#edit-playlisttrack-track-id').val()
        }
        var formData = new FormData();
        for (var item in data) {
            formData.append(item, data[item]);
        }

        if(formData.get("playlistTrackId") != "")
        {
            $.ajax({
                url:"./APIs/PlaylistTrack/editPlaylistTrack.php",
                method:"POST",
                data:formData,
                contentType: false,
                processData: false,
                success:function(response)
                {
                    var results = JSON.parse(response);
                    if(results.statusCode === 200)
                    {
                        console.log(results["data"]["playlisttrack"]);
                    }
                    else
                    {
                        console.log(results.statusCode);
                        console.log(results.message);
                    }
                }
            });
        }
        else
        {
            console.log("nothing");
        }
    });

    $("#delete-playlisttrack-btn").click(function()
    {
        var id = $("#playlisttrack-id").val();
        if(id != "")
        {
            $.ajax({
                url:"./APIs/PlaylistTrack/deletePlaylistTrack.php",
                method:"POST",
                data:{playlistTrackId:id},

                success:function(response)
                {
                    var results = JSON.parse(response);
                    if(results.statusCode === 200)
                    {
                        console.log("Successfully Removed.");
                    }
                    else
                    {
                        console.log(results.statusCode);
                        console.log(results.message);
                    }
                }
            });
        }
        else
        {
            console.log("nothing");
        }
    });

    $("#get-userplaylist-byUserPlaylistID-btn").click(function()
    {
        var userPlaylistId = $('#get-userplaylist-byUserPlaylistID-userplaylist-id').val();

        if(userPlaylistId != "")
        {
            $.ajax({
                url:"./APIs/UserPlaylist/getUserPlaylist.php",
                method:"GET",
                data:{userPlaylistId: userPlaylistId},
                success:function(response)
                {
                    var results = JSON.parse(response);
                    if(results.statusCode === 200)
                    {
                        console.log(results["data"]["userplaylists"]);
                    }
                    else
                    {
                        console.log(results.statusCode);
                        console.log(results.message);
                    }
                    console.log(response)
                }
            });
        }
        else
        {
            console.log("nothing");
        }
    });

    $("#get-userplaylist-byPlaylistORUserID-btn").click(function()
    {
        var playlistId = $('#get-userplaylist-byPlaylistORUserID-playlist-id').val();
        var userId = $('#get-userplaylist-byPlaylistORUserID-user-id').val();

        if(playlistId != "" || userId != "")
        {
            $.ajax({
                url:"./APIs/UserPlaylist/getUserPlaylist.php",
                method:"GET",
                data:{playlistId: playlistId,
                    userId: userId},
                success:function(response)
                {
                    var results = JSON.parse(response);
                    if(results.statusCode === 200)
                    {
                        console.log(results["data"]["userplaylists"]);
                    }
                    else
                    {
                        console.log(results.statusCode);
                        console.log(results.message);
                    }
                    console.log(response)
                }
            });
        }
        else
        {
            console.log("nothing");
        }
    });

    $("#create-userplaylist-btn").click(function()
    {
        var data = 
        {
            playlistId: $('#userplaylist-playlist-id').val(),
            userId: $('#userplaylist-user-id').val()
        }
        var formData = new FormData();
        for (var item in data) {
            formData.append(item, data[item]);
        }

        if(formData.get("playlistId") != "" && formData.get("userId") != "")
        {
            $.ajax({
                url:"./APIs/UserPlaylist/createUserPlaylist.php",
                method:"POST",
                data:formData,
                contentType: false,
                processData: false,
                success:function(response)
                {
                    var results = JSON.parse(response);
                    if(results.statusCode === 200)
                    {
                        console.log(results["data"]["userplaylist"]);
                    }
                    else
                    {
                        console.log(results.statusCode);
                        console.log(results.message);
                    }
                }
            });
        }
        else
        {
            console.log("nothing");
        }
    });

    $("#edit-userplaylist-btn").click(function()
    {
        var data = 
        {
            userPlaylistId : $('#edit-userplaylist-id').val(),
            playlistId: $('#edit-userplaylist-playlist-id').val(),
            userId: $('#edit-userplaylist-user-id').val()
        }
        var formData = new FormData();
        for (var item in data) {
            formData.append(item, data[item]);
        }

        if(formData.get("userPlaylistId") != "")
        {
            $.ajax({
                url:"./APIs/UserPlaylist/editUserPlaylist.php",
                method:"POST",
                data:formData,
                contentType: false,
                processData: false,
                success:function(response)
                {
                    var results = JSON.parse(response);
                    if(results.statusCode === 200)
                    {
                        console.log(results["data"]["userplaylist"]);
                    }
                    else
                    {
                        console.log(results.statusCode);
                        console.log(results.message);
                    }
                }
            });
        }
        else
        {
            console.log("nothing");
        }
    });

    $("#delete-userplaylist-btn").click(function()
    {
        var id = $("#userplaylist-id").val();
        if(id != "")
        {
            $.ajax({
                url:"./APIs/UserPlaylist/deleteUserPlaylist.php",
                method:"POST",
                data:{userPlaylistId:id},

                success:function(response)
                {
                    var results = JSON.parse(response);
                    if(results.statusCode === 200)
                    {
                        console.log("Successfully Removed.");
                    }
                    else
                    {
                        console.log(results.statusCode);
                        console.log(results.message);
                    }
                }
            });
        }
        else
        {
            console.log("nothing");
        }
    });

    // function showTracks(track, index, arr)
    // {
    //     document.getElementById("results").innerHTML += "<div>" + arr[index].music_premium_path + "</div>";
    // }

    // function showArtists(artist, index, arr)
    // {
    //     document.getElementById("results").innerHTML += "<div>" + arr[index].name + "</div>";
    //     // arr[index].tracks.forEach(showTracks);
    // }
});