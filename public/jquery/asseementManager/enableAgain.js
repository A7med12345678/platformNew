$(document).ready(function () {
    $('#upload-form').submit(function (event) {
        event.preventDefault();
        var reportType = $("input[name='report_type']:checked").val();
        var incOrdec = $("input[name='incOrdec']:checked").val();
        var buttonAction = $(this).find('button[type="submit"]:focus').data('value');
        var route;

        if (reportType === 'exam') {
            route = quiz_enableExam;
        } else if (reportType === 'homework') {
            route = quiz_enableHW;
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
        idInput.value = $("input[name='id1']").val();

        hiddenForm.appendChild(idInput);

        // Create and append the "selected_exam" input element
        var idInput2 = document.createElement('input');
        idInput2.type = 'hidden';
        idInput2.name = 'selected';
        idInput2.value = $("select[name='selected1']").val();
        hiddenForm.appendChild(idInput2);


        // Create and append the "selected_exam" input element
        var idInput3 = document.createElement('input');
        idInput3.type = 'hidden';
        idInput3.name = 'incOrdec';
        idInput3.value = incOrdec;
        hiddenForm.appendChild(idInput3);

        // Append the form to the body and submit it
        document.body.appendChild(hiddenForm);
        hiddenForm.submit();
    });
});