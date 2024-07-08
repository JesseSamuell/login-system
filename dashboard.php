<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: index.html');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title> Home Page</title> 
    <link rel="stylesheet" href="style.css">
</head>
    <body>
        <header>
            <ul>
            <nav class="menu">
            <a href="#"> <!--Home-->
            <i class="fa fa-home"></i>Home;
         </a>
            
           <a href="report.html"> <!--report-->
            <i class="fa fa-home"></i>Report;
           </a>


           <a href="flood.html"> <!--Flood assessment-->
            <i class="fa fa-home"></i>Flood Assessment;
           </a>
         </ul>
        </nav>
        </header>

<main>
        <section>
            <div class="Dashboard">
                <h1> Welcome to your Home Page! <?php echo ''. $_SESSION['user']; ?> </h1> 
                <div class="Message">
                    <p> We are dedicated to Forever pushing the frontier in early flood warning and reporting, to insure both you safety and peace of mind<br>
                    We value your trust in us and hope to fulfill all your needs </P> 
</div>
</main>
</body>




