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
