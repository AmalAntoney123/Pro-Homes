$(document).ready(function () {

    // Disable sub1mit button
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
    $("#city,#phone,#uname,#lname,#fname").each(function () {
        if ($(this).hasClass("is-invalid")) {
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
        success: function (data) {
            $("#erroruname").html(data);
        },
        error: function () {
        }
    });
}

//AJAX checking email availability
function checkAvailability1() {
    jQuery.ajax({
        url: "assets/php/check_email.php",
        data: 'email=' + $("#email").val(),
        type: "POST",
        success: function (data) {
            $("#erroremail").html(data);
        },
        error: function () {
        }
    });
}   


$(document).ready(function () {

    // Disable sub1mit button
    $("#sub1").attr("disabled", true);

    // Password validation
    $("#newPassword").on("input", function () {
        var pass = $("#newPassword").val().trim();
        if (!/^(?=.*[A-Z])(?=.*[!@#$&*])(?=.*[0-9]).{8,}$/.test(pass)) {
            $("#error6").show();
            $("#newPassword").addClass("is-invalid");
        } else {
            $("#error6").hide();
            $("#newPassword").removeClass("is-invalid");
        }
        checkValidity1();
    });

    // Confirm Password validation
    $("#renewPassword,#newPassword").on("input", function () {
        var pass = $("#newPassword").val().trim();
        var cpass = $("#renewPassword").val().trim();
        if (pass != cpass && cpass!="") {
            $("#error7").show();
            $("#renewPassword").addClass("is-invalid");
        } else {
            $("#error7").hide();
            $("#renewPassword").removeClass("is-invalid");
        }
        checkValidity1();
    });

});
function checkValidity1() {
    var isValid = true;

    // Check if all input fields are valid
    $("#renewPassword,#newPassword").each(function () {
        if ($(this).hasClass("is-invalid") || $(this).val().trim() == "") {
            isValid = false;
            return false; // break out of the loop
        }
    });

    // Enable or disable the sub1mit button
    if (isValid) {
        $("#sub1").attr("disabled", false);
    } else {
        $("#sub1").attr("disabled", true);
    }
}
//Address validation
$(document).ready(function() {
    $("#sub_address").attr("disabled", true);
    // Define the regex patterns for each field
    var regexPatterns = {
      street: /^[a-zA-Z0-9\s,'-]*$/,
      state: /^[a-zA-Z\s]*$/,
      locality: /^[a-zA-Z\s,'-]*$/,
      landmark: /^[a-zA-Z0-9\s,'-]*$/,
      pincode: /^\d{6}$/
    };
  
    // Define the error messages for each field
    var errorMessages = {
      street: 'Please enter a valid street address',
      state: 'Please enter a valid state name',
      locality: 'Please enter a valid locality',
      landmark: 'Please enter a valid landmark',
      pincode: 'Please enter a valid 6-digit pin code'
    };
  
    // Validate each field on keyup
    $('input[name="street"], input[name="state"], input[name="locality"], input[name="landmark"], input[name="pincode"]').on('keyup', function() {
      var fieldName = $(this).attr('name');
      var fieldValue = $(this).val();
  
      // Check if the field value matches the regex pattern
      if (fieldValue.match(regexPatterns[fieldName])) {
        // Hide the error message if it's currently visible
        $(this).removeClass('is-invalid');
        $(this).siblings('.invalid-feedback').text('');
      } else {
        // Show the error message if it's not currently visible
        $(this).addClass('is-invalid');
        $(this).siblings('.invalid-feedback').text(errorMessages[fieldName]);
      }
      checkValidity();
    });
    function checkValidity() {
      var isValid = true;
  
      // Check if all input fields are valid
      $('input[name="street"], input[name="state"], input[name="locality"], input[name="landmark"], input[name="pincode"]').each(function () {
          if ($(this).hasClass("is-invalid") || $(this).val().trim() == "") {
              isValid = false;
              return false; // break out of the loop
          }
      });
  
      // Enable or disable the submit button
      if (isValid) {
          $("#sub_address").attr("disabled", false);
      } else {
          $("#sub_address").attr("disabled", true);
      }
  }
  
  });