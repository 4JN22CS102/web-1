$(document).ready(function () {
    $("#registrationForm").on("submit", function (e) {
        let valid = true;

        // Check if all fields are filled
        $("input, select, textarea").each(function () {
            if ($(this).val().trim() === "") {
                alert($(this).prev("label").text() + " is required.");
                valid = false;
                return false;
            }
        });

        if (!valid) {
            e.preventDefault(); // Prevent form submission
        }
    });
});
