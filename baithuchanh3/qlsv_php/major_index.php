<?php
$conn = new mysqli("localhost", "root", "", "qlsv");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$sql = "SELECT * FROM major";
$result = $conn->query($sql);
?>
<h1>Danh sách Chuyên ngành</h1>
<a href="major_add.php">Thêm chuyên ngành mới</a><br><br>
<table border="1">
    <tr><th>ID</th><th>Tên Chuyên Ngành</th><th colspan="2">Hành động</th></tr>
    <?php 
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["id"]. "</td><td>" . $row["name_major"]. "</td>";
            // Nút Xóa
            echo "<td><form method='post' action='major_xoa.php'>
                  <input type='hidden' name='id' value='".$row['id']."'/>
                  <input type='submit' value='Xóa'/></form></td>";
            // Nút Sửa
            echo "<td><form method='post' action='major_edit.php'>
                  <input type='hidden' name='id' value='".$row['id']."'/>
                  <input type='submit' value='Sửa'/></form></td></tr>";
        }
    } else {
        echo "<tr><td colspan='4'>0 kết quả</td></tr>";
    }
    ?>
</table>
<?php $conn->close(); ?>