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

<!-- HTML code here -->
<link rel="stylesheet" href="flood.css">
<header>
    <ul>
    <nav class="menu">
    <a href="dashboard.php"> <!--Home-->
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
<br>
<br>
<br>
<body>
<div class="container">
<div class="assessment">
        <div>
            <video autoplay loop muted plays-inline  class="video">
                <source src="images/floods-home.mp4" type="video/mp4">
            </video>
        </div>
    <h1>Flood Assessment From Users</h1>
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