<?php
session_start();
include 'config.php'; // Ensure this file contains your database connection

function validateName($name) {
    return preg_match("/^[a-zA-Z][a-zA-Z\s]+$/", $name) && strlen($name) >= 1;
}

function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function validatePassword($password) {
    return strlen($password) >= 5 && preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).*$/', $password);
}

if (isset($_POST['submit'])) {
    // Error messages initialized
    $firstNameErr = $lastNameErr = $phoneErr = $emailErr = $addressErr = $passwordErr = $confirmPasswordErr = $termNcondiErr = '';

    // Data extracted from form
    $firstName = $lastName = $phone = $email = $address = $Rpassword = $confirmPassword = $conformBox = '';

    // Validating first name
    if (!empty($_POST['first_name'])) {
        $firstName = $_POST['first_name'];
        if (validateName($firstName)) {
            $firstName = filter_var($firstName, FILTER_SANITIZE_STRING);
        } else {
            $firstNameErr = "First name must start with a letter.";
        }
    } else {
        $firstNameErr = "First name cannot be empty.";
    }

    // Validating last name
    if (!empty($_POST['last_name'])) {
        $lastName = $_POST['last_name'];
        if (validateName($lastName)) {
            $lastName = filter_var($lastName, FILTER_SANITIZE_STRING);
        } else {
            $lastNameErr = "Last name must start with a letter.";
        }
    } else {
        $lastNameErr = "Last name cannot be empty.";
    }

    // Validating phone number
    if (!empty($_POST['phone_number'])) {
        $phone = $_POST['phone_number'];
        if (preg_match("/^[0-9]{10}$/", $phone)) {
            $phone = filter_var($phone, FILTER_SANITIZE_STRING);
        } else {
            $phoneErr = "Phone number must be exactly 10 digits.";
        }
    } else {
        $phoneErr = "Phone number cannot be empty.";
    }

    // Validating email
    if (!empty($_POST['email'])) {
        $email = $_POST['email'];
        if (validateEmail($email)) {
            $email = filter_var($email, FILTER_SANITIZE_STRING);
        } else {
            $emailErr = "Enter a valid email.";
        }
    } else {
        $emailErr = "Email cannot be empty.";
    }

    // Validating address
    if (!empty($_POST['address'])) {
        $address = filter_var($_POST['address'], FILTER_SANITIZE_STRING);
    } else {
        $addressErr = "Address cannot be empty.";
    }

    // Validating Password
    if (!empty($_POST['password'])) {
        $Rpassword = $_POST['password'];
        if (validatePassword($Rpassword)) {
            // Password is valid
        } else {
            $passwordErr = "Password should contain at least one uppercase letter, one lowercase letter, and a number. It must be 5 or more characters.";
        }
    } else {
        $passwordErr = "Password cannot be empty.";
    }

    // Validating Confirm Password
    if (!empty($_POST['confirm_password'])) {
        $confirmPassword = $_POST['confirm_password'];
        if ($Rpassword != $confirmPassword) {
            $confirmPasswordErr = "Confirm password does not match.";
        }
    } else {
        $confirmPasswordErr = "Confirm password cannot be empty.";
    }

    // Validating Terms and Conditions
    if (!isset($_POST['conformation'])) {
        $termNcondiErr = "Accept our terms and conditions.";
    }

    // Check if there are no errors
    if (empty($firstNameErr) && empty($lastNameErr) && empty($phoneErr) && empty($emailErr) && empty($addressErr) && empty($passwordErr) && empty($confirmPasswordErr) && empty($termNcondiErr)) {
        
        $sql = "SELECT * FROM `users` WHERE email = '$email'";
        include('config.php');
        $qry = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        $count = mysqli_num_rows($qry);

        if ($count == 0) {
            // Inserting data into the database
            $sql = "INSERT INTO `users` (first_name, last_name, phone_number, email, address, password, user_type) VALUES ('$firstName', '$lastName', '$phone', '$email', '$address', md5('$Rpassword'), 'user')";
            $qry = mysqli_query($conn, $sql) or die(mysqli_error($conn));

            if ($qry) {
                header('Location: login.php');
                exit(); // Use exit after header redirect
            } else {
                echo "<h1>Error</h1>";
            }
        } else {
            $termNcondiErr = "Account already exists.";
        }
    }
}

function input_data($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>User Registration</title>
</head>
<body>
    <div class="form-container">
        <form action="" method="POST">
            <h3>User Registration</h3>
            
            <!-- First Name -->
            <input type="text" name="first_name" placeholder="Enter Your First Name" class="box" value="<?php if (isset($_POST['first_name'])) echo filter_var($_POST['first_name'], FILTER_SANITIZE_STRING); ?>">
            <span class="error"><?php if (!empty($firstNameErr)) echo $firstNameErr; ?></span>
            <br/>

            <!-- Last Name -->
            <input type="text" name="last_name" placeholder="Enter Your Last Name" class="box" value="<?php if (isset($_POST['last_name'])) echo filter_var($_POST['last_name'], FILTER_SANITIZE_STRING); ?>">
            <span class="error"><?php if (!empty($lastNameErr)) echo $lastNameErr; ?></span>
            <br/>

            <!-- Phone Number -->
            <input type="text" name="phone_number" placeholder="Enter Your Phone Number" class="box" value="<?php if (isset($_POST['phone_number'])) echo filter_var($_POST['phone_number'], FILTER_SANITIZE_STRING); ?>">
            <span class="error"><?php if (!empty($phoneErr)) echo $phoneErr; ?></span>
            <br/>

            <!-- Email -->
            <input type="text" name="email" placeholder="Enter Your Email Address" class="box" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>">
            <span class="error"><?php if (!empty($emailErr)) echo $emailErr; ?></span>
            <br/>

            <!-- Address -->
            <input type="text" name="address" placeholder="Enter Your Address" class="box" value="<?php if (isset($_POST['address'])) echo filter_var($_POST['address'], FILTER_SANITIZE_STRING); ?>">
            <span class="error"><?php if (!empty($addressErr)) echo $addressErr; ?></span>
            <br/>

            <!-- Password -->
            <input type="password" name="password" placeholder="Enter Your Password" class="box">
            <span class="error"><?php if (!empty($passwordErr)) echo $passwordErr; ?></span>
            <br/>

            <!-- Confirm Password -->
            <input type="password" name="confirm_password" placeholder="Confirm Your Password" class="box">
            <span class="error"><?php if (!empty($confirmPasswordErr)) echo $confirmPasswordErr; ?></span>
            <br/>

            <!-- Terms and Conditions -->
            <p>
                <input class="inp-cbx" type="checkbox" name="conformation" <?php if (isset($_POST['conformation'])) echo "checked"; ?>>
                <label class="term-con">I accept the Terms and Conditions.</label>
            </p>
            <br/><br/>
            <span class="error"><?php if (!empty($termNcondiErr)) echo $termNcondiErr; ?></span>

            <!-- Submit Button -->
            <input class="btn" type="submit" value="Submit" name="submit"/>
            <br>
            <p>Already have an account? <a href="login.php">Login now</a></p>
        </form>
    </div>
</body>
</html>
