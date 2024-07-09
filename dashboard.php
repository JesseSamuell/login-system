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
            <i class="fa fa-home"></i>Home
         </a>
            
           <a href="report.html"> <!--report-->
            <i class="fa fa-home"></i>Report
           </a>


           <a href="flood.html"> <!--Flood assessment-->
            <i class="fa fa-home"></i>Flood Assessment
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

<style>
        #map {
            height: 400px; /* Adjust the height as needed */
            width: 100%;
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
                    Your Current position: latitude: ${lat}, longitude: ${lng}
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
</main>
</body>




