$(document).ready(function () {
    $('#upload-form').submit(function (event) {
        event.preventDefault();
        var reportType = $("input[name='report_type']:checked").val();
        var buttonAction = $(this).find('button[type="submit"]:focus').data('value');
        var route;

        if (reportType === 'exam') {
            if (buttonAction === 'pdf') {
                route = singleStudent;
            } else if (buttonAction === 'chart') {
                route = singleStudentChart;
            }
        } else if (reportType === 'homework') {
            if (buttonAction === 'pdf') {
                route = singleStudentHW;
            } else if (buttonAction === 'chart') {
                route = singleStudentChartHW;
            }
        }

        // Fetch the CSRF token from the meta tag
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        // Create a hidden form and submit it with the appropriate action
        var hiddenForm = document.createElement('form');
        hiddenForm.method = 'POST';
        hiddenForm.action = route;

        // Add CSRF token input
        var csrfTokenInput = document.createElement('input');
        csrfTokenInput.type = 'hidden';
        csrfTokenInput.name = '_token';
        csrfTokenInput.value = csrfToken;
        hiddenForm.appendChild(csrfTokenInput);


        // Create and append the "id" input element
        var idInput = document.createElement('input');
        idInput.type = 'hidden';
        idInput.name = 'id';
        // idInput.value = $('#id1').val();
        idInput.value = $("input[name='id1']").val();
        hiddenForm.appendChild(idInput);

        var idInput2 = document.createElement('input');
        idInput2.type = 'hidden';
        idInput2.name = 'to';
        // idInput.value = $('#id1').val();
        idInput2.value = $("admin");
        hiddenForm.appendChild(idInput2);
        console.log(idInput2.value);

        var idInput3 = document.createElement('input');
        idInput3.type = 'hidden';
        idInput3.name = 'course';
        // idInput.value = $('#id1').val();
        idInput3.value = $('#course').val();
        hiddenForm.appendChild(idInput3);
        console.log(idInput3.value);


        // Append the form to the body and submit it
        document.body.appendChild(hiddenForm);
        hiddenForm.submit();
    });
});