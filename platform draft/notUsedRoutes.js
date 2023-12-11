 // Disable the links with the class 'disabled-link' on page load
    document.addEventListener("DOMContentLoaded", function() {
        var disabledLinks = document.getElementsByClassName("disabled-link");
        for (var i = 0; i < disabledLinks.length; i++) {
            disabledLinks[i].addEventListener("click", function(event) {
                event.preventDefault(); // Prevent the link from being followed
            });
        }
    });
