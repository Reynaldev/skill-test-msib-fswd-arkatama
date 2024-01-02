<?php 

require("config.php");

// Pattern untuk mencari angka tahun
$reg_age = "/[0-9]/";
// Pattern untuk mencari kata tahun/thn/th. case-insensitivity
$reg_age_omit = "/tahun|thn|th/i";

$data = $_POST['data'];

// Cari kata yang sesuai dengan pattern $reg_age_omit, kemudian hilangkan
$data = preg_filter($reg_age_omit, '', $data);

// Pisahkan antara nama dan kota dengan umur sebagai pemisah 
$str = preg_split($reg_age, $data, 0, PREG_SPLIT_NO_EMPTY);
// Ubah nama dan kota menjadi UPPERCASE dan hilangkan spasi yang tidak berguna
$name = trim(strtoupper($str[0]));
$city = trim(strtoupper($str[1]));

// Ambil umur dengan menjadikan panjang nama dan posisi index awal kota sebagai patokan
$age_start = strpos($data, $name) + strlen($name);
$age_end = strpos($data, $city);
$age = substr($data, $age_start, $age_end - $age_start);

// echo "Name: $name";
// echo "<br>";
// echo "Age: $age";
// echo "<br>";
// echo "City: $city";

// Masukkan data ke dalam database
$sql = "INSERT INTO arkatama(name, age, city) VALUES('$name', '$age', '$city')";

// Jika berhasil, maka kembali ke index.php
if ($conn->query($sql)) {
    echo "Success!";
    header("Location: /index.php");
}

// Tutup
$conn->close();

?>