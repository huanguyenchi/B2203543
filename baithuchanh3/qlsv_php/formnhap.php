<?php
// Kết nối để lấy danh sách từ bảng major
$conn = new mysqli("localhost", "root", "", "qlsv");
$majors = $conn->query("SELECT * FROM major");
?>
<!DOCTYPE HTML>
<html>  
<body>

<form action="luu.php" method="post">
Name: <input type="text" name="name"><br>
E-mail: <input type="text" name="email"><br>
Birthday: <input type="date" name="birth"><br>

<!-- THÊM COMBOBOX CHUYÊN NGÀNH -->
Chuyên ngành: 
<select name="major_id">
    <?php while($m = $majors->fetch_assoc()) { ?>
        <option value="<?php echo $m['id']; ?>"><?php echo $m['name_major']; ?></option>
    <?php } ?>
</select><br><br>

<input type="submit">
</form>

</body>
</html>