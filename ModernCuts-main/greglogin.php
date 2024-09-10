<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);

    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['username'] = $user['username'];
        $_SESSION['email'] = $user['email'];

        // Redirect to confirmation_page.php
        header('Location: confirmation_page.php');
        exit;
    } else {
        // Invalid login credentials
        $error_message = "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
          body {
            margin: 0;
            padding: 0;
            background: url('moderncuts.jpeg'); /* Set the background image */
            background-size: cover;
            height: 100vh;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        /* Blurry Loading Image */
        .blurry-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('moderncuts.jpeg'); /* Replace with your background image */
            background-size: cover;
            filter: blur(10px); /* Adjust the blur amount as needed */
            z-index: -1;
        }

        .center {
            position: relative;
            width: 400px;
            background: rgba(255, 255, 255, 0.88); /* Add a semi-transparent white background for the content */
            border-radius: 10px;
            box-shadow: 10px 10px 15px rgba(0, 0, 0, 0.05);
            text-align: center;
            z-index: 1;
        }

        .center h1 {
            text-align: center;
            padding: 20px 0;
            border-bottom: 1px solid silver;
        }

        .center form {
            padding: 0 40px;
            box-sizing: border-box;
        }

        form .txt_field {
            position: relative;
            border-bottom: 2px solid #adadad;
            margin: 30px 0;
        }

        .txt_field input {
            width: 100%;
            padding: 0 5px;
            height: 40px;
            font-size: 16px;
            border: none;
            background: none;
            outline: none;
        }

        .txt_field label {
            position: absolute;
            top: 50%;
            left: 5px;
            color: #black;
            transform: translateY(-50%);
            font-size: 16px;
            pointer-events: none;
            transition: 0.5s;
        }

        .txt_field span::before {
            content: '';
            position: absolute;
            top: 40px;
            left: 0;
            width: 0%;
            height: 2px;
            background: #2691d9;
            transition: 0.5s;
        }

        .txt_field input:focus ~ label,
        .txt_field input:valid ~ label {
            top: -5px;
            color: #2691d9;
        }

        .txt_field input:focus ~ span::before,
        .txt_field input:valid ~ span::before {
            width: 100%;
        }

        .pass {
            margin: -5px 0 20px 5px;
            color: #a6a6a6;
            cursor: pointer;
        }

        .pass:hover {
            text-decoration: underline;
        }

        input[type="submit"] {
            width: 100%;
            height: 50px;
            border: 1px solid;
            background: #2691d9;
            border-radius: 25px;
            font-size: 18px;
            color: #e9f4fb;
            font-weight: 700;
            cursor: pointer;
            outline: none;
        }

        input[type="submit"]:hover {
            border-color: #2691d9;
            transition: 0.5s;
        }

        .signup_link {
            margin: 30px 0;
            text-align: center;
            font-size: 16px;
            color: #666666;
        }

        .signup_link a {
            color: #2691d9;
            text-decoration: none;
        }

        .signup_link a:hover {
            text-decoration: underline;
        }

        /* Add this CSS for the error box */
        .error-box {
            background: white;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            margin: 10px 0;
            font-size: 26px; /* Adjust the font size as needed */
        }

        .error-box a {
            color: #2691d9; /* Add the desired link color */
            text-decoration: none;
            font-size: 23px; /* Adjust the font size as needed */
        }

        .error-box a:hover {
            text-decoration: underline;
        }

    </style>
</head>
<body>
<div class="blurry-image"></div> <!-- Blurry Loading Image -->

<?php
if (isset($error_message)) {
    // Display an error message in a white box
    echo "<div class='error-box'>";
    echo $error_message . "<br> <a href='login.php'>Go back</a>";
    echo "</div>";
}
?>

<div class="blurry-background"></div> <!-- Blurry Background Image -->
<div class="center">
    <h1>Login</h1>
    <form name="form1" method="post" action="">
        <div class="txt_field">
            <input type="text" name="username" required>
            <span></span>
            <label>Username</label>
        </div>
        <div class="txt_field">
            <input type="password" name="password" required>
            <span></span>
            <label>Password</label>
        </div>
        <input type="submit" name="submit" value="Submit">
      
       
    </form>
</div>
</body>
</html>
