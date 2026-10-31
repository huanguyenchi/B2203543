<?php
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// 1. Kiem tra co chon file chua
if (!isset($_POST["submit"]) || $_FILES["fileToUpload"]["error"] != UPLOAD_ERR_OK) {
    echo "Ban chua chon file hoac upload bi loi.<br>";
    $uploadOk = 0;
}

// 2. Chi chap nhan duoi .csv
if ($fileType != "csv") {
    echo "Sorry, only CSV files are allowed.<br>";
    $uploadOk = 0;
}

// 3. Kiem tra MIME type (tham khao stackoverflow)
$csvMimes = array('text/csv', 'text/plain', 'application/csv', 'text/comma-separated-values',
                  'application/vnd.ms-excel', 'application/octet-stream', 'text/x-csv');
if ($uploadOk == 1 && !in_array($_FILES["fileToUpload"]["type"], $csvMimes)) {
    echo "File khong dung dinh dang CSV.<br>";
    $uploadOk = 0;
}

// 4. Kiem tra file da ton tai
if (file_exists($target_file)) {
    echo "Sorry, file already exists.<br>";
    $uploadOk = 0;
}

// 5. Kiem tra kich thuoc file (toi da 500KB)
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.<br>";
    $uploadOk = 0;
}

if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.<br>";
    echo '<a href="upload-csv.php">Quay lai</a>';
    exit;
}

if (!move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "Sorry, there was an error uploading your file.";
    exit;
}

echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.<br>";

// ===== Doc file CSV vua upload dua vao mang (tham khao read-csv.php) =====
$csv = array();
$lines = file($target_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

// Excel luu CSV co the them ky tu BOM o dau file -> xoa di
$lines[0] = preg_replace('/^\xEF\xBB\xBF/', '', $lines[0]);

// Excel (may cai dat tieng Viet) co the dung dau ; thay cho dau ,
$delimiter = (substr_count($lines[0], ';') > substr_count($lines[0], ',')) ? ';' : ',';

foreach ($lines as $key => $value) {
    $csv[$key] = str_getcsv($value, $delimiter);
}

// ===== Ket noi CSDL =====
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "qlbanhang";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
mysqli_report(MYSQLI_REPORT_OFF);

// Dung prepared statement de chong SQL Injection (cau 2)
$stmt = $conn->prepare("INSERT INTO customers (fullname, email, birthday, password) VALUES (?, ?, ?, ?)");

$success = 0;
$fail = 0;

echo '<table border="1" cellpadding="5">';
echo '<tr><th>Dong</th><th>Fullname</th><th>Email</th><th>Birthday</th><th>Ket qua</th></tr>';

// Duyet tung dong, bo qua dong tieu de (dong 0)
for ($i = 1; $i < count($csv); $i++) {
    $row = $csv[$i];
    if (count($row) < 4) {
        echo "<tr><td>" . ($i + 1) . "</td><td colspan='3'></td><td>Thieu cot, bo qua</td></tr>";
        $fail++;
        continue;
    }

    $fullname = trim($row[0]);
    $email    = trim($row[1]);
    $pass     = md5(trim($row[3]));   // ma hoa md5 giong luu.php

    // Chap nhan ngay dang yyyy-mm-dd hoac dd/mm/yyyy (Excel hay luu kieu nay)
    $d = DateTime::createFromFormat('Y-m-d', trim($row[2]));
    if (!$d) $d = DateTime::createFromFormat('d/m/Y', trim($row[2]));
    $birthday = $d ? $d->format('Y-m-d') : null;

    $stmt->bind_param("ssss", $fullname, $email, $birthday, $pass);

    if ($stmt->execute()) {
        $result = "Them thanh cong";
        $success++;
    } else {
        $result = "Loi: " . $stmt->error;   // vd: trung email (email la UNIQUE)
        $fail++;
    }

    echo "<tr><td>" . ($i + 1) . "</td><td>" . htmlspecialchars($fullname) . "</td><td>"
        . htmlspecialchars($email) . "</td><td>" . $birthday . "</td><td>" . $result . "</td></tr>";
}
echo '</table>';

echo "<br>Tong ket: $success dong them thanh cong, $fail dong loi.<br>";
echo '<a href="upload-csv.php">Upload file khac</a>';

$stmt->close();
$conn->close();
?>