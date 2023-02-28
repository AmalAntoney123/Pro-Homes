<html>

<head>
<!-- jQuery UI CSS -->
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<!-- jQuery UI JS -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#calendar').datepicker({
                defaultDate: new Date(),
                showOn: 'focus',
                minDate: 0,
                inline: true,
                beforeShow: function (input, inst) {
                    inst.dpDiv.css({
                        "margin-top": "0px",
                        "font-size": "14px"
                    });
                },
                onChangeMonthYear: function (year, month, inst) {
                    setTimeout(function () {
                        inst.dpDiv.css({
                            "margin-top": "0px",
                            "font-size": "14px"
                        });
                    }, 0);
                }
            });
            $('.ui-datepicker-trigger').remove();
        });


    </script>
    <style>
        #calendar {
            width: 100%;
            height: 100%;
        }

        .ui-datepicker {
            width: 100%;
            font-size: 14px;
            margin: 0 auto;
        }

        .ui-datepicker-header {
            text-align: center;
            background-color: #f5f5f5;
        }

        .ui-datepicker-title {
            font-size: 16px;
            font-weight: bold;
        }

        .ui-datepicker-prev,
        .ui-datepicker-next {
            display: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div id="calendar"></div>
            </div>
        </div>
    </div>
</body>

</html>