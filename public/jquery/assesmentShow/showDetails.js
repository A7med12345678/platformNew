$(document).ready(function () {
    $('#upload-form').submit(function (event) {
        event.preventDefault();
        var reportType = $("input[name='report_type']:checked").val();
        var buttonAction = $(this).find('button[type="submit"]:focus').data('value');
        var route;

        if (reportType === 'exam') {
            route = examShow_details;
        } else if (reportType === 'homework') {
            route = HWShow_details;
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
        
        // Create and append the "selected_exam" input element
        var idInput2 = document.createElement('input');
        idInput2.type = 'hidden';
        idInput2.name = 'grade';
        idInput2.value = $("select[id='gradeSec']").val();
        hiddenForm.appendChild(idInput2);

        // console.log(idInput2.value);

        // Append the form to the body and submit it
        document.body.appendChild(hiddenForm);
        hiddenForm.submit();
    });
});