<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Form data validation and sanitization should be performed here.
    $names = $_POST['Name'];
    $email = $_POST['Email'];
    $phone = $_POST['Phone'];
    $messages= $_POST['message'];

    // Database connection parameters
    $servername = "localhost"; // Change to your database server hostname
    $username = "root"; // Change to your database username
    $password = ""; // Change to your database password (if any)
    $dbname = "form"; // Change to your database name

    // Create a database connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
else{
    // Prepare and execute the SQL INSERT statement
    if($stmt = $conn->prepare("INSERT INTO form (Name,Email,Phone,message) VALUES (?, ?, ?, ?)"))
    {
        $stmt->bind_param("ssis", $names, $email, $phone, $messages);
    }
    

    if ($stmt->execute()) {
        echo "Booking done";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the prepared statement and database connection
    $stmt->close();
}
    $conn->close();
}
?>