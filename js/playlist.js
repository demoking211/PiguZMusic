function loadArtist(artist_id)
{
    console.log(artist_id);
}

function deletePlaylistTrack(playlisttrack_id)
{
    $.ajax({
        url:"./APIs/PlaylistTrack/deletePlaylistTrack.php",
        method:"POST",
        data:{playlistTrackId:playlisttrack_id},

        success:function(response)
        {
            var results = JSON.parse(response);
            if(results.statusCode === 200)
            {
                location.reload();
            }
        }
    });
}