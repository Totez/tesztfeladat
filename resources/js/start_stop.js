import { clearTimer, getCurrentProjectDateId, getCurrentProjectId, getIsRunning, setCurrentProjectDateId, setIsRunning, setTimer, startButton, startTimer, stopButton } from './state';

document.addEventListener("DOMContentLoaded", function () {

    document.body.addEventListener('click', function(event) {
        let memo = document.getElementById('modalProjectMemo');
        if (event.target && event.target === startButton) {
            const currentProjectId = getCurrentProjectId();
            if (!getIsRunning()) {
                fetch(`/project-date/${currentProjectId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Failed to save start time');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Start time saved:', data);
                    memo.value = "";
                    startTimer();
                    setIsRunning(true);
                    setCurrentProjectDateId(data.id);
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            }
        }

        if (event.target && event.target === stopButton) {
            let currentProjectDateId = getCurrentProjectDateId();
            if(memo.value !== ""){
                if (getIsRunning()) {
                    clearTimer();
                    setTimer();

                    fetch(`/project-date/${currentProjectDateId}`, {
                        method: 'PUT',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            memo: memo.value
                        })
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Failed to save finish time');
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log('Finish time saved:', data);
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
                }
            } else {
                alert("memo is required");
            }
        }
    });
});
