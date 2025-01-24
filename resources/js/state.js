
export let startButton;
export let stopButton;
export let memoText;

export let currentProjectId = null;
export let currentProjectDateId = null;

export let hours = 0, minutes = 0, seconds = 0;
export let timerInterval;
export let isRunning = false;

export function setCurrentProjectId(id) {
    return currentProjectId = id;
}

export function getCurrentProjectId() {
    return currentProjectId;
}

export function setCurrentProjectDateId(id) {
    return currentProjectDateId = id;
}

export function getCurrentProjectDateId(id) {
    return currentProjectDateId;
}

export function setTimer(h = 0, m = 0, s = 0){
    hours = h, minutes = m, seconds = s;
    updateTimer();
}

export function startTimer(){
    timerInterval = setInterval(updateTimer, 1000);
    setIsRunning(true);
}

export function clearTimer(){
    clearInterval(timerInterval);
    setIsRunning(false);
}

export function setIsRunning(bool){
    isRunning = bool;

    setStartButton(isRunning);
    setStopButton(!isRunning);

    if(isRunning){
        memoText.classList.remove("d-none");
    } else {
        memoText.classList.add("d-none");
    }

    return isRunning;
}

export function getIsRunning(){
    return isRunning;
}

export function setStopButton(bool){
    stopButton.disabled = bool;
}

export function getStopButton(){
    return stopButton;
}

export function setStartButton(bool){
    startButton.disabled = bool;
}

export function getStartButton(){
    return startButton;
}



function updateTimer() {
    if(isRunning){
        seconds++;
        if (seconds >= 60) {
            seconds = 0;
            minutes++;
        }
        if (minutes >= 60) {
            minutes = 0;
            hours++;
        }
    }

    document.getElementById('hour').innerText = String(hours).padStart(2, '0');
    document.getElementById('minute').innerText = String(minutes).padStart(2, '0');
    document.getElementById('second').innerText = String(seconds).padStart(2, '0');
}


document.addEventListener("DOMContentLoaded", function () {
    startButton = document.getElementById('startButton');
    stopButton = document.getElementById('stopButton');
    memoText = document.getElementById('modalProjectMemo');
});
