<?php
session_start(); // Phải có dòng này để khởi tạo Session

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "qlbanhang";

// Kết nối CSDL
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Câu truy vấn kiểm tra đăng nhập
$sql = "select id, fullname, email from customers where email = '".$_POST["email"]."' and password = '".md5($_POST["pass"])."'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  
  // LƯU THÔNG TIN VÀO SESSION THAY VÌ COOKIE
  $_SESSION['email'] = $row['email'];
  $_SESSION['fullname'] = $row['fullname'];
  $_SESSION['id'] = $row['id'];
  
  // Chuyển hướng sang trang chủ
  header('Location: homepage.php');
  
} else {
  echo "Sai thông tin đăng nhập! Đang quay lại...";
  header('Refresh: 3;url=login.php');
}
$conn->close();
?>