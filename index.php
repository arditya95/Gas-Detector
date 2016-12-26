<?php
    // Start MySQL Connection
    include('connect.php');
?>

<html>
<head>
  <title>Gas Leak Detector</title>

  <!-- javascript -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css" integrity="sha384-AysaV+vQoT3kOAXZkl02PThvDr8HYKPZhNT5h/CXfBThSRXQ6jW5DO2ekP5ViFdi" crossorigin="anonymous">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/js/bootstrap.min.js" integrity="sha384-BLiI7JTZm+JWlgKa0M0kGRpJbF2J8q+qreVrKBC47e3K6BW78kGLrCkeRX6I9RoK" crossorigin="anonymous"></script>
  <script type="text/javascript" src="js/jquery.min.js"></script>
  <script type="text/javascript" src="js/Chart.min.js"></script>
  <script type="text/javascript" src="js/app.js"></script>
  <!-- javascript -->

    <!-- Chart CSS -->
      <style type="text/css">
        #chart-container {
          width: 640px;
          height: auto;
      }</style>
    <!-- Chart CSS -->

    <!-- Tabel CSS -->
    <style type="text/css">
        .table_titles, .table_cells_normal, .table_cells_warning, .table_cells_danger {
                padding-right: 20px;
                padding-left: 20px;
                color: #fffcfc;
        }
        .table_titles {
            color: #FFF;
            background-color: #666;
        }
        .table_cells_normal {
            background-color: #18cb4a;
        }
        .table_cells_warning {
            background-color: #f7c511;
        }
        .table_cells_danger {
            background-color: #f60707;
        }
        body {
            font-family: "Trebuchet MS", Arial;
        }
        .header-title{
          background: #ece8e8;
        }
    </style>
    <!-- Tabel CSS -->

</head>
    <body>
      <div class="container-fluid header-title">
        <div class="row">
          <div class="col-md-4">
          </div>
          <div class="col-md-4">
            <h1>Gas Leak Detector</h1>
          </div>
          <div class="col-md-4">
          </div>
        </div>
      </div>

      <!-- Refresh Otomatis -->
      <?php
         $page = $_SERVER['PHP_SELF'];
         $sec = "10";
         header("Refresh: $sec; url=$page");
       ?>
      <!-- Refresh Otomatis -->

      <div class="container-fluid header-title">
        <div class="row">
          <!-- Tabel Start-->
          <div class="col-md-6">
            <table class="table table-striped table-bordered table-hover" border="3" cellspacing="0" cellpadding="4">
              <tr>
                    <td align="center" class="table_titles">ID</td>
                    <td align="center" class="table_titles">Date and Time</td>
                    <td align="center" class="table_titles">Gas Leak (%)</td>
                    <td align="center" class="table_titles">Status</td>
              </tr>
                <?php
                    $query= "SELECT * FROM data ORDER BY id DESC LIMIT 20"; // mengambil seluruh data yang ada berdasarkan id dan di urut dari belakang dan memiliki batas 20 baris data
                    $result = mysqli_query($con,$query); // melakuka eksekusi pada query yang telah dibuat sebelumnya

                    // memproses setiap data yang tersimpan
                    while( $row = mysqli_fetch_array($result) )
                    {
                      // melakukan pengecekan terhadap data gas yang diterima apakah melebihi 51, jika melebihi angka 51 maka Statusnya menjadi "BAHAYA GAS BOCOR !!!"
                        if ($row["gas"] > 51) {
                          $status = "BAHAYA GAS BOCOR !!!";
                          $css_class=' class="table_cells_danger"'; // mengatur warna tabel agar berwarna merah jika melebihi angka 51
                        }

                      // melakukan pengecekan terhadap data gas yang diterima apakah melebihi 26, jika melebihi angka 26 maka Statusnya menjadi "BOCOR SEDANG !!"
                        elseif ($row["gas"] > 26) {
                          $status = "BOCOR SEDANG !!";
                          $css_class=' class="table_cells_warning"'; // mengatur warna tabel agar berwarna kuning jika melebihi angka 26
                        }

                      //jika selain 2 kondisi diatas status dari gas adalah "GAS NORMAL"
                        else {
                          $status = "GAS NORMAL";
                          $css_class=' class="table_cells_normal"'; // mengatur warna tabel agar berwarna hijau jika gas normal
                        }

                        echo '<tr>';
                        echo '   <td align="center" '.$css_class.'>'.$row["id"].'</td>'; // menampilkan setiap data (ID) dari database kedalam tabel data
                        echo '   <td align="center" '.$css_class.'>'.$row["date"].'</td>'; // menampilkan setiap data (DATE) dari database kedalam tabel data
                        echo '   <td align="center" '.$css_class.'>'.$row["gas"].' %</td>'; // menampilkan setiap data (GAS) dari database kedalam tabel data
                        echo '   <td align="center" '.$css_class.'>'.$status.'</td>'; // menampilkan status dari kadar gas yang disimpan dalam database
                        echo '</tr>';
                    }
                ?>
            </table>
          </div>
          <!-- Tabel End-->

          <!-- mendeklarasikan canvas yang selanjutnya akan digunakan untuk menempatkan line chart pada halaman-->
          <div class="col-md-6" id="chart-container">
            <canvas id="mycanvas"></canvas>
          </div>
          <!-- Chart -->
        </div>
      </div>
    </body>
</html>
