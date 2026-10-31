<?php
$conn = new mysqli("localhost", "root", "", "qlsv");
$id = $_POST['id'];
$name_major = $_POST['name_major'];
$sql = "UPDATE major SET name_major='$name_major' WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
    header('Location: major_index.php');
    exit;
} else {
    echo "Lỗi: " . $conn->error;
}
$conn->close();
?>