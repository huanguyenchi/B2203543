<?php
$conn = new mysqli("localhost", "root", "", "qlsv");
$id = $_POST['id'];
$sql = "DELETE FROM major WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
    header('Location: major_index.php');
    exit;
} else {
    echo "Lỗi: " . $conn->error;
}
$conn->close();
?>