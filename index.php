<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/index.css">
        <?php require 'includes/cdn_linker.php'?>

        <title>PiguZMusic - Homepage</title>
    </head>
    <body>
        <div class="home_pg">
            <div id="main_wrapper">
                <!-- Sidebar Area -->
                <?php require 'fixed_layout/sidemenu.php'?>

                <!-- Main Content Area -->
                <div class="content_wrapper">
                    <!-- Top Bar -->
                    <?php require 'fixed_layout/topspace.php'?>

                    <!-- Content Here -->
                    <div class="main_content text-white">
                        <div id="main_index">
                            <div class="page_header pb_sec">
                                <h1>HOME</h1>
                            </div>
                            <div class="index_wrapper_1 pb_sec">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-12">
                                            <h1 class="big_title">Recently Added</h1>
                                            <div class="recently_slide">
                                                <div class="s_box">
                                                    <div class="s_img_wrapper">
                                                        <img src="https://dummyimage.com/1000x1000/" alt="">
                                                    </div>
                                                    <div class="text_wrapper text-center mt-3">
                                                        <div class="text_info">Demo 1</div>
                                                        <div class="text_info">Artist: Sample</div>
                                                        <div class="text_info">Category: J-POP</div>
                                                    </div>
                                                </div>
                                                <div class="s_box">
                                                    <div class="s_img_wrapper">
                                                        <img src="https://dummyimage.com/1000x1000/" alt="">
                                                    </div>
                                                    <div class="text_wrapper text-center mt-3">
                                                        <div class="text_info">Demo 2</div>
                                                        <div class="text_info">Artist: Sample</div>
                                                        <div class="text_info">Category: J-POP</div>
                                                    </div>
                                                </div>
                                                <div class="s_box">
                                                    <div class="s_img_wrapper">
                                                        <img src="https://dummyimage.com/1000x1000/" alt="">
                                                    </div>
                                                    <div class="text_wrapper text-center mt-3">
                                                        <div class="text_info">Demo 3</div>
                                                        <div class="text_info">Artist: Sample</div>
                                                        <div class="text_info">Category: J-POP</div>
                                                    </div>
                                                </div>
                                                <div class="s_box">
                                                    <div class="s_img_wrapper">
                                                        <img src="https://dummyimage.com/1000x1000/" alt="">
                                                    </div>
                                                    <div class="text_wrapper text-center mt-3">
                                                        <div class="text_info">Demo 4</div>
                                                        <div class="text_info">Artist: Sample</div>
                                                        <div class="text_info">Category: J-POP</div>
                                                    </div>
                                                </div>
                                                <div class="s_box">
                                                    <div class="s_img_wrapper">
                                                        <img src="https://dummyimage.com/1000x1000/" alt="">
                                                    </div>
                                                    <div class="text_wrapper text-center mt-3">
                                                        <div class="text_info">Demo 5</div>
                                                        <div class="text_info">Artist: Sample</div>
                                                        <div class="text_info">Category: J-POP</div>
                                                    </div>
                                                </div>
                                                <div class="s_box">
                                                    <div class="s_img_wrapper">
                                                        <img src="https://dummyimage.com/1000x1000/" alt="">
                                                    </div>
                                                    <div class="text_wrapper text-center mt-3">
                                                        <div class="text_info">Demo 6</div>
                                                        <div class="text_info">Artist: Sample</div>
                                                        <div class="text_info">Category: J-POP</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <script>
                                                let recentlyReadMoreAdded = false;

                                                $('.recently_slide').slick({
                                                    infinite: false,
                                                    slidesToShow: 4,
                                                    slidesToScroll: 1,
                                                    edgeFriction: 0.5
                                                });

                                                $('.recently_slide').on('edge',function(event, slick, direction){
                                                    if (!recentlyReadMoreAdded){
                                                        $('.recently_slide').slick('slickAdd', '<div class="readMore"><a href=""><button class="viewMore_btn">View More</button></a></div>');
                                                        recentlyReadMoreAdded = true;

                                                        var boxHeight = $(".s_box").height();
                                                        $(".readMore").css({
                                                            'height' : boxHeight
                                                        });
                                                    }
                                                });
                                            </script>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="index_wrapper_2 pb_sec">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="big_title">New Album</div>
                                            <div class="album_slide">
                                                <div class="s_box">
                                                    <div class="s_img_wrapper">
                                                        <img src="https://dummyimage.com/1000x1000/" alt="">
                                                    </div>
                                                    <div class="text_wrapper text-center mt-3">
                                                        <div class="text_info">Demo 1</div>
                                                        <div class="text_info">Artist: Sample</div>
                                                        <div class="text_info">Category: J-POP</div>
                                                    </div>
                                                </div>
                                                <div class="s_box">
                                                    <div class="s_img_wrapper">
                                                        <img src="https://dummyimage.com/1000x1000/" alt="">
                                                    </div>
                                                    <div class="text_wrapper text-center mt-3">
                                                        <div class="text_info">Demo 2</div>
                                                        <div class="text_info">Artist: Sample</div>
                                                        <div class="text_info">Category: J-POP</div>
                                                    </div>
                                                </div>
                                                <div class="s_box">
                                                    <div class="s_img_wrapper">
                                                        <img src="https://dummyimage.com/1000x1000/" alt="">
                                                    </div>
                                                    <div class="text_wrapper text-center mt-3">
                                                        <div class="text_info">Demo 3</div>
                                                        <div class="text_info">Artist: Sample</div>
                                                        <div class="text_info">Category: J-POP</div>
                                                    </div>
                                                </div>
                                                <div class="s_box">
                                                    <div class="s_img_wrapper">
                                                        <img src="https://dummyimage.com/1000x1000/" alt="">
                                                    </div>
                                                    <div class="text_wrapper text-center mt-3">
                                                        <div class="text_info">Demo 4</div>
                                                        <div class="text_info">Artist: Sample</div>
                                                        <div class="text_info">Category: J-POP</div>
                                                    </div>
                                                </div>
                                                <div class="s_box">
                                                    <div class="s_img_wrapper">
                                                        <img src="https://dummyimage.com/1000x1000/" alt="">
                                                    </div>
                                                    <div class="text_wrapper text-center mt-3">
                                                        <div class="text_info">Demo 5</div>
                                                        <div class="text_info">Artist: Sample</div>
                                                        <div class="text_info">Category: J-POP</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <script>
                                                let albumReadMoreAdded = false;

                                                $('.album_slide').slick({
                                                    infinite: false,
                                                    slidesToShow: 3,
                                                    slidesToScroll: 1,
                                                    edgeFriction: 0.5
                                                });

                                                $('.album_slide').on('edge',function(event, slick, direction){
                                                    if (!albumReadMoreAdded){
                                                        $('.album_slide').slick('slickAdd', '<div class="readMore"><a href=""><button class="viewMore_btn">View More</button></a></div>');
                                                        albumReadMoreAdded = true;

                                                        var boxHeight = $(".s_box").height();
                                                        $(".readMore").css({
                                                            'height' : boxHeight
                                                        });
                                                    }
                                                });
                                            </script>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="index_wrapper_3 pb_sec">
                            <div class="container">
                                <div class="row">
                                    <div class="col-12">
                                        <h1 class="big_title">New Songs</h1>
                                        <div class="song_slide">
                                            <div class="s_box">
                                                <div class="s_img_wrapper">
                                                    <img src="https://dummyimage.com/1000x1000/" alt="">
                                                </div>
                                                <div class="text_wrapper text-center mt-3">
                                                    <div class="text_info">Demo 1</div>
                                                    <div class="text_info">Artist: Sample</div>
                                                    <div class="text_info">Category: J-POP</div>
                                                </div>
                                            </div>
                                            <div class="s_box">
                                                <div class="s_img_wrapper">
                                                    <img src="https://dummyimage.com/1000x1000/" alt="">
                                                </div>
                                                <div class="text_wrapper text-center mt-3">
                                                    <div class="text_info">Demo 2</div>
                                                    <div class="text_info">Artist: Sample</div>
                                                    <div class="text_info">Category: J-POP</div>
                                                </div>
                                            </div>
                                            <div class="s_box">
                                                <div class="s_img_wrapper">
                                                    <img src="https://dummyimage.com/1000x1000/" alt="">
                                                </div>
                                                <div class="text_wrapper text-center mt-3">
                                                    <div class="text_info">Demo 3</div>
                                                    <div class="text_info">Artist: Sample</div>
                                                    <div class="text_info">Category: J-POP</div>
                                                </div>
                                            </div>
                                            <div class="s_box">
                                                <div class="s_img_wrapper">
                                                    <img src="https://dummyimage.com/1000x1000/" alt="">
                                                </div>
                                                <div class="text_wrapper text-center mt-3">
                                                    <div class="text_info">Demo 4</div>
                                                    <div class="text_info">Artist: Sample</div>
                                                    <div class="text_info">Category: J-POP</div>
                                                </div>
                                            </div>
                                            <div class="s_box">
                                                <div class="s_img_wrapper">
                                                    <img src="https://dummyimage.com/1000x1000/" alt="">
                                                </div>
                                                <div class="text_wrapper text-center mt-3">
                                                    <div class="text_info">Demo 5</div>
                                                    <div class="text_info">Artist: Sample</div>
                                                    <div class="text_info">Category: J-POP</div>
                                                </div>
                                            </div>
                                            <div class="s_box">
                                                <div class="s_img_wrapper">
                                                    <img src="https://dummyimage.com/1000x1000/" alt="">
                                                </div>
                                                <div class="text_wrapper text-center mt-3">
                                                    <div class="text_info">Demo 6</div>
                                                    <div class="text_info">Artist: Sample</div>
                                                    <div class="text_info">Category: J-POP</div>
                                                </div>
                                            </div>
                                        </div>
                                        <script>
                                            let songReadMoreAdded = false;

                                            $('.song_slide').slick({
                                                infinite: false,
                                                slidesToShow: 4,
                                                slidesToScroll: 1,
                                                edgeFriction: 0.5
                                            });

                                            $('.song_slide').on('edge',function(event, slick, direction){
                                                if (!songReadMoreAdded){
                                                    $('.song_slide').slick('slickAdd', '<div class="readMore"><a href=""><button class="viewMore_btn">View More</button></a></div>');
                                                    songReadMoreAdded = true;

                                                    var boxHeight = $(".s_box").height();
                                                    $(".readMore").css({
                                                        'height' : boxHeight
                                                    });
                                                }
                                            });
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="index_wrapper_4">
                            <div class="container">
                                <div class="row">
                                    <div class="col-12">
                                        <h1 class="big_title">Your Favourite Artist</h1>
                                        <div class="artist_slide">
                                            <div class="s_box rounded">
                                                <div class="s_img_wrapper">
                                                    <img src="https://dummyimage.com/1000x1000/" alt="">
                                                </div>
                                            </div>
                                            <div class="s_box rounded">
                                                <div class="s_img_wrapper">
                                                    <img src="https://dummyimage.com/1000x1000/" alt="">
                                                </div>
                                            </div>
                                            <div class="s_box rounded">
                                                <div class="s_img_wrapper">
                                                    <img src="https://dummyimage.com/1000x1000/" alt="">
                                                </div>
                                            </div>
                                            <div class="s_box rounded">
                                                <div class="s_img_wrapper">
                                                    <img src="https://dummyimage.com/1000x1000/" alt="">
                                                </div>
                                            </div>
                                            <div class="s_box rounded">
                                                <div class="s_img_wrapper">
                                                    <img src="https://dummyimage.com/1000x1000/" alt="">
                                                </div>
                                            </div>
                                            <div class="s_box rounded">
                                                <div class="s_img_wrapper">
                                                    <img src="https://dummyimage.com/1000x1000/" alt="">
                                                </div>
                                            </div>
                                        </div>
                                        <script>
                                            let artistReadMoreAdded = false;
                                            let boxHeight;
                                            
                                            $('.artist_slide').on('init', function(event, slick){
                                                boxHeight = $(".s_box.rounded").height()

                                                $(".artist_slide").css({
                                                    'height' : boxHeight
                                                });
                                            });

                                            $('.artist_slide').slick({
                                                infinite: false,
                                                slidesToShow: 4,
                                                slidesToScroll: 1,
                                                edgeFriction: 0.5
                                            });

                                            $('.artist_slide').on('edge',function(event, slick, direction){
                                                if (!artistReadMoreAdded){
                                                    $('.artist_slide').slick('slickAdd', '<div class="readMore"><a href=""><button class="viewMore_btn">View More</button></a></div>');
                                                    artistReadMoreAdded = true;

                                                    $(".readMore").css({
                                                        'height' : boxHeight
                                                    });
                                                }
                                            });
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Player Control -->
                <?php require 'fixed_layout/musicplayer.php'?>
                
                <script>
                    // Added space on top and bottom of content box
                    $(document).ready(function(){
                        var topBarHeight = $(".top_bar").outerHeight();
                        var playerBarHeight = $(".player_wrapper").outerHeight();
                        $(".main_content").css({
                            'margin-top' : topBarHeight,
                            'margin-bottom' : playerBarHeight
                        });
                    });
                </script>
            </div>
        </div>
    </body>
</html>