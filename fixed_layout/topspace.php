<div class="top_bar fixed-top">
    <div class="search_wrapper">
        <input type="text" id="search-input" size="50">
        <i style="cursor:pointer;" id="search-btn" class="fa fa-search" aria-hidden="true" style="color:#fff"></i>
    </div>
    <!-- <div>
        <form action="includes/logout.inc.php" method="POST">
            <button>Logout</button>
        </form>
    </div> -->
    <div class="profile_wrapper dropdown">
        <div class="profile_box dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <img class="img-fluid" src="https://dummyimage.com/1300x2300/" alt="">
        </div>
        <ul class="dropdown-menu mt-1">
            <li><a href="#" class="dropdown-item">My Profile</a></li>
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
            if(input != "")
            {
                $.ajax({
                    url:"./APIs/Track/getAllTracks.php",
                    method:"GET",
                    data:{title:input,
                          modules:['artist']},
                    success:function(response)
                    {
                        // Example of retrieving first element data.
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
                    }
                });
                $.ajax({
                    url:"./APIs/Artist/getAllArtists.php",
                    method:"GET",
                    data:{name:input,
                          modules:['track']},
                    success:function(response)
                    {
                        // Example of retrieving first element data.
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
                    }
                });
            }
            else
            {
                console.log("nothing");
            }
        });
    });
</script>