function validateFile(input, errorLabel) {
    var file = input.files[0];
    var fileType = file.type.toLowerCase();
    if (fileType != 'application/pdf') {
        $(errorLabel).text('Please upload a PDF file.');
        input.value = ''; // Clear the input so the user can select a different file
    } else {
        $(errorLabel).text('');
    }
}

$(document).ready(function () {
    // When a file is selected, show the name of the file in the label and validate the file type
    $('.custom-file-input').on('change', function () {
        var fileName = $(this).val().split('\\').pop();
        $(this).siblings('.custom-file-label').addClass('selected').html(fileName);
        var errorLabel = '#' + $(this).attr('id') + '-error';
        validateFile(this, errorLabel);
    });

    // Before form submission, check that each file is a PDF
    $('form').submit(function (event) {
        var qualifications = $('#qualification');
        var certificate = $('#certificate');
        var insurance = $('#insurance');

        var isValid = true;

        // Check qualifications file
        if (qualifications[0].files.length > 0) {
            var file = qualifications[0].files[0];
            var fileType = file.type.toLowerCase();
            if (fileType != 'application/pdf') {
                isValid = false;
                $('#qualification-error').text('Please upload a PDF file.');
            }
        }

        // Check certificate file
        if (certificate[0].files.length > 0) {
            var file = certificate[0].files[0];
            var fileType = file.type.toLowerCase();
            if (fileType != 'application/pdf') {
                isValid = false;
                $('#certificate-error').text('Please upload a PDF file.');
            }
        }

        // Check insurance file
        if (insurance[0].files.length > 0) {
            var file = insurance[0].files[0];
            var fileType = file.type.toLowerCase();
            if (fileType != 'application/pdf') {
                isValid = false;
                $('#insurance-error').text('Please upload a PDF file.');
            }
        }

        if (!isValid) {
            event.preventDefault(); // Prevent form submission
        }
    });
});