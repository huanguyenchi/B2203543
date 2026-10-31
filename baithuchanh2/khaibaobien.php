<?php
// Gán giá trị kiểu chuỗi (đặt trong dấu nháy kép hoặc nháy đơn)
$hoTen = "Nguyễn Văn A"; 
$monHoc = 'Lập trình Web';

// Gán giá trị kiểu số (viết trực tiếp, không dùng dấu nháy)
$namSinh = 2004;         // Kiểu số nguyên (Integer)
$diemTrungBinh = 8.5;    // Kiểu số thực (Float), dùng dấu chấm phần thập phân

// Gán giá trị ngày tháng (lưu dạng chuỗi tĩnh hoặc lấy từ hàm hệ thống)
$ngayThang = "15-10-2004"; 
$ngayHienTai = date("d/m/Y"); // Lấy ngày hiện hành theo định dạng Ngày/Tháng/Năm
echo "Họ tên: " . $hoTen . "<br>";
echo "Môn học: " . $monHoc . "<br>";
echo "Năm sinh: " . $namSinh . "<br>";
echo "Điểm TB: " . $diemTrungBinh . "<br>";
echo "Ngày sinh: " . $ngayThang . "<br>";
echo "Hôm nay là: " . $ngayHienTai;
?>


