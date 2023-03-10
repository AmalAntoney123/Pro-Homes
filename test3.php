<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  </head>
  <body>
    <input type="text" class="flatpickr" placeholder="Select dates" multiple>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
      flatpickr(".flatpickr", {
        mode: "multiple",
        dateFormat: "Y-m-d"
      });
    </script>
  </body>
</html>
