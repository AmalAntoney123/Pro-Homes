<!DOCTYPE html>
<html>
<head>
	<title>Select Date</title>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<!-- Datepicker CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <style>
    .datepicker-dropdown {
      top: 38px;
      border: none;
      box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.175);
    }

    .datepicker td, .datepicker th {
      width: 3rem;
      height: 3rem;
      font-size: 1.2rem;
      text-align: center;
    }

    .datepicker td span {
      width: 2.5rem;
      height: 2.5rem;
      line-height: 2.5rem;
      display: inline-block;
      border-radius: 50%;
    }

    .datepicker td.active, .datepicker td.active:hover, .datepicker td.active.disabled, .datepicker td.active.disabled:hover {
      background-color: #007bff;
    }

    .datepicker td.disabled, .datepicker td.disabled:hover {
      color: #999999;
      background-color: #f5f5f5;
      cursor: not-allowed;
    }

    .datepicker td.weekend {
      color: #999999;
    }
     /* Change color of active date */
  .datepicker td.active > a,
  .datepicker td.active > a:hover,
  .datepicker td.active > a:focus {
    background-color: #f06161;
    border-radius: 50%;
  }
  /* Change color of disabled date */
  .datepicker td.disabled,
  .datepicker td.disabled > span,
  .datepicker td.disabled > a {
    color: #ccc;
    background-color: #fff;
    cursor: not-allowed;
  }
  </style>
  
  <link rel="stylesheet" href="assets/css/ollie.css">
    <link rel="stylesheet" href="assets/css/scrollbar.css"/>
</head>
<body>

	<div class="container-fluid">
		<div class="row justify-content-center">
			<div class="col-md-6">
				<h1 class="text-center mb-4">Select Date</h1>
				<form class="mx-auto">
					<div class="form-group">
						<label for="date">Select a date:</label>
						<input type="text" class="form-control" id="date" name="date" required>
					</div>
					<button type="submit" class="btn btn-primary">Submit</button>
				</form>
			</div>
		</div>
	</div>

	<!-- jQuery and Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<!-- Datepicker JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
	<script type="text/javascript">
		$(function () {
			$('#date').datepicker({
				format: 'yyyy-mm-dd',
				startDate: new Date(),
				daysOfWeekDisabled: [0,7], // disable Sundays and Saturdays
				datesDisabled: [<?php
                // Disable specific dates
                $unavailableDates = ['2023-03-06', '2023-03-12', '2023-03-19'];
                foreach ($unavailableDates as $date) {
                    echo "'$date',";
                }
            ?>]
			});
		});
	</script>
</body>
</html>
