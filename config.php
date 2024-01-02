<?php 

$conn = new mysqli("localhost", "root", "", "db_arkatama_test");

if ($conn->connect_error) {
    die("Error: ". $conn->connect_error);
}

?>