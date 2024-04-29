<?php
$mysqli = new mysqli('localhost', 'root', '', 'data');

// Check connection
if ($mysqli->connect_error) {
    die('Failed to connect to MySQL: ' . $mysqli->connect_error);
}

echo 'Connected successfully!';

// Close connection
$mysqli->close();
?>
