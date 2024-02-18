<?php
$conn = new mysqli(SEVERNAME, USERNAME, PASSWORD, DBNAME);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
mysqli_set_charset($conn, "utf8");
