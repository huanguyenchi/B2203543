<!DOCTYPE HTML>
<html>
<head>
    <title>PHP Form Validation - CT299</title>
</head>
<body>

<?php
// 1 & 2. Khởi tạo các biến với giá trị rỗng
$name = $email = $gender = $comment = $website = "";

// 4. Kiểm tra phương thức submit form và gán dữ liệu đã qua xử lý
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = test_input($_POST["name"]);
  $email = test_input($_POST["email"]);
  $website = test_input($_POST["website"]);
  $comment = test_input($_POST["comment"]);
  $gender = test_input($_POST["gender"]);
}

// 3. Hàm làm sạch dữ liệu
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<h2>Ví dụ PHP Form Validation</h2>
<!-- Form gửi dữ liệu đến chính trang hiện tại bằng phương thức POST -->
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  Name: <input type="text" name="name">
  <br><br>
  E-mail: <input type="text" name="email">
  <br><br>
  Website: <input type="text" name="website">
  <br><br>
  Comment: <textarea name="comment" rows="5" cols="40"></textarea>
  <br><br>
  Gender:
  <input type="radio" name="gender" value="female">Female
  <input type="radio" name="gender" value="male">Male
  <input type="radio" name="gender" value="other">Other
  <br><br>
  <input type="submit" name="submit" value="Submit">
</form>

<?php
// Hiển thị kết quả dữ liệu đã được làm sạch sau khi submit
echo "<h2>Dữ liệu bạn đã nhập (sau khi làm sạch):</h2>";
echo $name;
echo "<br>";
echo $email;
echo "<br>";
echo $website;
echo "<br>";
echo $comment;
echo "<br>";
echo $gender;
?>

</body>
</html>