<?php
$conn = new mysqli("localhost", "root", "", "qlsv");
$id = $_POST['id'];
$result = $conn->query("SELECT * FROM major WHERE id='$id'");
$row = $result->fetch_assoc();
?>
<form action="major_edit_save.php" method="post">
    ID: <input type="text" name="id" value="<?php echo $row['id']; ?>" readonly><br><br>
    Tên chuyên ngành: <input type="text" name="name_major" value="<?php echo $row['name_major']; ?>"><br><br>
    <input type="submit" value="Cập nhật">
</form>