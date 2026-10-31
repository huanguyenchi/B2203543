<!DOCTYPE HTML>
<html>
<body>
  <h2>Dữ liệu bạn vừa nhập:</h2>
  Họ và tên: <?php echo $_POST["name"]; ?><br>
  Email: <?php echo $_POST["email"]; ?><br>
  Mật khẩu: <?php echo $_POST["matkhau"]; ?><br>
  Ngày sinh: <?php 
    // Chuyển đổi định dạng ngày sinh từ YYYY-MM-DD sang DD/MM/YYYY cho dễ nhìn
    echo date("d/m/Y", strtotime($_POST["ngaysinh"])); 
  ?>
</body>
</html>