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

        if(formData.get("title") != "" && formData.get("description") != "" && $('#playlist-thumbnail')[0].files[0])
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
                    console.log(results["data"]["tracks"]);
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

    function showTracks(track, index, arr)
    {
        document.getElementById("results").innerHTML += "<div>" + arr[index].name + "</div>";
    }
});