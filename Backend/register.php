<?php
// Retrieve form data
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$username = $_POST['username'];
$email = $_POST['email'];
$age = $_POST['age'];
$password = $_POST['password'];

// Check if all required fields are filled
if(empty($firstname) || empty($lastname) || empty($username) || empty($email) || empty($age) || empty($password)) {
    // Display an error message as a pop-up
    echo '<script>alert("Error: All fields are required.")</script>';
    // Redirect back to the form page
    echo '<script>window.location.href="http://localhost/Source_code/Frontend/index.html"</script>';
    // Exit the script
    exit();
}

// Connect to the database
$db = mysqli_connect('localhost', 'root', '', 'bookingusers');

// Check if the connection was successful
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}

// Prepare and execute the query to add the new user to the database
$stmt = $db->prepare("INSERT INTO users (firstname, lastname, username, email, age, password) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss", $firstname, $lastname, $username, $email, $age, $password);
$stmt->execute();

// Check if the query was executed successfully
if($stmt->affected_rows == 1) {
    // Registration successful: redirect to login page
    header('location: http://localhost/Source_code/Frontend/index2.html');
} else {
    // Registration failed: display an error message as a pop-up
    echo '<script>alert("Error: Could not register the user. Please try again later.")</script>';
    // Redirect back to the form page
    echo '<script>window.location.href="http://localhost/Source_code/Frontend/index.html"</script>';
}

// Close the connection
mysqli_close($db);
?>
