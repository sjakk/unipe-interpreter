document.addEventListener("DOMContentLoaded", () => {
    const executeButton = document.getElementById("executeButton");
    const codeInput = document.getElementById("codeInput");
    const outputContainer = document.getElementById("outputContainer");
    const spinner = document.getElementById("spinner");

    executeButton.addEventListener("click", () => {
        const code = codeInput.value;

        spinner.style.display = "inline-block";
        executeButton.style.display = "none";

        const formData = new FormData();
        formData.append("source_code", code);

        fetch("http://localhost:3000/interpreter.php", {
            method: "POST",
            body: formData,
        })
            .then(response => response.text())
            .then(output => {
                spinner.style.display = "none";
                executeButton.style.display = "inline-block";
                outputContainer.innerHTML = output;
            })
            .catch(error => {
                spinner.style.display = "none";
                executeButton.style.display = "inline-block";
                outputContainer.innerHTML = "Error: " + error.message;
            });
    });
});

