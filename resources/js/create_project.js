document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("create_new_project").addEventListener("submit", function (event) {
        event.preventDefault();

        let form = this;
        let formData = new FormData(form);

        fetch(form.getAttribute("action"), {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": formData.get("_token")
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.html) {
                document.getElementById("project-list").insertAdjacentHTML("afterbegin", data.html);
                form.reset();
            }
        })
        .catch(error => {
            console.error("Error:", error);
            alert("Failed to create project.");
        });
    });
});
