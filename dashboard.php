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
    <link rel="stylesheet" href="dashboard.css">
</head>
    <body>
    <div class="container">
        <div>
            <video autoplay loop muted plays-inline  class="Flooding">
                <source src="images/floods-home.mp4" type="video/mp4">
            </video>
        </div>
        <header>
            <ul>
            <nav class="menu">
            <a href="#"> <!--Home-->
            <i class="fa fa-home"></i>Home
         </a>
            
           <a href="report.html"> <!--report-->
            <i class="fa fa-home"></i>Report
           </a>


           <a href="flood.php"> <!--Flood assessment-->
            <i class="fa fa-home"></i>Flood Assessment
           </a>

           <a href="Logout.php"> <!--Flood assessment-->
            <i class="fa fa-home"></i>Logout
           </a>
         </ul>
        </nav>
        </header>

<main>
    
        <section>
            <div class="Dashboard">
                <br>
                <br>
                <br>
                <br>
                <h1 class="dashboard"> Welcome to your Home Page! <?php echo ''. $_SESSION['user']; ?> </h1> 
                <div class="Message">
                    <p> We are dedicated to Forever pushing the frontier in early flood warning and reporting,<br>
                     to insure both you safety and peace of mind<br>
                   
</div>
              <h2>Your Current Location:</h2>
<style>
        #map {
            height: 250px; /* Adjust the height as needed */
            width: 120%;
            scale: 65%;
            top: 10px;
            

        }
    </style>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <div id="output"></div>

    <script>
        if (!navigator.geolocation) {
            throw new Error("No geolocation available");
        }

        function success(pos) {
            const lat = pos.coords.latitude;
            const lng = pos.coords.longitude;

            const markup = `
                  <div id="map"></div>
                <a href="https://www.openstreetmap.org/#map=16/${lat}/${lng}">
                 Your Current position:
                </a>
            `;

            document.getElementById('output').innerHTML = markup;

            const map = L.map('map').setView([lat, lng], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            L.marker([lat, lng]).addTo(map)
                .bindPopup('You are here.')
                .openPopup();
        }

        function error() {
            console.error("Error occurred while fetching the location");
        }

        const options = {};
        navigator.geolocation.getCurrentPosition(success, error, options);
    </script>
    </div>
     <section class="call-action">
        <h2>We are gathering your current location <br> and processing for any 
            floods that are nearby, <br> if you wish to proceed, you can 'Report A Flooding'<br>event 
             or press 'Flood assessment' beside</h2>
              <section class="report-button">
             <a href="report.html">

  <button>Report A Flooding</button>
</a> <br>

<a href="flood.php">

<button>Flooding assessment</button>
</a>

    </section>
    </section>

    <section class="report-slides">
    <?php
// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "login_system");

// Check connection
if (!$conn) {
    die("Connection failed: ". mysqli_connect_error());
}

// Query the reports table
$sql = "SELECT * FROM reports";
$result = mysqli_query($conn, $sql);

// Check if there are any results
if (mysqli_num_rows($result) > 0) {
    // Loop through the results and store them in an array
    $reports = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $reports[] = $row;
    }
} else {
    echo "No reports found";
}

// Close the database connection
mysqli_close($conn);
?>

<h1>Flood Reports From Users</h1>
    <div id="carouselExample" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <?php foreach ($reports as $key => $report) {?>
            <li data-target="#carouselExample" data-slide-to="<?php echo $key;?>"<?php echo $key == 0? 'lass="active"' : '';?>></li>
            <?php }?>
        </ol>
        <div class="carousel-inner">
            <?php foreach ($reports as $key => $report) {?>
            <div class="carousel-item <?php echo $key == 0? 'active' : '';?>">
                <h2><?php echo $report['flood_scale'];?></h2>
                <p>Location: <?php echo $report['location'];?></p>
                <p><?php echo $report['report_description'];?></p>
                <?php if (!empty($report['image'])) {?>
                <img src="<?php echo $report['image'];?>" alt="<?php echo $report['flood_scale'];?>">
                <?php }?>
            </div>
            <?php }?>
        </div>
        <a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExample" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>
                </body>

  


    </section>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
    var carousel = document.getElementById('carouselExample');
    carousel.carouselInterval = setInterval(function() {
        carousel.nextElementSibling.click();
    }, 3000);
</script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</main>
</body>
<footer class="footer-section">
  <div class="footer-content">
    <div class="footer-left">
      <h4>About Us</h4>
      <p>We are dedicated to providing the best services and products to our customers. </p>
    </div>
    <div class="footer-middle">
      <h4>Quick Links</h4>
      <ul>
        <li><a href="#home">Home</a></li>
    </div>
  <div class="footer-bottom">
    <p>&copy; 2024 Your Company Name. All rights reserved.</p>
  </div>
</footer>





