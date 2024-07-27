<?php
require 'db.php';
session_start();

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin']!== true) {
    header('Location: login.php');
    exit();
}

$stmt = $conn->prepare("SELECT u.email, r.report_description, r.location, r.flood_scale FROM user u JOIN reports r ON u.id");
$stmt->execute();
$result = $stmt->get_result();

// Display user information and reports
?>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="admin.css">   
</head>
<body>
<div class="admin-dashboard">
<h1>Admin Dashboard</h1>
<div class="section">
<h2>User Reports</h2>
    <table>
        <tr>
            <th>User Email</th>
            <th>Report Description</th>
            <th>Location</th>
            <th>Flood Scale</th>
            <th>Alert Authorities</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) {?>
        <tr>
            <td><?php echo $row['email'];?></td>
            <td><?php echo $row['report_description'];?></td>
            <td><?php echo $row['location'];?></td>
            <td><?php echo $row['flood_scale'];?></td>
            <td>
                <form action="alert_authorities.php" method="post">
                    <input type="hidden" name="report_id" value="<?php echo $report['id'];?>">
                    <input type="submit" class="alert-button" value="Alert Authorities">
                </form>
            </td>
        </tr>
        <?php }?>
    </table>
    </div>
    <div class="section">
    <h2>System Logs</h2>
    <!-- Add system logs table here -->
    <?php
$system_logs = array(
    // User Activity Logs
    array(
        'date' => '2023-07-27 12:34:56',
        'event' => 'User login',
        'details' => 'User \'john.doe@example.com\' logged in successfully'
    ),
    array(
        'date' => '2023-07-27 10:15:23',
        'event' => 'User login',
        'details' => 'User \'jane.doe@example.com\' failed to log in'
    ),
    array(
        'date' => '2023-07-26 15:47:11',
        'event' => 'User registration',
        'details' => 'User \'jim.brown@example.com\' registered and created an account'
    ),
    array(
        'date' => '2023-07-25 09:28:34',
        'event' => 'User profile update',
        'details' => 'User \'sarah.jones@example.com\' updated her email to \'sarah.jones@newemail.com\''
    ),
    array(
        'date' => '2023-07-24 17:16:29',
        'event' => 'User report submission',
        'details' => 'User \'mike.jordan@example.com\' submitted a report (ID: 12345) with description \'Flooding at Main Street\' and location \'New York, NY\''
    ),

    // System Error Logs
    array(
        'date' => '2023-07-27 11:59:01',
        'event' => 'PHP error',
        'details' => 'PHP Fatal error: Uncaught Error: Call to a member function query() on null in /var/www/html/db.php:15 Stack trace: #0 /var/www/html/index.php(3): require() #1 {main} thrown in /var/www/html/db.php on line 15'
    ),
    array(
        'date' => '2023-07-27 10:02:18',
        'event' => 'Server error',
        'details' => '500 Internal Server Error - The server encountered an internal error or misconfiguration and was unable to complete your request.'
    ),
    array(
        'date' => '2023-07-27 10:02:18',
        'event' => 'Database error',
        'details' => 'Error: MySQL server has gone away'
    ),

    // Security Logs
    array(
        'date' => '2023-07-27 12:34:56',
        'event' => 'Successful login',
        'details' => 'Successful login attempt from IP \'192.168.1.100\''
    ),
    array(
        'date' => '2023-07-27 10:15:23',
        'event' => 'Password reset',
        'details' => 'Password reset requested for user \'jane.doe@example.com\''
    ),
    array(
        'date' => '2023-07-26 15:47:11',
        'event' => 'Account lockout',
        'details' => 'Account \'jim.brown@example.com\' locked out due to excessive failed login attempts'
    ),
    array(
        'date' => '2023-07-25 09:28:34',
        'event' => 'Suspicious activity',
        'details' => 'Suspicious login attempt from IP \'203.0.113.12\''
    ),

    // System Event Logs
    array(
        'date' => '2023-07-24 17:16:29',
        'event' => 'System update',
        'details' => 'System update started'
    ),
    array(
        'date' => '2023-07-23 16:05:10',
        'event' => 'Configuration change',
        'details' => 'Configuration change: User \'mike.jordan@example.com\' granted admin privileges'
    ),
    array(
        'date' => '2023-07-22 08:30:00',
        'event' => 'Scheduled task',
        'details' => 'Scheduled task \'daily_report.php\' executed'
    ),

    // Other Logs
    array(
        'date' => '2023-07-21 13:45:00',
        'event' => 'System performance',
        'details' => 'CPU usage: 75%, Memory usage: 50%, Response time: 200ms'
    )
);

// Display the system logs
echo '<div class="section">';
echo '<h2>System Logs</h2>';
echo '<table>';
echo '<tr><th>Date</th><th>';
  
?> 


    </div>
</body>
</html>

<script type="text/javascript">
    <?php if(isset($_GET['alert_sent']) && $_GET['alert_sent'] == 'true'): ?>
        alert('Alert sent to authorities successfully!');
    <?php endif; ?>
</script>

