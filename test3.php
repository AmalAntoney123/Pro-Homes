<!DOCTYPE html>
<html>
<head>
  <title>SweetAlert Demo</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.0/dist/sweetalert2.min.css">
</head>
<body>

  <button id="myButton">Click me to show alert</button>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.0/dist/sweetalert2.all.min.js"></script>
  <script>
    document.getElementById("myButton").addEventListener("click", function() {
      Swal.fire({
        title: 'Custom Alert!',
        text: 'This is a custom alert message.',
        icon: 'success',
        confirmButtonText: 'OK',
        confirmButtonColor: '#3085d6',
        backdrop: `
          rgba(0,0,123,0.4)
          url("https://media.giphy.com/media/3oEjI6SIIHBdRxXI40/giphy.gif")
          left top
          no-repeat
        `
      });
    });
  </script>
  
</body>
</html>
