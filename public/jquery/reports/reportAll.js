$(document).ready(function () {
    $('#upload-form4').submit(function (event) {
        event.preventDefault();
        var reportType = $("input[name='report_type']:checked").val();
        var route;

        if (reportType === 'exam') {
            route = allGrades;
        } else if (reportType === 'homework') {
            route = allGradesHW;
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
        
        // Create and append the "sec" input element
        var secInput = document.createElement('input');
        secInput.type = 'hidden';
        secInput.name = 'sec';
        secInput.value = $("select[name='sec4']").val();

        hiddenForm.appendChild(secInput);

        // Append the form to the body and submit it
        document.body.appendChild(hiddenForm);
        hiddenForm.submit();
    });
});