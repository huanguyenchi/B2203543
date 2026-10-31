<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "qlsv";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// SỬA CÂU LỆNH SQL Ở ĐÂY: Dùng LEFT JOIN để lấy tên chuyên ngành từ bảng major
$sql = "SELECT student.*, major.name_major FROM student LEFT JOIN major ON student.major_id = major.id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $result_all = $result->fetch_all(MYSQLI_ASSOC);
 ?>
 <h1>Bang du lieu sinh vien</h1>
 <!-- THÊM 2 CỘT: Mã CN và Tên CN vào thẻ th -->
 <table border=1><tr><th>ID</th><th>Hoten</th><th>email</th><th>ngaysinh</th><th>Mã CN</th><th>Tên CN</th><th colspan="2">Hanh dong</th></tr>
<?php 
    foreach ($result_all as $row) {
        $date = date_create($row['Birthday']);
        // THÊM XUẤT DỮ LIỆU: $row["major_id"] và $row["name_major"] vào thẻ td
        echo "<tr><td>" . $row["id"]. "</td><td>" . $row["fullname"]. "</td><td>" . $row["email"]. "</td><td>" . 
        $date->format('d-m-Y') . "</td><td>" . $row["major_id"] . "</td><td>" . $row["name_major"] . "</td><td>";
?>
        <form method="post" action="xoa.php"> 
        <input type="submit" name="action" value="xoa"/>
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>"/>
        </form>
<?php
        echo "</td>";
        echo "<td>";
?>
        <form method="post" action="form_sua.php"> 
        <input type="submit" name="action" value="sua"/>
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>"/>
        </form>
<?php
        echo "</td></tr>";
    }
   echo "</table>";
  
} else {
  echo "0 ket qua tra ve";
}
$conn->close();
?>