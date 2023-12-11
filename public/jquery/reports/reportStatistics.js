$(document).ready(function () {
    $('#upload-form5').submit(function (event) {
        event.preventDefault();
        var reportType = $("input[name='report_type']:checked").val();
        var route;

        if (reportType === 'exam') {
            route = getStatistics; // Update with your route for exam
        } else if (reportType === 'homework') {
            route = getStatisticsHW; // Update with your route for homework
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
        
        // Create and append the "from" input element
        var fromInput = document.createElement('input');
        fromInput.type = 'hidden';
        fromInput.name = 'from';
        fromInput.value = $("select[name='from5']").val();
        hiddenForm.appendChild(fromInput);

        // Create and append the "to" input element
        var toInput = document.createElement('input');
        toInput.type = 'hidden';
        toInput.name = 'to';
        toInput.value = $("select[name='to5']").val();
        hiddenForm.appendChild(toInput);

        // Create and append the "order" input element
        var orderInput = document.createElement('input');
        orderInput.type = 'hidden';
        orderInput.name = 'order';
        orderInput.value = $("select[name='order5']").val();
        hiddenForm.appendChild(orderInput);

        // Create and append the "num" input element
        var numInput = document.createElement('input');
        numInput.type = 'hidden';
        numInput.name = 'num';
        numInput.value = $("input[name='num5']").val();
        hiddenForm.appendChild(numInput);

        // Create and append the "grade" input element
        var numInput = document.createElement('input');
        numInput.type = 'hidden';
        numInput.name = 'grade';
        numInput.value = $("select[name='grade5']").val();
        hiddenForm.appendChild(numInput);


        // Append the form to the body and submit it
        document.body.appendChild(hiddenForm);
        hiddenForm.submit();
    });
});