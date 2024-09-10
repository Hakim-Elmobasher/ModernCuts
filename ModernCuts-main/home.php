<?php
// session_start() should be placed at the beginning of the PHP script
// Set session lifetime to 5 minutes (300 seconds)
ini_set('session.gc_maxlifetime', 300);
session_set_cookie_params(300);
session_start();



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Barbershop Booking</title>
    <style>
        /* Overwrite or add custom styles here */
        .fa {
            padding: 20px;
            font-size: 30px;
            text-align: center;
            text-decoration: none;
            margin: 0 10px;
            color: black;
        }

        .fa:hover {
            opacity: 0.7;
        }
    </style>
</head>

<body>
    <div class="container text-center mt-5">
        <!-- Image, title and booking button -->
        <img class="img-fluid" src="moderncuts.jpeg" alt="ModernCuts Image">
        <div class="mt-3">
            <h1 class="display-4">ModernCuts</h1>
        </div>
        <button class="btn btn-dark mt-3" onclick="openBookingPage()">Book Now</button>

        <!-- Navigation buttons -->
        <div class="mt-3">
            <a class="btn btn-outline-dark m-1" href="home.php">Home</a>
            <a class="btn btn-outline-dark m-1" href="about-us.php">About Us</a>
        </div>

        <!-- Services and Contact Us buttons -->
        <div class="mt-3">
            <a class="btn btn-outline-dark m-1" href="service_selection2.php">Services</a>
            <a class="btn btn-outline-dark m-1" href="contactus.html">Contact Us</a>
            <a class="btn btn-outline-dark m-1" href="FAQ.html">FAQ</a>
        </div>

        <!-- Slideshow (Carousel) -->
<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ul class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
    </ul>

    <!-- Slideshow images -->
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="images/barbershop.jpg" alt="barbershop.jpg" width="1000" height="400">
        </div>
        <div class="carousel-item">
            <img src="images/Chairs.jpg" alt="Image 2 Description" width="1000" height="500">
        </div>
        <div class="carousel-item">
            <img src="images/insideshop.jpg" alt="Image 3 Description" width="1000" height="500">
        </div>
    </div>

    <!-- Left and right controls -->
    <a class="carousel-control-prev" href="#myCarousel" data-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </a>
    <a class="carousel-control-next" href="#myCarousel" data-slide="next">
        <span class="carousel-control-next-icon"></span>
    </a>
</div>


</header>
    <!-- Centered image below the title -->
    <!-- Needs an API key for location
    src="https://www.google.com/maps/embed/v1/place?q=Farmingdale+State+College,2350+NY-110,Farmingdale,NY+11735&key=YOUR_API_KEY"
        allowfullscreen -->
    <!--Please replace "YOUR_API_KEY" with your actual Google Maps API key. Make sure you have a valid Google Maps API key, 
    and that you have enabled the Geocoding API and Maps JavaScript API in your Google Cloud Console project.-->
    <div class="centered-map">
    <iframe
        width="600"
        height="450"
        frameborder="0"
        style="border:0"
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3014.9329251489674!2d-73.42083234920906!3d40.726861844848376!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89e822b8b25a6f73%3A0x351e65a8efbc6d06!2sFarmingdale%20State%20College!5e0!3m2!1sen!2sus!4v1645625459560!5m2!1sen!2sus"
        allowfullscreen
    ></iframe>
</div>

       <section id="review-form" class="mt-5 container">
    <h2 class="text-center mb-4">Submit Your Review</h2>
    <form id="submitReviewForm">
        <div class="form-row">
            <div class="col">
                <label for="firstName">First Name (required)</label>
                <input type="text" class="form-control" id="firstName" required>
            </div>
            <div class="col">
                <label for="lastName">Last Name</label>
                <input type="text" class="form-control" id="lastName">
            </div>
        </div>
        <div class="form-group mt-3">
            <label for="email">Email (required)</label>
            <input type="email" class="form-control" id="email" required>
        </div>
        <div class="form-group mt-3">
            <label for="message">Review (required)</label>
            <textarea class="form-control" id="message" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Submit Review</button>
    </form>
    </section>

    <div id="reviewsCarousel" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        <!-- Reviews will be dynamically inserted here -->
    </div>
    <a class="carousel-control-prev" href="#reviewsCarousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#reviewsCarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>


        <!-- Social media icons -->
        <div class="mt-3">
            <a href="#" class="fa fa-facebook m-2"></a>
            <a href="#" class="fa fa-twitter m-2"></a>
            <a href="#" class="fa fa-instagram m-2"></a>
        </div>
    </div>

    <section id="services" class="mt-5">
        <!-- Content inside the services section -->
    </section>

    <section id="about" class="mt-5">
        <!-- Content inside the about section -->
    </section>

    <footer class="mt-5">
        <!-- Content inside the footer -->
    </footer>

    <!-- JavaScript to open the booking page -->
    <script>
        function openBookingPage() {
            window.location.href = 'professional-selection.php';
        }
    </script>

    <!-- Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    // Function to handle form submission
    document.getElementById('submitReviewForm').addEventListener('submit', function(e) {
        e.preventDefault();

        var formData = new FormData();
        formData.append('firstName', document.getElementById('firstName').value);
        formData.append('lastName', document.getElementById('lastName').value);
        formData.append('email', document.getElementById('email').value);
        formData.append('message', document.getElementById('message').value);

        // AJAX request to submit the review
        fetch('submit_review.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            console.log('Success:', data);
            loadReviews(); // Reload reviews to include the new one
        })
        .catch((error) => {
            console.error('Error:', error);
        });
    });

    // Function to load and display reviews in the carousel
    function loadReviews() {
        fetch('get_reviews.php')
            .then(response => response.json())
            .then(reviews => {
                var reviewsCarouselInner = document.querySelector('#reviewsCarousel .carousel-inner');
                reviewsCarouselInner.innerHTML = ''; // Clear existing items

                reviews.forEach((review, index) => {
                    var carouselItem = document.createElement('div');
                    carouselItem.className = 'carousel-item' + (index === 0 ? ' active' : '');
                    carouselItem.innerHTML = `
                        <div class="review">
                            <h5>${review.firstName} ${review.lastName}</h5>
                            <p>${review.message}</p>
                        </div>
                    `;
                    reviewsCarouselInner.appendChild(carouselItem);
                });
            })
            .catch(error => console.error('Error:', error));
    }

    // Load reviews when the page loads
    window.onload = function() {
        loadReviews();
    };
</script>


</body>

</html>
