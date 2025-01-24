import { getCurrentProjectDateId } from "./state";

let timeout;
let memo;

document.addEventListener("DOMContentLoaded", function () {
    memo = document.getElementById('modalProjectMemo');
    memo.addEventListener('input', function() {
        clearTimeout(timeout);
        timeout = setTimeout(saveChanges, 1000);
    });
});

function saveChanges() {

    if(memo.value !== ""){
        const currentProjectDateId = getCurrentProjectDateId();

        fetch(`/project-date/${currentProjectDateId}`, {
            method: 'PUT',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                memo: memo.value,
                autosave: true
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
}

