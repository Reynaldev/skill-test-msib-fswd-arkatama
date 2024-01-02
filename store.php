<?php 

require("config.php");

$reg_age = "/[0-9]/";
$reg_age_omit = "/tahun|th|thn/i";

$data = $_POST['data'];

$data = preg_filter($reg_age_omit, '', $data);

$str = preg_split($reg_age, $data, -1, PREG_SPLIT_NO_EMPTY);
$name = trim($str[0]);
$city = trim($str[1]);

$age_start = strpos($data, $name) + strlen($name);
$age_end = strpos($data, $city);
$age = substr($data, $age_start, $age_end - $age_start);

echo "Name: $name";
echo "<br>";
echo "Age: $age";
echo "<br>";
echo "City: $city";

$sql = "INSERT INTO arkatama(name, age, city) VALUES('$name', '$age', '$city')";

if ($conn->query($sql)) {
    echo "Success!";
    header("Location: /index.php");
}
$conn->close();

?>