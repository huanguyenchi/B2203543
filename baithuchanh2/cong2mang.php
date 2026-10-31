<?php
// Viết hàm xử lý cộng 2 mảng
function cong2mang($arr1, $arr2) {
    // Nếu 2 mảng không cùng độ dài thì trả về câu thông báo lỗi
    if (count($arr1) != count($arr2)) {
        return "Lỗi: Hai mảng không cùng độ dài!";
    }
    
    $ketQua = array();
    // Chạy vòng lặp để cộng từng phần tử ở cùng vị trí
    for ($i = 0; $i < count($arr1); $i++) {
        $ketQua[] = $arr1[$i] + $arr2[$i];
    }
    return $ketQua;
}

// Khai báo 2 mảng theo đề bài
$a = array(344, 224, 223, 7737, 9922, -828);
$b = array(-344, -324, 123, 773, -9922, 828);

// Gọi hàm và lưu vào biến
$mangTong = cong2mang($a, $b);

// Hiển thị kết quả
if (is_array($mangTong)) {
    echo "Kết quả cộng 2 mảng a và b là: <br>";
    echo "<pre>";
    print_r($mangTong);
    echo "</pre>";
} else {
    // Hiển thị thông báo lỗi nếu có
    echo $mangTong; 
}
?>