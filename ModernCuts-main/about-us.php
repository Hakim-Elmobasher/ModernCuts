<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <style>
        /* Reset some default styles */
        body, html {
            margin: 0;
            padding: 0;
        }

        /* Set the background color and font styles */
        body {
            font-family: 'Actor', sans-serif; /* Use the Actor font */
            background-color: #f5f5f5;
            font-weight: 400;
            font-style: normal;
            font-size: 16px;
            letter-spacing: 2px;
            text-transform: uppercase;
            text-decoration: none;
            color: rgba(0, 0, 0, 0.6);
            line-height: 1em;
        }

        header {
            background-color: black;
            color: #fff;
            text-align: center;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .barbershop-image {
            max-width: 100%;
            height: auto;
        }

        /* Add the same styles as in the Services page */
        .service-row {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            margin: 20px;
        }

        .service-card {
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin: 10px;
            padding: 20px;
            text-align: center;
            width: 300px;
            cursor: pointer; /* Add cursor style for service selection */
        }

        .service-card h2 {
            font-size: 20px;
        }

        .service-card p {
            font-size: 16px;
            color: #888;
        }

        #home-button {
            position: absolute;
            top: 20px;
            right: 20px;
            padding: 10px 20px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <header>
        <!-- Home button linking to home.php -->
        <a href="home.php" id="home-button">Home</a>
        <h1>About Us</h1>
        <p>Your Trusted Barbershop</p>
    </header>

    <div class="container">
        <h2>Our Story</h2>
        <p>At ModernCuts, our story is one of passion and dedication to the craft of grooming. It all began with a vision to create a place where individuals could experience the timeless art of barbering in a modern and welcoming setting.

        Founded by a team of experienced barbers, Hakim opened its doors with a commitment to providing top-notch grooming services. We believe that grooming is more than just a routine; it's an opportunity to boost your confidence, express your style, and feel your best.</p>

        <h2>Our Team</h2>
        <p>We have a dedicated team of experienced barbers who are passionate about their craft. Our team is committed to providing the best grooming services to our customers, ensuring they leave our barbershop looking and feeling their best.</p>

        <h2>Visit Us</h2>
        <p>Come and visit our barbershop for a relaxing grooming experience. We are located at:</p>
        <address>
            123 Barber Street<br>
            City, State 12345<br>
            Phone: (123) 456-7890
        </address>

        <h2>Our Barbershop</h2>
        <img src="barbershop.jpg" alt="Barbershop Image" class="barbershop-image">
    </div>
</body>
</html>
