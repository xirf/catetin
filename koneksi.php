<?php

$conn = mysqli_connect("localhost", "andka", "korekore", "db_catetin");

if (!$conn) {
    die("Error: " . mysqli_connect_error());
}
