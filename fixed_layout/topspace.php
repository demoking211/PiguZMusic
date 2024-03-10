<div class="top_bar fixed-top">
    <div class="search_wrapper">
        <input type="search" id="search-input" size="50">
        <i style="cursor:pointer;" id="search-btn" class="fa fa-search" aria-hidden="true" style="color:#fff"></i>
    </div>
    <div class="profile_wrapper dropdown">
        <div class="profile_box dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <img class="img-fluid" src="https://dummyimage.com/1300x2300/" alt="">
        </div>
        <ul class="dropdown-menu mt-1">
            <li><a href="/PiguZMusic/userProfile.php" class="dropdown-item">My Profile</a></li>
            <li><a href="./pricelist.php" class="dropdown-item">Subscription Plan</a></li>
            <li><a class="dropdown-item" id="logout-btn" style="cursor: pointer;">Logout</a></li>
        </ul>
    </div>
</div>

<script>
    $(document).ready(function(){
        $("#logout-btn").click(function()
        {
            $.ajax({
                url:"./includes/logout.inc.php",
                method:"POST",
                success:function(response)
                {
                    window.location.href = './login_register.php';
                }
            });
        });

        $("#search-btn").click(function()
        {
            var input = $("#search-input").val();
            $('.search_track_wrapper').find('.row').empty();
            $('.artist_area').find('.row').empty();
            $('.search_trigger').find('h2').html("Best result for " + "<span>" + input +"</span>");
            $('#search').find('h3').removeClass('d-none');
            
            const artistImg = $('#artist_img'),
                artistName = $('#search_artist_name'),
                artistDesc = $('#search_artist_desc');

            if(input != "")
            {
                $.ajax({
                    url:"./APIs/Track/getAllTracks.php?modules[]=genre&modules[]=artist",
                    method:"GET",
                    data:{title:input,
                          modules:['artist']},
                    success:function(response)
                    {
                        // Example of retrieving first element data.
                        var results = JSON.parse(response);
                        if(results.statusCode === 200)
                        {
                            var trackResult = results["data"]["tracks"];
                            trackResult.forEach(showSearchTrack);
                        }
                        else
                        {  
                            $('.search_track_wrapper').find('.row').append(results.message);
                            console.log(results.statusCode);
                            console.log(results.message);
                        }
                    }
                });
                $.ajax({
                    url:"./APIs/Artist/getAllArtists.php",
                    method:"GET",
                    data:{name:input,
                          modules:['track']},
                    success:function(response)
                    {
                        var results = JSON.parse(response);
                        if(results.statusCode === 200)
                        {
                            let artistResult = results["data"]["artists"];
                            var artistImgPath = "<?php echo $domain . $getImagePath?>" + "\\" + artistResult[0].path;
                            
                            var htmlContent =   '<div class="col-lg-3 pe-5">' +
                                                    '<div class="search_artist_img">' +
                                                        '<img class="img-fluid" src="'+ artistImgPath +'" alt="">' +
                                                    '</div>' +
                                                '</div>' +
                                                '<div class="col-lg-9">' +
                                                    '<h2 id="search_artist_name">'+ artistResult[0].name +'</h2>' +
                                                    '<p id="search_artist_desc">'+ artistResult[0].description +'</p>' +
                                                '</div>';
                            
                            $('.artist_area').find('.row').append(htmlContent);
                        }
                        else
                        {
                            $('.artist_area').find('.row').append(results.message);
                            console.log(results.statusCode);
                            console.log(results.message);
                        }
                    }
                });
            }
            else
            {
                $('.search_trigger').find('h2').html("No Input");
                $('#search').find('h3').addClass('d-none');
                console.log("nothing");
            }
        });

        function showSearchTrack(track, index, arr)
        {
            var imgPath = "<?php echo $domain . $getImagePath?>" + "\\" + arr[index].thumbnail_path;
            var trackPath = "<?php echo $domain . $getTrackPath?>" + "\\" + arr[index].music_path;
            var artist = "Artist";
            
            var htmlContent =   '<div class="col-lg-3">' +
                                    '<div class="search_track_box">' +
                                        '<div class="search_track_img" onclick="loadMusic(' + "'" + arr[index].id + "'" 
                                                                                            + "," + "'" + imgPath + "'"
                                                                                            + "," + "'" + artist + "'" 
                                                                                            + "," + "'" + trackPath + "'" 
                                                                                            + ')">' +
                                            '<img src="' + imgPath + '" alt="">' +
                                            '<i class="fa fa-play" aria-hidden="true"></i>' +
                                        '</div>' +
                                    '<div class="text_wrapper text-center mt-3">' +
                                        '<div class="text_info">' + arr[index].name + '</div>' +
                                        '<div class="text_info">Artist: ' + artist + '</div>' +
                                        '<div class="text_info">Category: ' + arr[index].genre[0].name + '</div>' +
                                    '</div>' +
                                '</div>';

            $('.search_track_wrapper').find('.row').append(htmlContent);
        }

        $('#search-btn').on('click', function(){
            $('#core').addClass('d-none');
            $('#search').removeClass('d-none');
            $('#search-input').val("");
        });

        $('#close_search').on('click', function(){
            $('#search, #core').toggleClass('d-none');
        });
    });
</script>