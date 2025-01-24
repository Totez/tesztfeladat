import { clearTimer, setCurrentProjectDateId, setCurrentProjectId, setTimer, startTimer } from './state';

document.addEventListener("DOMContentLoaded", function () {

    document.querySelector('.list-group').addEventListener('click', function(event) {

        if (event.target && event.target.classList.contains('list-group-item')) {

            var projectId = event.target.getAttribute('data-id');

            fetch(`/project/${projectId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        console.error(data.error);
                    } else {
                        setCurrentProjectId(data.id);
                        document.getElementById('modalProjectName').innerText = data.name;

                        clearTimer();

                        if(data.dates[0]){
                            const startTime = new Date(data.dates[0].start);
                            const endTime = new Date();
                            const elapsedTime = Math.max(0, endTime - startTime);

                            const hours = Math.floor(elapsedTime / 3600000);
                            const minutes = Math.floor((elapsedTime % 3600000) / 60000);
                            const seconds = Math.floor((elapsedTime % 60000) / 1000);

                            setCurrentProjectDateId(data.dates[0].id);
                            setTimer(hours, minutes, seconds);

                            if(!data.dates[0].finish){
                                startTimer();
                            }
                        } else {
                            setTimer();
                        }
                    }

                    var myModal = new bootstrap.Modal(document.getElementById('projectModal'));
                    myModal.show();
                })
                .catch(error => {
                    console.error('Hiba történt:', error);
                });
        }
    });
});
