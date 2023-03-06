//Address validation
$(document).ready(function() {
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