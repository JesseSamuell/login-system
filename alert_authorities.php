<?php
require 'db.php';

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin']!== true) {
    header('Location: alert_authorities.php');
    exit();
}

if (isset($_POST['report_id'])) {
    $report_id = $_POST['report_id'];

    // Retrieve the report details
    $stmt = $conn->prepare("SELECT report_description, location, flood_scale FROM reports WHERE id =?");
    $stmt->bind_param("i", $report_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    // Send alert to authorities
    $message = "Flood Alert: ". $row['report_description']. " at ". $row['location']. " with a flood scale of ". $row['flood_scale'];
    $to = "authorities@example.com";
    $subject = "Flood Alert";
    mail($to, $subject, $message);

    echo "Alert sent to authorities successfully!";
} else {
    echo "Error: Report ID not found.";
}

$message = "Flood Alert: ". $row['report_description']. " at ". $row['location']. " with a flood scale of ". $row['flood_scale'];
$to = "authorities@example.com";
$subject = "Flood Alert";
mail($to, $subject, $message);

header('Location: admin_dashboard.php?alert_sent=true');
exit;

?>

