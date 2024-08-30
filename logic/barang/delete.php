<?php

include('../../config/database.php');

$conn = connection();

$id = $_GET['id'];

$sql = "DELETE FROM barang WHERE id = $id";

if (mysqli_query($conn, $sql)) {
    header("Location: ../../index.php?page=barang");
} else {
    echo "Error" . $sql . "<br>" . mysqli_error($conn);
}
