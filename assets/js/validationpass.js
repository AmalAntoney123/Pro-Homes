$(document).ready(function () {

    // Disable submit button
    $("#sub").attr("disabled", true);

    // Password validation
    $("#pass").on("input", function () {
        var pass = $("#pass").val().trim();
        if (!/^(?=.*[A-Z])(?=.*[!@#$&*])(?=.*[0-9]).{8,}$/.test(pass)) {
            $("#error6").show();
            $("#pass").addClass("is-invalid");
        } else {
            $("#error6").hide();
            $("#pass").removeClass("is-invalid");
        }
        checkValidity();
    });

    // Confirm Password validation
    $("#cpass,#pass").on("input", function () {
        var pass = $("#pass").val().trim();
        var cpass = $("#cpass").val().trim();
        if (pass != cpass  && cpass!="") {
            $("#error7").show();
            $("#cpass").addClass("is-invalid");
        } else {
            $("#error7").hide();
            $("#cpass").removeClass("is-invalid");
        }
        checkValidity();
    });

});
function checkValidity() {
    var isValid = true;

    // Check if all input fields are valid
    $("input, select").each(function () {
        if ($(this).hasClass("is-invalid") || $(this).val().trim() == "") {
            isValid = false;
            return false; // break out of the loop
        }
    });

    // Enable or disable the submit button
    if (isValid) {
        $("#sub").attr("disabled", false);
    } else {
        $("#sub").attr("disabled", true);
    }
}
