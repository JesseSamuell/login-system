<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password === $confirm_password) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO user (email, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $email, $hashed_password);
        
        if ($stmt->execute()) {
            $_SESSION['user'] = $email;
            header('Location: dashboard.php?msg=welcome');
            exit; // Add this to prevent further execution
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Passwords do not match";
    }
}
?>

<html>
<body>
<?php if(isset($_GET['msg']) && $_GET['msg'] == 'welcome'): ?>
    <script type="text/javascript">
        alert('You Have successfully Registered!');
    </script>
<?php endif; ?>
</body>
</html>