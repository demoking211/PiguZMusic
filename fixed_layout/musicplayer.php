<div class="player_wrapper fixed-bottom">
    <div class="player_bar">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-9 player_main">
                    <div class="slider_bar">
                        <div class="slider_progress">
                            <audio id="main-audio"></audio>
                        </div>
                    </div>
                    <div class="player_lower">
                        <div class="time_text currentTime" id="currentTime">0:00</div>
                        <div class="player_control">
                            <button class="btnC prev">
                                <i class="fa fa-step-backward" aria-hidden="true"></i>
                            </button>    

                            <button class="btnC play">
                                <i class="fa fa-play" aria-hidden="true"></i>
                            </button> 

                            <button class="btnC next">
                                <i class="fa fa-step-forward" aria-hidden="true"></i>
                            </button> 
                        </div>
                        <div class="time_text totalTime" id="totalTime">0:00</div>
                    </div>
                </div>
                <div class="col-3 player_sub">
                    <div class="player_col">
                        <div class="track_img">
                            <img class="img-fluid" src="https://dummyimage.com/1200x900/" alt="">
                        </div>
                        <div class="track_info">
                            <div class="track_name"><p>No Track</p></div>
                            <div class="track_artist"><p>Artist: <span></span></p></div>
                            <div class="track_category"><p>Category: <span></span></p></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="main_player text-white">
        <div class="container-fluid main_player_wrapper">
            <div class="row">
                <div class="col-12 col-lg-6 px-3">
                    <div class="p_leftcol">
                        <div class="player_box">
                            <div class="track_img">
                                <img class="img-fluid" src="https://dummyimage.com/1000x1000/" alt="">
                            </div>
                            <div class="track_info d-flex flex-wrap">
                                <div class="track_name w-100"><p>Poppin' Shukin'</p></div>
                                <div class="track_artist w-50"><p>Artist: <span>Sample</span></p></div>
                                <div class="track_category w-50"><p>Category: <span>J-POP</span></p></div>
                            </div>
                            <div class="track_progress_bar">
                                <div class="time_group">
                                    <div class="time_text currentTime" id="currentTime">0:00</div>
                                    <div class="time_text totalTime" id="totalTime">0:00</div>
                                </div>
                                <div class="main_slider_bar">
                                    <div class="slider_progress">
                                        <audio id="main-audio"></audio>
                                    </div>
                                </div>
                                <div class="player_control">
                                    <button class="btnC prev">
                                        <i class="fa fa-step-backward" aria-hidden="true"></i>
                                    </button>    

                                    <button class="btnC play">
                                        <i class="fa fa-play" aria-hidden="true"></i>
                                    </button> 

                                    <button class="btnC next">
                                        <i class="fa fa-step-forward" aria-hidden="true"></i>
                                    </button> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 px-3">
                    <div class="p_rightcol">
                        <div class="playlist_box">
                            <div class="player_top_wrapper d-flex align-items-center">
                                <div class="artist_img">
                                    <img class="img-fluid" src="https://dummyimage.com/3000x2000/" alt="">
                                </div>
                                <div class="right-col ms-4">
                                    <div class="artist_name">
                                        <h3>NiziU</h3>
                                    </div>
                                    <div class="artist_desc">
                                        <p>JPY Entertainment</p>
                                    </div>
                                </div>
                            </div>
                            <div class="player_bottom_wrapper mt-4">
                                <div class="playlist_queue overflow-y-scroll d-flex flex-column gap-4">
                                    <!-- demo 1 -->
                                    <div class="queue_box d-flex align-items-center">
                                        <div class="queue_img">
                                            <img class="img-fluid" src="https://dummyimage.com/1000x1000/" alt="">
                                        </div>
                                        <div class="queue_track_info">
                                            <div class="text" id="queue_title">Demo1</div>
                                            <div class="text" id="queue_artist">Artist: <span>Artist 1</span></div>
                                            <div class="text" id="queue_category">Category: <span>Pop</span></div>
                                        </div>
                                        <div class="queue_track_duration">
                                            <div class="text" id="queue_duration">0:00</div>
                                        </div>
                                    </div>

                                    <!-- demo 1 -->
                                    <div class="queue_box d-flex align-items-center">
                                        <div class="queue_img">
                                            <img class="img-fluid" src="https://dummyimage.com/1000x1000/" alt="">
                                        </div>
                                        <div class="queue_track_info">
                                            <div class="text" id="queue_title">Demo2</div>
                                            <div class="text" id="queue_artist">Artist: <span>Artist 1</span></div>
                                            <div class="text" id="queue_category">Category: <span>Pop</span></div>
                                        </div>
                                        <div class="queue_track_duration">
                                            <div class="text" id="queue_duration">0:00</div>
                                        </div>
                                    </div>

                                    <!-- demo 1 -->
                                    <div class="queue_box d-flex align-items-center">
                                        <div class="queue_img">
                                            <img class="img-fluid" src="https://dummyimage.com/1000x1000/" alt="">
                                        </div>
                                        <div class="queue_track_info">
                                            <div class="text" id="queue_title">Demo3</div>
                                            <div class="text" id="queue_artist">Artist: <span>Artist 1</span></div>
                                            <div class="text" id="queue_category">Category: <span>Pop</span></div>
                                        </div>
                                        <div class="queue_track_duration">
                                            <div class="text" id="queue_duration">0:00</div>
                                        </div>
                                    </div>

                                    <!-- demo 1 -->
                                    <div class="queue_box d-flex align-items-center">
                                        <div class="queue_img">
                                            <img class="img-fluid" src="https://dummyimage.com/1000x1000/" alt="">
                                        </div>
                                        <div class="queue_track_info">
                                            <div class="text" id="queue_title">Demo4</div>
                                            <div class="text" id="queue_artist">Artist: <span>Artist 1</span></div>
                                            <div class="text" id="queue_category">Category: <span>Pop</span></div>
                                        </div>
                                        <div class="queue_track_duration">
                                            <div class="text" id="queue_duration">0:00</div>
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

<script src="js/player_script.js"></script>

<script>
    var savedScrollPos;

    $(document).ready(function(){
        $(".player_bar, .main_player").on("click", function(event){

            if($(event.target).hasClass("player_bar"))
            {
                savedScrollPos = window.scrollY;

                console.log("clicked PlayerBar");
                $('.main_player').slideToggle({
                    start: function(){
                        console.log("Player Pop Up");
                        $('.player_bar').toggle()
                        $('body').addClass('fullscreen-mode');
                    }
                });
            }

            else if($(event.target).hasClass("main_player"))
            {
                console.log("clicked MainPlayer");
                $('.player_bar').slideToggle({
                    start: function(){
                        console.log("Player Pop Down");
                        $('.main_player').slideToggle()
                        $('body').removeClass('fullscreen-mode');

                        window.scrollTo({
                            top: savedScrollPos,
                            behavior: 'instant'
                        });
                    }
                });
            }

        });
    });

</script>