$(document).ready(function () {
    $('#upload-form').submit(function (event) {
        event.preventDefault();
        var reportType = $("input[name='report_type']:checked").val();
        var buttonAction = $(this).find('button[type="submit"]:focus').data('value');
        var route;

        if (reportType === 'exam') {
            if (buttonAction === 'pdf') {
                route = "{{ route('singleStudent') }}";
            } else if (buttonAction === 'chart') {
                route = "{{ route('parentStudentChart') }}";
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
});



