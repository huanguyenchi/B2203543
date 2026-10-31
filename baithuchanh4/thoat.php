<?php
session_start();

// Xóa tất cả các biến session
session_unset();

// Hủy bỏ session
session_destroy();

// Xóa luôn các cookie nếu trước đó còn sót lại
setcookie("user", "", time() - 3600, "/");
setcookie("fullname", "", time() - 3600, "/");
setcookie("id", "", time() - 3600, "/");

// Thông báo và chuyển hướng về trang đăng nhập
echo "Bạn đã đăng xuất khỏi hệ thống thành công!";
header('Refresh: 2;url=login.php');
?>