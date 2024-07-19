   


document.addEventListener('DOMContentLoaded', (event) => {
    const audioPlayer = document.getElementById('audioPlayer');
    let btn = document.getElementById('playBtnWrapper');

    audioPlayer.volume = 0.1
    const isPlaying = localStorage.getItem('isPlaying') == 'true';

    

    if (isPlaying) {
        audioPlayer.play();
    }else if(localStorage.getItem('isPlaying') == undefined){
        audioPlayer.play();
    }else{
        btn.classList.remove("bi-volume-up-fill");
        btn.classList.add("bi-volume-mute-fill");
    }

    
    audioPlayer.addEventListener('play', () => {
        console.log(btn);
        localStorage.setItem('isPlaying', 'true');
        btn.classList.remove("bi-volume-mute-fill");
        btn.classList.add("bi-volume-up-fill");
    });

    audioPlayer.addEventListener('pause', () => {
        localStorage.setItem('isPlaying', 'false');
        btn.classList.remove("bi-volume-up-fill");
            btn.classList.add("bi-volume-mute-fill");
    });
});

// Reprendre la lecture après une redirection
window.addEventListener('beforeunload', (event) => {
    const audioPlayer = document.getElementById('audioPlayer');
    if (!audioPlayer.paused) {
        localStorage.setItem('currentTime', audioPlayer.currentTime);
    }
});

window.addEventListener('load', (event) => {
    const audioPlayer = document.getElementById('audioPlayer');
    const currentTime = localStorage.getItem('currentTime');
    if (currentTime) {
        audioPlayer.currentTime = parseFloat(currentTime);
    }
});

document.getElementById('playBtnWrapper').addEventListener('click' , () => {
    togglePlay()
});



function togglePlay() {
    let audioPlayer = document.getElementById('audioPlayer');
    // let btn = document.getElementById('playBtnWrapper');
    
    if (localStorage.getItem('isPlaying')) {
        audioPlayer.pause()
    }else{
        audioPlayer.play();
    }
    
};