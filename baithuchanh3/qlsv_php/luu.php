<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "qlsv";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$date = date_create($_POST["birth"]);

$sql = "INSERT INTO student (fullname, email, birthday, major_id) VALUES ('".$_POST["name"] ."', '".$_POST["email"] ."', '".$date->format('Y-m-d') ."', '".$_POST["major_id"]."')";
if ($conn->query($sql) == TRUE) {
  // In ra dòng chữ thông báo
  echo "<h3>Thêm sinh viên thành công! Đang chuyển hướng...</h3>";
  
  // Dùng lệnh Refresh để đợi 2 giây rồi tự động nhảy sang trang taidulieu_bang.php
  header('Refresh: 2; url=taidulieu_bang.php');
  exit;
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
