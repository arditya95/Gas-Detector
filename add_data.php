<?php
    // Connect to MySQL
    include("connect.php");

    // persiapan Query yang akan dieksekusi
    date_default_timezone_set("Australia/Perth");
    $dateS = date('Y-m-d H:i:s');
    echo $dateS;
    $query = "INSERT INTO gas_detector.data (date, gas) VALUES ('$dateS','".$_GET["gas"]."')"; // melakukan insert ke tabel data dengan fild yang akan di isi date dan gas dengan VALUES dari variable date dan data gas yang dikirim oleh Raspberry

    // melakuakn eksekusi query
    mysqli_query($con,$query);
    // menuju ke halaman indek.php
    header("Location: index.php");
?>
