// JavaScript to toggle checkbox selections
document.addEventListener('DOMContentLoaded', function () {
    const checkAll = document.getElementById('checkAll');
    const checkboxes = document.querySelectorAll('input[type="checkbox"][name="center_codes[]"]');

    checkAll.addEventListener('change', function () {
        checkboxes.forEach(function (checkbox) {
            checkbox.checked = checkAll.checked;
        });
    });
});
document.getElementById("upload").classList.add("disabled");

// prevent loss force upload attemps :
if (localStorage.getItem("enbale_upload") === "yes") {
    document.getElementById("force").classList.add("disabled");
} else {
    // document.getElementById("force").classList.add("d-block");
    document.getElementById("force").classList.remove("disabled");
}

// force upload (if wrong upload) :
function forceUpload() {
    var limit = parseInt(localStorage.getItem("limit"));
    limit++;
    localStorage.setItem("limit", limit);
    if (localStorage.getItem("limit") > 12) {
        // Do something here if week is greater than 2
        alert("Sorry , please contact the developer.");
    } else {
        if (confirm("Are you sure you want to enable uploads?")) {
            localStorage.setItem("enbale_upload", "yes");
            location.reload();
        }
    }
}
// Load the values from local storage if they exist
if (localStorage.getItem("selected_week")) {
    document.querySelector("#week-selector").value =
        localStorage.getItem("selected_week");
}
if (localStorage.getItem("selected_section")) {
    document.querySelector("#section-selector").value =
        localStorage.getItem("selected_section");
}

document
    .getElementById("upload")
    .classList.toggle(
        "disabled",
        localStorage.getItem("enbale_upload") !== "yes"
    );

function store() {
    localStorage.setItem(
        "selected_week",
        document.querySelector("#week-selector").value
    );
    localStorage.setItem(
        "selected_section",
        document.querySelector("#section-selector").value
    );
    localStorage.setItem("enbale_upload", "yes");
}

function disable() {
    document.getElementById("upload").classList.add("disabled");
    localStorage.setItem("enbale_upload", "no");
}

// document.getElementById('upload').classList.add('disabled');
// prevent loss force upload attemps :
// if (localStorage.getItem("enbale_upload") === "yes") {
//     document.getElementById("force").classList.add("disabled");
// } else {
//     // document.getElementById("force").classList.add("d-block");
//     document.getElementById("force").classList.remove("disabled");
// }

// // force upload (if wrong upload) :
// function forceUpload() {
//     var limit = parseInt(localStorage.getItem("limit"));
//     limit++;
//     localStorage.setItem("limit", limit);
//     if (localStorage.getItem("limit") > 2) {
//         // Do something here if week is greater than 2
//         alert("Sorry , please contact the developer");
//     } else {
//         if (confirm("Are you sure you want to enable uploads?")) {
//             localStorage.setItem("enbale_upload", "yes");
//             location.reload();
//         }
//     }
// }

// // Load the values from local storage if they exist
// if (localStorage.getItem('selected_week')) {
//     document.getElementById('week-selector').value = localStorage.getItem('selected_week');
// }
// if (localStorage.getItem('selected_section')) {
//     document.getElementById('section-selector').value = localStorage.getItem('selected_section');
// }

// if (localStorage.getItem('enbale_upload') === "yes") {
//     document.getElementById('upload').classList.remove('disabled')
// } else if (localStorage.getItem('enbale_upload') === "no") {
//     document.getElementById('upload').classList.add('disabled');
// }

// function store() {
//     localStorage.setItem('selected_week', document.getElementById('week-selector').value);
//     localStorage.setItem('selected_section', document.getElementById('section-selector').value);
//     localStorage.setItem('enbale_upload', 'yes');

// }

// function disable() {
//     document.getElementById('upload').classList.add('disabled');
//     localStorage.setItem('enbale_upload', 'no');

// }


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
         customClass: {
        icon: "custom-swal-icon" // Apply the custom class to the icon
    }
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

