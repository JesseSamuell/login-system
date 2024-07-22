<?php
require 'db.php'; // include the database connection file

// Check if the report button is clicked
if (isset($_POST['report'])) {
    // Get the report data from the form
    $flood_scale = $_POST['flood-scale'];
    $report_description = $_POST['report_description'];

    // Insert the report data into the database
    $query = "INSERT INTO reports (flood_scale, report_description) VALUES (?,?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $flood_scale, $report_description);
    $stmt->execute();

    // Check if the report was inserted successfully
    if ($stmt->affected_rows > 0) {
        $_SESSION['report_submitted'] = true;
        header('Location: report.html');
       
        exit;
    } else {
        $_SESSION['report_error'] = $stmt->error;
        header('Location: report.html');
        exit;
    }
    $stmt->close(); // close the statement
}

// Close the database connection
$conn->close();
?>