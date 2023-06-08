<?php
    $username = $_POST['username'];
    $password = $_POST['password'];




    // Connect to the database
    $db = mysqli_connect('localhost', 'root', '', 'bookingusers');
    // Check if the connection is successful
    if (!$db) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    // Prepare and bind the query
    $stmt = $db->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    
    $result = $stmt->get_result();

    if (empty($_POST['username']) || empty($_POST['password'])) {
        echo "Please fill all the fields! ";
    } else {
        if (mysqli_num_rows($result) == 1) {
            // Login successful: set session variables and redirect to page2
            session_start();
            $_SESSION['logged_in'] = true;
            $_SESSION['username'] = $username;
            header('location: http://localhost/Source_code/Frontend/index2.html');
        } else {
            // Login failed: display an error message
            echo "Invalid login credentials";
        }
    }
    

    
    // Close the connection
    mysqli_close($db);
?>