$(document).ready(function () {
    //  ---------------------------------- form 1 ---------------------------------- : 
    $('#upload-form').submit(function (event) {
        event.preventDefault();
        var reportType = $("input[name='report_type']:checked").val();
        var buttonAction = $(this).find('button[type="submit"]:focus').data('value');
        var route;

        if (reportType === 'exam') {
            if (buttonAction === 'pdf') {
                route = "{{ route('singleStudent') }}";
            } else if (buttonAction === 'chart') {
                route = "{{ route('singleStudentChart') }}";
            }
        } else if (reportType === 'homework') {
            if (buttonAction === 'pdf') {
                route = "{{ route('singleStudentHW') }}";
            } else if (buttonAction === 'chart') {
                route = "{{ route('parentStudentChartHW') }}";
            }
        }

        // Create a hidden form and submit it with the appropriate action
        var hiddenForm = document.createElement('form');
        hiddenForm.method = 'POST';
        hiddenForm.action = route;

        // Add CSRF token input
        var csrfTokenInput = document.createElement('input');
        csrfTokenInput.type = 'hidden';
        csrfTokenInput.name = '_token';
        csrfTokenInput.value = "{{ csrf_token() }}";
        hiddenForm.appendChild(csrfTokenInput);

        // Create and append the "id" input element
        var idInput = document.createElement('input');
        idInput.type = 'hidden';
        idInput.name = 'id';
        idInput.value = $('#id').val();
        hiddenForm.appendChild(idInput);

        // Append the form to the body and submit it
        document.body.appendChild(hiddenForm);
        hiddenForm.submit();
    });

    //  ---------------------------------- form 2 ---------------------------------- : 
    $('#upload-form2').submit(function (event) {
        event.preventDefault();
        var reportType = $("input[name='report_type']:checked").val();
        var route;

        if (reportType === 'exam') {
            route = "{{ route('singleGrade') }}";
        } else if (reportType === 'homework') {
            route = "{{ route('singleGradeHW') }}";
        }

        // Create a hidden form and submit it with the appropriate action
        var hiddenForm = document.createElement('form');
        hiddenForm.method = 'POST';
        hiddenForm.action = route;

        // Add CSRF token input
        var csrfTokenInput = document.createElement('input');
        csrfTokenInput.type = 'hidden';
        csrfTokenInput.name = '_token';
        csrfTokenInput.value = "{{ csrf_token() }}";
        hiddenForm.appendChild(csrfTokenInput);

        // Add grade and exam inputs (assuming they are form fields)
        var gradeInput = document.createElement('input');
        gradeInput.type = 'hidden';
        gradeInput.name = 'grade';
        gradeInput.value = $("select[name='grade']").val();
        hiddenForm.appendChild(gradeInput);

        var examInput = document.createElement('input');
        examInput.type = 'hidden';
        examInput.name = 'exam';
        examInput.value = $("select[name='exam']").val();
        hiddenForm.appendChild(examInput);

        // Append the form to the body and submit it
        document.body.appendChild(hiddenForm);
        hiddenForm.submit();
    });

    //  ---------------------------------- form 3 ---------------------------------- : 
    $('#upload-form3').submit(function (event) {
        event.preventDefault();
        var reportType = $("input[name='report_type']:checked").val();
        var route;

        if (reportType === 'exam') {
            route = "{{ route('groupStudent') }}";
        } else if (reportType === 'homework') {
            route = "{{ route('groupStudentHW') }}";
        }

        // Create a hidden form and submit it with the appropriate action
        var hiddenForm = document.createElement('form');
        hiddenForm.method = 'POST';
        hiddenForm.action = route;

        // Add CSRF token input
        var csrfTokenInput = document.createElement('input');
        csrfTokenInput.type = 'hidden';
        csrfTokenInput.name = '_token';
        csrfTokenInput.value = "{{ csrf_token() }}";
        hiddenForm.appendChild(csrfTokenInput);

        // Create and append the "sec" input element
        var secInput = document.createElement('input');
        secInput.type = 'hidden';
        secInput.name = 'sec';
        secInput.value = $("select[name='sec']").val();

        hiddenForm.appendChild(secInput);

        // Append the form to the body and submit it
        document.body.appendChild(hiddenForm);
        hiddenForm.submit();
    });

    //  ---------------------------------- form 4 ---------------------------------- : 
    $('#upload-form4').submit(function (event) {
        event.preventDefault();
        var reportType = $("input[name='report_type']:checked").val();
        var route;

        if (reportType === 'exam') {
            route = "{{ route('allGrades') }}";
        } else if (reportType === 'homework') {
            route = "{{ route('allGradesHW') }}";
        }

        // Create a hidden form and submit it with the appropriate action
        var hiddenForm = document.createElement('form');
        hiddenForm.method = 'POST';
        hiddenForm.action = route;

        // Add CSRF token input
        var csrfTokenInput = document.createElement('input');
        csrfTokenInput.type = 'hidden';
        csrfTokenInput.name = '_token';
        csrfTokenInput.value = "{{ csrf_token() }}";
        hiddenForm.appendChild(csrfTokenInput);

        // Create and append the "sec" input element
        var secInput = document.createElement('input');
        secInput.type = 'hidden';
        secInput.name = 'sec';
        secInput.value = $("select[name='sec']").val();

        hiddenForm.appendChild(secInput);

        // Append the form to the body and submit it
        document.body.appendChild(hiddenForm);
        hiddenForm.submit();
    });

    //  ---------------------------------- form 5 ---------------------------------- : 
    $('#upload-form5').submit(function (event) {
        event.preventDefault();
        var reportType = $("input[name='report_type']:checked").val();
        var route;

        if (reportType === 'exam') {
            route = "{{ route('getStatistics') }}"; // Update with your route for exam
        } else if (reportType === 'homework') {
            route = "{{ route('getStatisticsHW') }}"; // Update with your route for homework
        }

        // Create a hidden form and submit it with the appropriate action
        var hiddenForm = document.createElement('form');
        hiddenForm.method = 'POST';
        hiddenForm.action = route;

        // Add CSRF token input
        var csrfTokenInput = document.createElement('input');
        csrfTokenInput.type = 'hidden';
        csrfTokenInput.name = '_token';
        csrfTokenInput.value = "{{ csrf_token() }}";
        hiddenForm.appendChild(csrfTokenInput);

        // Create and append the "from" input element
        var fromInput = document.createElement('input');
        fromInput.type = 'hidden';
        fromInput.name = 'from';
        fromInput.value = $("select[name='from']").val();
        hiddenForm.appendChild(fromInput);

        // Create and append the "to" input element
        var toInput = document.createElement('input');
        toInput.type = 'hidden';
        toInput.name = 'to';
        toInput.value = $("select[name='to']").val();
        hiddenForm.appendChild(toInput);

        // Create and append the "order" input element
        var orderInput = document.createElement('input');
        orderInput.type = 'hidden';
        orderInput.name = 'order';
        orderInput.value = $("select[name='order']").val();
        hiddenForm.appendChild(orderInput);

        // Create and append the "num" input element
        var numInput = document.createElement('input');
        numInput.type = 'hidden';
        numInput.name = 'num';
        numInput.value = $("input[name='num']").val();
        hiddenForm.appendChild(numInput);

        // Append the form to the body and submit it
        document.body.appendChild(hiddenForm);
        hiddenForm.submit();
    });

    //  ---------------------------------- End of Forms ------------------------------
});

 // Scroll to the 'results-table' element when the page loads
    window.onload = function () {
        var resultsTable = document.getElementById('results-table');
        if (resultsTable) {
            resultsTable.scrollIntoView({ behavior: 'smooth' });
        }
    };
$(document).ready(function() {
    $("#search").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#table tbody tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });
});
// Function to update the content of the spans
function updateSpanContent() {
    totalValues.forEach((value, index) => {
        // Create a unique ID for the span based on the value and index
        const spanId = `${value}`;

        const spanElement = document.getElementById(spanId);

        if (spanElement) {
            spanElement.innerHTML = typeValues[index];

            if (typeValues[index] === 'exam') {
                spanElement.style.color = "white";
            }
        }
    });
}

// Call the function to update span content
updateSpanContent();
