<?php
session_start();

// Yêu cầu người dùng phải đăng nhập mới được đổi mật khẩu
if (!isset($_SESSION['id'])) {
    echo "Bạn cần đăng nhập trước để thực hiện chức năng này!";
    header('Refresh: 3;url=login.php');
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "qlbanhang";

// Kết nối CSDL
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

$thongbao = ""; // Biến lưu thông báo lỗi hoặc thành công

// Xử lý khi người dùng bấm nút Submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mk_cu = md5($_POST['mk_cu']);       // Băm mk cũ người dùng nhập để so sánh
    $mk_moi = $_POST['mk_moi'];
    $mk_moi2 = $_POST['mk_moi2'];
    $id_user = $_SESSION['id'];

    // 1. Truy vấn lấy mật khẩu hiện tại trong CSDL
    $sql = "SELECT password FROM customers WHERE id = '$id_user'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $mk_db = $row['password'];

        // 2. Kiểm tra mật khẩu cũ có khớp với CSDL không
        if ($mk_cu === $mk_db) {
            // 3. Kiểm tra 2 ô mật khẩu mới có khớp nhau không
            if ($mk_moi === $mk_moi2) {
                // 4. Kiểm tra mật khẩu mới không được giống mật khẩu cũ
                if (md5($mk_moi) !== $mk_db) {
                    // Tiến hành băm mật khẩu mới và lưu vào CSDL
                    $mk_moi_md5 = md5($mk_moi);
                    $sql_update = "UPDATE customers SET password = '$mk_moi_md5' WHERE id = '$id_user'";
                    
                    if ($conn->query($sql_update) === TRUE) {
                        $thongbao = "<span style='color:green; font-weight:bold;'>Đổi mật khẩu thành công!</span>";
                    } else {
                        $thongbao = "<span style='color:red;'>Lỗi cập nhật CSDL: " . $conn->error . "</span>";
                    }
                } else {
                    $thongbao = "<span style='color:red;'>Mật khẩu mới không được trùng với mật khẩu cũ!</span>";
                }
            } else {
                $thongbao = "<span style='color:red;'>Hai ô mật khẩu mới không khớp nhau!</span>";
            }
        } else {
            $thongbao = "<span style='color:red;'>Mật khẩu cũ không chính xác!</span>";
        }
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Đổi mật khẩu</title>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 50px; }
        .container { background-color: #fff; padding: 30px; width: 400px; margin: 0 auto; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        input[type=password] { width: 100%; padding: 10px; margin: 10px 0; display: inline-block; border: 1px solid #ccc; box-sizing: border-box; }
        button { background-color: #4CAF50; color: white; padding: 10px 20px; border: none; cursor: pointer; width: 100%; }
        button:hover { opacity: 0.8; }
    </style>
</head>
<body>

<div class="container">
    <h2 style="text-align:center;">ĐỔI MẬT KHẨU</h2>
    
    <!-- Hiển thị thông báo (nếu có) -->
    <div style="text-align:center; margin-bottom: 15px;">
        <?php echo $thongbao; ?>
    </div>

    <form method="POST" action="">
        <label><b>Mật khẩu cũ:</b></label>
        <input type="password" name="mk_cu" required>

        <label><b>Mật khẩu mới:</b></label>
        <input type="password" name="mk_moi" required>

        <label><b>Nhập lại mật khẩu mới:</b></label>
        <input type="password" name="mk_moi2" required>

        <button type="submit">Cập nhật mật khẩu</button>
    </form>
    
    <div style="text-align:center; margin-top: 20px;">
        <a href="homepage.php">Quay lại Trang chủ</a>
    </div>
</div>

</body>
</html>