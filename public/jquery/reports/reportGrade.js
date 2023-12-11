$(document).ready(function() {
    // console.log(singleGradeRoute);
    $('#upload-form2').submit(function(event) {
        event.preventDefault();
        var reportType = $("input[name='report_type']:checked").val();
        var route;

        if (reportType === 'exam') {
            route = singleGradeRoute;
        } else if (reportType === 'homework') {
            route = singleGradeRouteHW;
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

        // Add grade and exam inputs (assuming they are form fields)
        var gradeInput = document.createElement('input');
        gradeInput.type = 'hidden';
        gradeInput.name = 'grade';
        gradeInput.value = $("select[name='grade2']").val();
        hiddenForm.appendChild(gradeInput);

        var examInput = document.createElement('input');
        examInput.type = 'hidden';
        examInput.name = 'exam';
        examInput.value = $("select[name='exam2']").val();
        hiddenForm.appendChild(examInput);

        // Append the form to the body and submit it
        document.body.appendChild(hiddenForm);
        hiddenForm.submit();
    });
});





    // $(document).ready(function() {
    //     console.log(singleGradeRoute);
    
    //     $('#upload-form2').submit(function(event) {
    //         event.preventDefault();
    //         var reportType = $("input[name='report_type']:checked").val();
    //         var route;
    
    //         if (reportType === 'exam') {
    //             route = singleGradeRoute;
    //         } else if (reportType === 'homework') {
    //             route = singleGradeRouteHW;
    //         }
    
    //         var grade = $("select[name='grade2']").val();
    //         var exam = $("select[name='exam2']").val();
    
    //         // Create a hidden form using jQuery
    //         var hiddenForm = $("<form>", {
    //             method: 'POST',
    //             action: route
    //         });
    
    //         // Add CSRF token input using jQuery
    //         hiddenForm.append($('<input>', {
    //             type: 'hidden',
    //             name: '_token',
    //             value: csrfToken
    //         }));
    
    //         // Add grade and exam inputs using jQuery
    //         hiddenForm.append($('<input>', {
    //             type: 'hidden',
    //             name: 'grade',
    //             value: grade
    //         }));
    //         hiddenForm.append($('<input>', {
    //             type: 'hidden',
    //             name: 'exam',
    //             value: exam
    //         }));
    
    //         // Append the form to the body and submit it
    //         $('body').append(hiddenForm);
    //         hiddenForm.submit();
    //     });
    // });
    