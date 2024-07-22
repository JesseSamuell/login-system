<!DOCTYPE html>
<html>
<head>
    <title>Flood Assessment</title>
    <link rel="stylesheet" href="flood.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <style>
        .carousel-item {
            height: 500px;
            background-color: #f5f5f5;
            padding: 20px;
        }
        .carousel-item img {
            width: 100%;
            height: 300px;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Flood Assessment</h1>
        <div id="carouselExample" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <?php
                $reports = array(); // assume this is an array of reports from the database
                foreach ($reports as $key => $report) {
                    echo '<li data-target="#carouselExample" data-slide-to="'.$key.'"'.($key == 0 ? ' class="active"' : '').'></li>';
                }
                ?>
            </ol>
            <div class="carousel-inner">
                <?php foreach ($reports as $key => $report) { ?>
                <div class="carousel-item <?php echo $key == 0 ? 'active' : ''; ?>">
                    <h2><?php echo $report['flood_scale']; ?></h2>
                    <p><?php echo $report['report_description']; ?></p>
                    <?php if (!empty($report['image'])) { ?>
                    <img src="<?php echo $report['image']; ?>" alt="<?php echo $report['flood_scale']; ?>">
                    <?php } ?>
                </div>
                <?php } ?>
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
</html>