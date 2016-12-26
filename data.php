<?php
// setting header agar berformat JSON
header('Content-Type: application/json');

// Koeneksi Database
define('DB_HOST', 'localhost'); // mendefinisikan Host
define('DB_USERNAME', 'root'); // mendefinisikan user name
define('DB_PASSWORD', ''); // mendefinisikan password
define('DB_NAME', 'gas_detector'); // mendefinisikan nama database

$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME); // melakukan koneksi ke database

if(!$mysqli){
	die("Connection failed: " . $mysqli->error); // jika gagal dalam proses koneksi ke Database maka akan memunculkan errornya
}

// query untuk mendapatkan seluruh data dari tabel data dalam data base berdasarkan tanggal, diurut dari belakang dan dibatasi 20 baris data
$query = sprintf("SELECT data.id, data.date, data.gas FROM data ORDER BY data.date DESC LIMIT 20");

// melakukan eksekusi pada Query
$result = $mysqli->query($query);

// melakukan perulangan pada setiap data yang ada di dalam tabel database
$data = array();
foreach ($result as $row) {
	$data[] = $row;
}

// membersihkan memory yang sebelumnya digunakan
$result->close();

// menutup koneksi database
$mysqli->close();

// menampilkan data dalam bentuk format JSON
print json_encode($data);
