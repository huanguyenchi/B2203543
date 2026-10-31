<?php
class Sinhvien {
    // Khai báo các thuộc tính
    public $mssv;
    public $hoten;
    public $ngaysinh;

    // Phương thức xây dựng (Constructor)
    function __construct($mssv, $hoten, $ngaysinh) {
        $this->mssv = $mssv;
        $this->hoten = $hoten;
        $this->ngaysinh = $ngaysinh;
    }

    // Các phương thức gán trị (Setters)
    function set_mssv($mssv) { 
        $this->mssv = $mssv; 
    }
    function set_hoten($hoten) { 
        $this->hoten = $hoten; 
    }
    function set_ngaysinh($ngaysinh) { 
        $this->ngaysinh = $ngaysinh; 
    }

    // Các phương thức trả về giá trị (Getters)
    function get_mssv() { 
        return $this->mssv; 
    }
    function get_hoten() { 
        return $this->hoten; 
    }
    function get_ngaysinh() { 
        return $this->ngaysinh; 
    }

    // Hàm tính tuổi
    function tinhTuoi() {
        // Sử dụng class DateTime của PHP để tính tuổi chính xác
        $ngaySinhObj = new DateTime($this->ngaysinh);
        $hienTai = new DateTime();
        $tuoi = $hienTai->diff($ngaySinhObj);
        return $tuoi->y; // Trả về số năm (y = year)
    }

    // Phương thức hủy (Destructor)
    function __destruct() {
        echo "<br><i>[Thông báo hệ thống: Đối tượng sinh viên {$this->hoten} đã được giải phóng khỏi bộ nhớ!]</i>";
    }
}

// Khai báo 1 biến $sv có kiểu class Sinhvien và gán thông tin
$sv = new Sinhvien("B1234567", "Hứa Nguyên Chí", "2004-10-15"); // Cậu có thể sửa lại mssv và ngày sinh thật nhé

// Hiển thị kết quả ra màn hình thông qua các phương thức
echo "<h3>Thông tin sinh viên:</h3>";
echo "Mã số SV: " . $sv->get_mssv() . "<br>";
echo "Họ và tên: " . $sv->get_hoten() . "<br>";
echo "Ngày sinh: " . date("d/m/Y", strtotime($sv->get_ngaysinh())) . "<br>";

// Gọi hàm tính tuổi
echo "<b>Tuổi hiện tại: " . $sv->tinhTuoi() . " tuổi.</b><br>";
?>