<?php
    // Connect to MySQL
    include("connect.php");

    // Prepare the SQL statement

    date_default_timezone_set("Australia/Perth");
    $dateS = date('Y-m-d H:i:s');
    echo $dateS;
    $query = "INSERT INTO gas_detector.data (date, gas) VALUES ('$dateS','".$_GET["gas"]."')";

    // Execute SQL statement
    mysqli_query($con,$query);
    // Go to the review_data.php (optional)
    header("Location: index.php");
?>
