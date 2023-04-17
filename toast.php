<style>
            #toast-container {
                position: fixed;
                top: 60;
                right: 0;
                padding: 20px;
            }

            .toast {
                display: inline-block;
                min-width: 250px;
                background-color: #f06161;
                color: #fff;
                text-align: center;
                border-radius: 5px;
                padding: 20px;
                padding-right: 25px;
                font-size: 1.2rem;
                margin: 0 0 10px;
                opacity: 0;
                animation: fadeIn 0.3s ease-in-out;
            }

            .toast-success {
                background-color: #f06161;
            }

            .toast-error {
                background-color: #f06161;
            }

            .toast-info {
                background-color: #f06161;
            }

            @keyframes fadeIn {
                from {
                    opacity: 0;
                    transform: translateY(20px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            @keyframes fadeOut {
                from {
                    opacity: 1;
                    transform: translateY(0);
                }

                to {
                    opacity: 0;
                    transform: translateY(-20px);
                }
            }

            .toast a {
                color: #fff;
                text-decoration: underline;
                cursor: pointer;
            }

            .toast-close {
                position: absolute;
                top: 0;
                right: 0;
                margin: 3px;
                /* Add margin for the close button */
                font-size: 14px;
                border: none;
                border-radius: 50%;
                width: 20px;
                height: 20px;
                text-align: center;
                line-height: 20px;
                cursor: pointer;
            }

            .toast:not(.showing):not(.show) {
                opacity: 80;
            }
        </style>
        <script>
            function showToast(type, message) {
                var toastClass = '';
                switch (type) {
                    case 'success':
                        toastClass = 'toast-success';
                        break;
                    case 'error':
                        toastClass = 'toast-error';
                        break;
                    case 'info':
                        toastClass = 'toast-info';
                        break;
                    default:
                        break;
                }

                var toast = '<div class="toast ' + toastClass + '">' +
                    '<a href="sp_manage_appoinmnt.php" class="toast-message">' + message + '</a>' +
                    '<button class="toast-close"><i class="fas fa-times"></i></button>' +
                    '</div>';
                $('#toast-container').append(toast);

                var $newToast = $('.toast').last();

                $newToast.find('.toast-close').on('click', function() {
                    $newToast.remove();
                });

            }
        </script>
<div id="toast-container"></div>
        <script>
            function checkServiceRequests() {
                $.ajax({
                    url: "check_service_requests.php",
                    type: "GET",
                    success: function(data) {
                        // Check if a new request is found
                        if (data == "new") {
                            // Display a toast notification
                            showToast('success', 'New service appointment request');
                        }
                    }
                });
            }
            setInterval(function() {
                // Call the checkServiceRequests() function to check for new service requests
                checkServiceRequests();
            }, 5000); // Call every 5 seconds
        </script>