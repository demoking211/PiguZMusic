// mainAudio[0].currentTime = 0; // reset track

const trackImg = $('.track_img img'),
      trackName = $('.track_name p'),
      trackArtist = $('.track_artist p span'),
      trackCategory = $('.track_category p span'),
      mainAudio = $('#main-audio'),
      playBtn = $('#play-pause'),
      prevBtn = $('#prev'),
      nextBtn = $('#next'),
      progressArea = $('.slider_bar'),
      progressBar = $('.slider_progress'),
      currentTime = $('#currentTime'),
      totalTime = $('#totalTime');

let musicIndex = Math.floor((Math.random() * allMusic.length) + 1); // random index
isMusicPaused = true;

$(window).on("load", function(){
    console.log(musicIndex);
    loadMusic(musicIndex);
});

function loadMusic(indexNumb){
    trackImg.attr('src', allMusic[indexNumb - 1].img);
    trackName.html(allMusic[indexNumb - 1].name);
    trackArtist.html(allMusic[indexNumb - 1].artist);
    trackCategory.html(allMusic[indexNumb - 1].category);
    mainAudio.attr('src', allMusic[indexNumb - 1].src);
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

progressArea.on("click", function(e){
    let progressWidth = progressArea[0].clientWidth;
    let clickedOffsetX = e.offsetX;
    let songDuration = mainAudio[0].duration;

    mainAudio[0].currentTime = (clickedOffsetX / progressWidth) * songDuration;
    playMusic();
});

mainAudio.on("ended", function(){
    nextMusic();
});