// mainAudio[0].currentTime = 0; // reset track

const trackImg = $('.track_img img'),
      trackName = $('.track_name p'),
      trackArtist = $('.track_artist p span'),
      trackCategory = $('.track_category p span'),
      mainAudio = $('#main-audio'),
      playBtn = $('.btnC.play'),
      prevBtn = $('.btnC.prev'),
      nextBtn = $('.btnC.next'),
      progressArea = $('.slider_bar'),
      mainProgressArea = $('.main_slider_bar'),
      progressBar = $('.slider_progress'),
      currentTime = $('.currentTime'),
      totalTime = $('.totalTime');

isMusicPaused = true;

function loadMusic(trackData, trackimg, trackartist, trackpath){
    console.log(trackpath);
    getMusic(trackData);
    trackImg.attr('src', trackimg);
    trackArtist.html(trackartist);
    mainAudio.attr('src', trackpath);
}

function getMusic(trackID) {
    datas = [];
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "http://localhost/PiguZMusic/APIs/Track/getTrack.php?modules[]=genre&modules[]=artist&trackId=" + trackID);
    xhr.setRequestHeader("Accept", "/");
    var data = "";
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && this.status == 200) {
            data = xhr.responseText;
            var lists = JSON.parse(data);
            console.log(lists);
            let trackInfo = lists["data"]["track"];            
            trackName.html(trackInfo[0].name);
            trackCategory.html(trackInfo[0].genre[0].name);
            //mainAudio.attr('src', trackInfo[0].music_path.src);
        }
    };
    xhr.send();
}

function playMusic(){
    playBtn.addClass("paused");
    playBtn.html(`<i class="fa fa-pause" aria-hidden="true"></i>`);
    mainAudio.trigger("play");

}

function pauseMusic(){
    playBtn.removeClass("paused");
    playBtn.html(`<i class="fa fa-play" aria-hidden="true"></i>`);
    mainAudio.trigger("pause");
}

function prevMusic(){
    musicIndex --;
    musicIndex < 1 ? musicIndex = allMusic.length : musicIndex = musicIndex;
    loadMusic(musicIndex);
    playMusic();
}

function nextMusic(){
    musicIndex++;
    musicIndex > allMusic.length ? musicIndex = 1 : musicIndex = musicIndex;
    loadMusic(musicIndex);
    playMusic();
}

// Controller Event Handling
$(playBtn).click(function(){
    const isMusicPlay = playBtn.hasClass("paused");
    console.log(isMusicPlay);
    isMusicPlay ? pauseMusic() : playMusic();
});

$(prevBtn).click(function(){
    prevMusic();
});

$(nextBtn).click(function(){
    nextMusic();  
});

mainAudio.on("timeupdate", function(e){
    const cal_currentTime = e.target.currentTime;
    const cal_duration = e.target.duration;
    let progressWidth = (cal_currentTime / cal_duration) * 100;
    progressBar.css("width", `calc(${progressWidth}% + 9px)`);

    // Current Time
    let currentMin = Math.floor(cal_currentTime / 60);
    let currentSec = Math.floor(cal_currentTime % 60);
    if (currentSec < 10) {
        currentSec = `0${currentSec}`;
    }
    currentTime.html(`${currentMin}:${currentSec}`);
});

// Total Time
mainAudio.on("loadeddata", function () {
    let totalMin = Math.floor(mainAudio[0].duration / 60);
    let totalSec = Math.floor(mainAudio[0].duration % 60);
    if (totalSec < 10) {
        totalSec = `0${totalSec}`;
    }
    totalTime.html(`${totalMin}:${totalSec}`);
});

// Player bar click
progressArea.on("click", function(e) {
    let progressWidth = progressArea[0].clientWidth;
    let clickedOffsetX = e.offsetX;
    let songDuration = mainAudio[0].duration;

    mainAudio[0].currentTime = (clickedOffsetX / progressWidth) * songDuration;
    playMusic();
});

// Main player click
mainProgressArea.on("click", function(e){
    let main_progressWidth = mainProgressArea[0].clientWidth;
    let main_clickedOffsetX = e.offsetX;
    let main_songDuration = mainAudio[0].duration;

    mainAudio[0].currentTime = (main_clickedOffsetX / main_progressWidth) * main_songDuration;
    playMusic();
});

mainAudio.on("ended", function(){
    nextMusic();
});