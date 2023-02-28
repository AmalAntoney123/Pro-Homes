<html>

<head>
    <!-- Required CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Add necessary CSS links -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-OOamGvOgE0RUKrXrUpqlpFMOZ3q/rkWgj2xub+aHbOYDQ2NQV7XuNrlbNn7EgeZGp77bj/tp/xCdeOhwrV7Tg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assets/css/scrollbar.css"/>

    <link rel="stylesheet" href="assets/css/ollie.css">
    <!-- Required JS (with jQuery and Popper.js) -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
    <style>
        
        .review {
            max-height: 400px;
            /* set a maximum height for the modal body */
            overflow-y: auto;
            /* add a scrollbar when the content exceeds the maximum height */
        }
        /* Custom scrollbar style */

    </style>
</head>

<body>
    <!-- Button to reveal the modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#providerModal">
        View Profile
    </button>

    <div class="modal fade" id="providerModal" tabindex="-1" role="dialog" aria-labelledby="providerModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content bg-light text-dark">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-light" id="providerModalLabel">Service Provider Name</h5>
                    <button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-4">
                            <!-- Profile picture -->
                            <img src="profile-picture.jpg" class="img-fluid rounded-circle mb-2"
                                alt="Service Provider Name">
                            <!-- Book Now button -->
                            <button type="button" class="btn btn-primary btn-block mt-3">Book Now</button>
                        </div>
                        <div class="col-8">
                            <!-- Name and description -->
                            <h4 class="mb-0">Service Provider Name</h4>
                            <p class="text-muted mb-0">Electrician / Plumber</p>
                            <p class="mt-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis sodales libero
                                a arcu faucibus, vel consectetur sapien blandit. Sed ut euismod mi. Donec ut pharetra
                                quam. Fusce eu felis est. Nullam non malesuada ipsum.</p>
                            <p class="mt-2"><strong>City:</strong> London, UK</p>
                        </div>
                    </div>
                    <hr class="bg-light">
                    <div class="row">
                        <div class="col-12">
                            <!-- Reviews -->
                            <h5><i class="fas fa-star text-warning"></i><i class="fas fa-star text-warning"></i><i
                                    class="fas fa-star text-warning"></i><i class="fas fa-star text-warning"></i><i
                                    class="far fa-star text-warning"></i> 4.0</h5>
                            <div class="reviews-wrapper" style="height: 200px; overflow-y: scroll;">
                                <div class="card mb-2">
                                    <div class="card-body">
                                        <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis
                                            sodales
                                            libero a arcu faucibus, vel consectetur sapien blandit.</p>
                                        <small class="text-muted">Reviewer Name</small>
                                    </div>
                                </div>
                                <div class="card mb-2">
                                    <div class="card-body">
                                        <p class="mb-0">Sed ut euismod mi. Donec ut pharetra quam. Fusce eu felis est.
                                            Nullam
                                            non malesuada ipsum.</p>
                                        <small class="text-muted">Reviewer Name</small>
                                    </div>
                                </div>
                                <!-- add more reviews here -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>





</body>

</html>


<div class="modal fade" id="providerModal" tabindex="-1" role="dialog" aria-labelledby="providerModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content bg-light text-dark">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-light" id="providerModalLabel">' . $row['First_Name'] . ' ' . $row['Last_Name'] . '</h5>
                <button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-4">
                        <!-- Profile picture -->
                        <img src="profile-picture.jpg" class="img-fluid rounded-circle mb-2"
                            alt="Service Provider Name">
                        <!-- Book Now button -->
                        <button type="button" class="btn btn-primary btn-block mt-3">Book Now</button>
                    </div>
                    <div class="col-8">
                        <!-- Name and description -->
                        <h4 class="mb-0">' . $row['First_Name'] . ' ' . $row['Last_Name'] . '</h4>
                        <p class="text-muted mb-0">' . $row['Service_Name'] . '</p>
                        <p class="mt-2">' . $row['Service_Desc'] . '</p>
                        <p class="mt-2"><strong>City:</strong>' . $row['City'] . '</p>
                    </div>
                </div>
                <hr class="bg-light">
                <div class="row">
                    <div class="col-12">
                        <!-- Reviews -->
                        <h5><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                class="fas fa-star"></i><i class="fas fa-star"></i><i
                                class="far fa-star"></i> 4.0</h5>
                        <div class="reviews-wrapper" style="height: 200px; overflow-y: scroll;">
                            <div class="card mb-2">
                                <div class="card-body">
                                    <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis
                                        sodales
                                        libero a arcu faucibus, vel consectetur sapien blandit.</p>
                                    <small class="text-muted">Reviewer Name</small>
                                </div>
                            </div>
                            <div class="card mb-2">
                                <div class="card-body">
                                    <p class="mb-0">Sed ut euismod mi. Donec ut pharetra quam. Fusce eu felis est.
                                        Nullam
                                        non malesuada ipsum.</p>
                                    <small class="text-muted">Reviewer Name</small>
                                </div>
                            </div>
                            <!-- add more reviews here -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>