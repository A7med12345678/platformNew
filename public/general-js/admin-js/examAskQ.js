function createInputs() {
    const numInputs = parseInt(document.getElementById("numInputs").value);
    const dynamicInputsDiv = document.getElementById("dynamicInputs");
    dynamicInputsDiv.innerHTML = ""; // Clear previous dynamic inputs

    for (let i = 1; i <= numInputs; i++) {
        const inputGroup = document.createElement("div");
        inputGroup.classList.add("form-group");

        const inputLabel = document.createElement("label");
        inputLabel.textContent = "Question " + i + " : ";
        inputGroup.appendChild(inputLabel);

        // Create radio buttons for choices A, B, C, and D
        for (let j = 0; j < 4; j++) {
            const radioLabel = document.createElement("label");
            radioLabel.classList.add("radio-inline", "m-3");
            radioLabel.textContent = String.fromCharCode(65 + j); // ASCII code for A, B, C, D

            const radioButton = document.createElement("input");
            radioButton.setAttribute("type", "radio");
            radioButton.setAttribute("name", String(i)); // Convert i to a string
            radioButton.setAttribute("value", String.fromCharCode(97 + j));
            radioLabel.appendChild(radioButton);

            inputGroup.appendChild(radioLabel);
        }

        // Create checkbox for the group
        const checkboxLabel = document.createElement("label");
        checkboxLabel.classList.add("checkbox-inline", "m-3" , "text-danger" , "font-weight-bold");
        checkboxLabel.textContent = "2 marks";

        const checkbox = document.createElement("input");
        checkbox.setAttribute("type", "checkbox");
        checkbox.setAttribute("name", "check_" + String(i)); // Convert i to a string
        checkbox.setAttribute("value", "check");
        checkboxLabel.appendChild(checkbox);
        
        // ...
        checkbox.addEventListener("click", function() {
            const radioButtons = inputGroup.querySelectorAll("input[type='radio']");
            radioButtons.forEach(function(radioButton) {
                if (checkbox.checked) {
                    radioButton.value = radioButton.value + "2";
                } 
                // else {
                //     radioButton.value = radioButton.value.toLowerCase();
                // }
            });
        });
        // ...


        inputGroup.appendChild(checkboxLabel);

        dynamicInputsDiv.appendChild(inputGroup);
    }
}
