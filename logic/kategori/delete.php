<?php

include_once '../../config/database.php';

$conn = connection();

$id = $_GET['id'];

$sql = "DELETE FROM kategori WHERE id = $id";

if (mysqli_query($conn, $sql)) {
    header("Location: ../../index.php?page=kategori");
} else {
    echo "Error" . $sql . "<br>" . mysqli_error($conn);
}
