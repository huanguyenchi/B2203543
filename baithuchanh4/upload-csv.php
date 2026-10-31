<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Upload file CSV</title>
</head>
<body>

<h2>Import khách hàng từ file CSV</h2>

<form action="upload-csv-processing.php" method="post" enctype="multipart/form-data">
  Chọn file CSV để upload:
  <input type="file" name="fileToUpload" id="fileToUpload" accept=".csv">
  <input type="submit" value="Upload CSV" name="submit">
</form>

<p><i>File CSV gồm dòng tiêu đề: fullname,email,birthday,password<br>
Ngày sinh theo dạng yyyy-mm-dd (hoặc dd/mm/yyyy).</i></p>

</body>
</html>