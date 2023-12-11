
            function showCustomAlert(message) {
    Swal.fire({
        title: "Confirm",
        html: message,
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "OK",
        cancelButtonText: "Cancel",
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById("addExam").submit();
        }
    });
}

            
              function confirmSubmit() {
    const selectedOptions = gatherSelectedOptions();
    const confirmationMessage = `
        <div>
            <p class="text-center">Are you sure you want to add the exam with the following details?</p>
            <p>${selectedOptions}</p>
        </div>
    `;

    showCustomAlert(confirmationMessage);

    return false; // Prevent form submission
}

             function gatherSelectedOptions() {
    const grade = document.querySelector("#section-selector option:checked").text;
    const selectedWeek = document.querySelector("#week-selector option:checked").text;
    const numQuestions = document.getElementById("numInputs").value;
    const minutes = document.getElementById("minutes").value;

    let selectedOptions = `Exam For: <strong>${grade}</strong><br>`;
    selectedOptions += `Exam Number: <strong>${selectedWeek}</strong><br>`;
    selectedOptions += `Number of Questions: <strong>${numQuestions}</strong><br>`;
    selectedOptions += `Time Limit (minutes): <strong>${minutes}</strong><br><br>`;

    for (let i = 1; i <= numQuestions; i++) {
        const radioButtons = document.querySelectorAll("input[name='" + i + "']:checked");
        const checkbox = document.querySelector("input[name='check_" + i + "']:checked");

        if (radioButtons.length > 0) {
            const selectedRadioValue = radioButtons[0].value;
            if (checkbox) {
                selectedOptions += `Question ${i}: <strong>${selectedRadioValue}</strong> (2 marks)<br>`;
            } else {
                selectedOptions += `Question ${i}: <strong>${selectedRadioValue}</strong><br>`;
            }
        } else {
            selectedOptions += `Question ${i}: Not answered&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;!<br>`;
        }
    }

    return selectedOptions;
}
