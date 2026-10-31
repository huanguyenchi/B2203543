<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "qlsv";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
//tao chuoi luu cau lenh sql
$sql = "SELECT * FROM student";
//thuc thi cau lenh sql va dua doi tuong vao $result
$result = $conn->query($sql);


if ($result->num_rows > 0) {
  
  
  //cach 1: show du lieu nhu bien
  //show gia tri trong mang
	print_r ($result);
	echo '<br>';
	echo '<br>';
	
  //Cach 2: show theo tung dong voi for
  while($row = $result->fetch_assoc()) {
    echo "id: " . $row["id"]. " - Hoten: " . $row["fullname"]. " " . $row["email"].' ngaysinh: '.$row['Birthday']. "<br>";
  }
  echo '<br>';
  echo '<br>';
  //xoa ket qua cu tu o tren
  $result -> free_result();
  
  
  //Cach 3: trinh bay voi bang html
  //load du lieu moi len dua vao bien result
  $result = $conn->query($sql);
  $result_all = $result -> fetch_all();
  print_r($result_all);
  // trinh bay du lieu trong 1 bang html
  //tieu de bang
    echo "<table border=1><tr><th>ID</th><th>Hoten</th><th>email</th><th>ngaysinh</th></tr>";
    // output data of each row
    foreach ($result_all as $row) {
//dinh dang de hien thi ngay thang theo dd-mm-yyyy
		$date = date_create($row[3]);
        echo "<tr><td>" . $row[0]. "</td><td>" . $row[1]. "</td><td>" . $row[2]. "</td><td>" . 
		$date ->format('d-m-Y')
		. "</td></tr>";
    }
   echo "</table>";
  
} else {
  echo "0 ket qua tra ve";
}
// Cách 4: Hiển thị với fetch_row (Truy cập bằng chỉ số)
  echo "<h3>Cách 4: fetch_row</h3>";
  $result = $conn->query($sql);
  while($row = $result->fetch_row()) {
    echo "id: " . $row[0]. " - Hoten: " . $row[1]. " - email: " . $row[2]. " - ngaysinh: ".$row[3]. "<br>";
  }
  $result->free_result();


  // Cách 5: Hiển thị với fetch_object (Truy cập như thuộc tính của đối tượng)
  echo "<h3>Cách 5: fetch_object</h3>";
  $result = $conn->query($sql);
  while($obj = $result->fetch_object()) {
    echo "id: " . $obj->id . " - Hoten: " . $obj->fullname . " - email: " . $obj->email . " - ngaysinh: " . $obj->Birthday . "<br>";
  }
  $result->free_result();


  // Cách 6: Hiển thị với fetch_array (Kết hợp cả 2 cách truy cập)
  echo "<h3>Cách 6: fetch_array (với MYSQLI_BOTH mặc định)</h3>";
  $result = $conn->query($sql);
  while($row = $result->fetch_array()) {
    // Có thể dùng chỉ số $row[0] hoặc key $row["fullname"] đều được
    echo "id: " . $row[0] . " - Hoten: " . $row["fullname"] . " - email: " . $row[2] . " - ngaysinh: " . $row["Birthday"] . "<br>";
  }
  $result->free_result();
$conn->close();

?>

