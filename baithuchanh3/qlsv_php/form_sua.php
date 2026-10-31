<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "qlsv";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$id =  $_POST['id'];
$sql = "SELECT * FROM student WHERE ID='".$id."'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

// Lấy danh sách chuyên ngành
$majors = $conn->query("SELECT * FROM major");
?>

<!DOCTYPE HTML>
<html>  
<body>
<form action="sua.php" method="post">
ID:<input type="text" name="id" value="<?php echo $row['id'];?>" readonly><br>
Name: <input type="text" name="fullname" value="<?php echo $row['fullname'];?>"><br>
E-mail: <input type="text" name="email"  value="<?php echo $row['email'];?>"><br>
Birthday: <input type="date" name="birth" value="<?php echo $row['Birthday'];?>"><br>

<!-- THÊM COMBOBOX CHUYÊN NGÀNH VỚI LOGIC SELECTED -->
Chuyên ngành: 
<select name="major_id">
    <?php 
    while($m = $majors->fetch_assoc()) { 
        // Nếu ID của major đang lặp bằng với major_id của sinh viên, thêm chữ selected
        $isSelected = ($m['id'] == $row['major_id']) ? "selected" : "";
        echo "<option value='".$m['id']."' ".$isSelected.">".$m['name_major']."</option>";
    } 
    ?>
</select><br><br>

<input type="submit" value="Cập nhật">
</form>

</body>
</html>