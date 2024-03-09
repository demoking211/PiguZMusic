<?php

ini_set('session.use_only_cookies', 1);
ini_set('session.use_strict_mode', 1);

session_set_cookie_params([
    // Session lifetime
    'lifetime' => 604800, // One week or seven days
    'domain' => 'localhost',
    'path' => '/',
    'secure' => true,
    'httponly' => true
]);

session_start();

function regenerate_session_id()
{
    session_regenerate_id(true);
    $_SESSION["last_regeneration"] = time();
}

function regenerate_session_id_loggedin()
{
    session_regenerate_id(true);

    $userId = $_SESSION["user_id"];
    $newSessionId = session_create_id();
    $sessionId = $newSessionId . "_" . $userId;
    session_id($sessionId);

    $_SESSION["last_regeneration"] = time();
}

if(isset($_SESSION["user_id"]))
{
    if(!isset($_SESSION["last_regeneration"])) 
    {
        regenerate_session_id_loggedin();
    }
    else
    {
        $interval = 60 * 10080;
        if(time() - $_SESSION["last_regeneration"] >= $interval)
        {
            regenerate_session_id_loggedin();
        }
    }
}
else
{
    if(!isset($_SESSION["last_regeneration"])) 
    {
        regenerate_session_id();
    }
    else
    {
        $interval = 60 * 10080;
        if(time() - $_SESSION["last_regeneration"] >= $interval)
        {
            regenerate_session_id();
        }
    }
}

function GUIDv4 ($trim = true)
{
    mt_srand((double)microtime() * 10000);
    $charid = strtolower(md5(uniqid(rand(), true)));
    $hyphen = chr(45);                  // "-"
    $lbrace = $trim ? "" : chr(123);    // "{"
    $rbrace = $trim ? "" : chr(125);    // "}"
    $guidv4 = $lbrace.
              substr($charid,  0,  8).$hyphen.
              substr($charid,  8,  4).$hyphen.
              substr($charid, 12,  4).$hyphen.
              substr($charid, 16,  4).$hyphen.
              substr($charid, 20, 12).
              $rbrace;
              
    return $guidv4;
}

date_default_timezone_set('UTC');
$date = date('Y-m-d H:i:s');
$datetime_utc8 = date('Y-m-d H:i:s', strtotime($date . ' +8 hours'));
$date_utc8 = date('Ymd', strtotime($date . ' +8 hours'));

$image_path = "../../assets/images";
$track_path = "../../assets/tracks";

$domain = "http://localhost/PiguZMusic/";
$getImagePath = "assets/images";
$getTrackPath = "assets/tracks";