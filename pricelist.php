<?php
require_once 'includes/config.php';
?>

<!DOCTYPE html>
<html>
    <head>
    <meta charset="8-UTF">
    <meta name = "Viewport" content=""width="device-width", initial scale="1.0">
    <link rel="stylesheet" href="css\pricelist.css">
    <link rel="stylesheet" href="css\main.css">
    <?php require 'includes/cdn_linker.php';?>
    <title>PiguZMusic - Subscription Plan</title> 
    </head>   
    <body>
        <div class="price_pg container-fluid"> 
            <h2 class="text-center"><b>USER PRICING PLAN</b></h2>
            <div class ="price-row">
                <div class = "price-col">
                    <p>Standard</p>
                    <div class="price_box">
                        <div>FREE</div>
                        <div>/MONTHLY</div>
                    </div>
                    <ul class="feature_bar list-unstyled text-start">
                        <li><i class="fa fa-check"></i><span>Ads Free</span></li>
                        <li><i class="fa fa-check"></i><span>Unlmited Upload Spaces</span></li>
                        <li><i class="fa fa-times"></i><span>Free Usage</span></li>
                        <li><i class="fa fa-times"></i><span>Allow quality solution</span></li>
                        <li><i class="fa fa-times"></i><span>Offline Listening Plan</span></li>
                    </ul>
                    <button disable ><i class = "fa fa-check"></i></button>
                </div>
                <div class = "price-col">
                    <p>Premium</p>
                    <div class="price_box">
                        <div><span>RM</span>30.00</div>
                        <div>/MONTHLY</div>
                    </div>
                    <ul class="feature_bar list-unstyled text-start">
                        <li><i class="fa fa-check"></i><span>Ads Free</span></li>
                        <li><i class="fa fa-check"></i><span>Unlmited Upload Spaces</span></li>
                        <li><i class="fa fa-check"></i><span>Free Usage</span></li>
                        <li><i class="fa fa-check"></i><span>Allow quality solution</span></li>
                        <li><i class="fa fa-check"></i><span>Offline Listening Plan</span></li>
                    </ul>
                    <button id="update-user-role" data-role-id="2" name="update-user-role"><a href="/PiguZMusic/index.php" >PURCHASE</a></button>

                    <script>
                         $("#update-user-role").click(function()
                        {
                            var formData = new FormData();

                            formData.append("userId", "<?php echo $_SESSION["user_id"]; ?>");
                            $.ajax({
                                    url:"./includes/update_user_role.php",
                                    method:"POST",
                                    data:formData,
                                    contentType: false,
                                    processData: false,
                                    success:function(response)
                                    {
                                        console.log(response)
                                    }
                                });
                        });
                    </script>
                </div>
            </div>
        </div>
    </body>
</html>