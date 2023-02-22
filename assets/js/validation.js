$(document).ready(function () {

    // Disable submit button
    $("#sub").attr("disabled", true);

    // First name validation
    $("#fname").on("input", function () {
        var name = $("#fname").val().trim();
        if (!/^[a-zA-Z ]+$/.test(name)) {
            $("#error1").show();
            $("#fname").addClass("is-invalid");
        } else {
            $("#error1").hide();
            $("#fname").removeClass("is-invalid");
        }
        checkValidity();
    });

    // Last name validation
    $("#lname").on("input", function () {
        var name = $("#lname").val().trim();
        if (!/^[a-zA-Z ]+$/.test(name)) {
            $("#error2").show();
            $("#lname").addClass("is-invalid");
        } else {
            $("#error2").hide();
            $("#lname").removeClass("is-invalid");
        }
        checkValidity();
    });

    // Username validation
    $("#uname").on("input", function () {
        var name = $("#uname").val().trim();
        if (!/^[a-zA-Z0-9_]*$/g.test(name)) {
            $("#error3").show();
            $("#uname").addClass("is-invalid");
        } else {
            $("#error3").hide();
            $("#uname").removeClass("is-invalid");
            checkAvailability()
        }
        checkValidity();
    });

    // Phone number validation
    $("#phone").on("input", function () {
        var phone = $("#phone").val().trim();
        if (!/^[6-9]\d{9}$/.test(phone)) {
            $("#error10").show();
            $("#phone").addClass("is-invalid");
        } else {
            $("#error10").hide();
            $("#phone").removeClass("is-invalid");
        }
        checkValidity();
    });

    // Email validation
    $("#email").on("input", function () {
        var email = $("#email").val().trim();
        if (!/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(email)) {
            $("#error4").show();
            $("#email").addClass("is-invalid");
        } else {
            $("#error4").hide();
            $("#email").removeClass("is-invalid");
            checkAvailability1()
        }
        checkValidity();
    });

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

    // File validation
    $("#file").on("change", function () {
        var fileName = $(this).val().trim();
        if (fileName != "") {
            $("#error8").hide();
        } else {
            $("#error8").show();
        }
        checkValidity();
    });

    // Select validation
    $("#city").on("change", function () {
        var selectedOption = $("#city option:selected").val().trim();
        if (selectedOption == "") {
            $("#error9").show();
        } else {
            $("#error9").hide();
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
//file(Picture) checker 
function validateFileType() {
    var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
    var fileInput = document.getElementById('file');
    var filePath = fileInput.value;
    if (!allowedExtensions.exec(filePath)) {
        alert('Invalid file type. Only JPG, JPEG, PNG and GIF files are allowed.');
        fileInput.value = '';
        return false;
    }
}


//AJAX checking username availability
function checkAvailability() {
    jQuery.ajax({
        url: "assets/php/check_username.php",
        data: 'uname=' + $("#uname").val(),
        type: "POST",
        success: function(data) {
            $("#erroruname").html(data);
        },
        error: function() {
        }
    });
}   

//AJAX checking email availability
function checkAvailability1() {
    jQuery.ajax({
        url: "assets/php/check_email.php",
        data: 'email=' + $("#email").val(),
        type: "POST",
        success: function(data) {
            $("#erroremail").html(data);
        },
        error: function() {
        }
    });
}   