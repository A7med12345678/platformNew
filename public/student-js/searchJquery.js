$(document).ready(function() {
    $("#search").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        var foundMatch = false;
        $(".week-content").each(function() {
            var weekTitle = $(this).find(".title").text().toLowerCase();
            if (weekTitle.indexOf(value) > -1) {
                $(this).show();
                foundMatch = true;
            } else {
                $(this).hide();
            }
        });
        if (!foundMatch) {
            // If no match is found, hide the container holding all weeks
            $("#arc").hide();
        } else {
            $("#arc").show();
        }
    });
});