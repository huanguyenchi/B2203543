<?php
// Định nghĩa hàm tính giai thừa
function tinhGiaiThua($n) {
    // Giai thừa của 0 và 1 đều bằng 1
    if ($n == 0 || $n == 1) {
        return 1;
    }
    
    $ketQua = 1;
    for ($i = 2; $i <= $n; $i++) {
        $ketQua *= $i;
    }
    return $ketQua;
}

// Chạy thử với 10!
$so = 10;
echo "Giai thừa của " . $so . "! là: " . tinhGiaiThua($so);
?>