<?php
/**
 * Created by PhpStorm.
 * User: vuquo
 * Date: 8/29/2017
 * Time: 1:53 AM
 */


$conn = mysqli_connect("localhost","my_user","my_password","my_db");

// Check connection
if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$sql = "INSERT INTO test_cronjob (value) VALUES ('1111')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

