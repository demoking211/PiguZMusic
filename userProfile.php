<?php

require_once 'includes/config.php';

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/userprofile.css">
        <?php require 'includes/cdn_linker.php'?>

        <title>PiguZMusic - Homepage</title>
    </head>
    <body>
        <div class="userProfile_pg">
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
                            <div class="container-fluid">
                                <div class="row align-items-stretch">
                                    <div class="col-lg-4">
                                        <div class="profile_card">
                                            <div class="user_img_wrapper">
                                                <img class="img-fluid" src="https://dummyimage.com/1000x1000/" alt="">
                                            </div>
                                            <div class="user_info mt-3">
                                                <h3>Admin Name</h3>
                                                <p>admin.@gmail.com</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-8 ps-4">
                                        <div class="profile_edit">
                                            <h3 class="mb-4">Profile Setting</h3>
                                            <form action="">
                                                <div class="preview_group">
                                                    <img id='img-upload' src="https://dummyimage.com/1000x1000/"/>
                                                    <div class="input-group">
                                                        <span class="input-group-btn">
                                                            <span class="btn btn-default btn-file">
                                                                Change Photo <input type="file" id="imgInp">
                                                            </span>
                                                        </span>
                                                        <input type="text" name="img" class="form-control" readonly>
                                                    </div>
                                                </div>
                                                
                                                
                                                <div class="form_block">
                                                    <label for="username">Username</label>
                                                    <input type="text" id="username" name="username" placeholder="Enter name to update">
                                                </div>
                                                <div class="form_block">
                                                    <label for="email">Email</label>
                                                    <input type="email" id="email" name="email" placeholder="Enter email to update">
                                                </div>
                                                <input type="submit" name="submit" value="Submit">
                                            </form>
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
                <script>
                    // Added space on top and bottom of content box
                    $(document).ready(function(){
                        var topBarHeight = $(".top_bar").outerHeight() + 50;
                        var playerBarHeight = $(".player_wrapper").outerHeight() + 50;
                        $(".main_content").css({
                            'padding-top' : topBarHeight,
                            'padding-bottom' : playerBarHeight
                        });

                        var input = $('.input-group :text');
                        input.val("No File Selected");

                        $(document).on('change', '.btn-file :file', function() {
                        var input = $(this),
                            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
                        input.trigger('fileselect', [label]);
                        });

                        $('.btn-file :file').on('fileselect', function(event, label) {
                            
                            var log = label;
                            
                            if( input.length ) {
                                input.val(log);
                            } else {
                                if( log ) alert(log);
                            }
                        });

                        function readURL(input) {
                            if (input.files && input.files[0]) {
                                var reader = new FileReader();
                                
                                reader.onload = function (e) {
                                    $('#img-upload').attr('src', e.target.result);
                                }
                                
                                reader.readAsDataURL(input.files[0]);
                            }
                        }

                        $("#imgInp").change(function(){
                            readURL(this);
                        });     
                        
                    });
                </script>
            </div>
        </div>
    </body>
</html>
