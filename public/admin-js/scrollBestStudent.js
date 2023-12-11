 // Scroll to the 'results-table' element when the page loads
    window.onload = function () {
        var resultsTable = document.getElementById('results-table');
        if (resultsTable) {
            resultsTable.scrollIntoView({ behavior: 'smooth' });
        }
    };