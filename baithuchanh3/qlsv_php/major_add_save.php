<?php
$conn = new mysqli("localhost", "root", "", "qlsv");
$name_major = $_POST["name_major"];
$sql = "INSERT INTO major (name_major) VALUES ('$name_major')";

if ($conn->query($sql) === TRUE) {
    header('Location: major_index.php');
    exit;
} else {
    echo "Lỗi: " . $conn->error;
}
$conn->close();
?>